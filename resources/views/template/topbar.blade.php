<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3"
    >
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input
                type="text"
                class="form-control bg-light border-0 small"
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
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="searchDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div
                class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown"
            >
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control bg-light border-0 small"
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
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
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
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div
                class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
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
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">12 Desember 2019</div>
                        <span class="font-weight-bold">Laporan bulanan baru siap untuk diunduh!</span>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">7 Desember 2019</div>
                        $290.29 telah ditransfer ke akun Anda!
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">2 Desember 2019</div>
                        Peringatan Pengeluaran: Kami telah melihat pengeluaran yang tidak biasa tinggi untuk akun Anda.
                    </div>
                </a>
                <a
                    class="dropdown-item text-center small text-gray-500"
                    href="#"
                >Tampilkan Semua
                    Peringatan</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
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
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div
                class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown"
            >
                <h6 class="dropdown-header">
                    Pusat Pesan
                </h6>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="dropdown-list-image mr-3">
                        <img
                            class="rounded-circle"
                            src="{{ asset('img/undraw_profile_1.svg') }}"
                            alt="..."
                        >
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hai! Saya sedang bertanya-tanya apakah Anda dapat membantu saya
                            dengan masalah yang saya hadapi.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="dropdown-list-image mr-3">
                        <img
                            class="rounded-circle"
                            src="{{ asset('img/undraw_profile_3.svg') }}"
                            alt="..."
                        >
                        <div class="status-indicator"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Saya memiliki foto yang Anda pesan bulan lalu, bagaimana Anda ingin
                            mereka dikirim ke Anda?</div>
                        <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="dropdown-list-image mr-3">
                        <img
                            class="rounded-circle"
                            src="{{ asset('img/undraw_profile_3.svg') }}"
                            alt="..."
                        >
                        <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Laporan bulan lalu terlihat bagus, saya sangat senang dengan
                            kemajuan yang telah dicapai, teruskan pekerjaan yang baik!</div>
                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                </a>
                <a
                    class="dropdown-item d-flex align-items-center"
                    href="#"
                >
                    <div class="dropdown-list-image mr-3">
                        {{-- <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                            alt="..."> --}}
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Apakah saya anak yang baik? Alasannya saya bertanya adalah karena
                            seseorang memberitahu saya bahwa orang-orang mengatakan ini kepada semua anjing, bahkan jika
                            mereka tidak baik...</div>
                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                </a>
                <a
                    class="dropdown-item text-center small text-gray-500"
                    href="#"
                >Baca Lebih Banyak
                    Pesan</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="userDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                <img
                    class="img-profile rounded-circle"
                    src="{{ asset('img/undraw_profile.svg') }}"
                >
            </a>
            <!-- Dropdown - User Information -->
            <div
                class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown"
            >
                <a
                    class="dropdown-item"
                    href="#"
                >
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil
                </a>
                <a
                    class="dropdown-item"
                    href="#"
                >
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengaturan
                </a>
                <a
                    class="dropdown-item"
                    href="{{ route('log-activities') }}"
                >
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Log Aktivitas
                </a>
                <div class="dropdown-divider"></div>
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf
                    <button
                        type="submit"
                        class="dropdown-item"
                    >
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
