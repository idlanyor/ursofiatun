<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-star-and-crescent"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AL - FALAH</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kelas.index') }}">
            <i class="fas fa-fw fa-school"></i>
            <span>Kelas</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('guru.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('guru.index') }}">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Guru</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('santri.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('santri.index') }}">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Data Santri</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('matapelajaran.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('matapelajaran.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Mata Pelajaran</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item {{ request()->routeIs('kegiatan.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kegiatan.index') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Kegiatan</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('absensi.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('absensi.index') }}">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Absensi</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('nilai.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('nilai.index') }}">
            <i class="fas fa-fw fa-sticky-note"></i>
            <span>Nilai Santri</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Akun</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('pengaturan.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pengaturan.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
