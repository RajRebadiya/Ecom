@extends('layout/login_register')

@section('title', 'Register')

@section('content')
<!-- Sign up form -->
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" action="{{ url('submit') }}" class="register-form" id="register-form">
                    @csrf
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" />
                        @error('name')
                        <span style='color: red;'>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" />
                        @error('email')
                        <span style='color: red;'>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="pass" placeholder="Password" />
                        @error('password')
                        <span style='color: red;'>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="password_confirmation" id="re_pass" placeholder="Repeat your password" />
                        @error('password_confirmation')
                        <span style='color: red;'>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{ asset('assets/login_register/images/signup-image.jpg') }}" alt="sign up image"></figure>
                <a href="{{ url('login') }}" class="signup-image-link">I am already a member</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.register-form input').forEach(input => {
        input.addEventListener('input', () => {
            const errorElement = input.parentNode.querySelector('span[style]');
            if (errorElement) {
                errorElement.remove();
            }
        });
    });

</script>
@endsection
