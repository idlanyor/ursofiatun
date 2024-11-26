@extends('template.scaffold')
@section('style')
    <style>
        .table td,
        .table th {
            white-space: nowrap;
        }
    </style>
@endsection
@section('title', 'Data Kelas')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Santri per Kelas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        id="dataKelasTable"
                        class="table align-middle table-striped table-hover table-bordered"
                    >
                        <thead>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tempat/Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Orang Tua</th>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($santriPerKelas->count())
                                @foreach ($santriPerKelas as $index => $d)
                                    <tr>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id="{{ $d->id_santri }}"
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
                                                data-id="{{ $d->id_santri }}"
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
                                                data-id="{{ $d->id_santri }}"
                                            >
                                                <i
                                                    class="fas fa-trash"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($d->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $d->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->telepon }}</td>
                                        <td>{{ $d->orang_tua }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td
                                        colspan="7"
                                        class="text-center"
                                    >Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $santriPerKelas->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('module.santri.edit')
    @include('module.santri.destroy')
    @include('module.santri.show')
@endsection
