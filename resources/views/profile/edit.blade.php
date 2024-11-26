@extends('template.scaffold')

@section('title', 'Profil')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-4 card">
                <div class="text-center card-body">
                    <img src="https://api.dicebear.com/9.x/adventurer-neutral/svg?seed={{ Auth::user()->nama }}"
                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3 fw-bold">{{ Auth::user()->nama }}</h5>
                    <p class="mb-1">{{ Auth::user()->username }} <br> {{ Auth::user()->email }}</p>
                    <div class="mb-2 mt-3 d-flex justify-content-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateProfileModal"
                            class="btn btn-sm btn-primary">Perbarui Profil</button>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <div class="mb-4 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nama Lengkap</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-muted">{{ Auth::user()->nama }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">No. Telepon</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-muted">{{ Auth::user()->notelp }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Alamat</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-muted">{{ Auth::user()->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4 card mb-lg-0">
                        <div class="p-0 card-body">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">{{ Auth::user()->soc_website }}</p>
                                </li>
                                <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                                    <i class="fab fa-github fa-lg text-body"></i>
                                    <p class="mb-0">{{ Auth::user()->soc_github }}</p>
                                </li>
                                <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                                    <i class="fab fa-x-twitter fa-lg" style="color: #2c1800;"></i>
                                    <p class="mb-0">{{ Auth::user()->soc_x }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4 card mb-lg-0">
                        <div class="p-0 card-body">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">{{ Auth::user()->soc_ig }}</p>
                                </li>
                                <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">{{ Auth::user()->soc_fb }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- update password --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="mb-4 card mb-md-0">
                        <div class="card-body">
                            <header>
                                <h2 class="h5 font-weight-bold text-dark">
                                    {{ __('Perbarui Kata Sandi') }}
                                </h2>

                                <p class="text-muted">
                                    {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.') }}
                                </p>
                            </header>

                            <form id="updatePasswordForm" class="mt-4">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label for="current_password"
                                        class="form-label">{{ __('Kata Sandi Saat Ini') }}</label>
                                    <input id="current_password" name="current_password" type="password"
                                        class="form-control" autocomplete="current-password">
                                    <div class="mt-2 text-danger" id="current_password_error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Kata Sandi Baru') }}</label>
                                    <input id="password" name="password" type="password" class="form-control"
                                        autocomplete="new-password">
                                    <div class="mt-2 text-danger" id="password_error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation"
                                        class="form-label">{{ __('Konfirmasi Kata Sandi') }}</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" autocomplete="new-password">
                                    <div class="mt-2 text-danger" id="password_confirmation_error"></div>
                                </div>

                                <div class="gap-4 d-flex align-items-center">
                                    <button type="submit" class="btn btn-sm btn-primary">{{ __('Simpan') }}</button>
                                    <p class="mb-0 text-success small" id="success_message" style="display: none;">
                                        {{ __('Tersimpan.') }}
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Modal Perbarui Profil -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel"
        aria-hidden="true">
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
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        value="{{ Auth::user()->nama }}" placeholder="Nama">
                                    <label for="nama">Nama Lengkap</label>
                                    <div class="text-danger mt-1" id="nama_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="email"
                                        value="{{ Auth::user()->email }}" placeholder="Email">
                                    <label for="email">Email</label>
                                    <div class="text-danger mt-1" id="email_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="notelp" id="notelp"
                                        value="{{ Auth::user()->notelp }}" placeholder="No. Telepon">
                                    <label for="notelp">No. Telepon</label>
                                    <div class="text-danger mt-1" id="notelp_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" style="height: 100px">{{ Auth::user()->alamat }}</textarea>
                                    <label for="alamat">Alamat</label>
                                    <div class="text-danger mt-1" id="alamat_error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="soc_website" id="soc_website"
                                        value="{{ Auth::user()->soc_website }}" placeholder="Website">
                                    <label for="soc_website">Website</label>
                                    <div class="text-danger mt-1" id="soc_website_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="soc_github" id="soc_github"
                                        value="{{ Auth::user()->soc_github }}" placeholder="Github">
                                    <label for="soc_github">Github</label>
                                    <div class="text-danger mt-1" id="soc_github_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="soc_x" id="soc_x"
                                        value="{{ Auth::user()->soc_x }}" placeholder="X/Twitter">
                                    <label for="soc_x">X/Twitter</label>
                                    <div class="text-danger mt-1" id="soc_x_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="soc_ig" id="soc_ig"
                                        value="{{ Auth::user()->soc_ig }}" placeholder="Instagram">
                                    <label for="soc_ig">Instagram</label>
                                    <div class="text-danger mt-1" id="soc_ig_error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="soc_fb" id="soc_fb"
                                        value="{{ Auth::user()->soc_fb }}" placeholder="Facebook">
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

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let id = {{ Js::from(Auth::user()->id_user) }}
        console.log('isd', id)
        document.addEventListener('DOMContentLoaded', function() {
            const updateProfileForm = document.getElementById('updateProfileForm');
            const updatePasswordForm = document.getElementById('updatePasswordForm');
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

            updatePasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(updatePasswordForm);
                var id = updatePasswordForm.getAttribute('action').split('/').pop();

                axios.post(`/pengaturan/pengguna/${id}`, formData, {
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'X-HTTP-Method-Override': 'PUT'
                        }
                    })
                    .then(response => {
                        document.getElementById('success_message').style.display = 'block';
                        updatePasswordForm.reset();
                        setTimeout(() => {
                            document.getElementById('success_message').style.display = 'none';
                        }, 3000);
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
                            toastr.error('Terjadi kesalahan saat memperbarui kata sandi.');
                        }
                    });
            });
        });
    </script>
@endsection
