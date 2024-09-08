<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('alfalah.png') }}" type="image/x-icon">
    <title>Log In | TP Al - Falah</title>
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
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="header">TP Al - Falah</div>
        <div class="inputs">
            <input placeholder="Username" class="input" type="text" name="username" required>
            <input placeholder="Password" class="input" type="password" name="password" required>
            <div class="checkbox-container">
                <label class="checkbox">
                    <input type="checkbox" id="checkbox" name="remember">
                </label>
                <label for="checkbox" class="checkbox-text">Tetap masuk</label>
            </div>
            <button class="sigin-btn" type="submit">Masuk</button>
            <p class="signup-link">Belum punya akun? <a href="{{ route('register') }}">Daftar dulu</a></p>
        </div>
    </form>
</body>

</html>
{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form
        method="POST"
        action="{{ route('login') }}"
    >
        @csrf

        <div>
            <x-input-label
                for="username"
                :value="__('Username')"
            />
            <x-text-input
                id="username"
                class="block mt-1 w-full"
                type="text"
                name="username"
                :value="old('username')"
                autofocus
                autocomplete="username"
            />
            <x-input-error
                :messages="$errors->get('username')"
                class="mt-2"
            />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label
                for="password"
                :value="__('Password')"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label
                for="remember_me"
                class="inline-flex items-center"
            >
                <input
                    id="remember_me"
                    type="checkbox"
                    class="text-indigo-600 rounded border-gray-300 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >
                <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
