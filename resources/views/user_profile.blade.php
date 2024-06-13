@extends('layout.template')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display: inline-block;
        width: 100px;
        text-align: right;
    }

    .form-group input {
        border: none;
        border-bottom: 1px solid #ccc;
        padding: 5px;
        width: 200px;
    }

</style>

@if (session('success'))
<div id="successAlert" class="alert alert-success mt-5" style='width: 50%; margin-left: 25%'>
    {{ session('success')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<div class="container">
    <div class=" mt-5">
        <div class="section-title pl-4">
            <h4 class=''>User Profile</h4>
            {{-- <a href="{{url('edit_user_profile')}}"><button class="btn btn-dark float-right" type="submit" style='height: 35px; width: 37px' type='submit'><i class="fa fa-edit"></i></button></a> --}}
        </div>
        <!-- Panel-Body -->
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3" align="center">
                    <img src="{{ asset('assets/img/user.png') }}" class="img-responsive img-rounded" alt="User image">
                </div><!-- /.col-xs-12 -->
                <!-- User Information -->
                <div class="col-xs-12 col-md-5 col-lg-5">
                    {{-- <h3>{{$user->name}}</h3> --}}

                    <form action="/update-profile" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="mobile">Contact:</label>
                            <input type="text" id="mobile" name="mobile" value="{{ $user->mobile }}">
                        </div>

                        <div class="form-group">
                            <label for="state">State:</label>
                            <input type="text" id="state" name="state" value="{{ $user->state }}">
                        </div>

                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-5" style='margin-left: 65px;'>Update Profile</button>
                    </form>
                </div> <!-- /.table-responsive -->
                <!-- Social Buttons -->
                <div class="button-group">
                    <button class="btn">
                        <a href="#" class="social-icon si-border si-github si-border-round">
                            <i class="fa fa-github"></i></a></button>
                    <button class="btn"><a href="#" class="social-icon si-border si-g-plus si-border-round">
                            <i class="fa fa-google-plus"></i>
                        </a></button>
                    <button class="btn"><a href="#" class="social-icon si-border si-linkedin si-border-round">
                            <i class="fa fa-linkedin"></i>
                        </a></button>
                    <button class="btn"><a href="#" class="social-icon si-border si-facebook si-border-round">
                            <i class="fa fa-facebook"></i>
                        </a></button>

                </div><!-- /.button-group -->

            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
    </div><!-- /.panel-body -->

</div><!-- /.panel panel-info -->
</div>
@endsection
