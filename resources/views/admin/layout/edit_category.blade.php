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
									<i class="fa-category fa-solid fa-filter me-2"></i>Add Category
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
                                    <form enctype="multipart/form-data" id="form" action="update_category" method="POST">
                                        @csrf
                                    <div class="row">
										<div class="col-xl-6 col-sm-6">
											<label class="form-label">Name</label>
											<input type="text" name='category_name' value='{{$data->name}}' class="form-control mb-xl-0 mb-3"
												id="exampleFormControlInput1" placeholder="Title" >
                                                <input type="hidden" name='id' value='{{$data->id}}' class="form-control mb-xl-0 mb-3"
												id="exampleFormControlInput1" placeholder="Title" >
										</div>
                                        <div class="col-xl-12  col-sm-6 mb-3 mb-xl-0 mt-3">
											<label class="form-label">Image</label><br>
											<img src="{{ asset('storage/images/' . $data['image']) }}" width="100px" height="70px">
										</div>
                                        <br>
										<div class="col-xl-6  col-sm-6 mb-3 mb-xl-0 mt-3" >
											{{-- <label class="form-label">Image</label><br> --}}
											<input type="file" name='category_image' class="form-control mb-xl-0 mb-3"
												id="exampleFormControlInput1" placeholder="Title" ><br>
                                                <button class="btn btn-danger light mt-1" 
													type="submit">Add</button>
										</div>
										
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