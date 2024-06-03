@extends('layout.template')

@section('content')

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <form action="{{url('payment')}}" class="checkout__form" method='POST' id="checkoutForm">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style='margin-bottom: 20px'>
                            <div class="checkout__form__input">
                                <p>Full Name <span>*</span></p>
                                <input type="text" name="fullname" id="fullname">
                                @error('fullname')
                                <span class="error-message" style='color: red;  '>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Country <span>*</span></p>
                                <input type="text" name="country" id="country">
                                <span class="error-message" id="country-error"></span>
                            </div>
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Address <span>*</span></p>
                                <input type="text" name='address' id="address" placeholder="Street Address">
                                @error('address')
                                <span class="error-message" style='color: red;  '>{{ $message }}</span>
                                @enderror
                                <span class="error-message" id="address-error"></span>
                                <input type="text" placeholder="Apartment. suite, unit etc (optional)">
                            </div>
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Town/City <span>*</span></p>
                                <input type="text" name="city" id="city">
                                <span class="error-message" id="city-error"></span>
                            </div>
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Country/State <span>*</span></p>
                                <input type="text" name="state" id="state">
                                <span class="error-message" id="state-error"></span>
                            </div>
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text" name='pincode' id="pincode">
                                @error('pincode')
                                <span class="error-message" style='color: red;  '>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Phone <span>*</span></p>
                                <input type="text" name='mobile' id="mobile">
                                @error('mobile')
                                <span class="error-message" style='color: red;  '>{{ $message }}</span>
                                @enderror
                                <span class="error-message" id="mobile-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input" style='margin-bottom: 20px'>
                                <p>Email <span>*</span></p>
                                <input type="text" name="email" id="email">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                @php
                                $user_id = DB::table('users')->where('email',session('email'))->first()->id;
                                $order_id = DB::table('user_order')->where('user_id',$user_id)->latest()->first()->id;
                                $orderItems = DB::table('order_item')->where('order_id',$order_id)->get();
                                @endphp

                                @foreach ($orderItems as $item)
                                <li> {{$item->name}} <span>$ {{$item->total}}</span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li name='sub_total'>Subtotal <span>${{$order->main_total}}</span></li>
                                <li name='discount'>Discount <span>${{$order->discount}}</span></li>
                                <input type="hidden" name="sub_total" value="{{$order->main_total}}">
                                <li name="final_total">Total <span>$ {{$order->final_total}}</span></li>
                                <input type="hidden" name="total_amount" value="{{$order->final_total}}">
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="hidden" name="discount" value="{{$order->discount}}">
                                <input type="hidden" name="user_id" value="{{$user_id}}">
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                            <label for="razorpay">
                                Razorpay
                                <input type="checkbox" id="razorpay" name="p_type" value="Razorpay">
                                <span class="checkmark"></span>
                            </label>
                            <label for="COD">
                                Cash On Delivery
                                <input type="checkbox" id="COD" name="p_type" value="COD">
                                <span class="checkmark"></span>
                            </label>
                            @error('p_type')
                            <span class="error-message" style='color: red;  '>{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" id='placeOrderButton' class="site-btn">Place order</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>
<!-- Checkout Section End -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    // Variable to track if the "Place Order" button is clicked
    let placeOrderClicked = false;

    // Event listener for "Place Order" button click
    document.getElementById('placeOrderButton').addEventListener('click', function() {
        placeOrderClicked = true;
        document.getElementById('checkoutForm').submit();

    });


    window.addEventListener('beforeunload', function(e) {
        if (!placeOrderClicked) {


            // Send an AJAX request to delete the temporary order
            fetch('{{ route("deleteTemporaryOrder") }}', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

        }


    });

</script>

</script>
<script>
    document.getElementById('razorpay').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('COD').checked = false;
        }
    });

    document.getElementById('COD').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('razorpay').checked = false;
        }
    });

</script>



@endsection
