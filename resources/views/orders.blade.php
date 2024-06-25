@extends('layout.template')

@section('content')
    <!-- Trend Section Begin -->
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Orders</h4>
                        </div>
                        @php
                            $uniqueInvoiceIds = [];
                        @endphp

                        @foreach ($data as $item)
                            @if (!in_array($item->invoice_id, $uniqueInvoiceIds))
                                @php
                                    $uniqueInvoiceIds[] = $item->invoice_id;
                                @endphp

                                <div class="trend__item">
                                    <div class="trend__item__pic">
                                        @php
                                            $images = explode(',', $item->image);
                                            // print_r($images);
                                        @endphp
                                        <img height="200" width="300"
                                            src="{{ asset('storage/images/product/' . $images[0]) }}" alt="">
                                    </div>
                                    <div class="trend__item__text">
                                        <h6>{{ $item->fullname }}</h6>
                                        <div class="rating">
                                            <p class="mb-0">Order : {{ $item->invoice_id }}</p>
                                            <p>Order Date : {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                            </p>
                                        </div>
                                        <div class="product__price">Total : ${{ $item->total_amount }}</div>
                                        <form action="{{ url('full_order') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $item->order_id }}">
                                            <button type="submit" class="primary-btn"
                                                style="border: none; margin-top: 10px; border-radius: 26px;">View
                                                Details</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach


                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Zip-pockets pebbled tote <br />briefcase</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/bs-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Round leather bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-1.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Bow wrap skirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Metallic earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="img/trend/f-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Flap cross-body bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>
    </section>
    <!-- Trend Section End -->
@endsection
