@extends('layout.template')

@section('content')
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        @foreach ($order_item as $item)
                            <div class="blog__details__item">
                                {{-- @foreach ($product_id as $itm) --}}
                                @php
                                    $images = explode(',', $item->image);
                                    // print_r($images);
                                @endphp
                                <img height="300" width="500" src="{{ asset('storage/images/product/' . $images[0]) }}"
                                    alt="">
                                {{-- @endforeach --}}
                                <div class="blog__details__item__title">
                                    <span class="tip">#{{ $item->id }}</span>
                                    <h4>{{ $item->name }}</h4>
                                    <ul>
                                        {{-- <li>by <span>Ema Timahe</span></li> --}}
                                        <li>{{ $item->p_qty }}</li>
                                        <li>${{ $item->price }}</li>
                                        <li>${{ $item->price * $item->p_qty }}</li>
                                        <li>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Order Detail</h4>
                            </div>
                            <ul>
                                <li><span>Order ID:</span> {{ $data->invoice_id }}</li>
                                <li><span>Order Date:</span>
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('M d, Y') }}</li>
                                <li><span>Total:</span> ${{ $data->total_amount }}</li>
                                <li><span>Status:</span> {{ $data->order_status }}</li>


                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
