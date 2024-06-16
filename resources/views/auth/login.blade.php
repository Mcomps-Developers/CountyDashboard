<x-guest-layout>
    @section('title')
        Login
    @endsection
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="https://placehold.co/742x815" alt="https://placehold.co/742x815">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Welcome to {{ config('app.name') }}</h1>
                        <p class="account-subtitle">Need an account? <a href="javascript:void(0);">Sign Up</a></p>
                        <x-validation-errors class="mb-4 text-danger" />

                        @session('status')
                            <div class="mb-4 text-sm font-medium text-success">
                                {{ $value }}
                            </div>
                        @endsession
                        <h2>Sign in</h2>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Username <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" name="email">
                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <div class="form-group">
                                <label>Password <span class="login-danger">*</span></label>
                                <input class="form-control pass-input" type="password" name="password">
                            </div>
                            <div class="forgotpass">
                                <div class="remember-me">
                                    <label class="mb-0 mr-2 custom_check d-inline-flex remember-me"> Remember me
                                        <input type="checkbox" name="radio" name="remember">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                            </div>
                        </form>

                        <div class="login-or">
                            <span class="or-line"></span>
                            <span class="span-or">or</span>
                        </div>

                        <div class="social-login">
                            <a href="javascript:void(0);"><i class="fab fa-google"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
