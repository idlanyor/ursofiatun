@extends('template.scaffold')
@section('title', 'Data Guru')
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
        <div class="card text-black">
            <div class="card-header d-flex justify-content-between">
                <h5>Data Guru</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.export') }}" class="btn btn-sm btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-export"></i>
                        </span>
                        <span class="text">Export Excel</span>
                    </a>
                    <button type="button" class="btn btn-sm btn-info btn-icon-split" data-bs-toggle="modal" data-bs-target="#importModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-import"></i>
                        </span>
                        <span class="text">Import Excel</span>
                    </button>
                    <a href="{{ route('template.guru.download') }}" class="btn btn-sm btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-download"></i>
                        </span>
                        <span class="text">Download Template</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataGuruTable"class="table table-sm text-black align-middle table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tempat/Tgl Lahir</th>
                                <th>JK</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if ($guru->count())
                                @foreach ($guru as $index => $d)
                                    <tr>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-warning btn-sm edit-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id="{{ $d->id_guru }}"
                                            >
                                                <i
                                                    class="fas fa-pencil-alt"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary btn-sm show-btn"
                                                data-id="{{ $d->id_guru }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#showModal"
                                            >
                                                <i
                                                    class="fas fa-eye"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="px-2 btn btn-sm btn-danger btn-sm delete-btn"
                                                data-id="{{ $d->id_guru }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#destroyModal"
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
                    <div class="mt-3">
                        {{ $guru->links() }}
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
            $('#dataGuruTable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.5/i18n/id.json"
                }
            });
        })
    </script>
    @include('module.guru.edit')
    @include('module.guru.destroy')
    @include('module.guru.show')

    <!-- Tambahkan Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="importForm" action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control form-control-sm" id="file" name="file" accept=".xlsx,.xls" required>
                        </div>
                        <div class="alert alert-info">
                            <small>
                                <p>Catatan:</p>
                                <ul class="mb-0">
                                    <li>Gunakan template yang sudah disediakan</li>
                                    <li>Pastikan format tanggal sesuai (YYYY-MM-DD)</li>
                                    <li>Jenis kelamin hanya L atau P</li>
                                </ul>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('template.guru.download') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-download"></i> Download Template
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">
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
@endsection
