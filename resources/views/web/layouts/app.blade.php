<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="modinatheme">
        <meta name="description" content="Foodking - Fast Food Restaurant Html">
        <!-- ======== Page title ============ -->
        <title>@yield('title')</title>
        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.svg') }}">
        <!-- Bootstrap min.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Font Awesome.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
        <!-- Animate.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
        <!-- Magnific Popup.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <!-- MeanMenu.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
        <!-- Swiper Bundle.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
        <!-- Nice Select.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
        <!-- Main.css -->
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <!-- Style.css -->
        <link rel="stylesheet" href="{{ asset('style.css') }}">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (localStorage.getItem('access_token')) {
                    var accountUrl = '{{ route('web.customer.index') }}';
                    var cartUrl = '{{ route('web.cart') }}';

                    var accountLinks = document.getElementsByClassName('account');
                    var cartList = document.getElementsByClassName('cartList');

                    for (var i = 0; i < cartList.length; i++) {
                        cartList[i].href = cartUrl;
                    }

                    for (var i = 0; i < accountLinks.length; i++) {
                        accountLinks[i].href = accountUrl;
                    }
                }
            });
        </script>
        @yield('auth')
    </head>
    <body>
        <!-- Proloader Start -->
        <div id="preloader" class="preloader">
            <div class="animation-preloader">
                <div class="spinner">                
                </div>
                <div class="txt-loading">
                    <span data-text-preloader="F" class="letters-loading">
                    F
                    </span>
                    <span data-text-preloader="O" class="letters-loading">
                    O
                    </span>
                    <span data-text-preloader="0" class="letters-loading">
                    O
                    </span>
                    <span data-text-preloader="D" class="letters-loading">
                    D
                    </span>
                    <span data-text-preloader="K" class="letters-loading">
                    K
                    </span>
                    <span data-text-preloader="I" class="letters-loading">
                    I
                    </span>
                    <span data-text-preloader="N" class="letters-loading">
                    N
                    </span>
                    <span data-text-preloader="G" class="letters-loading">
                    G
                    </span>
                </div>
                <p class="text-center">Loading</p>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offcanvas Area Start -->
        <div class="fix-area">
            <div class="offcanvas__info">
                <div class="offcanvas__wrapper">
                    <div class="offcanvas__content">
                        <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                            <div class="offcanvas__logo">
                                <a href="{{ route('web.home') }}">
                                <img src="https://modinatheme.com/html/foodking-html/assets/img/logo/logo.svg" alt="logo-img">
                                </a>
                            </div>
                            <div class="offcanvas__close">
                                <button>
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mobile-menu fix mb-3"></div>
                        <div class="offcanvas__contact">
                            <h4>Contact Info</h4>
                            <ul>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a target="_blank" href="#">Main Street, Melbourne, Australia</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="tel:+013-003-003-9993"><span class="mailto:info@enofik.com">info@foodking.com</span></a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-clock"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a target="_blank" href="#">Mod-friday, 09am -05pm</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="far fa-phone"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="tel:+11002345909">+11002345909</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="header-button mt-4">
                                <a href="{{ route('web.product.list') }}" class="theme-btn">
                                <span class="button-content-wrapper d-flex align-items-center justify-content-center">
                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                <span class="button-text">Đặt Ngay</span>
                                </span>
                                </a>
                            </div>
                            <div class="social-icon d-flex align-items-center">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas__overlay"></div>

        <!-- Header Area Start -->
        <header>
            <div class="header-top">
                <div class="container">
                    <div class="header-top-wrapper">
                        <ul>
                            <li><span>100%</span> Secure delivery without contacting the courier</li>
                            <li><i class="fas fa-truck"></i>Track Your Order</li>
                        </ul>
                        <div class="top-right">
                            <div class="search-wrp">
                                <button><i class="far fa-search"></i></button>
                                <input placeholder="Tìm Kiếm " aria-label="Search">
                            </div>
                            <div class="social-icon d-flex align-items-center">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-vimeo-v"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-sticky" class="header-1">
                <div class="container">
                    <div class="mega-menu-wrapper">
                        <div class="header-main">
                            <div class="logo">
                                <a href="{{ route('web.home') }}" class="header-logo">
                                <img src="https://modinatheme.com/html/foodking-html/assets/img/logo/logo.svg" alt="logo-img">
                                </a>
                            </div>
                            <div class="header-left">
                                <div class="mean__menu-wrapper d-none d-lg-block">
                                    <div class="main-menu">
                                        <nav id="mobile-menu">
                                            <ul class="link-menu">
                                                <li class="has-dropdown active">
                                                    <a href="{{ route('web.home') }}">
                                                    TRANG CHỦ
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('web.product.list') }}">MUA PIZZA</a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <!-- for wp -->
                                    </div>
                                </div>
                            </div>
                            <div class="header-right d-flex justify-content-end align-items-center">
                                <div class="menu-cart">
                                    <a href="{{ route('web.auth') }}" class="account">
                                        <i class="fas fa-user"></i>
                                    </a>
                                </div>
                                <div class="header-button">
                                    <a href="{{ route('web.auth') }}" class="theme-btn bg-red-2 cartList">Giỏ Hàng</a>
                                </div>
                                <div class="header__hamburger d-xl-block my-auto">
                                    <div class="sidebar__toggle">
                                        <div class="header-bar">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!--<< Breadcrumb Section Start >>-->
        <div class="breadcrumb-wrapper bg-cover" style="background-image: url('https://modinatheme.com/html/foodking-html/assets/img/banner/breadcrumb.jpg');">
            <div class="container">
                <div class="page-heading center">
                    <h1 class="title-breadcrumb-top"></h1>
                    <ul class="breadcrumb-items">
                        <li>
                            <a href="{{ route('web.home') }}">
                            TRANG CHỦ
                            </a>
                        </li>
                        <li>
                            <i class="far fa-chevron-right"></i>
                        </li>
                        <li class="title-breadcrumb">
                            @yield('title-breadcrumb')
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @yield('content')

        <!-- Footer Section Start -->
        <footer class="footer-section section-bg-3 fix bg-cover" style="background-image: url('assets/img/hero-6/bg-shape.png');">
            <div class="container">
                <div class="footer-widgets-wrapper style-2">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 pe-md-2 wow fadeInUp" data-wow-delay=".3s">
                            <div class="single-footer-widget pe-md-5 border-right">
                                <div class="widget-head">
                                    <h4>Newsletter</h4>
                                </div>
                                <div class="footer-content">
                                    <p>
                                        Temporibus autem quibusdam officiis debitis
                                        aut rerum necessitatibus.
                                    </p>
                                    <div class="footer-input">
                                        <input type="email" id="email" placeholder="Your Email">
                                        <button class="newsletter-btn" type="submit">
                                            Subscribe
                                        </button>
                                    </div>
                                    <div class="social-icon d-flex align-items-center">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-vimeo-v"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-4 col-md-6 ps-xl-5 pe-md-5 wow fadeInUp" data-wow-delay=".5s">
                            <div class="single-footer-widget border-right">
                                <div class="widget-head">
                                    <h4>popular food</h4>
                                </div>
                                <div class="list-area d-flex align-items-center">
                                    <ul>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Hamburger</span>
                                            <span class="effect-1">Hamburger</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Chicken pizza</span>
                                            <span class="effect-1">Chicken pizza</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Vegetable roll</span>
                                            <span class="effect-1">Vegetable roll</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Sea fish</span>
                                            <span class="effect-1">Sea fish</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Fried chicken</span>
                                            <span class="effect-1">Fried chicken</span>
                                            </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">French fries</span>
                                            <span class="effect-1">French fries</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Onion rings</span>
                                            <span class="effect-1">Onion rings</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Chicken nuggets</span>
                                            <span class="effect-1">Chicken nuggets</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Tacos Pizza</span>
                                            <span class="effect-1">Tacos Pizza</span>
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-single.html">
                                            <span class="text-effect">
                                            <span class="effect-1">Hot Dogs</span>
                                            <span class="effect-1">Hot Dogs</span>
                                            </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 ps-xl-5 wow fadeInUp" data-wow-delay=".7s">
                            <div class="single-footer-widget">
                                <div class="widget-head">
                                    <div class="widget-head">
                                        <h4>contact us</h4>
                                    </div>
                                </div>
                                <div class="footer-content">
                                    <p>
                                        1403 Washington Ave, New Orlea <br>
                                        ns, LA 70130, United States
                                    </p>
                                    <a href="mailto:info@example.com" class="link">info@example.com</a>
                                    <a href="tel:+1718-904-4450" class="number">+1718-904-4450</a>
                                    <ul class="info-date">
                                        <li>Monday – Friday: <span>8am – 4pm</span></li>
                                        <li>Saturday: <span>8am – 12am</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom style-2">
                <div id="scrollUp" class="scroll-icon bg-cover" style="background-image: url('https://modinatheme.com/html/foodking-html/assets/img/shop-food/box.png');">
                    <i class="fas fa-arrow-alt-up"></i>
                </div>
                <div class="container">
                    <div class="footer-bottom-wrapper d-flex align-items-center justify-content-between">
                        <p class="wow fadeInLeft" data-wow-delay=".3s">
                            © Copyright <span class="theme-color-3">2024</span> <a href="{{ route('web.home') }}">Foodking </a>. All Rights Reserved.
                        </p>
                        <ul class="wow fadeInRight" data-wow-delay=".5s">
                            <li>
                                <a href="contact.html">
                                <span class="text-effect">
                                <span class="effect-1">Privacy Policy</span>
                                <span class="effect-1">Privacy Policy</span>
                                </span>
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
                                <span class="text-effect">
                                <span class="effect-1">Terms & Condition</span>
                                <span class="effect-1">Terms & Condition</span>
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        

        <!-- Back To Top Start -->
        <div class="scroll-up">
            <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
        
        <!-- All JS Plugins -->
        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        <!-- Viewport Js -->
        <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
        <!-- Bootstrap Js -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Nice Select Js -->
        <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
        <!-- Waypoints Js -->
        <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
        <!-- Counterup Js -->
        <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
        <!-- Swiper Slider Js -->
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <!-- MeanMenu Js -->
        <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
        <!-- Magnific Popup Js -->
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- GSAP Animation Js -->
        <script src="{{ asset('assets/js/animation.js') }}"></script>
        <!-- Wow Animation Js -->
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <!-- Main.js -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
<script>
var currentPage = 1;
var currentSearch = '';

function fetchDataCategory(page, search = '') {
    $.ajax({
        url: `{{ $api_url }}categories?page=${page}&search=${search}`,
        method: 'GET',
        success: function(response) {
            // Populate the table with data
            response.data.forEach(item => {
                const url = `/loai-pizza/${encodeURIComponent(item.slug)}`;
                $('.link-menu').append(`
                    <li>
                        <a href="${url}">${item.name}</a>
                    </li>
                `);
            });
        },
        error: function(xhr) {
            console.log(xhr)
        }
    });
}

fetchDataCategory(currentPage, currentSearch);
</script>
@yield('script')
