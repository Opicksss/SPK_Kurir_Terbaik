<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm-dark.png" alt="logo-sm-dark" height="24">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="logo-dark" height="22">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm-light.png" alt="logo-sm-light" height="24">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="logo-light" height="22">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
        id="vertical-menu-btn">
        <i class="ri-menu-2-line align-middle"></i>
    </button>

    <div data-simplebar class="vertical-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">


            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="uim uim-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kurir.index') }}"
                        class="waves-effect {{ request()->is('kurir*') ? 'active' : '' }}">
                        <i class="uim uim-layer-group"></i>
                        <span>Kurir</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('rekap.index') }}"
                        class="waves-effect {{ request()->is('rekap*') ? 'active' : '' }}">
                        <i class="uim uim-document-layout-left"></i>
                        <span>Rekap</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kriteria.index') }}"
                        class="waves-effect {{ request()->is('kriteria*') ? 'active' : '' }}">
                        <i class="uim uim-layers-alt"></i>
                        <span>Kriteria</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('topsis.index') }}"
                        class="waves-effect {{ request()->is('topsis*') ? 'active' : '' }}">
                        <i class="uim uim-graph-bar"></i>
                        <span>Perankingan</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.index') }}"
                        class="waves-effect {{ request()->is('admin*') ? 'active' : '' }}">
                        <i class="uim uim-lock-access"></i>
                        <span>Management Account</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="dropdown px-3 sidebar-user sidebar-user-info">
        <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img src="img/profilDefault.jpg" class="img-fluid header-profile-user rounded-circle"
                        alt="">
                </div>

                <div class="flex-grow-1 ms-2 text-start">
                    <span class="ms-1 fw-medium user-name-text">
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    </span>
                </div>

                <div class="flex-shrink-0 text-end">
                    <i class="mdi mdi-dots-vertical font-size-16"></i>
                </div>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <a class="dropdown-item" href="{{ route('profile', ['id' => auth()->id()]) }}"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"><i
                    class="mdi mdi-logout text-danger font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Logout</span></a>
        </div>
    </div>

</div>
