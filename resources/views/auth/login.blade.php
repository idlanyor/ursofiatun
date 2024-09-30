@extends('template.scaffold')
@section('title', 'Login | TPQ Al - Falah')
@push('style')
    <style>
        body {
            font-family: quicksand, sans-serif;
            /* background-color: #5bb2ff; */
            /* background-image: linear-gradient(to top right, #7fd3fa, #4dbd89); */
        }

        .form-container {
            display: flex;
            flex-direction: column;
            border-radius: 0.75rem;
            background-color: #fff;
            color: rgb(97 97 97);
            box-shadow: 20px 20px 30px rgba(0, 0, 0, .05);
            width: 22rem;
            padding: 1.5rem;
        }

        .header {
            background-color: #1ee5db;
            background-image: linear-gradient(to top right, #208f1100, #1ba564);
            border-radius: 0.75rem;
            color: #fff;
            text-align: center;
            padding: 1.5rem 0;
            font-weight: 600;
            font-size: 1.9rem;
        }

        .form-control:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.25);
        }

        .error-message {
            font-size: 0.85rem;
            color: #e74c3c;
            margin-top: 0.25rem;
            margin-bottom: 0.75rem;
            padding-left: 0.5rem;
        }

        .sigin-btn {
            background-color: #34a59f;
            background-image: linear-gradient(to top right, #208f1100, #1ba564);
            border-radius: .5rem;
            color: #fff;
            font-weight: 700;
            width: 100%;
            text-transform: uppercase;
        }

        .signup-link {
            text-align: center;
            margin-top: 1rem;
        }

        .signup-link a {
            color: #1e88e5;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
@endpush
@section('content-guest')

    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <form class="form-container" id="form-login" {{-- method="POST" action="{{ route('login') }}" --}}>
            @csrf
            <div class="header mb-5">TPQ Al - Falah</div>

            <!-- Input Username -->
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                <x-input-error :messages="$errors->get('username')" class="error-message" />
            </div>

            <!-- Input Password -->
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Input Role -->
            <div class="form-group">
                <select class="form-control" name="role">
                    <option value="pengurus">Pengurus</option>
                    <option value="admin">Admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="error-message" />
            </div>

            <button type="submit" class="btn sigin-btn">Masuk</button>

            <p class="signup-link">Belum punya akun? <a href="{{ route('register') }}">Daftar dulu</a></p>
        </form>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#form-login').submit(async function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                try {
                    let response = await axios.post("{{ route('login') }}", formData)
                    console.log(response.data)
                    toastr.success("Login berhasil,Mengalihkan...")
                    setTimeout(() => {
                        window.location.href = "{{ route('home') }}"
                    }, 1000)
                } catch (e) {
                    if (e.status === 422) {
                        e.response.data.errors.username.forEach(e => {
                            toastr.error(e)
                        });
                        e.response.data.errors.password.forEach(e => {
                            toastr.error(e)
                        });
                    } else if (e.status === 401) {
                        toastr.error(e.response.data.message)
                    } else {
                        toastr.error(
                            "Terjadi kesalahan di sisi server,silahkan coba beberapa saat lagi")
                    }
                }
                // $.ajax({
                //     type: 'POST',
                //     url: '{{ route('login') }}',
                //     data: formData,
                //     processData: false,
                //     contentType: false,
                //     success: function(response) {
                //         console.log(response)
                //         if (response.status == 'success') {
                //             window.location.href = '{{ route('home') }}';
                //         } else {
                //             alert('Gagal login');
                //         }
                //     }
                // });
            });
        });
    </script>
@endpush
