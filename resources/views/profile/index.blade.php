@extends('template.scaffold')

@section('title', 'Profil')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-4 card">
                <div class="text-center card-body">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#updateFotoModal">
                        @if (Auth::user()->foto_profil === null)
                            <img src="https://api.dicebear.com/9.x/adventurer-neutral/svg?seed={{ Auth::user()->nama }}"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        @else
                            <img src="{{ asset(Auth::user()->foto_profil) }}" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 150px;">
                        @endif
                    </a>
                    <h5 class="my-3 fw-bold">{{ Auth::user()->nama }}</h5>
                    <p class="mb-1">{{ Auth::user()->username }} <br> {{ Auth::user()->email }}</p>
                    <div class="mb-2 mt-3 d-flex justify-content-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateProfileModal"
                            class="btn btn-sm btn-primary">Perbarui Profil</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updatePasswordModal"
                            class=" mx-1 btn btn-sm btn-danger">Ubah Password</button>
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
        </div>
    </div>
    @push('style')
        <script>
            let id = {{ Js::from(Auth::user()->id_user) }}
        </script>
    @endpush
    @include('profile.partials.modal-update-profil');
    @include('profile.partials.modal-update-password');
    @include('profile.partials.modal-update-foto');
@endsection
