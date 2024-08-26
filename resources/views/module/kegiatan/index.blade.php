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

                </div>
                <div class="col-md-6">
                    <div class="card mt-2">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="fs-5 text-primary">Kegiatan</span>
                            <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                                Kegiatan Baru</button>
                        </div>
                        <div class="card-body">
                            <div style="max-height: 300px; overflow-y: auto;">
                                <ol class="list-group list-group-numbered">
                                    @foreach ($kegiatan as $kegiatan)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{ $kegiatan->nama_kegiatan }} <span
                                                        class="badge text-bg-primary rounded-pill">{{ $kegiatan->periode }}</span>
                                                </div>
                                                {{ $kegiatan->penanggung_jawab }}

                                            </div>

                                            <button class="badge btn text-bg-info rounded-pill p-2"> <i
                                                    class="fa fa-pencil-alt"></i> </button>
                                            <button class="badge btn text-bg-danger rounded-pill p-2 ml-2"><i
                                                    class="fa fa-trash"></i></button>
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
@include('module.kegiatan.createtahunan')
@push('script')
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        var calendarEl = document.getElementById('calendar');
        var calendar; // Deklarasi variabel kalender

        function renderCalendar(locale, kegiatan) {
            if (calendar) {
                calendar.destroy(); // Hancurkan kalender yang ada
            }
            console.log(kegiatan)

            var events = [];
            kegiatan.forEach(function(event) {
                events.push({
                    title: event.nama_kegiatan,
                    start: event.tanggal_pelaksanaan,
                    end: event.tanggal_selesai,
                    color: '#db1514',
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
                    document.getElementById('tglSelesai').value = formattedDate;


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

        document.getElementById('tglMulai').addEventListener('change', function() {
            var tanggalMulai = new Date(this.value);
            var lamaKegiatan = parseInt(document.getElementById('lamaKegiatanT').value) || 1;
            var tanggalSelesai = new Date(tanggalMulai);
            tanggalSelesai.setDate(tanggalSelesai.getDate() + lamaKegiatan - 1);
            var formattedEndDate = tanggalSelesai.toISOString().split('T')[0];
        });

        document.getElementById('tglSelesai').value = tanggalPelaksanaan;
        document.getElementById('lamaKegiatanT').addEventListener('input', function() {
            var lamaKegiatan = parseInt(this.value) || 1;
            if (tanggalPelaksanaan) {
                var tanggalSelesai = new Date(tanggalPelaksanaan);
                tanggalSelesai.setDate(tanggalSelesai.getDate() + lamaKegiatan - 1);
                var formattedEndDate = tanggalSelesai.toISOString().split('T')[0];
                document.getElementById('tglSelesai').value = formattedEndDate;
            }
        });
    </script>
@endpush
