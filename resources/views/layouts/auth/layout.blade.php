<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/tocly/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Sep 2025 01:34:44 GMT -->

<head>

    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />



</head>

<body>
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>

    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                <div class="text-center mb-4">
                                    <a href="{{ route('home') }}" class="">
                                        <img src="img/logo.png" alt="" height="50"
                                            class="auth-logo logo-dark mx-auto">
                                        <img src="img/logo.png" alt="" height="50"
                                            class="auth-logo logo-light mx-auto">
                                    </a>
                                    <p class="text-muted mt-2">Berbagi Solusi Dalam Satu Aplikasi
                                    </p>
                                </div>

                                @yield('content')
                                <!-- end card -->

                                <div class="mt-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> CEODE. Crafted with <i
                                            class="mdi mdi-heart text-danger"></i> by D&O Coders
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Icon -->
    <script src="unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <script src="assets/js/app.js"></script>

</body>

<!-- Mirrored from themesdesign.in/tocly/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Sep 2025 01:34:44 GMT -->

</html>
