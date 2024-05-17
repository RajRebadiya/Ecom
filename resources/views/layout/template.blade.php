<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from themewagon.github.io/ashion/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 10:05:13 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css')}}" type="text/css">
    
</head>
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="#"><span class="icon_heart_alt"></span>
            <div class="tip">2</div>
        </a></li>
        <li><a href="#"><span class="icon_bag_alt"></span>
            <div class="tip">2</div>
        </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="index.html"><img src="{{ asset('assets/img/logo.png')}}" alt="logo"></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        <a href="#">Login</a>
        <a href="#">Register</a>
    </div>
</div>
 <!-- Header Section Begin -->
   <header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="home"><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="home">Home</a></li>
                        {{-- <li><a href="#">Women’s</a></li>
                        <li><a href="#">Men’s</a></li> --}}
                        <li><a href="shop">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="product-details.html">Product Details</a></li>
                                <li><a href="shop-cart.html">Shop Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Category</a>
                            <ul class="dropdown">
                                <li><a href="{{url('all_product/men')}}">Men</a></li>
                                <li><a href="{{url('all_product/women')}}">Women</a></li>
                                <li><a href="{{url('all_product/kids')}}">Kids</a></li>
                                <li><a href="{{url('all_product/grocery')}}">Grocery</a></li>
                            </ul>
                        </li>
                        <li><a href="blog">Blog</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        <a href="login">Login</a>
                        <a href="register">Register</a>
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="#"><span class="icon_heart_alt"></span>
                            <div class="tip">2</div>
                        </a></li>
                        <li><a href="#"><span class="icon_bag_alt"></span>
                            <div class="tip">2</div>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<main>
    @yield('content')
</main>
<!-- Header Section End -->
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="index.html"><img src="{{ asset('assets/img/logo.png')}}" alt=""></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    cilisis.</p>
                    <div class="footer__payment">
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-1.png')}}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-2.png')}}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-3.png')}}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-4.png')}}" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-5.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <h6>Quick links</h6>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Orders Tracking</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    <h6>NEWSLETTER</h6>
                    <form action="#">
                        <input type="text" placeholder="Email">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer__copyright__text">
                    <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/mixitup.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.slicknav.js')}}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('assets/js/main.js')}}"></script>
</body>


<!-- Mirrored from themewagon.github.io/ashion/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 10:05:33 GMT -->
</html>