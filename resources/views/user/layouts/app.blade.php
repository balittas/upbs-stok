<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Title -->
    <title>Penyedia Benih Sumber - BSIP-TAS</title>

    <!-- Favicon -->
    <link rel="icon" href="{{url('assets/admin/img/logo/icon.png')}}">


    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{url('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/classy-nav.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/elegant-icon.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('assets/frontend/css/owl.carousel.min.css')}}">
    <link href='http://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" href="{{url('assets/admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
    @yield('css')

<style>
        .custom-map-control-button {
            background-color: grey;
            color: white;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
        }

    </style>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-circle"></div>
        <div class="preloader-img">
            <img src="{{url('assets/admin/img/logo/icon.png')}}" alt="">
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- ***** Top Header Area ***** -->
        <!-- ***** Navbar Area ***** -->
        <div class="alazea-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="alazeaNav">

                        <!-- Nav Brand -->
                        <a href="index.html" class="nav-brand"><img src="{{url('assets/admin/img/logo/logo.png')}}" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Navbar Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="{{ route('produk.index') }}">Home</a></li>

                                    <li><a href="{{route('contact')}}">Kontak</a></li>
                                    {{-- <li><a href="contact.html">Tentang Kami</a></li> --}}
                                    <li><a href="{{route('keranjang.index')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Keranjang <span id="cart-qty" class="cart-quantity">({{$cart_count}})</span></span></a>
                                    <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span> Akun
                                            </span></a>
                                        <ul class="dropdown">
                                            @if (!Auth::user())
                                            <li><a href="{{route('login')}}">Masuk</a></li>
                                            <li><a href="{{route('register')}}">Daftar</a></li>
                                            @else
                                            <li style="font-size: 12px;text-align:center"> <small>
                                                    {{Auth::user()->email}} </small></li>
                                            <li><a href="{{route('profile.show')}}">Profil</a></li>
                                            <li><a href="{{route('transaksi.index')}}">Transaksi</a></li>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Logout</a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                            @endif
                                        </ul>
                                    </li>
                                    </li>
                                </ul>

                            </div>
                            <!-- Navbar End -->
                        </div>
                    </nav>

                    <!-- Search Form -->
                    <div class="search-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type keywords &amp; press enter...">
                            <button type="submit" class="d-none"></button>
                        </form>
                        <!-- Close Icon -->
                        <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="breadcrumb-area">
        <!-- Top Breadcrumb Area -->
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(/assets/frontend/img/bg-img/24.jpg);">
            <h2>Penyedia Benih Sumber | BSIP-TAS</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
    <!-- ##### Header Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area bg-img" style="background-color: #111111;">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-footer-widget">
                            <div class="footer-logo mb-30">
                                <a href="#"><img src="{{url('assets/admin/img/logo/logo.png')}}" alt=""></a>
                            </div>
                            <p>Balai Pengujian Standar Instrumen Tanaman Pemanis dan Serat (BSIP-TAS) merupakan salah satu unit pelaksana
                                teknis (UPT) Badan Badan Standardisasi Instrumen Pertanian (BSIP), yang melaksanakan pengujian standar instrumen tanaman pemanis, serat, tembakau dan minyak industri</p>

                        </div>
                    </div>

                    {{-- <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>QUICK LINK</h5>
                            </div>
                            <nav class="widget-nav">
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Product</a></li>
                                    <li><a href="#">Cart</a></li>
                                    <li><a href="#">Checkout</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div> --}}

                    <!-- Single Footer Widget -->
                    {{-- <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>BEST SELLER</h5>
                            </div>

                            <!-- Single Best Seller Products -->
                            <div class="single-best-seller-product d-flex align-items-center">
                                <div class="product-thumbnail">
                                    <a href="shop-details.html"><img src="img/bg-img/4.jpg" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="shop-details.html">Cactus Flower</a>
                                    <p>$10.99</p>
                                </div>
                            </div>

                            <!-- Single Best Seller Products -->
                            <div class="single-best-seller-product d-flex align-items-center">
                                <div class="product-thumbnail">
                                    <a href="shop-details.html"><img src="img/bg-img/5.jpg" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <a href="shop-details.html">Tulip Flower</a>
                                    <p>$11.99</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>CONTACT</h5>
                            </div>

                            <div class="contact-information">
                                <p><span>Alamat:</span> Jalan Raya Karangploso Km 4 , Kotak Pos 199, Kabupaten Malang
                                    Jawa Timur, Indonesia</p>
                                <p><span>Phone:</span> (0341) 491447 / (0341) 485121</p>
                                <p><span>Email:</span> bsip.tanamanpemanis@pertanian.go.id </p>
                            </div><br>
                            <div class="social-info">
                                <a href="https://www.facebook.com/bsip.pemanis"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/BalittasMalang"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://www.youtube.com/@bsip.pemanis"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/bsip.pemanis/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="border-line"></div>
                    </div>
                    <!-- Copywrite Text -->
                    <div class="col-12 col-md-12">
                        <div class="copywrite-text">
                            <p style="text-align: center">&copy;
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy; <script>
                                    document.write(new Date().getFullYear());

                                </script> BSIP-TAS All rights reserved </a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <script src='http://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>

    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{url('assets/frontend/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{url('assets/frontend/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{url('assets/frontend/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{url('assets/frontend/js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{url('assets/frontend/js/active.js')}}"></script>

    <script src="{{url('assets/admin/js/alerts.js')}}"></script>
    <script src="{{url('assets/admin/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwN4gy8bqNav6ORJTv9xGTH7Ye9u4RrzQ&callback=initMap&v=weekly"
    async></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

    @yield('footer')

</body>

</html>
