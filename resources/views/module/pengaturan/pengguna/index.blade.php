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
                <span class="text">Tambah Pengguna Baru</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">

            <table class="table align-middle table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center table-group-divider">
                    @if ($dataUser->count())
                        @foreach ($dataUser as $index => $d)
                            <tr>
                                <td>
                                    <button
                                        type="button"
                                        class="btn {{ $d->status == 'aktif' ? 'btn-secondary' : 'btn-primary' }} btn-sm edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        data-id="{{ $d->id_user }}"
                                    >
                                        <i
                                            class="fas {{ $d->status == 'aktif' ? 'fa-user-slash' : 'fa-user-check' }}"
                                            aria-hidden="true"
                                        ></i> {{ $d->status == 'aktif' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-info btn-sm edit-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        data-id="{{ $d->id_user }}"
                                    >
                                        <i
                                            class="fas fa-user-pen"
                                            aria-hidden="true"
                                        ></i> Edit Akun
                                    </button>
                                    <button
                                        type="button"
                                        class="px-2 btn btn-danger btn-sm delete-btn"
                                        data-id="{{ $d->id_user }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#destroyModal"
                                    >
                                        <i
                                            class="fas fa-user-xmark"
                                            aria-hidden="true"
                                        ></i> Hapus Akun
                                    </button>
                                </td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->username }}</td>
                                <td>{{ Str::title($d->role) }}</td>
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
            {{ $dataUser->links() }}
        </div>
    </div>
</div>

@include('module.pengaturan.tahunajaran.edit')
@include('module.pengaturan.tahunajaran.show')
@push('script')
@endpush
