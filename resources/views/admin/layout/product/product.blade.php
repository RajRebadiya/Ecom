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
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Product List
                            </div>
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
                            <div class="tools">
                                @if (session('success'))
                                    <div id='success-message' class="alert alert-success col-md-6">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                {{-- add product button here --}}
                                <a href="add_product" class="btn btn-primary">Add Product</a>

                                {{-- <a href="javascript:void(0);" class="expand handle"><i
											class="fal fa-angle-down"></i></a> --}}
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <div class="card-body pb-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Image</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Selling Price</th>
                                                {{-- <th>Modified</th> --}}
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp

                                            @foreach ($product as $item)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['color'] }}</td>
                                                    <td>{{ $item['size'] }}</td>
                                                    @php
                                                        $image = explode(',', $item['image']);
                                                        $firstImage = $image[0] ?? '';
                                                    @endphp
                                                    <td>
                                                        @if ($firstImage)
                                                            <img src="{{ asset('storage/images/product/' . $firstImage) }}"
                                                                width="100px" height="70px">
                                                        @else
                                                            No image available
                                                        @endif
                                                    </td>
                                                    <td>{{ $item['price'] }}</td>
                                                    <td>{{ $item['qty'] }}</td>
                                                    <td>{{ $item['sell_price'] }}</td>
                                                    {{-- <td>{{$item['updated_at']}}</td> --}}
                                                    <td class="text-nowrap">
                                                        <a href="edit_product/{{ $item['id'] }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <a href="delete_product/{{ $item['id'] }}"
                                                            class="btn btn-danger btn-sm content-icon">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach


                                        </tbody>
                                    </table>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <small class="me-3">Page 1 of 5, showing 2 records out of 8 total,
                                            starting
                                            on record 1, ending on 2</small>
                                        <nav aria-label="Page navigation example mb-2">
                                            <ul class="pagination mb-2 mb-sm-0">
                                                <li class="page-item"><a class="page-link" href="javascript:void(0);"><i
                                                            class="fa-solid fa-angle-left"></i></a></li>
                                                <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a>
                                                </li>
                                                <li class="page-item"><a class="page-link " href="javascript:void(0);"><i
                                                            class="fa-solid fa-angle-right"></i></a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
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
