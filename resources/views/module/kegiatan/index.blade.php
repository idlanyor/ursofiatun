@push('style')
    <!-- FullCalendar CSS -->
    <link
        href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css'
        rel='stylesheet'
    />
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
                            <button
                                type="button"
                                id="createKegiatanBtn"
                                data-bs-toggle="modal"
                                data-bs-target="#createKegiatanModal"
                                class="btn btn-success btn-sm"
                            ><i class="fa fa-plus"></i>
                                Kegiatan Baru</button>
                        </div>
                        <div class="card-body">
                            <div style="max-height: 300px; overflow-y: auto;">
                                <ol class="list-group list-group-numbered">
                                    @foreach ($kegiatan as $k)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">
                                                    {{ $k->nama_kegiatan }}
                                                    <span
                                                        class="badge text-bg-primary rounded-pill">{{ $k->penanggung_jawab }}</span>
                                                </div>
                                                {{ \Carbon\Carbon::parse($k->tanggal_pelaksanaan)->translatedFormat('l,d F Y') }}

                                            </div>

                                            <button
                                                class="badge btn text-bg-info rounded-pill p-2 btn-edit-kegiatan"
                                                data-id="{{ $k->id_kegiatan }}"
                                                data-bs-toggle="modal"
                                            > <i class="fa fa-pencil-alt"></i> </button>
                                            <button
                                                class="badge btn text-bg-danger rounded-pill p-2 ml-2 btn-destroy-kegiatan"
                                                data-id="{{ $k->id_kegiatan }}"
                                                data-bs-toggle="modal"
                                            ><i class="fa fa-trash"></i></button>
                                        </li>
                                    @endforeach
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
        var calendar; // Deklarasi variabel kalender

        function renderCalendar(locale, kegiatan) {


            var events = [];
            kegiatan.forEach(function(event) {
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
                events.push({
                    title: event.nama_kegiatan,
                    start: event.tanggal_pelaksanaan,
                    color: eventColor,
                });

            });

            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: locale,
                initialView: 'dayGridMonth',
                events: events,
                dateClick: function(info) {
                    var localDate = new Date(info.date.getTime() + (7 * 60 * 60 * 1000)); // Menambahkan 7 jam
                    var formattedDate = localDate.toISOString().split('T')[0];

                    // Set nilai tanggal di input modal
                    document.getElementById('tglMulai').value = formattedDate;


                    // Tampilkan modal
                    var eventModal = new bootstrap.Modal(document.getElementById('createkegiatanT'));
                    eventModal.show();
                },
            });
            calendar.render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetch('/events') // Mengambil data events dari API
                .then(response => response.json())
                .then(data => renderCalendar('id', data)); // Render kalender Masehi dengan data dari API
        });
    </script>
@endpush
