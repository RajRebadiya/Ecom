@extends('layout.template')

@section('content')
<style>
    /* Example styles to match the span design */
    .icon_close {
        display: inline-block;
        width: 24px;
        height: 24px;
        background: url('icon_close.png') no-repeat center center;
        /* Replace with your icon URL */
        background-size: contain;
        cursor: pointer;
    }

    .cart__close button {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }

</style>

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title">

                    <h4 class='mb-5' style='font-weight: 600;'>Cart</h4>
                </div>
            </div>
            <div class="col-lg-6 float-right ">


                <?php
                //if my cart is empty then remove all buttone will be disabled
                $remove_all = DB::table('addtocart')->where('user_id', $user_id = DB::table('users')->where('email', session('email'))->first()->id)->count();
                if($remove_all != 0){
                    ?>
                <form action="{{url('remove-all-cart')}}" method="post">
                    @csrf
                    <button style="display: block" class="view__all float-right btn btn-danger light mt-1 ">Remove All</button>
                </form>
                <?php
                }
                ?>


            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif




        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                            <tr>


                                <input type="hidden" name="user_id" value="{{$item->user_id}}">
                                <input type="hidden" name="product_id" value="{{$item->product_id}}">
                                <td class="cart__product__item">
                                    <img style='height: 100px; width: 100px;' src="{{ asset('storage/images/product/' . $item->image) }}" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>{{ $item->name }}</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price"> <span class="item-price">{{ $item->price }}</span></td>
                                <td class="cart__quantity">


                                    <div class="pro">
                                        <span id='' onclick="decreaseQty({{ $item->id }})" class="dec qtybtn" style='cursor: pointer;'>-</span>
                                        <input id="sst-{{ $item->id }}" style="width: 102px;border: none;text-align: center;" name='p_qty' onchange="updateCartQty({{ $item->id }});" class="quantity-input" value="{{ $item->p_qty }}" min="1">
                                        <span id='' onclick="increaseQty({{ $item->id }})" class="inc qtybtn" style='cursor: pointer;'>+</span>
                                    </div>

                                </td>
                                <td class="cart__total">
                                    <span id='item-qty-total-{{ $item->id }}' class="item-total">₹{{ $item->price * $item->p_qty }}</span>
                                </td>

                                <td class="cart__close">

                                    <form action="{{ url('delete-cart/'.$item->id)}}" method="post">
                                        @csrf
                                        <button class="icon_close" type="submit"></button>
                                    </form>

                                </td>


                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{url('all_product')}}">Continue Shopping</a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6 style='margin-left: 12px'>Discount codes</h6>
                    <div id="mess_coup_div" style="font-weight:700;color:green"></div>
                    <div id="mess_coup_error" style="font-weight:700;color:red"></div>
                    <input type="text" id='coupon-form' style="
                        padding: 7px;
                        /* border-radius: 22px; */
                        /* border: 2px solid black; */
                        background: #f5f5f5;
                        border: none;
                        color: rgb(170 22 22);
                        font-weight: 500;
                    " placeholder="Enter your coupon code" name="coupon">
                    <button type="button" class="site-btn" onclick="check_coupon()">Apply</button>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        {{-- @php
                        $cartItems = DB::table('addtocart')
                        ->join('products', 'addtocart.product_id', '=', 'products.id')
                        ->where('addtocart.user_id', $user_id = DB::table('users')->where('email', session('email'))->first()->id)
                        ->select('addtocart.p_qty', 'products.price')
                        ->get();

                        $total = 0;
                        foreach ($cartItems as $item) {
                        $total += $item->p_qty * $item->price;
                        }
                        @endphp --}}
                        <li>Subtotal <span class="main-total"></span></li>
                        <li>Discount Amount <span class="discount-amount"></span></li>
                        <li>Total <span class="final-total"></span></li>
                    </ul>
                    <form action="{{route('checkout')}}" method="post">
                        @php
                        $user_id = DB::table('users')->where('email', session('email'))->first()->id;

                        @endphp
                        @csrf
                        <input type="hidden" name="final_total" class='final-total' value="">
                        <input type="hidden" name="main_total" class='main-total' value="">
                        <input type="hidden" name="discount" value="">
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        {{-- <input type="hidden" name="product_id" value="{{$product_id}}"> --}}

                        <button type="submit" class="primary-btn">Proceed to checkout</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</section>



<!-- Shop Cart Section End -->
<!-- Assuming the discount is stored in the session as 'coupon_discount' -->
<!-- Make sure jQuery library is included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function check_coupon() {
        var couponCode = $('#coupon-form').val();
        console.log('Coupon Code:', couponCode);
        $.ajax({
            url: '{{ url("apply-coupon") }}'
            , method: 'POST'
            , headers: {
                'Content-Type': 'application/json'
                , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            , data: JSON.stringify({
                coupon: couponCode
            })
            , success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    $("#mess_coup_div").text(response.success).css('color', 'green');

                    window.coupon = {
                        type: response.type
                        , amount: response.amount
                    };

                    // Update cart total after applying coupon
                    calculateCartTotal();
                } else {
                    $("#mess_coup_error").text(response.error).css('color', 'red');
                    window.coupon = null;
                    calculateCartTotal();
                }
                setTimeout(function() {
                    $("#mess_coup_div, #mess_coup_error , #coupon-form").text("").css('color', '');
                    $('#coupon-form').val('');
                }, 2000); // 2000 milliseconds = 2 seconds
            }
            , error: function(xhr, status, error) {
                $("#mess_coup_div").text("Failed to apply coupon. Please try again.").css('color', 'red');
            }
        });
    }

    function calculateCartTotal() {
        let subtotal = 0;
        $('.item-total').each(function() {
            subtotal += parseFloat($(this).text().replace('₹', ''));
        });

        let discount = 0;
        if (window.coupon) {
            if (window.coupon.type === 'flat') {
                discount = parseFloat(window.coupon.amount);
            } else if (window.coupon.type === 'discount') {
                discount = subtotal * parseFloat(window.coupon.amount) / 100;
            }
        }

        let finalTotal = subtotal - discount;

        $('.main-total').text('₹' + subtotal.toFixed(2));

        // Display discount amount if discount is applied, otherwise reset to zero
        if (discount > 0) {
            $('.discount-amount').text('₹' + discount.toFixed(2));
        } else {
            $('.discount-amount').text('₹0.00');
        }

        $('.final-total').text('₹' + finalTotal.toFixed(2));
        $('input[name="final_total"]').val(finalTotal.toFixed(2));
        $('input[name="main_total"]').val(subtotal.toFixed(2));
        $('input[name="discount"]').val(discount.toFixed(2));
    }


    function increaseQty(itemId) {
        var result = document.getElementById('sst-' + itemId);
        var sst = parseInt(result.value);
        if (!isNaN(sst)) {
            result.value = sst + 1;
            updateCartQty(itemId);
        }
    }

    function decreaseQty(itemId) {
        var result = document.getElementById('sst-' + itemId);
        var sst = parseInt(result.value);
        if (!isNaN(sst) && sst > 1) {
            result.value = sst - 1;
            updateCartQty(itemId);
        }
    }

    function updateCartQty(itemId) {
        var qty = $('#sst-' + itemId).val();

        $.ajax({
            url: `/update-quantity/${itemId}`
            , method: 'POST'
            , headers: {
                'Content-Type': 'application/json'
                , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            , data: JSON.stringify({
                p_qty: qty
            })
            , success: function(data) {
                if (data.success) {
                    $('#item-qty-total-' + itemId).text('₹' + data.itemTotalPrice);
                    calculateCartTotal();
                } else {
                    alert(data.message);
                }
            }
            , error: function(error) {
                console.error('Error:', error);
                alert('An error occurred while updating the cart.');
            }
        });
    }



    $(document).ready(function() {
        // Calculate cart total on page load
        calculateCartTotal();
    });

</script>








@endsection
