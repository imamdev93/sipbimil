<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.min.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/venobox.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <main class="main-wrapper">

        <!-- .....:::::: Start Header Section :::::.... -->
        <header class="header-section sticky-header d-none d-xl-block section-fluid-185">
            <div class="header-wrapper">
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <!-- Start Header Logo -->
                            {{-- <a href="/" class="header-logo">
                                <img src="assets/images/logo/logo.png" alt="">
                            </a> --}}
                            <!-- End Header Logo -->
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <!-- Start Header Menu -->
                            <ul class="header-nav">
                                <li><a href="/">Beranda</a></li>
                                {{-- <li><a href="/dashboard">Monitoring</a></li> --}}
                            </ul>
                            <!-- End Header Menu -->

                            <div class="header-btn-link text-end">
                                @if(auth()->guard('web')->check() || auth()->guard('admin')->check())
                                    <a href="/logout"
                                        class="btn btn-lg btn-default-outline-alt btn-animate"><span>Logout</span></a>
                                @else
                                    <a href="/login"
                                        class="btn btn-lg btn-default-outline-alt btn-animate"><span>Login</span></a>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- .....:::::: End Header Section :::::.... -->

        <!-- .....:::::: Start Mobile Header Section :::::.... -->
        <div class="mobile-header d-block d-xl-none">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <div class="mobile-action-link text-end">
                            <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu"><i
                                    class="icofont-navigation-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .....:::::: Start MobileHeader Section :::::.... -->

        <!--  Start Offcanvas Mobile Menu Section -->
        <div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
            <!-- Start Offcanvas Header -->
            <div class="offcanvas-header text-right">
                <button class="offcanvas-close"><i class="icofont-close-line"></i></button>
            </div> <!-- End Offcanvas Header -->
            <!-- Start Offcanvas Mobile Menu Wrapper -->
            <div class="offcanvas-mobile-menu-wrapper">
                <!-- Start Mobile Menu  -->
                <div class="mobile-menu-bottom">
                    <!-- Start Mobile Menu Nav -->
                    <div class="offcanvas-menu">
                        <ul>
                            <li><a href="/"><span>Beranda</span></a></li>
                            <li><a href="/dashboard"><span>Monitoring</span></a></li>
                            <li><a href="/login"><span>Login</span></a></li>
                        </ul>
                    </div> <!-- End Mobile Menu Nav -->
                </div> <!-- End Mobile Menu -->

            </div> <!-- End Offcanvas Mobile Menu Wrapper -->
        </div>
        <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

        <!-- Offcanvas Overlay -->
        <div class="offcanvas-overlay"></div>

        @yield('content')
        <!-- ...::: Start Footer Section :::... -->
        <footer class="footer-section">
            <!-- Start Footer Top Area -->
            {{-- <div class="footer-top-area section-inner-padding-200 section-top-gap-150">
                <div class="footer-top-shape">
                    <img class="img-width" src="assets/images/background/footer-shape-bg.png" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer-top-box-wrapper">
                                <!-- Start Footer About -->
                                <div class="footer-top-single-item footer-about">
                                    <a href="index.html" class="logo">
                                        <img class="img-fluid" src="assets/images/logo/logo.png" alt="">
                                    </a>
                                    <p>Lorem Ipsum simply prting and tyeseting
                                        standard emmy text evere since the when
                                        to make specimen book.</p>
                                    <form action="#" class="footer-form" method="post">
                                        <input type="email" placeholder="Enter email" required>
                                        <button type="submit">Subscribe <i class="icofont-double-right"></i></button>
                                    </form>
                                </div>
                                <!-- End Footer About -->
                                <!-- Start Footer Widget -->
                                <div class="footer-top-single-item footer-menu footer-widget">
                                    <h4 class="title">Services</h4>

                                    <ul class="footer-nav">
                                        <li><a href="service-details.html">Infant Activities</a></li>
                                        <li><a href="service-details.html">High Risk Pregnancy</a></li>
                                        <li><a href="service-details.html">Gynecological Services</a></li>
                                        <li><a href="service-details.html">Prenatal ultrasound</a></li>
                                        <li><a href="service-details.html">Fertility medication</a></li>
                                        <li><a href="service-details.html">Infant Activities</a></li>
                                    </ul>
                                </div>
                                <!-- End Footer Widget -->
                                <!-- Start Footer Widget -->
                                <div class="footer-top-single-item footer-social footer-widget">
                                    <h4 class="title">Follow Us</h4>

                                    <ul class="social-link-2">
                                        <li>
                                            <a href="https://example.com/" target="_blank">
                                                <span class="icon"><i class="icofont-facebook"></i></span>
                                                <span class="text">Facebook</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://example.com/" target="_blank">
                                                <span class="icon"><i class="icofont-twitter"></i></span>
                                                <span class="text">Twitter</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://example.com/" target="_blank">
                                                <span class="icon"><i class="icofont-instagram"></i></span>
                                                <span class="text">Instagram</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Footer Widget -->
                                <!-- Start Footer Widget -->
                                <div class="footer-top-single-item footer-contact footer-widget">
                                    <h4 class="title">Contact</h4>

                                    <div class="footer-info">
                                        <address class="footer-single-info">
                                            <span class="icon"><i class="icofont-google-map"></i></span>
                                            <span class="text">Address: Your address goes here.</span>
                                        </address>
                                        <a href="tel:+0123456789" class="footer-single-info">
                                            <span class="icon"><i class="icofont-phone"></i></span>
                                            <span class="text">012 345 6789</span>
                                        </a>
                                        <a href="mailto:demo@example.com" class="footer-single-info">
                                            <span class="icon"><i class="icofont-envelope"></i></span>
                                            <span class="text">demo@example.com</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- End Footer Widget -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- End Footer Top Area -->

            <!-- Start Footer BottomArea -->
            <div class="footer-bottom-area section-top-gap-150 ">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <p class="copyright-text text-center">
                                &copy; 2022 <a class="mark-color" href="/">Monitoring Perkembangan Ibu Hamil
                                    dan Balita</a>. Made with <i class="icofont-heart mark-color"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer Bottom Area-->
        </footer>
        <!-- ...::: End Footer Section :::... -->

        <!-- material-scrolltop button -->
        <button class="material-scrolltop" type="button"></button>
    </main>

    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-ui.min.js') }}"></script>

    <!--Plugins JS-->
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ajax-mail.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/material-scrolltop.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
