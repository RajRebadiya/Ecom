@extends('layout.template')

@section('content')
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

    <!-- Product Section Begin -->
    <section class="product spad">
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
            <div class="row property__gallery">
                @foreach ($data as $category)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                        @php
                            $images = explode(',', $category->image);
                            // print_r($images);
                        @endphp
                        <div class="product__item" style='cursor: pointer'>
                            <div class="product__item__pic set-bg" style='height: 200px; width: 300px'
                                data-setbg="{{ asset('storage/images/product/' . $images[0]) }}">
                                {{-- <div class="label new">New</div> --}}
                                <ul class="product__hover">
                                    <li>
                                        <a href="{{ asset('storage/images/product/' . $category['image']) }}"
                                            onclick="preventDefaultAction(event)" class="image-popup"><span
                                                class="arrow_expand"></span></a>
                                    </li>
                                    {{-- <li><form method='post' action='{{url('add-to-wishlist')}}'>@csrf <a href="#"><span type="submit" class="icon_heart_alt"></span></a><input type="hidden" name="product_id" value="{{$category->id}}"></form>
                            </li> --}}
                                    @php
                                        if (session()->has('email')) {
                                            $user = DB::table('users')->where('email', session('email'))->first();
                                            $user_id = $user->id;
                                            $wish = DB::table('wishlist')
                                                ->where('user_id', $user_id)
                                                ->where('product_id', $category->id)
                                                ->first();
                                            $wish_count = DB::table('wishlist')
                                                ->where('user_id', $user_id)
                                                ->where('product_id', $category->id)
                                                ->count();
                                        } else {
                                            $wish_count = 0;
                                        }

                                    @endphp
                                    <li>
                                        <form method="post" action="{{ url('add-to-wishlist') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $category->id }}">
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

                                            <input type="hidden" name="product_id" value="{{ $category->id }}">
                                            <a href="">
                                                <button type="submit" class="normal_btn">
                                                    <span class="icon_bag_alt"></span>
                                                </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $category->name }}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ {{ $category->price }}</div>
                                <div class="product__price"><input type="hidden" value="{{ $category->id }}"></div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
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
    <!-- Product Section End -->
@endsection
