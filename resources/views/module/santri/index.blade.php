@extends('template.scaffold')
@section('title', 'Data Santri')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex gap-2">
                    <a href="{{ route('santri.export') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-export"></i>
                        </span>
                        <span class="text">Export Excel</span>
                    </a>
                    <button type="button" class="btn btn-info btn-icon-split" data-bs-toggle="modal"
                        data-bs-target="#importModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-import"></i>
                        </span>
                        <span class="text">Import Excel</span>
                    </button>
                    <a href="{{ route('template.santri.download') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-download"></i>
                        </span>
                        <span class="text">Download Template</span>
                    </a>
                    <a href="{{ route('santri.create') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-user-plus"></i>
                        </span>
                        <span class="text">Tambah Data Santri</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataSantriTable" class="table align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="white-space: nowrap;">#</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tempat/Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($dataSantri->count())
                                @foreach ($dataSantri as $index => $d)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $d->id_santri }}">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm show-btn"
                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                data-id="{{ $d->id_santri }}">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $d->id_santri }}">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->kelas->nama_kelas }}</td>
                                        <td>{{ $d->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($d->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $d->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>

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
                        {{ $dataSantri->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Santri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="importForm" action="{{ route('santri.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls"
                                required>
                        </div>
                        <div class="alert alert-info">
                            <small>
                                <p>Catatan:</p>
                                <ul class="mb-0">
                                    <li>Gunakan template yang sudah disediakan</li>
                                    <li>Pastikan format tanggal sesuai (YYYY-MM-DD)</li>
                                    <li>Jenis kelamin hanya L atau P</li>
                                    <li>ID Kelas harus sesuai dengan yang ada di database</li>
                                </ul>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('template.santri.download') }}" class="btn btn-secondary">
                            <i class="fas fa-download"></i> Download Template
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            document.getElementById('importForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                axios.post(this.action, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            toastr.success(response.data.success);
                            location.reload();
                        }
                    })
                    .catch(error => {
                        toastr.error(error.response.data.error || 'Terjadi kesalahan saat import data');
                    });
            });
        </script>
    @endpush
    @include('module.santri.edit')
    @include('module.santri.destroy')
    @include('module.santri.show')
@endsection
