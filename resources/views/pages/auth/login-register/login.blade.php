@extends('layouts.web-master')
@section('site_content')
<section class="section register d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                            <p class="text-center small">Submit you email and password to login</p>
                        </div>

                        <form class="row g-3 needs-validation" action="{{ route('log.in_verify') }}" novalidate="" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                    @if(!empty(request()->email))
                                    <input type="email" class="form-control" id="email" name="email"
                                        required="" value="{{ request()->email }}">
                                    @else
                                    <input type="email" class="form-control" id="email" name="email" required="">
                                    @endif
                                    <div class="invalid-feedback">Provide registered email</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control text-center" id="password" name="password"
                                    required="" value="{{ request()->old('password') }}">
                                <div class="invalid-feedback">Insert your password</div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="see_password" value="true"
                                        id="see_password">
                                    <label class="form-check-label" for="see_password">See password</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn w-100" type="submit">Login</button>
                            </div>
                            <div class="row text-center pt-3">
                                <div class="col-md-6 col-sm-12 custom_padding">
                                    <p class="small mb-0">No account? <a href="{{ route('route.choose') }}">Register here</a></p>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

</section>
@endsection
