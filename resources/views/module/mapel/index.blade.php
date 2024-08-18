@extends('template.scaffold')
@section('title', 'Data Mata Pelajaran')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Mata Pelajaran</h5>
                <a href="{{ route('matapelajaran.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Data Mata Pelajaran</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-xl">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataMapel->count())
                                @foreach ($dataMapel as $index => $mapel)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $mapel->kode_mapel }}</td>
                                        <td>{{ $mapel->nama_mapel }}</td>
                                        <td>{{ $mapel->guru->nama ?? 'Tidak Ada' }}</td>
                                        <td>{{ $mapel->kelas->nama_kelas ?? 'Tidak Ada' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $mapel->id }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-id="{{ $mapel->id }}" data-bs-toggle="modal"
                                                data-bs-target="#showModal">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn px-2"
                                                data-id="{{ $mapel->id }}" data-bs-toggle="modal"
                                                data-bs-target="#destroyModal">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
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
    @include('module.mapel.edit')
    @include('module.mapel.destroy')
    @include('module.mapel.show')
@endsection
