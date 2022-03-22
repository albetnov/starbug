<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>Welcome to {{ $appName }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/guest/vendor') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--

TemplateMo 570 Chain App Dev

https://templatemo.com/tm-570-chain-app-dev

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/guest') }}/css/templatemo-chain-app-dev.css">
    <link rel="stylesheet" href="{{ asset('assets/guest') }}/css/animated.css">
    <link rel="stylesheet" href="{{ asset('assets/guest') }}/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img src="{{ asset('assets/admin/img/favicon/favicon.ico') }}" alt="StarBug">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#services">Services</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="#pricing">Pricing</a></li>
                            <li class="scroll-to-section"><a href="#newsletter">Newsletter</a></li>
                            <li>
                                <div class="gradient-button"><a href="{{ route('login') }}"><i
                                            class="fa fa-sign-in-alt"></i> Sign In Now</a></div>
                            </li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12 text-light">
                                        <h2>Star<b>Bug</b> Cashier</h2>
                                        <p class="text-light">Welcome to StarBug Cashier Page. Online StarBug
                                            Cashier</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="{{ asset('assets/guest') }}/images/slider-dec.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h4>Amazing <em>Services &amp; Features</em> for you</h4>
                        <img src="{{ asset('assets/guest') }}/images/heading-line-dec.png" alt="">
                        <p>Make the Cashier work online. Access from anywhere and everywhere at anytime.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="service-item first-service">
                        <div class="icon"></div>
                        <h4>Easy To Understand</h4>
                        <p>This app has been tweaked for you. To provide an easier interface for you to understand</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item second-service">
                        <div class="icon"></div>
                        <h4>Rocket Speed of App</h4>
                        <p>Built with Laravel Technology. As fast as any other Laravel Apps.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-item fourth-service">
                        <div class="icon"></div>
                        <h4>24/7 Help &amp; Support</h4>
                        <p>Maintained by Albet Novendo. Get in touch with him easily!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="section-heading">
                        <h4>About <em>StarBug</em> &amp; Who We Are</h4>
                        <img src="{{ asset('assets/guest') }}/images/heading-line-dec.png" alt="">
                        <p>This app are made for Internal Staff of StarBug.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Records Transaction</a></h4>
                                <p>Easily track customer transaction</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Smart Calculations</a></h4>
                                <p>Just input the number. Let the app do the rest.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Eye Candy Interface</a></h4>
                                <p>A fresh and eye candy interface giving you confortable while using this app.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-item">
                                <h4><a href="#">Syncronized Menu</a></h4>
                                <p>Easily data your menu here and let the other staff access it too.</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p>Intrested to StarBug technology?</p>
                            <div class="gradient-button">
                                <a href="#">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-image">
                        <img src="{{ asset('assets/guest') }}/images/about-right-dec.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="clients" class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4>Check What <em>The Clients Say</em> About Our {{ $appName }}</h4>
                        <img src="{{ asset('assets/guest') }}/images/heading-line-dec.png" alt="">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="naccs">
                        <div class="grid">
                            <div class="row">
                                <div class="col-lg-7 align-self-center">
                                    <div class="menu">
                                        <div class="first-thumb active">
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Lian Kawan</h4>
                                                        <span class="date">30 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Kafe Lian</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.8</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Asep Surasep</h4>
                                                        <span class="date">29 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Edgy Cafe</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>May Catherina</h4>
                                                        <span class="date">27 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">Lit House</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.7</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Random User</h4>
                                                        <span class="date">24 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">DownUnnormal</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">3.9</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="last-thumb">
                                            <div class="thumb">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <h4>Mark Amber Do</h4>
                                                        <span class="date">21 November 2021</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 d-none d-sm-block">
                                                        <span class="category">High Up</span>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-4 col-12">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">4.3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <ul class="nacc">
                                        <li class="active">
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('assets/guest') }}/images/quote.png"
                                                                    alt="">
                                                                <p>“When everything needs to done online. StarBug helps
                                                                    us a lot since our staff can start working from
                                                                    Home. And we as owner can easily track their
                                                                    progress.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('assets/guest') }}/images/client-image.jpg"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Hashin</h4>
                                                                    <span>CEO of Low Down</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('assets/guest') }}/images/quote.png"
                                                                    alt="">
                                                                <p>“CTO, Lorem ipsum dolor sit amet, consectetur
                                                                    adpiscing elit, sed do eismod tempor idunte ut
                                                                    labore et dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('assets/guest') }}/images/client-image.jpg"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Jake H. Nyo</h4>
                                                                    <span>CTO of Digital Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('assets/guest') }}/images/quote.png"
                                                                    alt="">
                                                                <p>“May, Lorem ipsum dolor sit amet, consectetur
                                                                    adpiscing elit, sed do eismod tempor idunte ut
                                                                    labore et dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('assets/guest') }}/images/client-image.jpg"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>May C.</h4>
                                                                    <span>Founder of Catherina Co.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('assets/guest') }}/images/quote.png"
                                                                    alt="">
                                                                <p>“Lorem ipsum dolor sit amet, consectetur adpiscing
                                                                    elit, sed do eismod tempor idunte ut labore et
                                                                    dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('assets/guest') }}/images/client-image.jpg"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Random Staff</h4>
                                                                    <span>Manager, Digital Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <div class="thumb">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="client-content">
                                                                <img src="{{ asset('assets/guest') }}/images/quote.png"
                                                                    alt="">
                                                                <p>“Mark, Lorem ipsum dolor sit amet, consectetur
                                                                    adpiscing elit, sed do eismod tempor idunte ut
                                                                    labore et dolore magna aliqua darwin kengan
                                                                    lorem ipsum dolor sit amet, consectetur picing elit
                                                                    massive big blasta.”</p>
                                                            </div>
                                                            <div class="down-content">
                                                                <img src="{{ asset('assets/guest') }}/images/client-image.jpg"
                                                                    alt="">
                                                                <div class="right-content">
                                                                    <h4>Mark Am</h4>
                                                                    <span>CTO, Amber Do Company</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="newsletter">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>
                        This app were made using StarBug By <a href="https://github.com/albetnov">Albet Novendo</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="{{ asset('assets/guest/vendor') }}/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/guest/vendor') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/guest') }}/js/owl-carousel.js"></script>
    <script src="{{ asset('assets/guest') }}/js/animation.js"></script>
    <script src="{{ asset('assets/guest') }}/js/imagesloaded.js"></script>
    <script src="{{ asset('assets/guest') }}/js/popup.js"></script>
    <script src="{{ asset('assets/guest') }}/js/custom.js"></script>
</body>

</html>
