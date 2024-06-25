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
                                }, 3000); // Remove after 2 seconds (2000 milliseconds)
                            </script>
                            <div class="cpa">
                                <i class="fa-category fa-solid fa-filter me-2"></i>Add Product
                            </div>

                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                            @if (session('success'))
                                <div id='success-message' class="alert alert-success col-md-6">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body">
                                <form enctype="multipart/form-data" id="form" action="add_product" method="POST">
                                    @csrf
                                    <div class="row gx-2">
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="product-name">Product name:</label>
                                            <input class="form-control" name="product_name" type="text">
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="product-name">Description:</label>
                                            <input class="form-control" name="description" type="text">
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="manufacturar-name">Category:</label>
                                            <select class="form-control" name="c_id">
                                                <option value="">Select Category</option>
                                                @foreach ($data as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="colorSelect">Color:</label>
                                            <select class="form-select form-control" id="colorSelect" name="color">
                                                <option value="">Select a color</option>
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
                                                <option value="">Select a size</option>
                                                <option class="colored-option" value="S">S</option>
                                                <option class="colored-option" value="M">M</option>
                                                <option class="colored-option" value="L">L</option>
                                                <option class="colored-option" value="XL">XL</option>
                                                <option class="colored-option" value="XXL">XXL</option>
                                                <option class="colored-option" value="XXXL">XXXL</option>

                                                <!-- Add more color options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="product-image">Product Image:</label>
                                        <input class="form-control" name='product_image[]' id="product-image" type="file"
                                            multiple>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="product-price">Quantity:</label>
                                        <input class="form-control" id="quantity" name='qty' type="number">
                                    </div>
                                    <div class="row">

                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="product-price">Price:</label>
                                            <input class="form-control" id="price" name='price' type="number">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label" for="product-price">Sell Price:</label>
                                            <input class="form-control" id="sell-price" name='sell_price'
                                                type="number">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button class="btn btn-danger light mt-1" type="submit">Add Product</button>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <small class="me-3">Page 1 of 5, showing 2 records out of 8 total,
                    starting
                    on record 1, ending on 2</small>
                <nav aria-label="Page navigation example mb-2">
                    <ul class="pagination mb-2 mb-sm-0">
                        <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                                    class="fa-solid fa-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                        <li class="page-item"><a class="page-link " href="javascript:void(0);"><i
                                    class="fa-solid fa-angle-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>
    {{-- </div>  --}}
    </div>
    </div>
    </div>
    </div>


    <!--**********************************
                                            Content body end
                                        ***********************************-->


@endsection
