@extends('layout.template')

@section('content')

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <form action="#" class="checkout__form">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>First Name <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Last Name <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Country <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" placeholder="Street Address">
                                <input type="text" placeholder="Apartment. suite, unite ect ( optinal )">
                            </div>
                            <div class="checkout__form__input">
                                <p>Town/City <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Country/State <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Phone <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Email <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__checkbox">
                                <label for="acc">
                                    Create an acount?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create am acount by entering the information below. If you are a returing
                                    customer login at the <br />top of the page</p>
                            </div>
                            <div class="checkout__form__input">
                                <p>Account Password <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__checkbox">
                                <label for="note">
                                    Note about your order, e.g, special noe for delivery
                                    <input type="checkbox" id="note">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__form__input">
                                <p>Oder notes <span>*</span></p>
                                <input type="text" placeholder="Note about your order, e.g, special noe for delivery">
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
                                <li>Subtotal <span>${{$order->main_total}}</span></li>
                                <li>Total <span>$ {{$order->final_total}}</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                            <label for="o-acc">
                                Create an acount?
                                <input type="checkbox" id="o-acc">
                                <span class="checkmark"></span>
                            </label>
                            <p>Create am acount by entering the information below. If you are a returing customer
                                login at the top of the page.</p>
                            <label for="check-payment">
                                Cheque payment
                                <input type="checkbox" id="check-payment">
                                <span class="checkmark"></span>
                            </label>
                            <label for="paypal">
                                PayPal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" id='placeOrderButton' class="site-btn">Place oder</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->

<script>
    // Variable to track if the "Place Order" button is clicked
    let placeOrderClicked = false;

    // Event listener for "Place Order" button click
    document.getElementById('placeOrderButton').addEventListener('click', function() {
        placeOrderClicked = true;
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


@endsection