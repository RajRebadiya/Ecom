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
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateTotalPrice = (input) => {
            const quantity = parseInt(input.value);
            const cartRow = input.closest('tr');
            const priceElement = cartRow.querySelector('.item-price');
            const totalElement = cartRow.querySelector('.item-total');
            const price = parseFloat(priceElement.textContent);

            if (quantity > 0) {
                const total = (price * quantity).toFixed(2);
                totalElement.textContent = `${total}`; // Adding dollar sign for clarity
                updateMainTotal(); // Update the main total whenever an item total is updated
            }
        };

        const updateMainTotal = () => {
            let mainTotal = 0;
            document.querySelectorAll('.item-total').forEach(itemTotalElement => {
                const itemTotal = parseFloat(itemTotalElement.textContent.replace('$', ''));
                mainTotal += itemTotal;
            });
            document.querySelector('.main-total').textContent = `$${mainTotal.toFixed(2)}`;
            document.querySelector('.final-total').textContent = `$${mainTotal.toFixed(2)}`;
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