<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from themewagon.github.io/ashion/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 10:05:13 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}" type="text/css">


    <style>
        @charset "UTF-8";

        /*
-----------------
Dropdown Styles
-----------------
*/
        .dropdown-container {
            display: inline-block;
            /* padding: 10px; */
        }

        .dropdown-container .dropdown {
            position: relative;
        }

        .dropdown-container .dropdown[open] .with-down-arrow::after {
            content: "";
        }

        .dropdown-container .dropdown[open] summary {
            background: #ffffff10;
        }

        .dropdown-container .dropdown summary {
            list-style: none;
            display: inline-block;
            cursor: pointer;
            border-radius: 6px;
        }

        .dropdown-container .dropdown summary.avatar {
            border-radius: 50px;
        }

        .dropdown-container .dropdown summary.avatar img {
            width: 28px;
            height: 26px;
            border-radius: 50px;
            display: inline-block;
            margin-left: 2px;
        }

        .dropdown-container .dropdown summary .with-down-arrow {
            display: inline-flex;
            padding: 5px;
            align-items: center;
            color: #fff;
            line-height: 1;
        }

        .dropdown-container .dropdown summary .with-down-arrow::after {
            content: "";
            font-family: "Material Symbols Outlined";
            font-weight: normal;
            font-style: normal;
            font-size: 1.5rem;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-smoothing: antialiased;
        }

        .dropdown-container .dropdown.left ul {
            left: 0;
        }

        .dropdown-container .dropdown.right ul {
            right: 0;
        }

        .dropdown-container .dropdown ul {
            padding: 0;
            margin: 0;
            box-shadow: 0 0 10px #00000030;
            min-width: max-content;
            position: absolute;
            top: 100%;
            border-radius: 10px;
            background-color: #fff;
            z-index: 2;
        }

        .dropdown-container .dropdown ul li {
            list-style-type: none;
            display: block;
            /* If you use divider & borders, it's best to use top borders */
            /*border-top: 1px solid #ccc;*/
        }

        .dropdown-container .dropdown ul li:first-of-type {
            border: none;
            background-color: #f2f2f2;
        }

        .dropdown-container .dropdown ul li p {
            padding: 10px 15px;
            margin: 0;
        }

        .dropdown-container .dropdown ul li a {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 10px 15px;
            text-decoration: none;
            line-height: 1;
            color: #333;
        }

        .dropdown-container .dropdown ul li a:hover {
            color: #474644a7;
        }

        .dropdown-container .dropdown ul li:first-of-type {
            border-radius: 10px 10px 0 0;
        }

        .dropdown-container .dropdown ul li:last-of-type {
            border-radius: 0 0 10px 10px;
        }

        .dropdown-container .dropdown ul li.divider {
            border: none;
            border-bottom: 1px solid #333;
            /*
   * removes border from Li after the divider element
   * best used in combination with top borders on other LIs
   */
        }

        .dropdown-container .dropdown ul li.divider~li {
            border: none;
        }

        /*
-----------------
IGNORE: CODEPEN STYLES
-----------------
*/
        * {
            box-sizing: border-box;
        }





        /* section blockquote {
            padding: 10px 15px;
            border-radius: 6px;
            background: #f2f2f2;
            margin: 0 0 20px 0;
            width: 100%;
            border-left: 5px solid #ff34b2;
        } */

        /* section article {
            box-shadow: 0 0 10px #00000030;
            border-radius: 6px;
            margin: 20px 0;
        } */

        /* nav {
            background: #232224;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 6px;
        } */

        /* nav .links {
            display: flex;
            align-items: center;
        } */
        /*
        nav .links a {
            text-decoration: none;
            color: #fff;
            padding: 10px 15px;
        } */

        /* nav .links a.icon-logo {
            font-size: 1.5rem;
            line-height: 1;
            color: #ff34b2;
        } */

        .block {
            display: block;
        }

        .bold {
            font-weight: bold;
        }

        .italic {
            font-style: italic;
        }
    </style>

</head>
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li><a href="{{ url('wishlist') }}"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
        <li><a href="{{ url('cart') }}"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
    </ul>
    <div class="offcanvas__logo">
        <a href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
        <a href="{{ url('login') }}">Login</a>
        <a href="{{ url('register') }}">Register</a>
    </div>
</div>
<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="home"><img src="{{ asset('assets/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ url('home') }}">Home</a>
                        </li>
                        {{-- <li><a href="#">Women’s</a></li>
                        <li><a href="#">Men’s</a></li> --}}
                        <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="{{ url('shop') }}">Shop</a>
                        </li>
                        <li class="{{ Request::is('pages') ? 'active' : '' }}"><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="product-details.html">Product Details</a></li>
                                <li><a href="shop-cart.html">Shop Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="{{ url('blog') }}">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('all_product') ? 'active' : '' }}"><a
                                href="{{ url('all_product') }}">Category</a>
                            <ul class="dropdown">
                                <li><a href="{{ url('all_product/men') }}">Men</a></li>
                                <li><a href="{{ url('all_product/women') }}">Women</a></li>
                                <li><a href="{{ url('all_product/kids') }}">Kids</a></li>
                                <li><a href="{{ url('all_product/grocery') }}">Grocery</a></li>
                            </ul>
                        </li>

                        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a
                                href="{{ url('contact') }}">Contact</a></li>

                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        @if (session('email'))
                            {{-- <p>Welcome {{session('email')}}</p> --}}
                        @else
                            <a href="login">Login</a>
                            <a href="register">Register</a>
                        @endif
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="{{ url('wishlist') }}"><span class="icon_heart_alt"></span>
                                <?php
                                $user_data = DB::table('users')->where('email', session('email'))->first();
                                if ($user_data == true) {
                                    $user_id = $user_data->id;
                                    $wishlist_data = DB::table('wishlist')->where('user_id', $user_id)->count();
                                } else {
                                    // redirect me to login page
                                    $wishlist_data = 0;
                                }
                                ?>
                                <div class="tip">{{ $wishlist_data }}</div>
                            </a></li>
                        <li><a href="{{ url('cart') }}"><span class="icon_bag_alt"></span>
                                @php
                                    $user_data = DB::table('users')->where('email', session('email'))->first();
                                    // print_r($user_data);
                                    // exit();
                                    if ($user_data == true) {
                                        $user_id = $user_data->id;
                                        $cart_data = DB::table('addtocart')->where('user_id', $user_id)->count();
                                    } else {
                                        $cart_data = 0;
                                    }
                                @endphp

                                <div class="tip">{{ $cart_data }}</div>
                            </a></li>
                        {{-- @if (session('email'))

                        <li style="margin-right: 10px;"><a href="{{url('logout')}}"><span class="fa fa-sign-out" style="font-size:20px margin-right:10px"></span>
                        @else

                        @endif --}}

                        </a></li>
                        @if (session('email'))
                            <div class="dropdown-container">
                                <details class="dropdown right">
                                    <summary class="avatar">
                                        <img src="{{ asset('assets/img/user.png') }}" alt=" ">
                                    </summary>
                                    <ul>
                                        <!-- Optional: user details area w/ gray bg -->
                                        <li
                                            style="
                                    margin-right: 0px;
                                ">
                                            <p>
                                                <span class="block bold">{{ $user_data->name }}</span>
                                                <span class="block italic">{{ $user_data->email }}</span>
                                            </p>
                                        </li>
                                        <!-- Menu links -->
                                        <li
                                            style="
                                    margin-right: 0px;
                                ">
                                            <a href="{{ url('user-profile') }}">
                                                <span class="material-symbols-outlined">account_circle</span> Account
                                            </a>
                                        </li>
                                        <li
                                            style="
                                    margin-right: 0px;
                                ">
                                            <a href="{{ url('orders') }}">
                                                <span class="material-symbols-outlined">local_shipping</span>
                                                Orders
                                            </a>
                                        </li>
                                        <li
                                            style="
                                    margin-right: 0px;
                                ">
                                            <a href="#">
                                                <span class="material-symbols-outlined">help</span> Help
                                            </a>
                                        </li>
                                        <!-- Optional divider -->
                                        <li class="divider"></li>
                                        <li
                                            style="
                                    margin-right: 0px;
                                ">
                                            <a href="{{ url('logout') }}">
                                                <span class="material-symbols-outlined">logout</span> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </details>
                            </div>
                        @else
                        @endif

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
                        <a href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt=""></a>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        cilisis.</p>
                    <div class="footer__payment">
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-1.png') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-2.png') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-3.png') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-4.png') }}"
                                alt=""></a>
                        <a href="#"><img src="{{ asset('assets/img/payment/payment-5.png') }}"
                                alt=""></a>
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
                    <p>Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i
                            class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com/"
                            target="_blank">Colorlib</a>
                    </p>
                </div>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<script>
    function closeOpenDropdowns(e) {
        let openDropdownEls = document.querySelectorAll("details.dropdown[open]");

        if (openDropdownEls.length > 0) {
            // If we're clicking anywhere but the summary element, close dropdowns
            if (e.target.parentElement.nodeName.toUpperCase() !== "SUMMARY") {
                openDropdownEls.forEach((dropdown) => {
                    dropdown.removeAttribute("open");
                });
            }
        }
    }

    document.addEventListener("click", closeOpenDropdowns);
</script>

<!-- Js Plugins -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>


<!-- Mirrored from themewagon.github.io/ashion/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 10:05:33 GMT -->

</html>
