@extends('layout/template')

@section('title', 'Shop')
@section('content')

    <style>
        svg.w-5.h-5 {
            width: 20px;
        }

        .flex.justify-between.flex-1.sm\:hidden {
            display: none;
        }

        p.text-sm.text-gray-700.leading-5.dark\:text-gray-400 {
            display: none;
        }

        a.relative.inline-flex.items-center.px-2.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.rounded-r-md.leading-5.hover\:text-gray-400.focus\:z-10.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-500.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:active\:bg-gray-700.dark\:focus\:border-blue-800 {
            color: red;
        }

        a.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.hover\:text-gray-500.focus\:z-10.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:text-gray-400.dark\:hover\:text-gray-300.dark\:active\:bg-gray-700.dark\:focus\:border-blue-800 {
            color: red;
        }

        a.relative.inline-flex.items-center.px-2.py-2.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.rounded-l-md.leading-5.hover\:text-gray-400.focus\:z-10.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-500.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:active\:bg-gray-700.dark\:focus\:border-blue-800 {
            color: red;
        }

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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            color: #333;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination li a:hover {
            background-color: #f8f8f8;
        }

        .pagination li.active a {
            background-color: #333;
            color: #fff;
            border-color: #333;
        }
    </style>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="home"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
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
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <form action="{{ url('filter') }}" method="post">
                            @csrf
                            <div class="sidebar__categories" class='mb-0' style='margin-bottom: 0px'>

                                <div class="categories__accordion">

                                    <div id="accordionExample">
                                        <div class="card">
                                            <div class="sidebar__sizes">
                                                <div class="section-title">
                                                    <h4>Categories</h4>
                                                </div>

                                                @if (url()->current() == url('shop'))
                                                    @foreach ($data as $size)
                                                        <div class="size__list">
                                                            <label for="{{ $size->name }}">
                                                                {{ $size->name }}
                                                                <input type="checkbox" name="category[]"
                                                                    value="{{ $size->name }}" id="{{ $size->name }}">

                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach ($data as $size)
                                                        <div class="size__list">
                                                            <label for="{{ $size->name }}">
                                                                {{ $size->name }}
                                                                <input type="checkbox" name="category[]"
                                                                    value="{{ $size->name }}" id="{{ $size->name }}"
                                                                    @if (in_array($size->name, $categories)) checked @endif>

                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="sidebar__filter">
                                <div class="section-title">
                                    <h4>Shop by price</h4>
                                </div>
                                <div class="filter-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="100" data-max="10000"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p>Price:</p>
                                            <input type="text" name="min_price" id="minamount" style='max-width: 21%;'
                                                value="{{ $minPrice ?? '' }}">
                                            <span>-</span>
                                            <input type="text" name='max_price' id="maxamount" style='max-width: 24%;'
                                                value="{{ $maxPrice ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Shop by size</h4>
                                </div>
                                @if (url()->current() == url('shop'))
                                    @php
                                        $uniqueSizes = $product->unique('size')->pluck('size');
                                    @endphp

                                    @foreach ($uniqueSizes as $size)
                                        <div class="size__list">
                                            <label for="{{ $size }}">
                                                {{ $size }}
                                                <input type="checkbox" name="size[]" value="{{ $size }}"
                                                    id="{{ $size }}">

                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    @php
                                        $uniqueSizes = $products->unique('size')->pluck('size');
                                    @endphp

                                    @foreach ($uniqueSizes as $size)
                                        <div class="size__list">
                                            <label for="{{ $size }}">
                                                {{ $size }}
                                                <input type="checkbox" name="size[]" value="{{ $size }} "
                                                    id="{{ $size }}"
                                                    @if (in_array($size, $sizes)) checked @endif>



                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif






                            </div>
                            <div class="sidebar__color">
                                <div class="section-title">
                                    <h4>Shop by Color</h4>
                                </div>
                                @if (url()->current() == url('shop'))

                                    @php
                                        $uniquecolor = $product->unique('color')->pluck('color');
                                    @endphp
                                    @foreach ($uniquecolor as $item)
                                        <div class="size__list color__list">
                                            <label for="{{ $item }}">
                                                {{ $item }}
                                                <input type="checkbox" name="color[]" value="{{ $item }} "
                                                    id="{{ $item }}">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    @endforeach
                                @else
                                    @php
                                        $uniquecolor = $products->unique('color')->pluck('color');
                                    @endphp
                                    @foreach ($uniquecolor as $item)
                                        <div class="size__list color__list">
                                            <label for="{{ $item }}">
                                                {{ $item }}
                                                <input type="checkbox" name="color[]" value="{{ $item }}"
                                                    id="{{ $item }}"
                                                    @if (in_array($item, $colors)) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    @endforeach

                                @endif

                                @if (url()->current() == url('filter'))
                                    <a href="{{ url('reset') }}">
                                        <button type="button"
                                            style="font-size: 14px; color: #0d0d0d; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; display: inline-block; padding: 5px 16px 5px 24px; border: 2px solid #ff0000; right: 0; bottom: -5px; border-radius: 2px;"'
                                            id="">Reset</button>
                                    </a>
                                @endif



                                <a href="{{ url('filter') }}">
                                    <button type="submit"
                                        style="font-size: 14px; color: #0d0d0d; text-transform: uppercase; letter-spacing: 2px; font-weight: 700; display: inline-block; padding: 5px 16px 5px 24px; border: 2px solid #ff0000; right: 0; bottom: -5px; border-radius: 2px;"
                                        id="filterButton">Filter</button>
                                </a>


                            </div>
                        </form>




                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">

                        @foreach ($product as $item)
                            <div class="col-lg-4 col-md-6">
                                @php
                                    $images = explode(',', $item->image);
                                    // print_r($images);
                                @endphp
                                <div class="product__item" style='cursor: pointer'>
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ asset('storage/images/product/' . $images[0]) }}">
                                        {{-- <div class="label new">New</div> --}}
                                        <ul class="product__hover">
                                            <li><a href="{{ asset('storage/images/product/' . $item->image) }}"
                                                    class="image-popup"><span class="arrow_expand"></span></a></li>
                                            @php
                                                if (session()->has('email')) {
                                                    $user = DB::table('users')
                                                        ->where('email', session('email'))
                                                        ->first();
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
                                        <h6><a href="#">{{ $item->name }}</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ {{ $item->price }}</div>
                                        <div class="product__price"><input type="hidden" value="{{ $item->id }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach





                        @if ($product->count() != 0)
                            @if (url()->current() == url('filter'))
                                <div class="col-lg-12 text-center">
                                    @if ($products->lastPage() > 5)
                                        {{ $products->links() }}
                                    @endif

                                </div>
                            @else
                                <div class="col-lg-12 text-center">
                                    {{ $product->links() }}

                                </div>
                            @endif
                        @else
                            <div class="col-lg-12 text-center">
                                <p style=" font-size: 42px;  font-weight: 700; ">
                                    No Products found</p>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
    <script>
        function preventDefaultAction(event) {
            event.preventDefault();
        }
        document.addEventListener('DOMContentLoaded', function() {
            var productItems = document.getElementsByClassName('product__item');

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
        });
    </script>

@endsection
