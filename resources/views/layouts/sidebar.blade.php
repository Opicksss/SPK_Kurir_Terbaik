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

                <li class="mm-active">
                    <a href="/" class="waves-effect active">
                        <i class="uim uim-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uim uim-comment-message"></i>
                        <span>Management Account</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">

                        @auth
                            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
                                <li><a href="{{ route('admin.index') }}">Admin</a></li>
                            @endif
                        @endauth

                        @auth
                            @if (Auth::user()->role === 'superadmin')
                                <li><a href="{{ route('superadmin.index') }}">Super Admin</a></li>
                            @endif
                        @endauth

                    </ul>
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
                    <img src="assets/images/users/avatar-2.jpg" class="img-fluid header-profile-user rounded-circle"
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
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><span class="badge bg-primary mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a>

            <a class="dropdown-item" href="{{ route('logout') }}"><i
                    class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Logout</span></a>
        </div>
    </div>

</div>
