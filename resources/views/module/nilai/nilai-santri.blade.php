@extends('template.scaffold')
@section('title', 'Data Nilai Santri per Kelas')
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
                <h5>Data Nilai</h5>
                <a
                    href="{{ route('nilai.create') }}"
                    class="btn btn-sm btn-success btn-icon-split"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Data Nilai</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        id="dataNilaiTable"
                        class="table table-sm align-middle table-striped table-hover table-bordered"
                    >
                        <thead>
                            <tr>
                                <th
                                    class="text-center"
                                    style="white-space: nowrap;"
                                >#</th>
                                <th style="width: 5%;">No</th>
                                <th>Nama Santri</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai Ulangan 1</th>
                                <th>Nilai Ulangan 2</th>
                                <th>Nilai Ulangan 3</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataNilai->count())
                                @foreach ($dataNilai as $index => $d)
                                    <tr>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id="{{ $d->id_nilai }}"
                                            >
                                                <i
                                                    class="fas fa-pencil-alt"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary btn-sm show-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showModal"
                                                data-id="{{ $d->id_nilai }}"
                                            >
                                                <i
                                                    class="fas fa-eye"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-sm delete-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-id="{{ $d->id_nilai }}"
                                            >
                                                <i
                                                    class="fas fa-trash"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </td>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $d->santri->nama }}</td>
                                        <td>{{ $d->mapel->nama_mapel }}</td>
                                        <td>{{ $d->ulangan_1 }}</td>
                                        <td>{{ $d->ulangan_2 }}</td>
                                        <td>{{ $d->ulangan_3 }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td
                                        colspan="8"
                                        class="text-center"
                                    >Tidak Ada Data</td>
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
            $('#dataNilaiTable').DataTable({
                dom: 'Brftp',
                buttons: [{
                        extend: 'copy',
                        text: 'Salin',
                        className: 'btn btn-sm btn-primary'
                    },
                    {
                        extend: 'excel',
                        text: 'Ekspor ke Excel',
                        className: 'btn btn-sm btn-success'
                    },
                    {
                        extend: 'print',
                        text: 'Cetak',
                        className: 'btn btn-sm btn-info'
                    }
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.5/i18n/id.json"
                }
            });
        })
    </script>
    @include('module.nilai.edit')
    @include('module.nilai.destroy')
    @include('module.nilai.show')
@endsection
