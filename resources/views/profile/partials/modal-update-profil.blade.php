<!-- Modal Perbarui Profil -->
<div class="modal fade" id="updateProfileModal" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Perbarui Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateProfileForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="nama" id="nama"
                                    value="{{ Auth::user()->nama }}" placeholder="Nama">
                                <label for="nama">Nama Lengkap</label>
                                <div class="text-danger mt-1" id="nama_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control form-control-sm" name="email" id="email"
                                    value="{{ Auth::user()->email }}" placeholder="Email">
                                <label for="email">Email</label>
                                <div class="text-danger mt-1" id="email_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="notelp" id="notelp"
                                    value="{{ Auth::user()->notelp }}" placeholder="No. Telepon">
                                <label for="notelp">No. Telepon</label>
                                <div class="text-danger mt-1" id="notelp_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Alamat" style="height: 100px">{{ Auth::user()->alamat }}</textarea>
                                <label for="alamat">Alamat</label>
                                <div class="text-danger mt-1" id="alamat_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="soc_website"
                                    id="soc_website" value="{{ Auth::user()->soc_website }}" placeholder="Website">
                                <label for="soc_website">Website</label>
                                <div class="text-danger mt-1" id="soc_website_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="soc_github"
                                    id="soc_github" value="{{ Auth::user()->soc_github }}" placeholder="Github">
                                <label for="soc_github">Github</label>
                                <div class="text-danger mt-1" id="soc_github_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="soc_x" id="soc_x"
                                    value="{{ Auth::user()->soc_x }}" placeholder="X/Twitter">
                                <label for="soc_x">X/Twitter</label>
                                <div class="text-danger mt-1" id="soc_x_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="soc_ig" id="soc_ig"
                                    value="{{ Auth::user()->soc_ig }}" placeholder="Instagram">
                                <label for="soc_ig">Instagram</label>
                                <div class="text-danger mt-1" id="soc_ig_error"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" name="soc_fb"
                                    id="soc_fb" value="{{ Auth::user()->soc_fb }}" placeholder="Facebook">
                                <label for="soc_fb">Facebook</label>
                                <div class="text-danger mt-1" id="soc_fb_error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const updateProfileForm = document.getElementById('updateProfileForm');
            const updateProfileModal = new bootstrap.Modal(document.getElementById('updateProfileModal'));
            updateProfileForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(updateProfileForm);

                axios.post(`/pengaturan/pengguna/${id}`, formData, {
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-HTTP-Method-Override': 'PATCH'
                        }
                    })
                    .then(response => {
                        if (response.data?.message) {
                            toastr.success(response.data.message);
                            location.reload();
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
                            toastr.error('Terjadi kesalahan saat memperbarui profil.');
                        }
                    });
            });
        })
    </script>
@endpush
