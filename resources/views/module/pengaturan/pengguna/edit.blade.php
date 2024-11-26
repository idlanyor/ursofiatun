<!-- Modal Edit -->
<div class="modal fade" id="editPenggunaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Edit Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPenggunaForm">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama" id="editNama"
                                    placeholder="Nama">
                                <label for="editNama">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="editEmail"
                                    placeholder="Email">
                                <label for="editEmail">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="editUsername"
                                    placeholder="Username">
                                <label for="editUsername">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="alamat" id="editAlamat"
                                    placeholder="Alamat">
                                <label for="editAlamat">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="notelp" id="editNotelp"
                                    placeholder="No. Telepon">
                                <label for="editNotelp">No. Telepon</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="soc_website" id="editWebsite"
                                    placeholder="Website">
                                <label for="editWebsite">Website</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="soc_github" id="editGithub"
                                    placeholder="Github">
                                <label for="editGithub">Github</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="soc_x" id="editX"
                                    placeholder="X/Twitter">
                                <label for="editX">X/Twitter</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="soc_ig" id="editInstagram"
                                    placeholder="Instagram">
                                <label for="editInstagram">Instagram</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="soc_fb" id="editFacebook"
                                    placeholder="Facebook">
                                <label for="editFacebook">Facebook</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="role" id="editRole">
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="pengurus">Pengurus</option>
                                </select>
                                <label for="editRole">Role</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="status" id="editStatus">
                                    <option value="">Pilih Status</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                    <option value="pending">Pending</option>
                                </select>
                                <label for="editStatus">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editPenggunaForm = document.getElementById('editPenggunaForm');
        var editPenggunaModal = new bootstrap.Modal(document.getElementById('editPenggunaModal'));

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/pengaturan/pengguna/${id}`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('editNama').value = data.nama;
                        document.getElementById('editEmail').value = data.email;
                        document.getElementById('editUsername').value = data.username;
                        document.getElementById('editAlamat').value = data.alamat;
                        document.getElementById('editNotelp').value = data.notelp;
                        document.getElementById('editWebsite').value = data.soc_website;
                        document.getElementById('editGithub').value = data.soc_github;
                        document.getElementById('editX').value = data.soc_x;
                        document.getElementById('editInstagram').value = data.soc_ig;
                        document.getElementById('editFacebook').value = data.soc_fb;
                        document.getElementById('editRole').value = data.role;
                        document.getElementById('editStatus').value = data.status;
                        editPenggunaForm.setAttribute('action',
                            `/pengaturan/pengguna/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data pengguna.');
                    });
            });
        });

        editPenggunaForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editPenggunaForm);
            var id = editPenggunaForm.getAttribute('action').split('/').pop();

            axios.post(`/pengaturan/pengguna/${id}`, formData, {
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'X-HTTP-Method-Override': 'PATCH'
                    }
                })
                .then(response => {
                    var data = response.data;
                    if (data?.message) {
                        toastr.success(data.message)
                        location.reload()
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        var errors = error.response.data.errors;
                        var errorMessages = Object.values(errors).flat().join('\n');
                        toastr.error('Validasi error:\n' + errorMessages);
                    } else {
                        console.error('There was an error updating the data:', error);
                        toastr.error('Terjadi kesalahan saat memperbarui data pengguna.');
                    }
                });
        });
    });
</script>
