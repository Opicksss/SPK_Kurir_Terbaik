@extends('layouts.home.layout')
@section('title', 'Home')

@section('content')
    <section class="py-xxl-10 pb-0" id="home">
        <div class="bg-holder bg-size"
            style="background-image:url(home/assets/img/gallery/hero-header-bg.png);background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100"
                        src="home/assets/img/illustrations/hero.png" alt="hero-header" /></div>
                <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-8">
                    <h1 class="fw-normal fs-6 fs-xxl-7">Berbagi Solusi Dalam Satu Aplikasi</h1>
                    <h1 class="fw-bolder fs-6 fs-xxl-7 mb-2">CEODE</h1>
                    <p class="fs-1 mb-5">Layanan distribusi barang dan ojek yang berada di bawah naungan PT. Alpha Group
                        Nuswantara. CEODE mulai beroperasi pada 1 November 2019 dan berfokus pada layanan pengantaran cepat
                        oleh kurir di wilayah Sumenep.
                        <br />Layanan ini beroperasi di Jl. Widuri 02, Bangselok, Sumenep.
                    </p><a class="btn btn-primary me-2" href="#!" role="button">Get started<i
                            class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-7" id="services" container-xl="container-xl">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 text-center mb-3">
                    <h5 class="text-danger">SERVICES</h5>
                    <h2>Layanan CEODE untuk Anda</h2>
                </div>
            </div>
            <div class="row h-100 justify-content-center">
                <!-- Ride Service -->
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5">
                                <img class="img-fluid" src="home/assets/img/icons/services-1.svg" alt="..." />
                                <h5 class="my-4">Ride (Antar Jemput)</h5>
                            </div>
                            <p>Layanan transportasi cepat dan praktis untuk kebutuhan mobilitas Anda di sekitar Sumenep.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Antar jemput penumpang</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Pesan via aplikasi</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Aman & terpercaya</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Food Delivery -->
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5">
                                <img class="img-fluid" src="home/assets/img/icons/services-2.svg" alt="..." />
                                <h5 class="my-4">Food Delivery</h5>
                            </div>
                            <p>Pesan makanan favorit Anda dari berbagai restoran lokal, diantar langsung ke rumah dengan
                                cepat.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Pesan makanan via aplikasi</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Pengantaran cepat</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Restoran lokal Sumenep</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- PPOB & IDI Send -->
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5">
                                <img class="img-fluid" src="home/assets/img/icons/services-3.svg" alt="..." />
                                <h5 class="my-4">PPOB & IDI Send</h5>
                            </div>
                            <p>CEODE memudahkan pembayaran online dan pengiriman barang lokal dengan aman dan terpercaya.
                            </p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Pembayaran pulsa & token listrik</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Pembayaran online (PPOB)</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Pengiriman barang lokal (IDI Send)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    {{-- <section class="pt-7 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="home/assets/img/icons/awards.png" alt="..." />
                        <h1 class="text-primary mt-4">26+</h1>
                        <h5 class="text-800">Awards won</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="home/assets/img/icons/states.png" alt="..." />
                        <h1 class="text-primary mt-4">65+</h1>
                        <h5 class="text-800">States covered</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="home/assets/img/icons/clients.png" alt="..." />
                        <h1 class="text-primary mt-4">689K+</h1>
                        <h5 class="text-800">Happy clients</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="home/assets/img/icons/goods.png" alt="..." />
                        <h1 class="text-primary mt-4">130M+</h1>
                        <h5 class="text-800">Goods delivered</h5>
                    </div>
                </div>
                <div class="col-6 col-lg mb-5">
                    <div class="text-center"><img src="home/assets/img/icons/business.png" alt="..." />
                        <h1 class="text-primary mt-4">130M+</h1>
                        <h5 class="text-800">Antar Jeput</h5>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================--> --}}
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-dark text-white py-4 py-sm-0">
                        <img class="w-100" src="home/assets/img/gallery/video.png" alt="video" />
                        <div class="card-img-overlay bg-dark-gradient d-flex flex-column flex-center">
                            <img src="home/assets/img/icons/play.png" width="80" alt="play" />
                            <h5 class="text-primary">PENGANTARAN TERCEPAT</h5>
                            <p class="text-center">
                                CEODE siap mengantarkan barang berharga Anda dengan cepat dan aman.<br
                                    class="d-none d-sm-block" />
                                Karena kebutuhan darurat Anda adalah prioritas utama kami.
                            </p>
                            <a class="stretched-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></a>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content overflow-hidden">
                                        <div class="modal-header p-0">
                                            <div class="ratio ratio-16x9" id="exampleModalLabel">
                                                <iframe src="https://www.youtube.com/embed/8QT6ET7KFMw?si=JZnlmvyqFesxQL0E"
                                                    title="YouTube video" allowfullscreen="allowfullscreen"></iframe>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section id="findUs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5 mb-6 text-center">
                    <h5 class="text-danger">TEMUKAN KAMI</h5>
                    <h2>Akses kami dengan mudah</h2>
                </div>
                <div class="col-12">
                    <div class="card card-span rounded-2 mb-3">
                        <div class="row">
                            <div class="col-md-6 col-lg-7 d-flex"><img
                                    class="w-100 fit-cover rounded-md-start rounded-top rounded-md-top-0"
                                    src="img/map.png" alt="map" /></div>
                            <div class="col-md-6 col-lg-5 d-flex flex-center">
                                <div class="card-body">
                                    <h5>Hubungi Kami</h5>
                                    <p class="text-700 my-4"> <i class="fas fa-map-marker-alt text-warning me-3"></i><a
                                            class="text-700"
                                            href="https://www.google.com/maps/place/CEODE/@-7.0112479,113.8539888,17z/data=!4m6!3m5!1s0x2dd9e5dca9a9847d:0xb5c4ae5a26e49329!8m2!3d-7.0112479!4d113.8539888!16s%2Fg%2F11rrz3cr43?hl=id-ID&entry=ttu&g_ep=EgoyMDI1MTExMi4wIKXMDSoASAFQAw%3D%3D">
                                            Jl. Widuri II, Pakalongan, Pajagalan, Kec. Kota Sumenep, Kabupaten Sumenep, Jawa
                                            Timur 69416</a></p>
                                    <p><i class="fas fa-phone-alt text-warning me-3"></i><span class="text-700">Senin -
                                            Minggu : 07.00 - 21.00 WIB</span></p>
                                    <ul class="list-unstyled list-inline mt-5">
                                        <li class="list-inline-item"><a class="text-decoration-none"
                                                href="https://www.facebook.com/profile.php?id=100070511694086"><i
                                                    class="fab fa-facebook-square fs-2"></i></a></li>
                                        <li class="list-inline-item"><a class="text-decoration-none"
                                                href="https://www.instagram.com/ceode.id/"><i
                                                    class="fab fa-instagram-square fs-2"></i></a></li>
                                        <li class="list-inline-item"><a class="text-decoration-none"
                                                href="https://www.tiktok.com/@ceodesumenep?_r=1&_t=ZS-91Uj61wayum"> <i
                                                    class="fab fa-tiktok fs-2"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><button class="btn btn-primary px-5" type="submit"><i
                                class="fas fa-phone-alt me-2"></i><a class="text-light" href="tel:+6287756200703">Hubungi
                                kami untuk pengiriman +6287756200703</a></button></div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-900 pb-4 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-6 mb-4 order-0 order-sm-0"><a class="text-decoration-none"
                        href="#"><img src="img/logo.png" height="51" alt="" /></a>
                    <p class="text-500 my-4">Perusahaan kurir paling terpercaya<br />di wilayah Anda.</p>
                </div>
                <div class="col-6 col-sm-4 col-lg-2 mb-3 order-2 order-sm-1">
                </div>
                <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
                </div>
                <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
                    <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif"> Other links</h5>
                    <ul class="list-unstyled mb-md-4 mb-lg-0">
                        <li class="lh-lg"><a class="text-500" href="{{ route('home') }}">Home</a></li>
                        <li class="lh-lg"><a class="text-500" href="#services">Services</a></li>
                        <li class="lh-lg"><a class="text-500" href="#findUs">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-0 bg-1000">
        <div class="container">
            <div class="row justify-content-md-between justify-content-evenly py-4">
                <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                    <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; Your Company,
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                    </p>
                </div>
                <div class="col-12 col-sm-8 col-md-6">
                    <p class="fs--1 my-2 text-center text-md-end text-200"> Made with&nbsp;<svg
                            class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="12"
                            height="12" fill="#F95C19" viewBox="0 0 16 16">
                            <path
                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z">
                            </path>
                        </svg>&nbsp;by&nbsp;<a class="fw-bold text-primary" href="https://themewagon.com/"
                            target="_blank">D&O Coders </a></p>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->
@endsection
