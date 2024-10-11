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
        <title>Foodking - Fast Food Restaurant HTML Template</title>
        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.svg') }} ">
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
    </head>
    <body>
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
                                <img src="assets/img/logo/logo.svg" alt="logo-img">
                                </a>
                            </div>
                            <div class="offcanvas__close">
                                <button>
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <p class="text d-none d-lg-block">
                            This involves interactions between a business and its customers. It's about meeting customers' needs and resolving their problems. Effective customer service is crucial.
                        </p>
                        <div class="offcanvas-gallery-area d-none d-lg-block">
                            <div class="offcanvas-gallery-items">
                                <a href="assets/img/header/01.jpg" class="offcanvas-image img-popup">
                                <img src="assets/img/header/01.jpg" alt="gallery-img">
                                </a>
                                <a href="assets/img/header/02.jpg" class="offcanvas-image img-popup">
                                <img src="assets/img/header/02.jpg" alt="gallery-img">
                                </a>
                                <a href="assets/img/header/03.jpg" class="offcanvas-image img-popup">
                                <img src="assets/img/header/03.jpg" alt="gallery-img">
                                </a>
                            </div>
                            <div class="offcanvas-gallery-items">
                                <a href="assets/img/header/04.jpg" class="offcanvas-image img-popup">
                                <img src="assets/img/header/04.jpg" alt="gallery-img">
                                </a>
                                <a href="assets/img/header/05.jpg" class="offcanvas-image img-popup">
                                <img src="assets/img/header/05.jpg" alt="gallery-img">
                                </a>
                                <a href="assets/img/header/06.jpg" class="offcanvas-image img-popup">
                                <img src="assets/img/header/06.jpg" alt="gallery-img">
                                </a>
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
                                <a href="shop-single.html" class="theme-btn">
                                <span class="button-content-wrapper d-flex align-items-center justify-content-center">
                                <span class="button-icon"><i class="flaticon-delivery"></i></span>
                                <span class="button-text">order now</span>
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

        <!-- Header Top Start -->
        <div class="header-top header-top-6">
            <div class="container">
                <div class="header-top-wrapper style-6">
                    <ul>
                        <li><span>100%</span> Secure delivery without contacting the courier</li>
                        <li><i class="fas fa-truck"></i>Track Your Order</li>
                    </ul>
                    <div class="top-right">
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

        <!-- Header Middle Start -->
        <div class="header-middle-section">
            <div class="container">
                <div class="header-middle-wrapper">
                    <form action="#" class="search-toggle-box d-md-block">
                        <div class="input-area">
                            <input type="text" placeholder="Tìm Kiếm Pizza Dành Cho Bạn">
                            <button class="cmn-btn">
                                <i class="far fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="middle-header-logo">
                        <a href="{{ route('web.home') }}">
                            <img src="assets/img/logo/logo.svg" alt="">
                        </a>
                    </div>
                    <div class="middle-header-right">
                        <div class="icon-items">
                            <i class="far fa-phone-alt"></i>
                            <div class="content">
                                <p>24/7 Support cente</p>
                                <h5><a href="tel:+1718-904-4450">+1718-904-4450</a></h5>
                            </div>
                        </div>
                        <div class="menu-cart">
                            <a class="cartList" href="{{ route('web.auth') }}">
                                <i class="far fa-shopping-basket"></i>
                            </a>
                            
                        </div>
                        <div class="menu-cart">
                            <a class="account" href="{{ route('web.auth') }}">
                                <i class="fas fa-user"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Area Start -->
        <header id="header-sticky" class="header-1 style-6">
            <div class="container">
                <div class="mega-menu-wrapper">
                    <div class="header-main">
                        <div class="logo">
                            <a href="{{ route('web.home') }}" class="header-logo">
                            <img src="assets/img/logo/logo-3.svg" alt="logo-img">
                            </a>
                        </div>
                        
                        <div class="header-right d-flex justify-content-end align-items-center">
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
                            <div class="header__hamburger d-lg-none my-auto">
                                <div class="sidebar__toggle">
                                    <i class="far fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section Start -->
        <section class="hero-section-5 fix hero-6 section-padding bg-cover" style="background-image: url('assets/img/banner/main-bg.jpg');">
            <div class="hero-shape">
                <img src="assets/img/hero-6/hero/hero-shape.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero-content">
                            <h3 class="wow fadeInUp" data-wow-delay=".3s">Today's Best Deal</h3>
                            <h1 class="wow fadeInUp" data-wow-delay=".5s">italian food</h1>
                            <h2 class="wow fadeInUp" data-wow-delay=".7s">Super Delicious</h2>
                        </div>
                        <div class="hero-image wow fadeInUp" data-wow-delay=".4s">
                            <img src="assets/img/hero-6/hero/02.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Food Menu Section Start -->
        <section class="food-menu-section pt-80 pb-80">
            <div class="container">
                <div class="section-title text-center mb-0">
                    <h4 class="menu-title wow fadeInUp" data-wow-delay=".3s">menu</h4>
                </div>
                <div class="food-menu-card-wrapper pt-5">
                    
                </div>
            </div>
        </section>

        <!-- Food Banner Section Start -->
        <section class="food-banner-section section-padding fix pt-0">
            <div class="burger-shape-2">
                <img src="assets/img/shape/burger-shape-2.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="row g-4">
                    <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="single-offer-items bg-cover style-3" style="background-image: url('assets/img/banner/offer-bg-2.png');">
                            <div class="offer-content">
                                <h5>crispy, every bite taste</h5>
                                <h3>
                                    Delicious & <br>
                                    hot pizza
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                        <div class="single-offer-items bg-cover style-3" style="background-image: url('assets/img/banner/french-fry-bg.png');">
                            <div class="french-content">
                                <h4>
                                    <span>Todays</span>Delicious
                                </h4>
                                <h3>french fry</h3>
                                <h5>This Weekend only</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeInUp" data-wow-delay=".7s">
                        <div class="single-offer-items bg-cover style-3" style="background-image: url('assets/img/banner/chiken-bg.png');">
                            <div class="offer-content">
                                <h5>crispy, every bite taste</h5>
                                <h3>
                                    chiken & <br>
                                    french fry
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Dishes Section Start -->
        <section class="popular-dishes-section fix section-padding pt-0">
            <div class="container">
                <div class="section-title text-center">
                    <span class="wow fadeInUp">Menu PIZZA</span>
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Danh sách Pizza</h2>
                </div>
                <div class="swiper popular-dishes-slider">
                    <div class="swiper-wrapper pizza-menu-list-1">
                    </div>
                </div>
                <div class="swiper popular-dishes-slider-2">
                    <div class="swiper-wrapper pizza-menu-list-2">

                    </div>
                </div>
            </div>
        </section>

        <!-- Cta Delivery Section Start -->
        <section class="cta-delivery-section fix section-bg section-padding bg-cover" style="background-image: url('assets/img/hero-6/bg-shape.png');">
            <div class="container">
                <div class="cta-delivery-wrapper">
                    <div class="delivery-content">
                        <div class="section-title text-center">
                            <span class="wow fadeInUp">We guarantee</span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">30 Minutes Delivery!</h2>
                        </div>
                        <p class="mt-3 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                            It's the perfect dining experience where every dish is crafted with fresh, high-quality
                            Experience quick and efficient <br> service that ensures your food is servead fresh It's the
                            dining experience.
                        </p>
                        <a href="shop-single.html" class="theme-btn bg-red-2 mt-5 wow fadeInUp" data-wow-delay=".3s">
                            <span class="button-content-wrapper d-flex align-items-center">
                            <span class="button-icon"><i class="flaticon-delivery"></i></span>
                            <span class="button-text">view more</span>
                            </span>
                        </a>
                    </div>
                    <div class="delivery-man">
                        <img src="assets/img/hero-6/delivery.png" alt="img">
                    </div>
                    <div class="comboo-image">
                        <img src="assets/img/hero-6/comboo.png" alt="img">
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Section Start -->
        <footer class="footer-section section-bg-3 fix bg-cover" style="background-image: url('assets/img/hero-6/bg-shape.png');">
            <div class="footer-logo-6">
                <a href="{{ route('web.home') }}">
                    <img src="assets/img/logo/logo-2.svg" alt="logo-img">
                </a>
            </div>
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
                <div id="scrollUp" class="scroll-icon bg-cover" style="background-image: url('assets/img/shop-food/box.png');">
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

    var last_page;

    function fetchDataCategory(page, search = '') {
        $.ajax({
            url: `{{ $api_url }}categories?page=${page}&search=${search}`,
            method: 'GET',
            success: function(response) {
                // Clear the table body
                $('link-menu').empty();
                $('.food-menu-card-wrapper').empty();

                let rowNumber = 1;

                // Populate the table with data
                response.data.forEach(item => {
                    const url = `/loai-pizza/${encodeURIComponent(item.slug)}`;
                    $('.link-menu').append(`
                        <li>
                            <a href="${url}">${item.name}</a>
                        </li>
                    `);

                    if(rowNumber == 1){
                        $('.food-menu-card-wrapper').append(`
                            <div class="food-menu-card-items wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <div class="menu-thumb">
                                    <a href="${url}">
                                        <img style="width: 117px; height: 95px;" src="{{ asset('storage') }}/${item.image}" alt="${item.name}" alt="img">
                                    </a>
                                </div>
                                <h5 class="title">
                                    <a href="${url}">${item.name}</a>
                                </h5>
                            </div>
                        `);
                    }else{
                        $('.food-menu-card-wrapper').append(`
                            <div class="food-menu-card-items wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="menu-thumb">
                                    <a href="${url}">
                                        <img style="width: 117px; height: 95px;" src="{{ asset('storage') }}/${item.image}" alt="${item.name}" alt="img">
                                    </a>
                                </div>
                                <h5 class="title">
                                    <a href="${url}">${item.name}</a>
                                </h5>
                            </div>
                        `);
                    }
                    rowNumber++
                });
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });
    }

    $(document).ready(function() {
        function fetchDataPizza1(page, search = '') {
            $.ajax({
                url: `{{ $api_url }}products?page=${page}&search=${search}`,
                method: 'GET',
                success: function(response) {
                    // Clear the table body
                    $('.pizza-menu-list-1').empty();
                    // Populate the table with data
                    response.data.forEach(item => {
                        last_page = item.last_page;
                        const url = `/pizza/${encodeURIComponent(item.slug)}-${item.id}.html`;
                        var price = item.detail_products.length >= 1 ? Number(item.detail_products[0].price) : 0 ;
                        $('.pizza-menu-list-1').append(`
                            <div class="swiper-slide">
                                <div class="popular-dishes-items">
                                    <div class="dishes-image">
                                        <img style="width: 198px; height: 203px;" src="{{ asset('storage') }}/${item.image}" alt="food-img">
                                    </div>
                                    <div class="dishes-content">
                                        <div class="star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4>
                                            <a href="${url}">${item.name}</a>
                                        </h4>
                                        <h5>${price.toLocaleString('vi-VN')}đ</h5>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchDataPizza2(page, search = '') {
            console.log(page)
            $.ajax({
                url: `{{ $api_url }}products?page=${page}&search=${search}`,
                method: 'GET',
                success: function(response) {
                    // Clear the table body
                    $('.pizza-menu-list-2').empty();
                    // Populate the table with data
                    response.data.forEach(item => {
                        const url = `/pizza/${encodeURIComponent(item.slug)}-${item.id}.html`;
                        var price = item.detail_products.length >= 1 ? Number(item.detail_products[0].price) : 0 ;
                        $('.pizza-menu-list-2').append(`
                            <div class="swiper-slide">
                                <div class="popular-dishes-items">
                                    <div class="dishes-image">
                                        <img style="width: 198px; height: 203px;" src="{{ asset('storage') }}/${item.image}" alt="food-img">
                                    </div>
                                    <div class="dishes-content">
                                        <div class="star">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4>
                                            <a href="${url}">${item.name}</a>
                                        </h4>
                                        <h5>${price.toLocaleString('vi-VN')}đ</h5>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }
        
        // Initial fetch
        fetchDataPizza1(currentPage, currentSearch);
        fetchDataPizza2(last_page, currentSearch);
    });

    fetchDataCategory(currentPage, currentSearch);
</script>