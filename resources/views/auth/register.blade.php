<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In | TPQ Al - Falah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #1e88e5;
            background-image: linear-gradient(to top right, #1e88e5, #42a5f5);
        }

        .form {
            position: relative;
            display: flex;
            flex-direction: column;
            border-radius: 0.75rem;
            background-color: #fff;
            color: rgb(97 97 97);
            box-shadow: 20px 20px 30px rgba(0, 0, 0, .05);
            width: 22rem;
            background-clip: border-box;
        }

        .header {
            position: relative;
            background-clip: border-box;
            background-color: #1e88e5;
            background-image: linear-gradient(to top right, #1e88e5, #42a5f5);
            margin: 10px;
            border-radius: 0.75rem;
            overflow: hidden;
            color: #fff;
            box-shadow: 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 0 #0000, rgba(33, 150, 243, .4);
            height: 7rem;
            letter-spacing: 0;
            line-height: 1.375;
            font-weight: 600;
            font-size: 1.9rem;
            font-family: Roboto, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inputs {
            padding: 1.5rem;
            gap: 1rem;
            display: flex;
            flex-direction: column;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            min-width: 200px;
            width: 100%;
            height: 2.75rem;
            position: relative;
        }

        .input {
            border: 1px solid rgba(128, 128, 128, 0.61);
            outline: 0;
            color: rgb(69 90 100);
            font-weight: 400;
            font-size: .9rem;
            line-height: 1.25rem;
            padding: 0.75rem;
            background-color: transparent;
            border-radius: .375rem;
            height: 100%;
        }

        .input:focus {
            border: 1px solid #1e88e5;
        }

        .checkbox-container {
            margin-left: -0.625rem;
            display: inline-flex;
            align-items: center;
        }

        .checkbox {
            position: relative;
            overflow: hidden;
            padding: .55rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.027);
            height: 35px;
            width: 35px;
        }

        .checkbox input {
            width: 100%;
            height: 100%;
        }



        .sigin-btn {
            text-transform: uppercase;
            font-weight: 700;
            font-size: .75rem;
            line-height: 1rem;
            text-align: center;
            padding: .75rem 1.5rem;
            cursor: grabbing;
            background-color: #1e88e5;
            background-image: linear-gradient(to top right, #1e88e5, #42a5f5);
            border-radius: .5rem;
            width: 100%;
            outline: 0;
            border: 0;
            color: #fff;
        }

        .signup-link {
            line-height: 1.5;
            font-weight: 300;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-link a,
        .forget {
            line-height: 1.5;
            font-weight: 700;
            font-size: .875rem;
            margin-left: .25rem;
            color: #1e88e5;
        }

        .forget {
            text-align: right;
            font-weight: 600;
        }
    </style>

</head>

<body class="flex justify-center items-center w-screen h-screen">
    <form class="form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="header">TPQ Al - Falah</div>
        <div class="inputs">
            <input placeholder="Nama" class="input" type="text" name="nama" value="{{ old('nama') }}">
            <x-input-error :messages="$errors->get('nama')" class="text-danger" />
            <input placeholder="Username" class="input" type="text" name="username" value="{{ old('username') }}">
            <x-input-error :messages="$errors->get('username')" class="text-danger" />
            <input placeholder="Password" class="input" type="password" name="password" value="{{ old('password') }}">
            <x-input-error :messages="$errors->get('password')" class="text-danger" />
            <input value="{{ old('password_confirmation') }}" placeholder="Konfirmasi Password" class="input" type="password" name="password_confirmation"
                autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
            <button class="sigin-btn" type="submit">Daftar</button>
            <p class="signup-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div>
    </form>
</body>

</html>
{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')"
                required autofocus autocomplete="nama" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" class="block mt-1 w-full" name="role" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="pengurus">Pengurus</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

        </div>

        <div class="flex justify-end items-center mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
