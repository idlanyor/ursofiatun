@extends('template.scaffold')
@section('title', 'Data Guru')
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
                <h5>Data Guru</h5>
                <a href="{{ route('guru.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Tambah Data Guru</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataGuruTable"class="table align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tempat/Tgl Lahir</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($guru->count())
                                @foreach ($guru as $index => $d)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $d->id_guru }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-id="{{ $d->id_guru }}" data-bs-toggle="modal"
                                                data-bs-target="#showModal">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="px-2 btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $d->id_guru }}" data-bs-toggle="modal"
                                                data-bs-target="#destroyModal">
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

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .dt-buttons .btn {
            margin-right: 5px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('#dataGuruTable').DataTable({
                dom: 'Brftp',
                buttons: [{
                        extend: 'copy',
                        text: 'Salin',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: 'Ekspor ke Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'print',
                        text: 'Cetak',
                        className: 'btn btn-info'
                    }
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.5/i18n/id.json"
                }
            });
        })
    </script>
    @include('module.guru.edit')
    @include('module.guru.destroy')
    @include('module.guru.show')
@endsection
