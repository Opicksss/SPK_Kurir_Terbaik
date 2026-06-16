<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="img/logo.png" alt="logo-sm-dark" height="50">
            </span>
            <span class="logo-lg">
                <img src="img/logo.png" alt="logo-dark" height="50">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="img/logo.png" alt="logo-sm-light" height="24">
            </span>
            <span class="logo-lg">
                <img src="img/logo.png" alt="logo-light" height="22">
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



</div>
