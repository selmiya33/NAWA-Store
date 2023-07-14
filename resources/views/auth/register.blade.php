<x-shop-layout title="Login">
    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">

                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mt-4" class="form-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="alert alert-danger mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4" class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="email" name="email"
                                    :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="alert alert-danger mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4" class="form-group">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="form-control" type="password" name="password"
                                    required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="alert alert-danger mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4" class="form-group">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="form-control" type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="alert alert-danger mt-2" />
                            </div>

                            <div class="mt-4 form-group">

                                <div class="button">
                                    <x-primary-button class="ml-4 btn">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                                <p class="outer-link" >
                                    {{ __('Already have an account?') }}
                                    <a href="{{ route('login') }}">Login Now</a>
                                </p>

                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>
