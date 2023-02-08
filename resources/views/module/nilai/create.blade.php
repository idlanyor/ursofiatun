<!-- Modal Edit -->
<div class="modal fade" id="createNilai" tabindex="-1" aria-labelledby="createNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Edit Nilai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="ulangan_1" id="editUlangan1"
                            placeholder="Nilai Ulangan 1">
                        <label for="editUlangan1">Nilai Ulangan 1</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="ulangan_2" id="editUlangan2"
                            placeholder="Nilai Ulangan 2">
                        <label for="editUlangan2">Nilai Ulangan 2</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="ulangan_3" id="editUlangan3"
                            placeholder="Nilai Ulangan 3">
                        <label for="editUlangan3">Nilai Ulangan 3</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="mapel_id" id="editMapel" required>
                            <option value="" disabled>Pilih Mata Pelajaran</option>
                            @foreach ($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                        <label for="editMapel">Mata Pelajaran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="santri_id" id="editSantri" required>
                            <option value="" disabled>Pilih Santri</option>
                            @foreach ($santri as $s)
                                <option value="{{ $s->id_santri }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                        <label for="editSantri">Santri</label>
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
        var createNilai = new bootstrap.Modal(document.getElementById('createNilai'));

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/nilai/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        console.log(data);
                        document.getElementById('editUlangan1').value = data.ulangan_1;
                        document.getElementById('editUlangan2').value = data.ulangan_2;
                        document.getElementById('editUlangan3').value = data.ulangan_3;
                        document.getElementById('editMapel').value = data.mapel_id;
                        document.getElementById('editSantri').value = data.santri_id;
                        editForm.setAttribute('action', `/nilai/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data nilai.');
                    });
            });
        });

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editForm);
            var id = editForm.getAttribute('action').split('/').pop();

            axios.post(`/nilai/${id}`, formData, {
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
                        toastr.error('Terjadi kesalahan saat memperbarui data nilai.');
                    }
                });
        });
    });
</script>
