<!-- Modal Edit -->
<div
    class="modal fade"
    id="editModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="editLabel"
                >Edit Tahun Ajaran</h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="tahun_mulai"
                            id="editTahunMulai"
                            placeholder="Tahun Mulai"
                        >
                        <label for="editTahunMulai">Tahun Mulai</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="tahun_akhir"
                            id="editTahunAkhir"
                            placeholder="Tahun Akhir"
                        >
                        <label for="editTahunAkhir">Tahun Akhir</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select
                            class="form-select"
                            name="status"
                            id="editStatus"
                        >
                            <option value="">Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                        </select>
                        <label for="editStatus">Status</label>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >Close</button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >Update</button>
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
                axios.get(`/pengaturan/tahun-ajaran/${id}/edit`)
                    .then(response => {
                        var data = response.data;
                        document.getElementById('editTahunMulai').value = data.tahun_mulai;
                        document.getElementById('editTahunAkhir').value = data.tahun_akhir;
                        document.getElementById('editStatus').value = data.status;
                        editForm.setAttribute('action', `/pengaturan/tahun-ajaran/${id}`);
                    })
                    .catch(error => {
                        console.error('There was an error fetching the data:', error);
                        toastr.error('Terjadi kesalahan saat mengambil data tahun ajaran.');
                    });
            });
        });

        editForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(editForm);
            var id = editForm.getAttribute('action').split('/').pop();

            axios.post(`/pengaturan/tahun-ajaran/${id}`, formData, {
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
                        toastr.error('Terjadi kesalahan saat memperbarui data tahun ajaran.');
                    }
                });
        });
    });
</script>
