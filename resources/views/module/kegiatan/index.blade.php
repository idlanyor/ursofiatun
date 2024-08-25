@extends('template.scaffold')
@section('title', 'Data Santri')
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
                <h5>Data Santri</h5>
                <a href="{{ route('santri.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Tambah Data Santri</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataSantriTable" class="table table-striped table-hover table-bordered align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="white-space: nowrap;">#</th>
                                <th style="width: 5%;">No</th>
                                <th>Nama</th>
                                <th>Tempat/Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Orang Tua</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataSantri->count())
                                @foreach ($dataSantri as $index => $d)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $d->id_santri }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                data-id="{{ $d->id_santri }}">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $d->id_santri }}">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($d->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $d->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->telepon }}</td>
                                        <td>{{ $d->orang_tua }}</td>
                                        <td>{{ $d->kelas->nama_kelas }}</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#dataSantriTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/Indonesian.json"
                }
            });
        })
    </script>
    @include('module.santri.edit')
    @include('module.santri.destroy')
    @include('module.santri.show')
@endsection