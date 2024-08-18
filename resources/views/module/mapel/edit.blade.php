<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Edit Mata Pelajaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="kode_mapel" id="editKodeMapel"
                            placeholder="Kode Mata Pelajaran">
                        <label for="editKodeMapel">Kode Mata Pelajaran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama_mapel" id="editNamaMapel"
                            placeholder="Nama Mata Pelajaran">
                        <label for="editNamaMapel">Nama Mata Pelajaran</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="guru_id" id="editGuruId" required>
                            <option value="" disabled>Pilih Guru</option>
                            @foreach($guru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                        <label for="editGuruId">Guru</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-control" name="kelas_id" id="editKelasId" required>
                            <option value="" disabled>Pilih Kelas</option>
                            @foreach($kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                        <label for="editKelasId">Kelas</label>
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
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));

        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                axios.get(`/matapelajaran/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('editKodeMapel').value = data.kode_mapel;
                        document.getElementById('editNamaMapel').value = data.nama_mapel;
                        document.getElementById('editGuruId').value = data.guru_id;
                        document.getElementById('editKelasId').value = data.kelas_id;
                        editForm.setAttribute('action', `/matapelajaran/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data mata pelajaran.');
                    });
            });
        });

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editForm);
            var id = editForm.getAttribute('action').split('/').pop();

            axios.post(`/matapelajaran/${id}`, formData, {
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
                        toastr.error('Terjadi kesalahan saat memperbarui data mata pelajaran.');
                    }
                });
        });
    });
</script>
