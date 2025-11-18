<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/logo-home.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo-home.png">
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="home/assets/css/theme.min.css" rel="stylesheet" />
    <link href="home/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar">
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img
                        src="img/logo.png" height="45" alt="logo" /></a><button
                    class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
                        <li class="nav-item px-2"><a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item px-2"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#ranking">Ranking</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="#findUs">Contact</a></li>
                    </ul>
                    </div><a class="btn btn-primary order-1 order-lg-0 ms-lg-3" href="{{ route('login') }}">Log In</a>
                </div>
            </div>
        </nav>

        @yield('content')

    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="home/vendors/%40popperjs/popper.min.js"></script>
    <script src="home/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="home/vendors/is/is.min.js"></script>
    <script src="home/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
    <script src="home/vendors/fontawesome/all.min.js"></script>
    <script src="home/assets/js/theme.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
</body>

</html>
