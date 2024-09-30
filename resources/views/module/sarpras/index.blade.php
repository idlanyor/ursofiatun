@extends('template.scaffold')
@section('title', 'Data Sarpras')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Sarpras</h5>
                <a href="{{ route('sarpras.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Tambah Data Sarpras</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataSarprasTable" class="table align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="white-space: nowrap;">#</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pengadaan</th>
                                <th>Kondisi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataSarpras->count())
                                @foreach ($dataSarpras as $index => $d)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $d->id_sarpras }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                data-id="{{ $d->id_sarpras }}">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $d->id_sarpras }}">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td>{{ $d->nama_barang }}</td>
                                        <td>{{ $d->tanggal_pengadaan }}</td>
                                        <td>{{ $d->kondisi }},
                                        <td>{{ $d->jumlah }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $dataSarpras->links() }}
                    </div>
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
            $('#dataSarprasTable').DataTable({
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
    {{-- @include('module.sarpras.edit')
    @include('module.sarpras.destroy')
    @include('module.sarpras.show') --}}
@endsection
