@extends('template.scaffold')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="mb-4 col-md-8">
            <div class="py-2 shadow card border-left-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center h5">
                        <div class="mr-2 col-md-12">
                            @if (Auth::user()->status === 'pending')
                                <div class="mb-0 text-gray-800">
                                    Akun Anda masih dalam status <span
                                        class="font-weight-bold">{{ Auth::user()->status }}</span>. Anda hanya
                                    bisa mengakses menu dashboard dan informasi akun.Silahkan
                                    hubungi <span class="text-danger font-weight-bold">Admin</span> untuk mengaktifkan akun
                                </div>
                            @else
                                <div class="mb-0 text-gray-800">
                                    Selamat datang <span class="font-weight-bold">{{ Auth::user()->nama }}</span>
                                    Anda Login sebagai <span
                                        class="font-weight-bold text-danger">{{ Str::title(Auth::user()->role) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 col-md-4">
            <div class="py-2 shadow card border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="mr-2 col">
                            @php
                                use Carbon\Carbon;
                                // Mendapatkan tanggal dan waktu saat ini
                                $tanggal = Carbon::now();
                            @endphp
                            <div class="mb-0 text-muted">
                                <span
                                    class="font-weight-bold text-primary">{{ $tanggal->isoFormat('dddd, D MMMM YYYY') }}</span>
                                <br><span class="fs-3" id="time-display">{{ $tanggal->format('H:i:s') }}
                                    WIB</span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if ($id_tahun_ajaran === null)
            <div class="col-md-12">
                <div class="py-2 shadow card border-left-danger">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center h5">
                            <div class="mr-2 col-md-12">
                                <div class="mb-0 text-gray-800">
                                    Tidak ada Tahun pelajaran <span
                                        class="font-weight-bold">Aktif </span>saat ini / Tahun Ajaran Belum diatur. Silahkan
                                    Pergi ke menu <a href="{{ route('pengaturan.index') }}" class="text-danger font-weight-bold">Pengaturan</a> untuk mengatur Tahun Ajaran
                                    akun
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- card kecil diatas --}}
            <a href="{{ route('santri.index') }}" class="mb-4 col-xl-3 col-md-6" style="text-decoration: none;">
                <div class="py-2 shadow card border-left-primary h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="mr-2 col">
                                <div class="mb-1 text-xs font-weight-bold text-primary text-uppercase">
                                    Jumlah Santri</div>
                                <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $jumlahSantri }} Orang</div>
                            </div>
                            <div class="col-auto">
                                <i class="text-gray-300 fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- card kecil diatas --}}
            <a href="{{ route('guru.index') }}" class="mb-4 col-xl-3 col-md-6" style="text-decoration: none;">
                <div class="py-2 shadow card border-left-success h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="mr-2 col">
                                <div class="mb-1 text-xs font-weight-bold text-success text-uppercase">
                                    Jumlah Guru</div>
                                <div class="mb-0 text-gray-800 h5 font-weight-bold">{{ $jumlahGuru }} Orang</div>
                            </div>
                            <div class="col-auto">
                                <i class="text-gray-300 fas fa-dollar-sign fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- card kecil diatas --}}
            <a href="{{ route('kelas.index') }}" class="mb-4 col-xl-3 col-md-6" style="text-decoration: none;">
                <div class="py-2 shadow card border-left-info h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="mr-2 col">
                                <div class="mb-1 text-xs font-weight-bold text-info text-uppercase">Jumlah Kelas
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="mr-3 mb-0 text-gray-800 h5 font-weight-bold">{{ $jumlahKelas }}
                                            Kelas
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mr-2 progress progress-sm">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="text-gray-300 fas fa-clipboard-list fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            {{-- card kecil diatas --}}
            <a class="mb-4 col-xl-3 col-md-6" style="text-decoration: none;" class="card-link"
                href="{{ route('pengaturan.index') }}">
                <div class="py-2 shadow card border-left-warning h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="mr-2 col">
                                <div class="mb-1 text-xs font-weight-bold text-warning text-uppercase">
                                    Permintaan Pending</div>
                                <div class="mb-0 text-gray-800 h5 font-weight-bold"> {{ $userPending }} permintaan
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="text-gray-300 fas fa-comments fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @if (Auth::user()->status === 'pending')
            @else
                @include('module.kegiatan.index')
            @endif
        @endif
    </div>

@endsection
@push('script')
    <script>
        // JavaScript untuk memperbarui waktu secara real-time
        function updateTime() {
            // Buat objek tanggal baru untuk mendapatkan waktu sekarang
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0'); // Format jam dua digit
            var minutes = now.getMinutes().toString().padStart(2, '0'); // Format menit dua digit
            var seconds = now.getSeconds().toString().padStart(2, '0'); // Format detik dua digit

            // Tampilkan waktu dalam format "HH.mm.ss"
            var timeString = hours + ':' + minutes + ':' + seconds + ' WIB';
            document.getElementById('time-display').textContent = timeString;
        }

        // Panggil fungsi updateTime setiap detik
        setInterval(updateTime, 1000);
    </script>
@endpush
