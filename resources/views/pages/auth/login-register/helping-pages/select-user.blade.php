@extends('layouts.web-master')
@section('site_content')
<style>
#main-card {
  width: 70%;
  margin: 0 auto;
}
</style>
<section class="section register d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center flex-md-grow-0 flex-lg-grow-1">

                <div class="card mb-3" id="main-card">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Choose</h5>
                            <p class="text-center small">Select your path</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <a href="{{ route('route.redirect_reg',['path' => 'shop']) }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="py-3 text-center">Shop</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <a href="{{ route('route.redirect_reg',['path' => 'client']) }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="py-3 text-center">Cleint</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <a href="{{ route('route.redirect_reg',['path' => 'rider']) }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="py-3 text-center">Rider</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

</section>
@endsection
