<x-guest-layout>
    @section('title')
        Forgot password
    @endsection
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="https://placehold.co/742x815" alt="https://placehold.co/742x815">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Forgot Password</h1>
                        <p class="account-subtitle">Forgot your password? No problem. Just let us know your email address
                            and
                            we will
                            email you a password reset link that will allow you to choose a new one.</p>
                        @session('status')
                            <div class="mb-4 text-sm font-medium text-success">
                                {{ $value }}
                            </div>
                        @endsession

                        <x-validation-errors class="mb-4 text-danger" />
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label>Enter your registered email address <span class="login-danger">*</span></label>
                                <input class="form-control" type="text" name="email">
                                <span class="profile-views"><i class="fas fa-envelope"></i></span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit">Reset My Password</button>
                            </div>
                            <div class="mb-0 form-group">
                                <a class="btn btn-primary primary-reset btn-block" href="{{ route('login') }}">Login</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
