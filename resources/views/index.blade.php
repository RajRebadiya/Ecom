@extends('layout/template')

@section('title', 'Home')

@Section('content')
    <style>
        .normal_btn {
            border: none;
            background-color: transparent;
            position: relative;
            -webkit-transform: rotate(0);
            -ms-transform: rotate(0);
            transform: rotate(0);
            -webkit-transition: all, 0.3s;
            -o-transition: all, 0.3s;
            transition: all, 0.3s;
            display: inline-block;
        }

        .red_btn {
            font-size: 18px;
            color: #ffffff;
            display: block;
            height: 45px;
            width: 45px;
            background: #ec1d1d;
            line-height: 48px;
            text-align: center;
            border-radius: 50%;
            -webkit-transition: all, 0.5s;
            -o-transition: all, 0.5s;
            transition: all, 0.5s;
            border: none;
        }
    </style>

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            @if (session('error'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @error('error')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="row">

                <div class="col-lg-6 p-0">
                    <div class="categories__item categories__large__item set-bg"
                        data-setbg="{{ asset('assets/img/categories/category-1.jpg') }}">
                        <div class="categories__text">
                            <h1>Women’s fashion</h1>
                            <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                                edolore magna aliquapendisse ultrices gravida.</p>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('assets/img/categories/category-2.jpg') }}">
                                <div class="categories__text">
                                    <h4>Men’s fashion</h4>
                                    <p>358 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('assets/img/categories/category-3.jpg') }}">
                                <div class="categories__text">
                                    <h4>Kid’s fashion</h4>
                                    <p>273 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('assets/img/categories/category-4.jpg') }}">
                                <div class="categories__text">
                                    <h4>Cosmetics</h4>
                                    <p>159 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg"
                                data-setbg="{{ asset('assets/img/categories/category-5.jpg') }}">
                                <div class="categories__text">
                                    <h4>Accessories</h4>
                                    <p>792 items</p>
                                    <a href="#">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>New product</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">All</li>

                        @foreach ($category as $item)
                            <li class="" onclick='latestProducts({{ $item->id }})'
                                data-filter="{{ $item->id }}">
                                {{ $item->name }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="row property__gallery" id="product">
                @foreach ($product as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                        <div class="product__item" style='cursor: pointer'>
                            @php
                                $image = explode(',', $item->image);
                                $images = $image[0];
                                // print_r($images);
                            @endphp
                            <div class="product__item__pic set-bg" height='200' width='300'
                                data-setbg="{{ asset('storage/images/product/' . $images) }}">

                                @php
                                    if (session('email')) {
                                        $user = DB::table('users')->where('email', session('email'))->first();
                                        $user_id = $user->id;
                                        $wish = DB::table('wishlist')
                                            ->where('user_id', $user_id)
                                            ->where('product_id', $item->id)
                                            ->first();
                                        $wish_count = DB::table('wishlist')
                                            ->where('user_id', $user_id)
                                            ->where('product_id', $item->id)
                                            ->count();
                                    } else {
                                        $wish_count = 0;
                                    }

                                @endphp
                                <ul class="product__hover">
                                    <li><a href="{{ asset('storage/images/product/' . $item->image) }}"
                                            class="image-popup img"><span class="arrow_expand"></span></a></li>
                                    <li>
                                        <form method="post" action="{{ url('add-to-wishlist') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            <input type="hidden" name="user_id" value="{{ session('email') }}">
                                            <a href="">
                                                <button type="submit"
                                                    class="{{ $wish_count > 0 ? 'red_btn' : 'normal_btn' }}">
                                                    <span class="icon_heart_alt"></span>
                                                </button>
                                            </a>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ url('add-to-cart') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $item->id }}">
                                            <a href="">
                                                <button type="submit" class="normal_btn">
                                                    <span class="icon_bag_alt"></span>
                                                </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6 id='product_name'><a href="#">{{ $item->name }}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ {{ $item->price }}</div>
                                <div class="product__price"><input type="hidden" value="{{ $item->id }}"></div>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all oder over $99</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If good have Problems</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="{{ asset('assets/img/banner/banner-1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <script>
        function latestProducts(id) {
            // alert(id);


            $.ajax({
                url: '{{ url('latest-product') }}',
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({
                    id: id
                }),
                success: function(response) {

                    console.log('response:', response);
                    // Filter the products based on the selected category
                    const filteredProducts = response.filter(data => data.c_id === id);
                    // console.log('filteredProducts:', filteredProducts);
                    // Render the filtered products on the page
                    renderProducts(filteredProducts);

                },

            });
        }

        function renderProducts(products) {
            $('#product').empty();

            products.forEach(product => {
                const productHtml = `
            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                <div class="product__item" style="cursor: pointer">
                    <img class="product__item__pic set-bg" height="200" width="300" src="${`storage/images/product/${product.image}`}" />
                        <ul class="product__hover">
                            <li>
                                <a href="${`storage/images/product/${product.image}`}" class="image-popup img">
                                    <span class="arrow_expand"></span>
                                </a>
                            </li>
                            <li>
                                <form method="post" action="${`{{ url('add-to-wishlist') }}`}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    <input type="hidden" name="user_id" value="${`{{ session('email') }}`}">
                                    <a href="">
                                        <button type="submit" class="${`{{ $wish_count > 0 ? 'red_btn' : 'normal_btn' }}`}">
                                            <span class="icon_heart_alt"></span>
                                        </button>
                                    </a>
                                </form>
                            </li>
                            <li>
                                <form action="${`{{ url('add-to-cart') }}`}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="${product.id}">
                                    <a href="">
                                        <button type="submit" class="normal_btn">
                                            <span class="icon_bag_alt"></span>
                                        </button>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="product__item__text">
                        <h6 id="product_name"><a href="#">${product.name}</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ ${product.price}</div>
                         <div class="product__price"><input type="hidden" value="${product.id}"></div>

                    </div>
                </div>
            </div>
        `;

                $('#product').append(productHtml);
            });
        }

        function getAllProducts() {
            $.ajax({
                type: 'GET',
                url: '{{ url('all-products') }}',
                success: function(data) {
                    renderProducts(data);
                }
            });
        }





        function preventDefaultAction(event) {
            event.preventDefault();
        }
        document.addEventListener('DOMContentLoaded', function() {
            var productItems = document.getElementsByClassName('product__item');
            console.log('productItems:', productItems);

            // Loop through each product item
            for (var i = 0; i < productItems.length; i++) {
                // Add click event listener to each product item
                productItems[i].addEventListener('click', function() {
                    // Get the product ID
                    var productId = this.querySelector('.product__price input[type="hidden"]').value;

                    // Construct the product detail page URL
                    var productDetailUrl = "{{ url('product-detail') }}/" + productId;

                    // Redirect to the product detail page
                    window.location.href = productDetailUrl;
                });
            }
            $('.filter__controls li').on('click', function() {
                const categoryId = $(this).data('filter');
                console.log('categoryId:', categoryId);
                if (categoryId === '*') {
                    // If "All" is clicked, get all products
                    getAllProducts();
                } else {
                    // If a category is clicked, get latest products by category ID
                    latestProducts(categoryId);
                }
            });
        });
    </script>




@endsection
