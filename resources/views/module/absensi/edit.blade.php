<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Edit Santri</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="nama" id="editNama" placeholder="Nama Santri">
                        <label for="editNama">Nama Santri</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="editTempatLahir" placeholder="Tempat Lahir">
                                <label for="editTempatLahir">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control form-control-sm" name="tanggal_lahir" id="editTanggalLahir" placeholder="Tanggal Lahir">
                                <label for="editTanggalLahir">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control form-control-sm" name="jenis_kelamin" id="editJenisKelamin" required>
                            <option value="" disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <label for="editJenisKelamin">Jenis Kelamin</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="orang_tua" id="editOrangTua" placeholder="Orang Tua">
                                <label for="editOrangTua">Orang Tua</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="telepon" id="editTelepon" placeholder="Telepon">
                                <label for="editTelepon">Telepon</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-sm" name="alamat" id="editAlamat" placeholder="Alamat">
                        <label for="editAlamat">Alamat</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editForm = document.getElementById('editForm');
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/santri/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('editNama').value = data.nama;
                        document.getElementById('editTempatLahir').value = data.tempat_lahir;
                        document.getElementById('editTanggalLahir').value = data.tanggal_lahir;
                        document.getElementById('editJenisKelamin').value = data.jenis_kelamin;
                        document.getElementById('editOrangTua').value = data.orang_tua;
                        document.getElementById('editTelepon').value = data.telepon || '';
                        document.getElementById('editAlamat').value = data.alamat || '';
                        editForm.setAttribute('action', `/santri/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data santri.');
                    });
            });
        });

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editForm);
            var id = editForm.getAttribute('action').split('/').pop();

            axios.post(`/santri/${id}`, formData, {
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'X-HTTP-Method-Override': 'PUT'
                    }
                })
                .then(response => {
                    var data = response.data;
                    if (data.success) {
                        toastr.success(data.success)
                        location.reload();
                    } else {
                        toastr.error('Terjadi kesalahan: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        var errors = error.response.data.errors;
                        var errorMessages = Object.values(errors).flat().join('\n');
                        toastr.error('Validasi error:\n' + errorMessages);
                    } else {
                        console.log(error);
                        console.error('There was an error updating the data:', error);
                        toastr.error('Terjadi kesalahan saat memperbarui data santri.');
                    }
                });
        });
    });
</script>
