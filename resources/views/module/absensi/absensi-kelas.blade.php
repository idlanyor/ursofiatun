@extends('template.scaffold')
@section('title', 'Data Absensi')
@section('style')
    <style>
        .table td,
        .table th {
            white-space: nowrap;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Absensi per Kelas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataAbsensiTable" class="table table-sm align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Kelas</th>
                                <th>Jumlah Santri</th>
                                <th>Jumlah Mapel</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            @if ($kelas->count())
                                @foreach ($kelas as $index => $d)
                                    <tr>
                                        <td>
                                            <a type="button" class="btn btn-sm btn-primary btn-sm show-btn"
                                                href="{{ route('absensi.show', $d->id_kelas). '?bulan=Januari' }}">
                                                <i class="fas fa-table" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="text-left">{{ $d->nama_kelas }}</td>
                                        <td>{{ $jumlahSantriPerKelas[$d->id_kelas] ?? 0 }}</td>
                                        <td>{{ $jumlahMapelPerKelas[$d->id_kelas] ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
