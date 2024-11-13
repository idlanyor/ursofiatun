<!-- Topbar -->
<nav class="mb-4 bg-white shadow navbar navbar-expand navbar-light topbar sticky-top">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="mr-3 btn btn-link rounded-circle">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    {{-- <form class="my-2 mr-auto d-none d-sm-inline-block form-inline ml-md-3 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input
                type="text"
                class="border-0 form-control bg-light small"
                placeholder="Cari..."
                aria-label="Cari"
                aria-describedby="basic-addon2"
            >
            <div class="input-group-append">
                <button
                    class="btn btn-primary"
                    type="button"
                >
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> --}}

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
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts
        <li class="mx-1 nav-item dropdown no-arrow">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="alertsDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <div
                class="shadow dropdown-list dropdown-menu dropdown-menu-right animated--grow-in"
                aria-labelledby="alertsDropdown"
            >
                <h6 class="dropdown-header">
                    Pusat Peringatan
                </h6>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="text-white fas fa-file-alt"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 small">12 Desember 2019</div>
                        <span class="font-weight-bold">Laporan bulanan baru siap untuk diunduh!</span>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="text-white fas fa-donate"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 small">7 Desember 2019</div>
                        $290.29 telah ditransfer ke akun Anda!
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="text-white fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 small">2 Desember 2019</div>
                        Peringatan Pengeluaran: Kami telah melihat pengeluaran yang tidak biasa tinggi untuk akun Anda.
                    </div>
                </a>
                <a
                    class="text-center text-gray-500 dropdown-item small"
                    href="#"
                >Tampilkan Semua
                    Peringatan</a>
            </div>
        </li>

        <li class="mx-1 nav-item dropdown no-arrow">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="messagesDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <div
                class="shadow dropdown-list dropdown-menu dropdown-menu-right animated--grow-in"
                aria-labelledby="messagesDropdown"
            >
                <h6 class="dropdown-header">
                    Pusat Pesan
                </h6>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3 dropdown-list-image">
                        <img
                            class="rounded-circle"
                            src="{/{ asset('img/undraw_profile_1.svg') }}"
                            alt="..."
                        >
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hai! Saya sedang bertanya-tanya apakah Anda dapat membantu saya
                            dengan masalah yang saya hadapi.</div>
                        <div class="text-gray-500 small">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3 dropdown-list-image">
                        <img
                            class="rounded-circle"
                            src="{/{ asset('img/undraw_profile_3.svg') }}"
                            alt="..."
                        >
                        <div class="status-indicator"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Saya memiliki foto yang Anda pesan bulan lalu, bagaimana Anda ingin
                            mereka dikirim ke Anda?</div>
                        <div class="text-gray-500 small">Jae Chun · 1d</div>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3 dropdown-list-image">
                        <img
                            class="rounded-circle"
                            src="{/{ asset('img/undraw_profile_3.svg') }}"
                            alt="..."
                        >
                        <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Laporan bulan lalu terlihat bagus, saya sangat senang dengan
                            kemajuan yang telah dicapai, teruskan pekerjaan yang baik!</div>
                        <div class="text-gray-500 small">Morgan Alvarez · 2d</div>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3 dropdown-list-image">
                        {{-- <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                            alt="..."> --}}
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Apakah saya anak yang baik? Alasannya saya bertanya adalah karena
                            seseorang memberitahu saya bahwa orang-orang mengatakan ini kepada semua anjing, bahkan jika
                            mereka tidak baik...</div>
                        <div class="text-gray-500 small">Chicken the Dog · 2w</div>
                    </div>
                </a>
                <a
                    class="text-center text-gray-500 dropdown-item small"
                    href="#"
                >Baca Lebih Banyak
                    Pesan</a>
            </div>
        </li>
    -->

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 text-gray-600 d-none d-lg-inline small">{{ Auth::user()->nama }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Keluar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End of Topbar -->
