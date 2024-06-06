@extends('layout.template')

@section('content')
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title">
                    <h4 class='mb-5'>Wishlist</h4>
                </div>
            </div>
            <div class="col-lg-6 float-right ">
                <?php
                // Check if the wishlist is empty and disable the "Remove All" button if it is
                $remove_all = DB::table('wishlist')->where('user_id', $user_id = DB::table('users')->where('email', session('email'))->first()->id)->count();
                if($remove_all != 0){
                    ?>
                <form action="{{url('remove-all-wishlist')}}" method="post">
                    @csrf
                    <button style="display: block" class="view__all float-right btn btn-danger light mt-1 ">Remove All</button>
                </form>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="row property__gallery">
            @foreach ($wishlist as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                <div class="product__item">
                    <div class="product__item__pic set-bg" style='height: 200px; width: 300px' data-setbg="{{ asset('storage/images/product/' . $item->image)}}">
                        <div class="close-icon" data-id="{{ $item->id }}" style="position: absolute; top: 10px; right: 10px; cursor: pointer;">
                            <i class="fa fa-times" style="color: rgb(0, 0, 0);  padding: 5px; border-radius: 50%;"></i>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">{{$item->name}}</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ {{$item->price}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for close icons
        document.querySelectorAll('.close-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                console.log('Item ID:', itemId);

                // Confirm deletion
                if (confirm('Are you sure you want to remove this item from your wishlist?')) {
                    // AJAX request to remove item from wishlist
                    fetch(`/remove-wishlist-item/${itemId}`, {
                            method: 'POST'
                            , headers: {
                                'Content-Type': 'application/json'
                                , 'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                            , body: JSON.stringify({
                                id: itemId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Response:', data);
                            if (data.success) {
                                // Remove the item from the DOM
                                this.closest('.col-lg-3').remove();
                            } else {
                                alert('Failed to remove item from wishlist.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    });

</script>
@endsection
