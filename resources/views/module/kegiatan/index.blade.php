@push('style')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
@endpush

<div class="mb-4 col-md-12">
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Kalender Kegiatan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            Mingguan
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse show"
                                        data-bs-parent="#accordionFlushExample">
                                        <div style="max-height: 300px; overflow-y: auto;">
                                            <ol class="list-group list-group-numbered">
                                                @foreach ($mingguan as $d)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">
                                                                {{ $d->nama_kegiatan }}
                                                                <span
                                                                    class="badge text-bg-primary rounded-pill">{{ $d->penanggung_jawab }}</span>
                                                            </div>
                                                            {{ \Carbon\Carbon::parse($d->tanggal_pelaksanaan)->translatedFormat('l, d F Y') }}
                                                        </div>

                                                        <button
                                                            class="p-2 badge btn text-bg-info rounded-pill btn-edit-kegiatan"
                                                            data-id="{{ $d->id_kegiatan }}" data-bs-toggle="modal">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button
                                                            class="p-2 badge btn text-bg-danger rounded-pill ms-2 btn-destroy-kegiatan"
                                                            data-id="{{ $d->id_kegiatan }}" data-bs-toggle="modal">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                            aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Bulanan
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div style="max-height: 300px; overflow-y: auto;">
                                            <ol class="list-group list-group-numbered">
                                                @foreach ($bulanan as $d)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">
                                                                {{ $d->nama_kegiatan }}
                                                                <span
                                                                    class="badge text-bg-primary rounded-pill">{{ $d->penanggung_jawab }}</span>
                                                            </div>
                                                            {{ \Carbon\Carbon::parse($d->tanggal_pelaksanaan)->translatedFormat('l, d F Y') }}
                                                        </div>

                                                        <button
                                                            class="p-2 badge btn text-bg-info rounded-pill btn-edit-kegiatan"
                                                            data-id="{{ $d->id_kegiatan }}" data-bs-toggle="modal">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button
                                                            class="p-2 badge btn text-bg-danger rounded-pill ms-2 btn-destroy-kegiatan"
                                                            data-id="{{ $d->id_kegiatan }}" data-bs-toggle="modal">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Tahunan
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div style="max-height: 300px; overflow-y: auto;">
                                            <ol class="list-group list-group-numbered">
                                                @foreach ($tahunan as $d)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">
                                                                {{ $d->nama_kegiatan }}
                                                                <span
                                                                    class="badge text-bg-primary rounded-pill">{{ $d->penanggung_jawab }}</span>
                                                            </div>
                                                            {{ \Carbon\Carbon::parse($d->tanggal_pelaksanaan)->translatedFormat('l, d F Y') }}
                                                        </div>

                                                        <button
                                                            class="p-2 badge btn text-bg-info rounded-pill btn-edit-kegiatan"
                                                            data-id="{{ $d->id_kegiatan }}" data-bs-toggle="modal">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button
                                                            class="p-2 badge btn text-bg-danger rounded-pill ms-2 btn-destroy-kegiatan"
                                                            data-id="{{ $d->id_kegiatan }}" data-bs-toggle="modal">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
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
        </div>
    </div>
</div>

@include('module.kegiatan.create')
@include('module.kegiatan.edit')
@include('module.kegiatan.destroy')

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
@endpush
