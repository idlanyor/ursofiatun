<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In | Siak Al - Falah</title>
    <style>
        /* From Uiverse.io by Pinparker */
        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #4d4d4d;
        }
        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            display: block;
            padding: 2.2rem;
            max-width: 350px;
            background: linear-gradient(14deg,
                    rgba(2, 0, 36, 0.8) 0%,
                    rgba(24, 24, 65, 0.7) 66%,
                    rgb(20, 76, 99) 100%),
                radial-gradient(circle,
                    rgba(2, 0, 36, 0.5) 0%,
                    rgba(32, 15, 53, 0.2) 65%,
                    rgba(14, 29, 28, 0.9) 100%);
            border: 2px solid #fff;
            -webkit-box-shadow: rgba(0, 212, 255) 0px 0px 50px -15px;
            box-shadow: rgba(0, 212, 255) 0px 0px 50px -15px;
            overflow: hidden;
            z-index: +1;
            border-radius: 8px;
        }

        /*------input and submit section-------*/

        .input-container {
            position: relative;
        }

        .input-container input,
        .form button {
            outline: none;
            border: 2px solid #ffffff;
            margin: 8px 0;
            font-family: monospace;
            border-radius: 4px;
        }

        .input-container input {
            background-color: #fff;
            padding: 6px;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 250px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .input-mail:focus::placeholder {
            opacity: 0;
            transition: opacity 0.9s;
        }

        .input-pwd:focus::placeholder {
            opacity: 0;
            transition: opacity 0.9s;
        }

        .submit {
            position: relative;
            display: block;
            padding: 8px;
            background: linear-gradient(90deg, #243949 0%, #517fa4 100%);
            color: #ffffff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            text-transform: uppercase;
            overflow: hidden;
        }

        .submit:hover {
            -webkit-transition: all 0.2s ease-out;
            -moz-transition: all 0.2s ease-out;
            transition: all 0.2s ease-out;
            box-shadow: 4px 5px 17px -4px #ffffff;
            cursor: pointer;
        }

        .submit:hover::before {
            -webkit-animation: sh02 0.5s 0s linear;
            -moz-animation: sh02 0.5s 0s linear;
            animation: sh02 0.5s 0s linear;
        }

        .submit::before {
            content: "";
            display: block;
            width: 0px;
            height: 85%;
            position: absolute;
            top: 50%;
            left: 0%;
            opacity: 0;
            background: #fff;
            box-shadow: 0 0 50px 30px #fff;
            -webkit-transform: skewX(-20deg);
            -moz-transform: skewX(-20deg);
            -ms-transform: skewX(-20deg);
            -o-transform: skewX(-20deg);
            transform: skewX(-20deg);
        }

        @keyframes sh02 {
            from {
                opacity: 0;
                left: 0%;
            }

            50% {
                opacity: 1;
            }

            to {
                opacity: 0;
                left: 100%;
            }
        }

        /*--------signup section---------*/

        .signup-link {
            color: #c0c0c0;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
            font-family: monospace;
        }

        .signup-link a {
            color: #fff;
            text-decoration: none;
        }

        .up:hover {
            text-decoration: underline;
        }

        /*--------header section-----------*/

        .form-title {
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-family: monospace;
            font-weight: 600;
            text-align: center;
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.7);
            animation-duration: 1.5s;
            overflow: hidden;
            transition: 0.12s;
        }

        .form-title span {
            animation: flickering 2s linear infinite both;
        }

        .title-2 {
            display: block;
            margin-top: -0.5rem;
            font-size: 2.1rem;
            font-weight: 800;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            -webkit-text-stroke: #fff 0.1rem;
            letter-spacing: 0.2rem;
            color: transparent;
            position: relative;
            text-shadow: 0px 0px 16px #cecece;
        }

        .title-2 span::before,
        .title-2 span::after {
            content: "—";
        }

        @keyframes flickering {

            0%,
            100% {
                opacity: 1;
            }

            41.99% {
                opacity: 1;
            }

            42% {
                opacity: 0;
            }

            43% {
                opacity: 0;
            }

            43.01% {
                opacity: 1;
            }

            47.99% {
                opacity: 1;
            }

            48% {
                opacity: 0;
            }

            49% {
                opacity: 0;
            }

            49.01% {
                opacity: 1;
            }
        }

        /*---------shooting stars-----------*/

        .bg-stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background-size: cover;
            animation: animateBg 50s linear infinite;
        }

        @keyframes animateBg {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        .star {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 4px;
            height: 4px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1),
                0 0 0 8px rgba(255, 255, 255, 0.1), 0 0 20px rgba(255, 255, 255, 0.1);
            animation: animate 3s linear infinite;
        }

        .star::before {
            content: "";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 300px;
            height: 1px;
            background: linear-gradient(90deg, #fff, transparent);
        }

        @keyframes animate {
            0% {
                transform: rotate(315deg) translateX(0);
                opacity: 1;
            }

            70% {
                opacity: 1;
            }

            100% {
                transform: rotate(315deg) translateX(-1000px);
                opacity: 0;
            }
        }

        .star:nth-child(1) {
            top: 0;
            right: 0;
            left: initial;
            animation-delay: 0s;
            animation-duration: 1s;
        }

        .star:nth-child(2) {
            top: 0;
            right: 100px;
            left: initial;
            animation-delay: 0.2s;
            animation-duration: 3s;
        }

        .star:nth-child(3) {
            top: 0;
            right: 220px;
            left: initial;
            animation-delay: 2.75s;
            animation-duration: 2.75s;
        }

        .star:nth-child(4) {
            top: 0;
            right: -220px;
            left: initial;
            animation-delay: 1.6s;
            animation-duration: 1.6s;
        }
    </style>
</head>

<body class="flex justify-center items-center w-screen h-screen">
    <form class="form">
        <div class="form-title"><span>Login</span></div>
        <div class="title-2"><span>TP Al - Falah</span></div>
        <div class="input-container">
            <input placeholder="Email" type="email" class="input-mail" />
            <span> </span>
        </div>

        <section class="bg-stars">
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
            <span class="star"></span>
        </section>

        <div class="input-container">
            <input placeholder="Password" type="password" class="input-pwd" />
        </div>
        <button class="submit" type="submit">
            <span class="sign-text">Sign in</span>
        </button>

        <p class="signup-link">
            No account?
            <a class="up" href="">Sign up!</a>
        </p>
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
