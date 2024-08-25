@extends('template.scaffold')
@section('title', 'Data Tahun Ajaran')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Tahun Ajaran</h5>
                <div>
                    <a href="{{ route('tahunajaran.create') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data Tahun Ajaran</span>
                    </a>
                    <button id="deleteAllBtn" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Hapus Semua</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-xl">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Akhir</th>
                                <th>Status</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataTahunAjaran->count())
                                @foreach ($dataTahunAjaran as $index => $d)
                                    <tr>
                                        <td scope="row">{{ $index + 1 }}</td>
                                        <td>{{ $d->tahun_mulai }}</td>
                                        <td>{{ $d->tahun_akhir }}</td>
                                        <td>{{ $d->status }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $d->id }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-id="{{ $d->id }}" data-bs-toggle="modal"
                                                data-bs-target="#showModal">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn px-2"
                                                data-id="{{ $d->id }}" data-bs-toggle="modal"
                                                data-bs-target="#destroyModal">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('module.tahunajaran.edit')
    @include('module.tahunajaran.destroy')
    @include('module.tahunajaran.show')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteAllBtn = document.getElementById('deleteAllBtn');

        deleteAllBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus semua data tahun ajaran?')) {
                axios.delete('/tahunajaran/delete-all')
                    .then(response => {
                        var data = response.data;
                        if (data.success) {
                            toastr.success(data.success);
                            location.reload();
                        } else {
                            toastr.error('Terjadi kesalahan: ' + (data.error || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('There was an error deleting all data:', error);
                        toastr.error('Terjadi kesalahan saat menghapus semua data tahun ajaran.');
                    });
            }
        });
    });
</script>
