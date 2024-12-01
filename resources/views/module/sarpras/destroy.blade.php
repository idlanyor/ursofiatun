<!-- Modal Hapus -->
<div class="modal fade" id="deleteSarprasModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteLabel">Hapus Sarpras</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data sarpras ini?</p>
            </div>
            <div class="modal-footer">
                <form id="destroySarprasForm" method="POST">
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
            var destroySarprasForm = document.getElementById('destroySarprasForm');
            var destroyModal = new bootstrap.Modal(document.getElementById('deleteSarprasModal'));

            // Modal Destroy
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var destroySarprasForm = document.getElementById('destroySarprasForm');
                    destroySarprasForm.setAttribute('action', `/sarpras/${id}`);
                    var deleteSarprasModal = new bootstrap.Modal(document.getElementById(
                        'deleteSarprasModal'));
                    deleteSarprasModal.show();
                });
            });
            // Handle form submission for deleting
            document.getElementById('destroySarprasForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var destroySarprasForm = document.getElementById('destroySarprasForm');
                var actionUrl = destroySarprasForm.getAttribute('action');

                if (actionUrl) {
                    axios.delete(actionUrl, {
                            headers: {
                                'X-CSRF-TOKEN': destroySarprasForm.querySelector('input[name="_token"]')
                                    .value
                            }
                        })
                        .then(response => {
                            var data = response.data;
                            if (data.message) {
                                toastr.success(data.message);
                                location.reload();
                            } else {
                                toastr.error(data.error);
                            }
                        })
                        .catch(error => {
                            if (error.response && error.response.status === 422) {
                                var errors = error.response.data.errors;
                                var errorMessages = Object.values(errors).flat().join('\n');
                                toastr.error('Validasi error:\n' + errorMessages);
                            } else {
                                console.error('There was an error deleting the data:', error);
                                toastr.error('Terjadi kesalahan saat menghapus data sarpras.');
                            }
                        });
                } else {
                    toastr.error('Form action URL tidak valid.');
                }
            });
        })
    </script>
@endpush
