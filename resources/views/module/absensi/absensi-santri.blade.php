@extends('template.scaffold')
@section('title', 'Data Absensi')
@section('style')
    <style>
        .table td,
        .table th {
            white-space: nowrap;
            text-align: center;
        }

        .table td input[type="text"] {
            width: 30px;
            padding: 2px;
            text-align: center;
            border: 1px solid #ced4da;
            background-color: green;
            color: white;
            border-radius: 4px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Absensi</h5>
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Bulan
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($absensiKelas as $d)
                            <li><a class="dropdown-item" href="#">{{ $d->bulan }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('absensi.store') }}" method="post">
                    @csrf
                    {{-- <input type="hidden" name="kelas_id" value="{{ $kelas->id_kelas }}"> --}}
                    <input type="hidden" name="absensi_kelas_id" value="{{ $idAbsen }}">
                    <div class="table-responsive">
                        <table id="dataAbsensiTable" class="table align-middle table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <th>{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach ($absensiSantri as $d)
                                    <tr>
                                        <td class="text-left">{{ $d->nama }}</td>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <td>
                                                <input type="text"
                                                    name="absensi[{{ $d->santri_id }}][{{ $i }}]"
                                                    list="jenis_absen" value="H" maxlength="1" onfocus="this.value=''"
                                                    oninput="changeBgInput(this, this.value)">
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <datalist id="jenis_absen">
                            <option value="H">
                            <option value="S">
                            <option value="I">
                            <option value="A">
                        </datalist>
                    </div>
                    <div class="mt-3 float-end">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-floppy-disk"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <script>
        function changeBgInput(el, val) {
            switch (val) {
                case 'H':
                    el.style.backgroundColor = 'green';
                    el.style.color = 'white'; // Text color for H
                    break;
                case 'S':
                    el.style.backgroundColor = 'yellow';
                    el.style.color = 'black'; // Text color for S (yellow bg, so black text)
                    break;
                case 'I':
                    el.style.backgroundColor = 'blue';
                    el.style.color = 'white'; // Text color for I
                    break;
                case 'A':
                    el.style.backgroundColor = 'red';
                    el.style.color = 'white'; // Text color for A
                    break;
                default:
                    el.style.backgroundColor = '';
                    el.style.color = ''; // Reset text color
                    break;
            }
        }
    </script>
@endpush
