@extends('layout/login_register')

@section('title', 'Register')

@section('content')
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="submit" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                            </div>
                                @error('name')
                                <span  style='color: red;' >{{ $message }}</span>
                                @enderror
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" />
                            </div>
                                @error('email')
                                <span  style='color: red;' >{{ $message }}</span>
                                @enderror
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password" />
                            </div>
                                @error('password')
                                    <span  style='color: red;' >{{ $message }}</span>
                                @enderror
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password_confirmation" id="re_pass" placeholder="Repeat your password" />
                            </div>
                                @error('re_pass')
                                <span  style='color: red;' >{{ $message }}</span>
                                @enderror
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{ asset('assets/login_register/images/signup-image.jpg') }}" alt="sign up image"></figure>
                        <a href="login" class="signup-image-link">I am already a member</a>
                    </div>
                </div>
            </div>
        </section>

        <script>
            // Add event listener to each input field to clear error messages on typing
            document.querySelectorAll('.register-form input').forEach(input => {
                input.addEventListener('input', () => {
                    const errorElement = input.parentNode.querySelector('.alert');
                    if (errorElement) {
                        errorElement.remove();
                    }
                });
            });
        </script>
        
@endsection