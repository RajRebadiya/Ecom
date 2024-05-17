@extends('admin.layout.template')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body default-height" style="margin-left: 0px;">
			<div class="container-fluid">
				
				<!-- Row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="filter cm-content-box box-primary">
							<div class="content-title SlideToolHeader">
                             @if ($errors->any())
                                <div id='error-message' class="alert alert-danger col-md-6">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            

                                <script>
                                    // Function to remove success message after 2 seconds
                                    setTimeout(function() {
                                        var successMessage = document.getElementById('success-message');
                                        if (successMessage) {
                                            successMessage.remove();
                                        }
                                    }, 3000); 
                                    setTimeout(function() {
                                        var successMessage = document.getElementById('error-message');
                                        if (successMessage) {
                                            successMessage.remove();
                                        }
                                    }, 3000);// Remove after 2 seconds (2000 milliseconds)
                                </script>
                                
                        
                                
                           
								<div class="cpa">
									<i class="fa-product fa-solid fa-filter me-2"></i>Edit Product
								</div>
                               
								<div class="tools">
									<a href="javascript:void(0);" class="expand handle"><i
											class="fal fa-angle-down"></i></a>
								</div>
                                @if (session('success'))
                                <div id='success-message' class="alert alert-success col-md-6">
                                    {{ session('success') }}
                                </div>
                                @endif
							</div>
							<div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <form enctype="multipart/form-data" id="form" action="update_product" method="POST">
                                        @csrf
                                      <div class="row gx-2">
                                        <div class="col-12 mb-3"><input class="form-control" name="id" value='{{$data->id}}' type="hidden"></div>
                                        <div class="col-12 mb-3"><label class="form-label" for="product-name">Product name:</label><input class="form-control" value='{{$data->name}}' name="product_name" type="text"></div>
                                        {{-- category with select tag --}}
                                       <!-- your_view.blade.php -->

                                       <div class="col-12 mb-3">
                                        <label class="form-label" for="manufacturar-name">Category:</label>
                                        <select class="form-control" name="c_id">
                                            <option value="{{ $data->category->id }}">{{ $data->category->name }}</option> <!-- Display currently selected category -->
                                            @foreach($category as $dataa)
                                            {{-- @if($category->c_id != $data->c_id) --}}
                                            <!-- Exclude the currently selected category -->
                                                    <option value="{{ $dataa->id }}">{{ $dataa->name }}</option>
                                                {{-- @endif --}}
                                            @endforeach
                                        </select>
                                    </div>

                                        <div class="col-12 mb-3"><label class="form-label" for="manufacturar-name">Description:</label><input class="form-control" value='{{$data->description}}' id="description" name='description' type="text"></div>
                                        {{-- <div class="col-6 mb-3"><label class="form-label" for="identification-no">Color:</label><input class="form-control" id="color" value='{{$data->color}}' name='color' type="text"></div>
                                        <div class="col-6 mb-3"><label class="form-label" for="product-summary">Size: </label><input class="form-control" id="size" value='{{$data->size}}' name='size' type="text"></div> --}}
                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="colorSelect">Color:</label>
                                            <select class="form-select form-control" id="colorSelect" name="color">
                                                <option value="{{$data->color}}">{{$data->color}}</option>
                                                <option class="colored-option" value="white">White</option>
                                                <option class="colored-option" value="black">Black</option>
                                                <option class="colored-option" value="ref">Red</option>
                                                <option class="colored-option" value="green">Green</option>
                                                <option class="colored-option" value="blue">Blue</option>
                                                <option class="colored-option" value="yellow">Yellow</option>
                                                <option class="colored-option" value="cyan">Cyan</option>
                                                <!-- Add more color options as needed -->
                                            </select>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="sizeSelect">Size:</label>
                                            <select class="form-select form-control" id="sizeselect" name="size">
                                                <option value="{{$data->size}}">{{$data->size}}</option>
                                                <option class="colored-option" value="S">S</option>
                                                <option class="colored-option" value="M">M</option>
                                                <option class="colored-option" value="L">L</option>
                                                <option class="colored-option" value="XL">XL</option>
                                                <option class="colored-option" value="XXL">XXL</option>
                                                <option class="colored-option" value="XXXL">XXXL</option>
    
                                                <!-- Add more color options as needed -->
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3"><label class="form-label" for="product-image">Product Image:</label><br><img src="{{ asset('storage/images/product/' . $data['image']) }}" width="100px" height="70px"><input class="form-control mt-2"  name='product_image' id="product-image" type="file"></div>
                                        <div class="col-12 mb-3"><label class="form-label" for="product-price">Quantity:</label><input class="form-control" id="quantity" value='{{$data->qty}}' name='qty' type="text"></div>
                                        <div class="col-6 mb-3"><label class="form-label" for="product-price">Price:</label><input class="form-control" id="price" value='{{$data->price}}' name='price' type="text"></div>
                                        <div class="col-6 mb-3"><label class="form-label" for="product-price">Sell Price:</label><input class="form-control" id="sell-price" value='{{$data->sell_price}}' name='sell_price' type="text"></div>
                                        <div class="col-12 mb-3"><button class="btn btn-danger light mt-1" type="submit">Edit Product</button></div>
                                        
                                      
                                     
                                    </div>
                                    </form>
								</div>
							</div>
						</div>
						

					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->


@endsection