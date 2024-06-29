@extends('layout.template')

@section('content')
    <!-- verify_password.blade.php -->
    @error('otp')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify OTP and Set New Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            {{-- //div with class alert alert-danger alert-dismissible fade show --}}
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{-- <div class="alert alert-danger"  role="alert">
                                {{ session('error') }}
                            </div> --}}
                        @endif

                        <form action="{{ url('verify-otp') }}" method="post">
                            @csrf
                            <!-- OTP Verification -->
                            <div class="form-group row">
                                <label for="otp"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Enter OTP') }}</label>

                                <div class="col-md-6">
                                    <input id="otp" type="number"
                                        class="form-control @error('otp') is-invalid @enderror" name="otp"
                                        value="{{ old('otp') }}" required autocomplete="otp" autofocus>

                                    @error('otp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Verify OTP Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit    " id='otp-verify' class="btn btn-primary">
                                        {{ __('Verify OTP') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
