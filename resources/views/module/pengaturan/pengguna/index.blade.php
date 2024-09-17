<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Data Akun Pengguna</h5>
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
                                    <button type="button"
                                        class="btn {{ $d->status == 'aktif' ? 'btn-secondary' : 'btn-primary' }} btn-sm cek-status-btn"
                                        data-bs-toggle="modal" data-bs-target="#cekStatusModal"
                                        data-id="{{ $d->id_user }}" data-status="{{ $d->status }}">
                                        <i class="fas {{ $d->status == 'aktif' ? 'fa-user-slash' : 'fa-user-check' }}"
                                            aria-hidden="true"></i>
                                        {{ $d->status == 'aktif' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}
                                    </button>

                                    <button type="button" class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $d->id_user }}">
                                        <i class="fas fa-user-pen" aria-hidden="true"></i> Edit Akun
                                    </button>
                                    <button type="button" class="px-2 btn btn-danger btn-sm destroyUserModal-btn"
                                        data-id="{{ $d->id_user }}" data-bs-toggle="modal"
                                        data-bs-target="#destroyUserModal">
                                        <i class="fas fa-user-xmark" aria-hidden="true"></i> Hapus Akun
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
                            <td colspan="5" class="text-center">Tidak Ada Data</td>
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
@include('module.pengaturan.pengguna.destroy')
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua tombol edit
            document.querySelectorAll('.cek-status-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Ambil ID dan status dari data attribute
                    var userId = this.getAttribute('data-id');
                    var currentStatus = this.getAttribute('data-status');

                    // Tentukan status baru
                    var newStatus = currentStatus === 'aktif' ? 'pending' : 'aktif';

                    // Kirim permintaan PUT
                    fetch(`/pengaturan/pengguna/${userId}/update-status`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                // Beri tahu pengguna tentang perubahan status
                                toastr.success(data.message);
                                // Refresh halaman atau bagian tabel
                                location.reload();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endpush
