@extends('layout.template')

@section('content')
    <style>

    </style>
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
            <div class="row">


                <div class="col-lg-6">
                    <div class="product__details__pic">
                        @php
                            $images = explode(',', $datas->image);
                            // print_r($images);
                        @endphp
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            <a class="pt active" href="#product-1">
                                <img src="{{ asset('storage/images/product/' . $images[0]) }}" alt="">
                            </a>
                            <a class="pt" href="#product-3">
                                <img src="{{ isset($images[1]) ? asset('storage/images/product/' . $images[1]) : asset('storage/images/product/' . end($images)) }}"
                                    alt="">
                            </a>
                            <a class="pt" href="#product-3">
                                <img src="{{ isset($images[2]) ? asset('storage/images/product/' . $images[2]) : asset('storage/images/product/' . end($images)) }}"
                                    alt="">
                            </a>
                            <a class="pt" href="#product-3">
                                <img src="{{ isset($images[3]) ? asset('storage/images/product/' . $images[3]) : asset('storage/images/product/' . end($images)) }}"
                                    alt="">
                            </a>
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-hash="product-1" class="product__big__img"
                                    src="{{ asset('storage/images/product/' . $images[0]) }}" alt="">
                                <img data-hash="product-2" class="product__big__img"
                                    src="{{ isset($images[1]) ? asset('storage/images/product/' . $images[1]) : asset('storage/images/product/' . end($images)) }}"
                                    alt="">
                                <img data-hash="product-3" class="product__big__img"
                                    src="{{ isset($images[2]) ? asset('storage/images/product/' . $images[2]) : asset('storage/images/product/' . end($images)) }}"
                                    alt="">
                                <img data-hash="product-4" class="product__big__img"
                                    src="{{ isset($images[3]) ? asset('storage/images/product/' . $images[3]) : asset('storage/images/product/' . end($images)) }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{ $datas->name }}</h3>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span>( 138 reviews )</span>
                        </div>
                        <div class="product__details__price">$ {{ $datas->sell_price }} <span>$ {{ $datas->price }}</span>
                        </div>
                        <p>Nemo enim ipsam voluptatem quia aspernatur aut odit aut loret fugit, sed quia consequuntur
                            magni lores eos qui ratione voluptatem sequi nesciunt.</p>

                        <div class="product__details__button">
                            <form action="{{ url('add-to-cart') }}" method="post">

                                <div class="quantity">
                                    <label
                                        style="    display: inline-block;
                                                  margin-bottom: .5rem;
                                                 margin-right: 26px;">Quantity
                                    </label>
                                    <div class="pro"
                                        style="
                                    display: inline-block;
                                    margin-top: 13px;
                                ">
                                        <span class="dec qtybtn" style='cursor: pointer;'>-</span>
                                        <input style="width: 102px;border: none;text-align: center;" name='p_qty'
                                            class="quantity-input" value='1' min="1">
                                        <span class="inc qtybtn" style='cursor: pointer;'>+</span>
                                    </div>
                                    @csrf
                                    <button type="submit" class="cart-btn"
                                        style="border: none;/* display: inline-block; */float: right;margin-left: 60px;"><span
                                            class="icon_bag_alt"></span> Add to
                                        cart</button>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $datas->id }}">
                            </form>


                        </div>


                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Availability:</span>
                                    <div class="stock__checkbox">
                                        <label for="stockin">
                                            @if ($datas->qty < 0)
                                                Out of Stock
                                            @else
                                                In Stock
                                            @endif
                                            <input type="checkbox" id="stockin">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">

                                        <label for="{{ $datas->color }}">
                                            <input type="radio" name="color__radio" id="red" checked>
                                            <span class="checkmark" style="background: {{ $datas->color }}"></span>
                                        </label>

                                    </div>
                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__checkbox">
                                        <label for="{{ $datas->size }}" class="active">
                                            <input type="radio" id="xs-btn">
                                            {{ $datas->size }}
                                        </label>

                                    </div>
                                </li>
                                <li>
                                    <span>Promotions:</span>
                                    <p>Free shipping</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1"
                                    role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Description</h6>
                            <p>{{ $datas->description }}</p>

                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Specification</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <h6>Reviews (2)</h6>
                            <div class="give-review-container">
                                <button class="give-review-btn" data-toggle="modal" data-target="#exampleModal"
                                    style="
                                float: right;
                                /* display: inline-block; */
                                font-size: 14px;
                                color: #ffffff;
                                background: #ca1515;
                                font-weight: 600;
                                text-transform: uppercase;
                                padding: 8px 10px 8px;
                                border-radius: 8px;
                                float: right;
                                margin-right: -1px;
                                margin-bottom: 3px;
                                border: none;
                            ">Give
                                    Review</button>
                                <!-- Modal -->

                                @php
                                    if (session()->has('email')) {
                                        $user = DB::table('users')->where('email', session('email'))->first();
                                        $user_id = $user->id;
                                    } else {
                                        $user_id = 6;
                                    }

                                @endphp

                                <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ url('review') }}" method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Username:</label>
                                                        <input type="text" name='user_name' class="form-control"
                                                            id="recipient-name">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $datas->id }}">
                                                        <input type="hidden" id="user_id" name="user_id"
                                                            value="{{ $user_id }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Reviews:</label>
                                                        <textarea class="form-control" name="detail" id="message-text"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Save changes</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (count($reviews) > 0)
                                @foreach ($reviews as $item)
                                    <div class="review">
                                        <div class="review-header">
                                            <img width="50" height="50"
                                                src="{{ asset('storage/images/' . $item['image']) }}" alt="User Avatar">
                                            <span>{{ $item->user_name }}</span>
                                        </div>
                                        <p>{{ $item->detail }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p>No reviews yet</p>
                            @endif



                        </div>
                    </div>
                </div>

            </div>
            {{-- </div> --}}


        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const decrementBtn = document.querySelector('.dec');
            const incrementBtn = document.querySelector('.inc');
            const quantityInput = document.querySelector('.quantity-input');

            decrementBtn.addEventListener('click', function() {
                // Ensure value doesn't go below 1
                if (quantityInput.value > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            });

            incrementBtn.addEventListener('click', function() {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            });


        });

        function openModal() {
            $('#reviewModal').modal('show');
        }

        function saveReview() {
            // Get form values
            var username = $('#username').val();
            var review = $('#review').val();


            // Perform AJAX request to save the review in the database
            $.ajax({
                url: '/save-review',
                method: 'POST',
                data: {

                    username: username,
                    review: review
                },
                success: function(response) {
                    // Handle success response
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(error);

                }
            });
        }
    </script>
    <!-- Product Details Section End -->
@endsection
