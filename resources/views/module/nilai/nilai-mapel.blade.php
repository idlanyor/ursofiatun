@extends('template.scaffold')
@section('title', 'Data Nilai')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Nilai</h5>
                <a href="{{ route('nilai.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Data Nilai</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataNilaiTable" class="table align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataMapel->count())
                                @foreach ($dataMapel as $index => $d)
                                    <tr>
                                        <td>
                                            <a href="{{ route('nilai.create') }}" class="btn btn-primary btn-sm"
                                                data-id="{{ $d->id_nilai }}">
                                                <i class="fas fa-list-check" aria-hidden="true"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $d->id_nilai }}">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td>{{ $d->nama_mapel }}</td>
                                        <td>{{ $d->kelas->nama_kelas }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $dataMapel->links() }}
            </div>
        </div>
    </div>
    <style>
        .dt-buttons .btn {
            margin-right: 5px;
        }
    </style>
@endsection
