@push('style')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
@endpush

<div class="col-md-12 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kalender Kegiatan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div id='calendar'></div>
                    <div class="mt-4">
                        <p><strong>Keterangan Warna:</strong></p>
                        <div style="display: flex; align-items: center; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; margin-right: 16px;">
                                <div style="width: 20px; height: 20px; background-color: #109010;"></div>
                                <span style="margin-left: 8px;">Tahunan</span>
                            </div>
                            <div style="display: flex; align-items: center; margin-right: 16px;">
                                <div style="width: 20px; height: 20px; background-color: #000080;"></div>
                                <span style="margin-left: 8px;">Bulanan</span>
                            </div>
                            <div style="display: flex; align-items: center; margin-right: 16px;">
                                <div style="width: 20px; height: 20px; background-color: #db1514;"></div>
                                <span style="margin-left: 8px;">Mingguan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-2">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="fs-5 text-primary">Kegiatan</span>
                            <button type="button" id="createKegiatanBtn" data-bs-toggle="modal"
                                data-bs-target="#createKegiatanModal" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> Kegiatan Baru
                            </button>
                        </div>
                        <div class="card-body">
                            <div style="max-height: 300px; overflow-y: auto;">
                                <ol class="list-group list-group-numbered" id="kegiatanList">
                                    <span>Kosong</span>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('module.kegiatan.create')
@include('module.kegiatan.destroy')
@include('module.kegiatan.edit')
@include('module.kegiatan.createtahunan')

@push('script')
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        var calendarEl = document.getElementById('calendar');
        var calendar;

        function renderCalendar(locale, kegiatan) {
            var events = kegiatan.map(event => {
                let eventColor = '';
                switch (event.periode) {
                    case 'Tahunan':
                        eventColor = '#109010';
                        break;
                    case 'Bulanan':
                        eventColor = '#000080';
                        break;
                    case 'Mingguan':
                        eventColor = '#db1514';
                        break;
                    default:
                        eventColor = '#109010';
                        break;
                }
                return {
                    title: event.nama_kegiatan,
                    start: event.tanggal_pelaksanaan,
                    color: eventColor,
                };
            });

            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: locale,
                initialView: 'dayGridMonth',
                events: events,
                dateClick: function(info) {
                    var localDate = new Date(info.date.getTime() + (7 * 60 * 60 * 1000)); // Menambahkan 7 jam
                    var formattedDate = localDate.toISOString().split('T')[0];

                    document.getElementById('tanggalPelaksanaanT').value = formattedDate;
                    var eventModal = new bootstrap.Modal(document.getElementById('createKegiatanModal'));
                    eventModal.show();
                    document.querySelector('.btn-close').addEventListener('click', function(e) {
                        e.preventDefault();
                        eventModal.hide();
                    })
                },
            });
            calendar.render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetch('/events')
                .then(response => response.json())
                .then(data => renderCalendar('id', data))
                .catch(error => console.error('Error fetching events:', error));
        });
    </script>

    <script>
        async function updateKegiatanList() {
            await axios.get('/all-kegiatan')
                .then(response => {
                    let kegiatanList = document.getElementById('kegiatanList');
                    kegiatanList.innerHTML = ''; // Kosongkan daftar
                    response.data.forEach(kegiatan => {
                        let listItem = document.createElement('li');
                        listItem.className =
                            'list-group-item d-flex justify-content-between align-items-start';
                        listItem.innerHTML = `
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">
                                ${kegiatan.nama_kegiatan}
                                <span class="badge text-bg-primary rounded-pill">${kegiatan.penanggung_jawab}</span>
                            </div>
                            ${new Date(kegiatan.tanggal_pelaksanaan).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })}
                        </div>
                        <button class="badge btn text-bg-info rounded-pill p-2 btn-edit-kegiatan"
                            data-id="${kegiatan.id_kegiatan}" data-bs-toggle="modal">
                            <i class="fa fa-pencil-alt"></i>
                        </button>
                        <button class="badge btn text-bg-danger rounded-pill p-2 ms-2 btn-destroy-kegiatan"
                            data-id="${kegiatan.id_kegiatan}" data-bs-toggle="modal">
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                        kegiatanList.appendChild(listItem);
                    });
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat mengambil data kegiatan:', error);
                    toastr.error('Terjadi kesalahan saat mengambil data kegiatan.');
                });
        }
        document.addEventListener('DOMContentLoaded', async function() {


            document.getElementById('saveKegiatanBtn').addEventListener('click', function() {
                const form = document.getElementById('createKegiatanForm');
                const formData = new FormData(form);
                axios.post('/kegiatan', formData)
                    .then(async (response) => {
                        if (response.data.status) {
                            toastr.success(response.data.message);
                            await updateKegiatanList(); // Refresh daftar kegiatan
                            var eventModal = new bootstrap.Modal(document.getElementById(
                                'createKegiatanModal'));
                            eventModal.hide(); // Tutup modal
                        } else {
                            toastr.error(response.data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error creating data:', error);
                        toastr.error('Terjadi kesalahan saat menambah kegiatan.');
                    });
            });
            await updateKegiatanList();
        });
    </script>
@endpush
