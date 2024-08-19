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
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Nama Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataKelas->count())
                                @foreach ($dataKelas as $index => $d)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $d->nama_kelas }}</td>
                                        <td>{{ $d->tahunAjaran->tahun_mulai }}/{{ $d->tahunAjaran->tahun_akhir }}</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-warning btn-sm edit-kelas-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModalKelas"
                                                data-id="{{ $d->id }}"
                                            >
                                                <i
                                                    class="fas fa-pencil-alt"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-primary btn-sm show-btn"
                                                data-id="{{ $d->id }}"
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
                                                class="btn btn-danger btn-sm delete-btn px-2"
                                                data-id="{{ $d->id }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#destroyModalKelas"
                                            >
                                                <i
                                                    class="fas fa-trash"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                        </td>
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
                </div>
            </div>
        </div>
    </div>
    @include('module.kelas.edit')
    @include('module.kelas.destroy')
    @include('module.kelas.show')
@endsection
