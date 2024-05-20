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
                            
                <form action="{{url('remove-all-wishlist')}}" method="post">
                     @csrf
                    <button class="view__all float-right btn btn-danger light mt-1 ">Remove All</button>
                </form>
                        
            </div>
                   
             
               
        </div>
           
           
      
        
        <div class="row property__gallery">
            @foreach ($wishlist as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                <div class="product__item">
                    <div class="product__item__pic set-bg" style='height: 200px; width: 300px' data-setbg="{{ asset('storage/images/product/' . $item->image)}}">
                      
                        <ul class="product__hover">
                            <li><a href="img/product/product-1.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                        </ul>
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
    
@endsection