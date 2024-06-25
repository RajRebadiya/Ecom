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
                                <i class="fa-category fa-solid fa-filter me-2"></i>Add Category
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
                                <form enctype="multipart/form-data" id="form" action="add_category" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <label class="form-label">Name</label>
                                            <input type="text" name='category_name' class="form-control mb-xl-0 mb-3"
                                                id="exampleFormControlInput1" placeholder="Title">
                                        </div>
                                        <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">Image</label>
                                            <input type="file" name='category_image' class="form-control mb-xl-0 mb-3"
                                                id="exampleFormControlInput1" placeholder="Title">
                                        </div>
                                        <div class="col-xl-3 col-sm-6 align-self-end">
                                            <div>

                                                <button class="btn btn-danger light" type="submit">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-solid fa-file-lines me-1"></i>Category List
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
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
                                                <th>Image</th>
                                                {{-- <th>Modified</th> --}}
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp

                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td><img src="{{ asset('storage/images/' . $item['image']) }}"
                                                            width="100px" height="70px">
                                                    </td>
                                                    {{-- <td>{{$item['updated_at']}}</td> --}}
                                                    <td class="text-nowrap">
                                                        <a href="edit_category/{{ $item['id'] }}"
                                                            class="btn btn-warning btn-sm content-icon">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <a href="delete_category/{{ $item['id'] }}"
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
