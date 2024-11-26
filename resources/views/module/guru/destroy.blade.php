<!-- Modal Hapus -->
<div class="modal fade" id="deleteGuruModal" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteLabel">Hapus Guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data Guru ini?</p>
            </div>
            <div class="modal-footer">
                <form id="destroyGuruForm" method="POST">
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
        var destroyGuruForm = document.getElementById('destroyGuruForm');
        var destroyModal = new bootstrap.Modal(document.getElementById('deleteGuruModal'));

        // Modal Destroy
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var destroyGuruForm = document.getElementById('destroyGuruForm');
                destroyGuruForm.setAttribute('action', `/guru/${id}`);
                var deleteGuruModal = new bootstrap.Modal(document.getElementById('deleteGuruModal'));
                deleteGuruModal.show();
            });
        });
        // Handle form submission for deleting
        document.getElementById('destroyGuruForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var destroyGuruForm = document.getElementById('destroyGuruForm');
            var actionUrl = destroyGuruForm.getAttribute('action');

            if (actionUrl) {
                axios.delete(actionUrl, {
                        headers: {
                            'X-CSRF-TOKEN': destroyGuruForm.querySelector('input[name="_token"]').value
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
                            toastr.error('Terjadi kesalahan saat menghapus data Guru.');
                        }
                    });
            } else {
                toastr.error('Form action URL tidak valid.');
            }
        });
    })
</script>
@endpush
