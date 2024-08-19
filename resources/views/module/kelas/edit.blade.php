<!-- Modal Edit -->
<div class="modal fade" id="editModalKelas" tabindex="-1" aria-labelledby="editLabelKelas" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabelKelas">Edit Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFormKelas">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama_kelas" id="editNamaKelas"
                            placeholder="Nama Kelas">
                        <label for="editNamaKelas">Nama Kelas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="id_tahun_ajaran" id="editTahunAjaran" required>
                            <option value="" disabled>Pilih Tahun Ajaran</option>
                            @foreach ($tahunAjaran as $tahun)
                                <option value="{{ $tahun->id }}">{{ $tahun->tahun_mulai }} - {{ $tahun->tahun_akhir }}</option>
                            @endforeach
                        </select>
                        <label for="editTahunAjaran">Tahun Ajaran</label>
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
        var editFormKelas = document.getElementById('editFormKelas');
        var editModalKelas = new bootstrap.Modal(document.getElementById('editModalKelas'));

        document.querySelectorAll('.edit-kelas-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/kelas/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('editNamaKelas').value = data.kelas.nama_kelas;
                        document.getElementById('editTahunAjaran').value = data.kelas.id_tahun_ajaran;
                        editFormKelas.setAttribute('action', `/kelas/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data kelas.');
                    });
            });
        });

        editFormKelas.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editFormKelas);
            var id = editFormKelas.getAttribute('action').split('/').pop();

            axios.post(`/kelas/${id}`, formData, {
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
                        toastr.error('Terjadi kesalahan saat memperbarui data kelas.');
                    }
                });
        });
    });
</script>