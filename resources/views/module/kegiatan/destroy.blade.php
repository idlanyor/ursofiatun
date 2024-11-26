<!-- Modal Hapus -->
<div
    class="modal fade"
    id="destroyKegiatanModal"
    tabindex="-1"
    aria-labelledby="deleteLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="deleteLabel"
                >Hapus Kegiatan</h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus kegiatan ini?</p>
            </div>
            <div class="modal-footer">
                <form
                    id="destroyKegiatanForm"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')
                    <button
                        type="button"
                        class="btn btn-sm btn-secondary"
                        data-bs-dismiss="modal"
                    >Batal</button>
                    <button
                        type="submit"
                        class="btn btn-sm btn-danger"
                    >Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-destroy-kegiatan').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('destroyKegiatanForm').setAttribute('action',
                        `/kegiatan/${id}`);
                    new bootstrap.Modal(document.getElementById('destroyKegiatanModal')).show();
                });
            });

            document.getElementById('destroyKegiatanForm').addEventListener('submit', function(event) {
                event.preventDefault();
                axios.delete(this.action, {
                        headers: {
                            'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => {
                        toastr.success(response.data.message);
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                        toastr.error('Terjadi kesalahan saat menghapus kegiatan.');
                    });
            });

            document.querySelector('.btn-close').addEventListener('click', function() {
                const modal = bootstrap.Modal.getInstance(document.getElementById('destroyKegiatanModal'));
                modal.hide();
            });
        });
    </script>
@endpush
