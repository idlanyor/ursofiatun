@extends('template.scaffold')
@section('title', 'Data Mata Pelajaran')
@section('content')
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Mapel</h5>
                <a href="{{ route('matapelajaran.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="m-2 alig-items-center">Tambah Mapel</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive-xl">
                    <table class="table text-center align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataMapel->count())
                                @foreach ($dataMapel as $index => $mapel)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $mapel->id_mata_pelajaran }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="px-2 btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $mapel->id_mata_pelajaran }}" data-bs-toggle="modal"
                                                data-bs-target="#destroyModal">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td>{{ $mapel->kode_mapel }}</td>
                                        <td>{{ $mapel->nama_mapel }}</td>
                                        <td>{{ $mapel->guru->nama }}</td>
                                        <td>{{ $mapel->kelas->nama_kelas }}</td>

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
                {{ $dataMapel->links() }}
            </div>
        </div>
    </div>
   </div>
    @include('module.mapel.edit')
    @include('module.mapel.destroy')
@endsection
