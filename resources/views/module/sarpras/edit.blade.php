<!-- Modal Edit -->
<div class="modal fade" id="editSarprasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Edit Sarpras</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama_barang" id="editNamaBarang"
                            placeholder="Nama barang">
                        <label for="editNamaBarang">Nama barang</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="tanggal_pengadaan" id="editTglPengadaan"
                            placeholder="Tanggal Pengadaan">
                        <label for="editTglPengadaan">Tanggal Pengadaan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="kondisi" id="editKondisi" required>
                            <option value="" disabled>Pilih Kondisi</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                        <label for="editKondisi">Kondisi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="jumlah" id="editJumlah"
                            placeholder="Jumlah">
                        <label for="editJumlah">Jumlah</label>
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
        var editForm = document.getElementById('editForm');
        var editSarprasModal = new bootstrap.Modal(document.getElementById('editSarprasModal'));

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/sarpras/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        console.log(data);
                        document.getElementById('editNamaBarang').value = data.nama_barang;
                        document.getElementById('editTglPengadaan').value = data.tanggal_pengadaan;
                        document.getElementById('editKondisi').value = data.kondisi;
                        document.getElementById('editJumlah').value = data.jumlah;
                        editForm.setAttribute('action', `/sarpras/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data sarpras.');
                    });
            });
        });

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editForm);
            var id = editForm.getAttribute('action').split('/').pop();

            axios.post(`/sarpras/${id}`, formData, {
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
                        toastr.error('Terjadi kesalahan saat memperbarui data sarpras.');
                    }
                });
        });
    });
</script>
