<x-shop-layout title="home" :showbreadcrumb='false'>
    <!-- Start Contact Area -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Updated Profile</h2>
                            <p>Hi, {{ Auth::user()->name }} let's go to edit your profile ...</p>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="row">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-12">
                            <div class="contact-form-head">
                                <div class="form-main">
                                    <form class="form" method="post" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="first_name" type="text"
                                                        placeholder="Your First Name" required="required"
                                                        value="{{ old('first_name', $user->profile->first_name) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="last_name" type="text" placeholder="Your last name"
                                                        required="required"
                                                        value="{{ old('last_name', $user->profile->last_name) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" type="email" placeholder="Your Email"
                                                        required="required" value="{{ old('email', $user->email) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="birthday" type="date" placeholder="Your birthday"
                                                        required="required"
                                                        value="{{ old('birthday', $user->profile->birthday) }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn ">Save</button>
                                                </div>
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
    </section>
    <!--/ End Contact Area -->
</x-shop-layout>
