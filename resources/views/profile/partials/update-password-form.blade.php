<section>
    <header>
        <h2 class="h5 font-weight-bold text-dark">
            {{ __('Ubah Password') }}
        </h2>

        <p class="text-muted">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Password Saat Ini') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control"
                autocomplete="current-password">
            @error('current_password')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password Baru') }}</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                autocomplete="new-password">
            @error('password_confirmation')
                <div class="mt-2 text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="gap-4 d-flex align-items-center">
            <button type="submit" class="btn btn-sm btn-primary">{{ __('Simpan') }}</button>

            @if (session('status') === 'password-updated')
                <p class="mb-0 text-success small">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
