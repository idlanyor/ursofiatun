<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Data Tahun Ajaran</h5>
        <div>
            <a
                {{-- href="{{ route('tahunajaran.create') }}" --}}
                class="btn btn-success btn-icon-split"
            >
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Tahun Mulai</th>
                        <th>Tahun Akhir</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    @if ($dataTahunAjaran->count())
                        @foreach ($dataTahunAjaran as $index => $d)
                            <tr>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        data-id="{{ $d->id_tahun_ajaran }}"
                                    >
                                        <i
                                            class="fas fa-pencil-alt"
                                            aria-hidden="true"
                                        ></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm delete-btn px-2"
                                        data-id="{{ $d->id_tahun_ajaran }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#destroyModal"
                                    >
                                        <i
                                            class="fas fa-trash"
                                            aria-hidden="true"
                                        ></i>
                                    </button>
                                </td>
                                <td>{{ $d->tahun_mulai }}</td>
                                <td>{{ $d->tahun_akhir }}</td>
                                <td>{{ $d->status }}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td
                                colspan="5"
                                class="text-center"
                            >Tidak Ada Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $dataTahunAjaran->links() }}
        </div>
    </div>
</div>

@include('module.pengaturan.tahunajaran.edit')
@include('module.pengaturan.tahunajaran.show')
@push('script')
@endpush
