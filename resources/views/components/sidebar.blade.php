<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Presensi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"><i class="far fa-handshake text-success"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="far fa-square"></i> <span>Beranda</span></a>
            </li>
            <li class="{{ Request::is('users') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('users') }}"><i class="far fa-user"></i> <span>Pengguna</span></a>
            </li>
            <li class="{{ Request::is('companies') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('companies') }}"><i class="far fa-building"></i>
                    <span>Perusahaan</span></a>
            </li>
            <li class="{{ Request::is('attendances') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('attendances') }}"><i class="far fa-clipboard-user"></i>
                    <span>Kehadiran</span></a>
            </li>

        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
