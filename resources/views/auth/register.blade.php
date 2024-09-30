@extends('template.scaffold')
@section('title', 'Registrasi | TPQ Al-Falah')
@push('style')
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            /* background-color: #5bb2ff; */
            /* background-image: linear-gradient(to top right, #7fd3fa, #4dbd89); */
        }

        .form-container {
            display: flex;
            flex-direction: column;
            border-radius: 0.75rem;
            background-color: #fff;
            color: rgb(97, 97, 97);
            box-shadow: 20px 20px 30px rgba(0, 0, 0, .05);
            width: 22rem;
            background-clip: border-box;
        }

        .header {
            background-color: #1ee5db;
            background-image: linear-gradient(to top right, #208f1100, #1ba564);
            margin: 10px;
            border-radius: 0.75rem;
            color: #fff;
            box-shadow: rgba(33, 150, 243, .4);
            height: 7rem;
            font-weight: 600;
            font-size: 1.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-body {
            padding: 1.5rem;
            gap: 1rem;
            display: flex;
            flex-direction: column;
        }

        .input-field {
            border: 1px solid rgba(128, 128, 128, 0.61);
            color: rgb(69, 90, 100);
            padding: 0.75rem;
            border-radius: .375rem;
            font-size: .9rem;
            background-color: transparent;
            transition: border-color 0.2s ease;
        }

        .input-field:focus {
            border-color: #1e88e5;
            outline: none;
            box-shadow: none;
        }

        .error-message {
            font-size: 0.85rem;
            color: #e74c3c;
        }

        .sigin-btn {
            text-transform: uppercase;
            font-weight: 700;
            font-size: .75rem;
            text-align: center;
            padding: .75rem 1.5rem;
            cursor: pointer;
            background-color: #34a59f;
            background-image: linear-gradient(to top right, #208f1100, #1ba564);
            border-radius: .5rem;
            color: #fff;
            border: none;
        }

        .signup-link {
            font-weight: 300;
            font-size: 0.875rem;
            text-align: center;
        }

        .signup-link a {
            text-decoration: none;
            font-weight: 700;
            color: #1e88e5;
            margin-left: .25rem;
        }
    </style>
@endpush

@section('content-guest')
    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <div class="form-container">
            <div class="header">TPQ Al - Falah</div>
            <form class="form-body" method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" name="nama" placeholder="Nama" class="form-control input-field"
                    value="{{ old('nama') }}">
                <x-input-error :messages="$errors->get('nama')" class="error-message" />

                <input type="text" name="username" placeholder="Username" class="form-control input-field"
                    value="{{ old('username') }}">
                <x-input-error :messages="$errors->get('username')" class="error-message" />

                <input type="password" name="password" placeholder="Password" class="form-control input-field"
                    value="{{ old('password') }}">
                <x-input-error :messages="$errors->get('password')" class="error-message" />

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                    class="form-control input-field" value="{{ old('password_confirmation') }}">
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />

                <button type="submit" class="sigin-btn">Daftar</button>

                <p class="signup-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
            </form>
        </div>
    </div>
@endsection
