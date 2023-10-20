@extends('layouts.web-master')
@section('site_content')
<section class="section register d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Client Register</h5>
                            <p class="text-center small">Register here</p>
                        </div>

                        <form class="row g-3 needs-validation" action="{{ route('client.register') }}"
                            method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="name" name="name" required=""
                                        value="{{ request()->old('name') }}">
                                    <div class="invalid-feedback">Write your name</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    <input type="email" name="email" class="form-control" id="email"
                                        value="{{ request()->old('email') }}" required>
                                </div>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control text-center" id="password"
                                    required="">
                                <div class="invalid-feedback">Write your password</div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="see_password" value="true"
                                        id="see_password">
                                    <label class="form-check-label" for="see_password">See password</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn w-100" type="submit">Register</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

</section>
@endsection
