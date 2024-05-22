@extends('layout.template')

@section('content')
<style>
    /* Example styles to match the span design */
    .icon_close {
        display: inline-block;
        width: 24px;
        height: 24px;
        background: url('icon_close.png') no-repeat center center; /* Replace with your icon URL */
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
                            
                <form action="{{url('remove-all-cart')}}" method="post">
                     @csrf
                    <button class="view__all float-right btn btn-danger light mt-1 ">Remove All</button>
                </form>
                        
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
                                <td class="cart__price">$ <span class="item-price">{{ $item->price }}</span></td>
                                <td class="cart__quantity">
                                    <div class="pro">
                                        <span class="dec qtybtn" style='cursor: pointer;'>-</span>
                                        <input style="width: 102px;border: none;text-align: center;"   class="quantity-input" value="1" min="1">
                                        <span class="inc qtybtn" style='cursor: pointer;'>+</span>
                                    </div>
                                </td>
                                <td class="cart__total">$ <span class="item-total">{{ $item->price }}</span></td>
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
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                    @endif
                    @if (session('coupon_code'))
                    <div class="alert alert-success alert-dismissible fade show col-md-6" role="alert">
                        {{ session('coupon_code') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                @endif

                <div id="mess_coup_div" style="font-weight:700;color:green"></div>
                <div id="mess_coup_error" style="font-weight:700;color:red"></div>
                    {{-- <form action="{{url('add-coupon')}}" method="get">
                        @csrf --}}
                        <input type="text" id='coupon-form' style="
                        padding: 7px;
                        border-radius: 22px;
                        border: 2px solid black;
                        background: #f5f5f5;
                        color: rgb(0, 0, 0);
                    " placeholder="Enter your coupon code" name="coupon">
                        <button type="button" class="site-btn" onclick="check_coupon()">Apply</button>
                    {{-- </form> --}}
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal  <span class="main-total">{{ $item->price }}</span></li>
                        <li>Total  <span class="final-total">{{ $item->price }}</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
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
        var cname = $('#coupon-form').val();
        $.ajax({
            url: "{{ url('add-coupon') }}",
            type: "GET",
            data: {
                cname: cname
            },
            success: function(response) {
                console.log('Response:', response);
                if (response.success) {
                    // Display success message
                    $("#mess_coup_div").text(response.success).css('color', 'green');
                    
                    // Store coupon data in session-like variable
                    window.coupon = {
                        type: response.type, // Assuming response contains type of coupon
                        amount: response.amount // Assuming response contains amount of discount
                    };

                    const updateMainTotal = () => {
        let mainTotal = 0;
        document.querySelectorAll('.item-total').forEach(itemTotalElement => {
            const itemTotal = parseFloat(itemTotalElement.textContent.replace('$', ''));
            mainTotal += itemTotal;
        });

        let finalTotal = mainTotal;

        if (window.coupon) {
            if (window.coupon.type === 'flat') {
                finalTotal -= window.coupon.amount;
            } else if (window.coupon.type === 'discount') {
                finalTotal -= (mainTotal * (window.coupon.amount / 100));
            }
        }

        document.querySelector('.main-total').textContent = `$${mainTotal.toFixed(2)}`;
        document.querySelector('.final-total').textContent = `$${finalTotal.toFixed(2)}`;
    };

                    // Update total price
                    updateMainTotal();
                } else {
                    // Display error message if no success
                    $("#mess_coup_error").text(response.error).css('color', 'red');
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                $("#mess_coup_div").text("Failed to apply coupon. Please try again.").css('color', 'red');
            }
        });
    }

    $(document).ready(function() {
        // Function to handle form submission via AJAX
        
        const updateTotalPrice = (input) => {
            const quantity = parseInt(input.value);
            const cartRow = input.closest('tr');
            const priceElement = cartRow.querySelector('.item-price');
            const totalElement = cartRow.querySelector('.item-total');
            const price = parseFloat(priceElement.textContent.replace('$', ''));

            if (quantity > 0) {
                const total = (price * quantity).toFixed(2);
                totalElement.textContent = `$${total}`; // Adding dollar sign for clarity
                updateMainTotal(); // Update the main total whenever an item total is updated
            }
        };

        const updateMainTotal = () => {
            let mainTotal = 0;
            document.querySelectorAll('.item-total').forEach(itemTotalElement => {
                const itemTotal = parseFloat(itemTotalElement.textContent.replace('$', ''));
                mainTotal += itemTotal;
            });

            let finalTotal = mainTotal;

            if (window.coupon) {
                if (window.coupon.type === 'flat') {
                    finalTotal -= window.coupon.amount;
                } else if (window.coupon.type === 'discount') {
                    finalTotal -= (mainTotal * (window.coupon.amount / 100));
                }
            }

            document.querySelector('.main-total').textContent = `$${mainTotal.toFixed(2)}`;
            document.querySelector('.final-total').textContent = `$${finalTotal.toFixed(2)}`;
        };

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', function () {
                if (parseInt(this.value) < 1) {
                    this.value = 1;
                }
                updateTotalPrice(this);
            });
        });

        document.querySelectorAll('.qtybtn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default action to avoid multiple triggers
                const input = this.closest('.pro').querySelector('.quantity-input');
                let currentValue = parseInt(input.value);

                if (this.classList.contains('inc')) {
                    input.value = currentValue + 1;
                } else if (this.classList.contains('dec')) {
                    input.value = Math.max(1, currentValue - 1); // Prevent going below 1
                }

                input.dispatchEvent(new Event('input')); // Trigger input event to update the total price
            });
        });

        // Initial calculation of the main total
        updateMainTotal();
    });
</script>

    
 
    
    
    
@endsection