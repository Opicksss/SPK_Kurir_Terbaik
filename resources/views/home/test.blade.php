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
                    <h1 class="fw-normal fs-6 fs-xxl-7">A trusted provider of </h1>
                    <h1 class="fw-bolder fs-6 fs-xxl-7 mb-2">courier services.</h1>
                    <p class="fs-1 mb-5">We deliver your products safely to <br />your home in a reasonable time. </p><a
                        class="btn btn-primary me-2" href="#!" role="button">Get started<i
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
                    <h2>Our services for you</h2>
                </div>
            </div>
            <div class="row h-100 justify-content-center">
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5"><img class="img-fluid" src="home/assets/img/icons/services-1.svg"
                                    alt="..." />
                                <h5 class="my-4">Business Services</h5>
                            </div>
                            <p>Offering home delivery around the city, where your products will be at your doorstep within
                                48-72 hours.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Corporate goods </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Shipment</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Accesories</li>
                            </ul>
                            <div class="text-center my-5">
                                <div class="d-grid"><button class="btn btn-outline-danger" type="submit">Learn more
                                    </button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5"><img class="img-fluid" src="home/assets/img/icons/services-2.svg"
                                    alt="..." />
                                <h5 class="my-4">Statewide Services</h5>
                            </div>
                            <p>Offering home delivery around the city, where your products will be at your doorstep within
                                48-72 hours.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Unlimited Bandwidth </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Encrypted Connection</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Yes Traffic Logs</li>
                            </ul>
                            <div class="text-center my-5">
                                <div class="d-grid"> <button class="btn btn-danger hover-top btn-glow border-0"
                                        type="submit">Learn more</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-4 px-md-2 px-lg-3">
                    <div class="card h-100 px-lg-5 card-span">
                        <div class="card-body d-flex flex-column justify-content-around">
                            <div class="text-center pt-5"><img class="img-fluid" src="home/assets/img/icons/services-3.svg"
                                    alt="..." />
                                <h5 class="my-4">Personal Services</h5>
                            </div>
                            <p>You can trust us to safely deliver your most sensitive documents to the specific area in a
                                short time.</p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Unlimited Bandwidth </li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Encrypted Connection</li>
                                <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary"
                                            style="font-size:.5rem"></i></span>Yes Traffic Logs</li>
                            </ul>
                            <div class="text-center my-5">
                                <div class="d-grid"><button class="btn btn-outline-danger" type="submit">Learn more
                                    </button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-7 pb-0">
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
                        <h5 class="text-800">Business hours</h5>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-dark text-white py-4 py-sm-0"><img class="w-100"
                            src="home/assets/img/gallery/video.png" alt="video" />
                        <div class="card-img-overlay bg-dark-gradient d-flex flex-column flex-center"><img
                                src="home/assets/img/icons/play.png" width="80" alt="play" />
                            <h5 class="text-primary">FASTEST DELIVERY</h5>
                            <p class="text-center">You can get your valuable item in the fastest period of<br
                                    class="d-none d-sm-block" />time with safety. Because your emergency<br
                                    class="d-none d-sm-block" />is our first priority.</p><a class="stretched-link"
                                href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content overflow-hidden">
                                        <div class="modal-header p-0">
                                            <div class="ratio ratio-16x9" id="exampleModalLabel"><iframe
                                                    src="https://www.youtube.com/embed/TlcP2aTOp-Q" title="YouTube video"
                                                    allowfullscreen="allowfullscreen"></iframe></div>
                                        </div>
                                        <div class="modal-footer"><button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Close</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="py-7">
        <div class="container-fluid">
            <div class="row flex-center">
                <div class="bg-holder bg-size"
                    style="background-image:url(home/assets/img/gallery/quote.png);background-position:top;background-size:auto;margin-left:-270px;margin-top:-45px;">
                </div>
                <!--/.bg-holder-->
                <div class="col-md-8 col-lg-5 text-center">
                    <h5 class="text-danger">TESTIMONIAL</h5>
                    <h2>Our Awesome Clients</h2>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="overflow-hidden">
        <div class="container-fluid">
            <div class="row bg-offcanvas">
                <div class="col-12">
                    <div class="swiper-container" data-pagination-target="pagination1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide h-auto">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I'm loving the look and the very useful included complete
                                            page templates. Such a time saver!I'm also glad to see Bootstrap v5 support
                                            coming. Highly recommended.</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img
                                                    src="home/assets/img/icons/user-1.png" alt="..." />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">John Adams</h6>
                                                    <p class="fs--2 fw-normal mb-0">Ceo</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">This is my first bootstrap template and I've had quite a
                                            few questions, mostly driven by my own lack of experience. Nevertheless have
                                            received excellent support from the author, even to my noob question And my
                                            project is starting now to take shape nicely.</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img
                                                    src="home/assets/img/icons/user-2.png" alt="..." />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img
                                                    src="home/assets/img/icons/user-3.png" alt="..." />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Austin Min</h6>
                                                    <p class="fs--2 fw-normal mb-0">Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">We’re looking for someone interested in business theory
                                            and research that’ll help us bridge the gap between our s...</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img
                                                    src="home/assets/img/icons/user-1.png" alt="..." />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                                                    <p class="fs--2 fw-normal mb-0">Ceo</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">Review our community chat for the most frequently asked
                                            questions and document answers for our product docs.</p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img
                                                    src="home/assets/img/icons/user-2.png" alt="..." />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">John Adams</h6>
                                                    <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div class="card h-100 card-span p-3">
                                    <div class="card-body">
                                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this
                                            courier service provider assisted me in getting it delivered to my home. I
                                            received my phone within one day, and I was really satisfied with their service
                                            when I received it. </p>
                                        <div class="d-xl-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center mb-3"><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i><i
                                                    class="fas fa-star text-primary me-1"></i></div>
                                            <div class="d-flex align-items-center"><img
                                                    src="home/assets/img/icons/user-3.png" alt="..." />
                                                <div class="flex-1 ms-3">
                                                    <h6 class="mb-0 fs--1 text-1000 fw-medium">Austin Min</h6>
                                                    <p class="fs--2 fw-normal mb-0">Designer</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination" id="pagination1"></div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-xl-4"><img src="home/assets/img/illustrations/callback.png"
                        alt="..." />
                    <h5 class="text-danger">REQUEST A CALLBACK</h5>
                    <h2>We will contact in the shortest time.</h2>
                    <p class="text-muted">Monday to Friday, 9am-5pm.</p>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <form class="row">
                        <div class="mb-3"><label class="form-label visually-hidden" for="inputName">Name</label><input
                                class="form-control form-quriar-control" id="inputName" type="text"
                                placeholder="Name" /></div>
                        <div class="mb-3"><label class="form-label visually-hidden" for="inputEmail">Another
                                label</label><input class="form-control form-quriar-control" id="inputEmail"
                                type="email" placeholder="Email" /></div>
                        <div class="mb-5"><label class="form-label visually-hidden"
                                for="validationTextarea">Message</label>
                            <textarea class="form-control form-quriar-control is-invalid border-400" id="validationTextarea"
                                placeholder="Message" style="height: 150px" required="required"></textarea>
                        </div>
                        <div class="d-grid"> <button class="btn btn-primary" type="submit">Send Message<i
                                    class="fas fa-paper-plane ms-2"></i></button></div>
                    </form>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
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
