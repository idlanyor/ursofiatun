@extends('template.scaffold')
@section('title', 'Dashboard')
@section('style')
    <!-- FullCalendar CSS -->
    <link
        href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css'
        rel='stylesheet'
    />
@endsection
@section('content')

    {{-- card kecil diatas --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Santri</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahSantri }} Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- card kecil diatas --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Guru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahGuru }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- card kecil diatas --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Mapel
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jumlahMataPelajaran }}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div
                                        class="progress-bar bg-info"
                                        role="progressbar"
                                        style="width: 50%"
                                        aria-valuenow="50"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

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
                                    <button
                                        type="button"
                                        class="btn btn-success btn-sm"
                                    ><i class="fa fa-plus"></i> Kegiatan Baru</button>
                                </div>
                                <div class="card-body">
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($kegiatan as $kegiatan)
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">{{ $kegiatan->nama_kegiatan }} <span
                                                            class="badge text-bg-primary rounded-pill"
                                                        >{{ $kegiatan->periode }}</span></div>
                                                    {{ $kegiatan->penanggung_jawab }}

                                                </div>

                                                <span class="badge text-bg-info rounded-pill p-2"> <i
                                                        class="fa fa-pencil-alt"
                                                    ></i> </span>
                                                <span class="badge text-bg-danger rounded-pill p-2 ml-2"><i
                                                        class="fa fa-trash"
                                                    ></i></span>
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

    <div
        class="modal fade"
        id="eventModal"
        tabindex="-1"
        aria-labelledby="eventModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="eventModalLabel"
                    >Tambah Kegiatan</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="eventName"
                                        class="form-label"
                                    >Nama Kegiatan</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="eventName"
                                        placeholder="Masukkan Nama Kegiatan"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="eventPerson"
                                        class="form-label"
                                    >Penanggung Jawab</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="eventPerson"
                                        placeholder="Masukkan Penanggung Jawab"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="lamaKegiatan"
                                        class="form-label"
                                    >Lama Kegiatan (Hari)</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="lamaKegiatan"
                                        placeholder="Masukkan Lama Kegiatan"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="schoolYear"
                                        class="form-label"
                                    >Tahun Ajaran</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="schoolYear"
                                        placeholder="Masukkan Tahun Ajaran"
                                        required
                                    >
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="eventDate"
                                        class="form-label"
                                    >Tanggal Pelaksanaan</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="eventDate"
                                        disabled
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label
                                        for="eventEndDate"
                                        class="form-label"
                                    >Tanggal Selesai</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="eventEndDate"
                                        disabled
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label
                                        for="eventPeriod"
                                        class="form-label"
                                    >Periode</label>
                                    <select
                                        class="form-control"
                                        id="eventPeriod"
                                    >
                                        <option value="Mingguan">Mingguan</option>
                                        <option value="Bulanan">Bulanan</option>
                                        <option value="Tahunan">Tahunan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >Close</button>
                    <button
                        type="button"
                        class="btn btn-primary"
                    >Simpan</button>
                </div>
            </div>
        </div>
    </div>


@endsection
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
                    color: '#007bff',
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
                    document.getElementById('eventDate').value = formattedDate;

                    // Tampilkan modal
                    var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
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

        document.getElementById('lamaKegiatan').addEventListener('input', function() {
            var lamaKegiatan = this.value;
            var tanggalPelaksanaan = document.getElementById('eventDate').value;
            var tanggalSelesai = new Date(tanggalPelaksanaan);
            tanggalSelesai.setDate(tanggalSelesai.getDate() + parseInt(lamaKegiatan));
            var formattedEndDate = tanggalSelesai.toISOString().split('T')[0];
            document.getElementById('eventEndDate').value = formattedEndDate;
        });
    </script>
@endpush
