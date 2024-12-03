{{-- Modal Update Password  --}}
<div class="modal fade" id="updatePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updatePasswordForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updatePasswordModalLabel">Ganti Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <input class="form-control form-control-sm form-control-sm" name="old_password" type="password"
                        placeholder="Password Lama" aria-label="Password Lama">
                    <input class="form-control form-control-sm form-control-sm" name="new_password" type="password"
                        placeholder="Password Baru" aria-label="Password Baru">
                    <input class="form-control form-control-sm form-control-sm" name="new_password_confirmation"
                        type="password" placeholder="Konfirmasi Password Baru" aria-label="Konfirmasi Password Baru">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const updatePasswordForm = document.getElementById('updatePasswordForm');
            const updatePasswordModal = new bootstrap.Modal(document.getElementById('updatePasswordModal'));



            updatePasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(updatePasswordForm);

                axios.post(`/update-password`, formData, {
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-HTTP-Method-Override': 'PUT'
                        }
                    })
                    .then(response => {
                        if (response.data?.message) {
                            toastr.success(response.data.message);
                            // updatePasswordModal.hide();
                            window.location.reload();
                        }
                        if (response.data?.error) {
                            toastr.error(response.data.detail)
                        }
                    })
                    .catch(error => {
                        if (error.response && error.response.status === 422) {
                            const errors = error.response.data.errors;
                            Object.keys(errors).forEach(field => {
                                const errorElement = document.getElementById(`${field}_error`);
                                if (errorElement) {
                                    errorElement.textContent = errors[field][0];
                                }
                            });
                        } else {
                            toastr.error('Terjadi kesalahan saat memperbarui password.');
                        }
                    });
            });
        })
    </script>
@endpush
