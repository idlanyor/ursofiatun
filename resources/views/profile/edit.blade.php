@extends('template.scaffold')

@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-4 card">
                <div class="text-center card-body">
                    <img src="{{ asset('img/undraw_profile.svg') }}" alt="avatar" class="rounded-circle img-fluid"
                        style="width: 150px;">
                    <h5 class="my-3 fw-bold">{{ Auth::user()->nama }}</h5>
                    <p class="mb-1">{{ Str::title(Auth::user()->role) }} - {{ Auth::user()->status }}</p>
                    <div class="mb-2 d-flex justify-content-center">
                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Update
                            Profil</button>
                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger ms-1">Hapus
                            Akun</button>
                    </div>
                </div>
            </div>
            <div class="mb-4 card mb-lg-0">
                <div class="p-0 card-body">
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <p class="mb-0">https://roidev.com</p>
                        </li>
                        <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                            <i class="fab fa-github fa-lg text-body"></i>
                            <p class="mb-0">roidev</p>
                        </li>
                        <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                            <p class="mb-0">@roidev</p>
                        </li>
                        <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                            <p class="mb-0">roidev</p>
                        </li>
                        <li class="p-3 list-group-item d-flex justify-content-between align-items-center">
                            <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                            <p class="mb-0">roidev</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="mb-4 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-muted">{{ Auth::user()->nama }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Notelp</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-muted">(62) 81882898488</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Alamat</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 text-muted">Pluto</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-4 card mb-md-0">
                        <div class="card-body">
                            <header>
                                <h2 class="h5 font-weight-bold text-dark">
                                    {{ __('Update Password') }}
                                </h2>

                                <p class="text-muted">
                                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                </p>
                            </header>

                            <form method="post" action="{{ route('password.update') }}" class="mt-4">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                    <input id="current_password" name="current_password" type="password"
                                        class="form-control" autocomplete="current-password">
                                    @error('current_password')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                                    <input id="password" name="password" type="password" class="form-control"
                                        autocomplete="new-password">
                                    @error('password')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation"
                                        class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" autocomplete="new-password">
                                    @error('password_confirmation')
                                        <div class="mt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="gap-4 d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                                    @if (session('status') === 'password-updated')
                                        <p class="mb-0 text-success small">
                                            {{ __('Saved.') }}
                                        </p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
