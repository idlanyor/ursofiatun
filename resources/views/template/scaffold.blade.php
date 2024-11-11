<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Roynaldi">
    <meta name="author" content="Ursofiatun">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('alfalah.png') }}" type="image/x-icon">

    <title>@yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('dist/fontawesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('dist/quicksand.css') }}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('dist/bs5.css') }}" href="{{ asset('dist/bs4.css') }}">
    <link href="{{ asset('dist/sbadmin.css') }}" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('dist/toastr.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dist/perfect-scrollbar.css') }}"> --}}
    {{-- ngatur tabel --}}
    <style>
        .table th {
            white-space: nowrap;
            text-align: center
        }
    </style>
    @yield('style')
    @stack('style')


</head>

<body id="page-top" style="font-family: Quicksand">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @auth
            @include('template.sidebar')
        @endauth
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Setelah navbar, tambahkan: -->
            @if (session('error'))
                <div class="container mt-3">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <!-- Main Content -->
            <div id="content">
                @guest
                    <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
                        @yield('content-guest')
                    </div>
                @endguest
                @auth
                    @include('template.topbar')
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                @endauth


            </div>
            <!-- End of Main Content -->

            @include('template.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="rounded scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/axios.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dist/js/jquery.js') }}"></script>

    <script src="{{ asset('dist/js/bs5.js') }}"></script>
    <script src="{{ asset('dist/js/bs4.js') }}"></script>
    {{-- <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dist/js/jqeasing.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('dist/js/sbadmin.js') }}"></script>
    <!-- Toastr JavaScript -->
    {{-- <script src="{{ asset('dist/js/perfect-scrollbar.js') }}"></script> --}}
    <script src="{{ asset('dist/js/toastr.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('script')

</body>

</html>
