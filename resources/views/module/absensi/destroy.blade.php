<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteLabel">Hapus Santri</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data santri ini?</p>
            </div>
            <div class="modal-footer">
                <form id="destroySantriForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var destroySantriForm = document.getElementById('destroySantriForm');
            var destroyModal = new bootstrap.Modal(document.getElementById('deleteModal'));

            // Modal Destroy
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var destroySantriForm = document.getElementById('destroySantriForm');
                    destroySantriForm.setAttribute('action', `/santri/${id}`);
                    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    deleteModal.show();
                });
            });
            // Handle form submission for deleting
            document.getElementById('destroySantriForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var destroySantriForm = document.getElementById('destroySantriForm');
                var actionUrl = destroySantriForm.getAttribute('action');

                if (actionUrl) {
                    axios.delete(actionUrl, {
                            headers: {
                                'X-CSRF-TOKEN': destroySantriForm.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => {
                            var data = response.data;
                            if (data.success) {
                                toastr.success(data.success);
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
                                console.error('There was an error deleting the data:', error);
                                toastr.error('Terjadi kesalahan saat menghapus data santri.');
                            }
                        });
                } else {
                    toastr.error('Form action URL tidak valid.');
                }
            });
        })
    </script>
@endpush
