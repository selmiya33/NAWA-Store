<x-shop-layout title="Login">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="post">
                        <div class="card-body">
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>You can login using your social media account or email address.</p>
                            </div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn facebook-btn"
                                            href="javascript:void(0)"><i class="lni lni-facebook-filled"></i> Facebook
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn twitter-btn"
                                            href="javascript:void(0)"><i class="lni lni-twitter-original"></i> Twitter
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn google-btn"
                                            href="javascript:void(0)"><i class="lni lni-google"></i> Google login</a>
                                    </div>
                                </div>
                            </div>
                            <div class="alt-option">
                                <span>Or</span>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="alert alert-danger mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="current-password" />

                                    <x-input-error :messages="$errors->get('password')" class="alert alert-danger mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="d-flex flex-wrap justify-content-between bottom-content">
                                    <div class="form-check">

                                        <input id="remember_me" type="checkbox" name="remember"
                                            class="form-check-input width-auto">
                                        <label for="remember_me"
                                            class="form-check-label">{{ __('Remember me') }}</label>

                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="lost-pass" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="button">
                                    <x-primary-button class="btn btn-primary">
                                        {{ __('Log in') }}
                                    </x-primary-button>
                                </div>

                            </form>
                            <p class="outer-link">Don't have an account? <a href="{{ route('register') }}">Register here </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-shop-layout>
