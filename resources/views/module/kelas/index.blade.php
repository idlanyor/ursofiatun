@extends('template.scaffold')
@section('title', 'Data Kelas')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Kelas</h5>
                <a
                    href="{{ route('kelas.create') }}"
                    class="btn btn-success btn-icon-split"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Tambah Data Kelas</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-xl">
                    <table
                        id="dataKelasTable"
                        class="table align-middle table-striped table-hover table-bordered"
                    >
                        <thead>
                            <tr>
                                <th style="width: 150px">#</th>
                                <th>Nama Kelas</th>
                                <th>Jumlah Santri</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataKelas->count())
                                @foreach ($dataKelas as $index => $d)
                                    <tr>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-warning btn-sm edit-kelas-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModalKelas"
                                                data-id="{{ $d->id_kelas }}"
                                            >
                                                <i
                                                    class="fas fa-pencil-alt"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-primary btn-sm show-btn"
                                                data-id="{{ $d->id_kelas }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showModalKelas"
                                            >
                                                <i
                                                    class="fas fa-eye"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="px-2 btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $d->id_kelas }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#destroyModalKelas"
                                            >
                                                <i
                                                    class="fas fa-trash"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </td>
                                        <td>{{ $d->nama_kelas }}</td>
                                        <td>{{ $jumlahSantriPerKelas[$d->id_kelas] ?? 0 }}</td>
                                        <!-- Menampilkan jumlah santri -->
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td
                                        colspan="4"
                                        class="text-center"
                                    >Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $dataKelas->links() }}
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
            $('#dataKelasTable').DataTable({
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
    @include('module.kelas.edit')
    @include('module.kelas.destroy')
    @include('module.kelas.show')
@endsection
