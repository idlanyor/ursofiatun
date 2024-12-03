<!-- Topbar -->
<nav class="mb-4 bg-white shadow navbar navbar-expand navbar-light topbar sticky-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="mr-3 btn btn-sm btn-link rounded-circle">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="ml-auto navbar-nav">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <div class="p-3 shadow dropdown-menu dropdown-menu-right animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="mr-auto form-inline w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="border-0 form-control bg-light small" placeholder="Cari..."
                            aria-label="Cari" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-gray-600 d-none d-lg-inline small">{{ Auth::user()->nama }}</span>
                @if (Auth::user()->foto_profil === null)
                    <img src="https://api.dicebear.com/9.x/adventurer-neutral/svg?seed={{ Auth::user()->nama }}"
                        alt="avatar" class="rounded-circle img-profile img-fluid">
                @else
                    <img src="{{ asset(Auth::user()->foto_profil) }}" alt="avatar" class="rounded-circle img-profile">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="shadow dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="mr-2 text-gray-400 fas fa-user fa-sm fa-fw"></i>
                    Profil
                </a>
                <a class="dropdown-item" href="{{ route('pengaturan.index') }}">
                    <i class="mr-2 text-gray-400 fas fa-cogs fa-sm fa-fw"></i>
                    Pengaturan
                </a>
                <a class="dropdown-item" href="{{ route('log-activities') }}">
                    <i class="mr-2 text-gray-400 fas fa-list fa-sm fa-fw"></i>
                    Log Aktivitas
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="dropdown-item">
                        <i class="mr-2 text-gray-400 fas fa-sign-out-alt fa-sm fa-fw"></i>
                        Keluar
                    </button>
                </form>
                <!-- Button trigger modal -->



            </div>
        </li>

    </ul>

</nav>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Keluar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Apakah anda yakin ingin <strong>keluar</strong> </span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-sm btn-primary" type="submit">Keluar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End of Topbar -->
