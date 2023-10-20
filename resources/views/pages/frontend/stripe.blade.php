@extends('layouts.web-master')
@section('site_content')
<section class="section register d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Pay via your card</h5>
                        </div>

                        <form class="row g-3 needs-validation" action="{{ route('procced_payment.stripe') }}" novalidate=""
                            method="POST">
                            @csrf
                            <div class="col-12" hidden>
                                <input class="form-control" type="text" name="trx" value="{{ $trx }}" required>
                                <input class="form-control" type="number" name="total_price" value="{{ $converted }}" >
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Card number</label>
                                <div class="input-group has-validation">
                                    <input type="number" class="form-control" id="card_number" name="card_number" placeholder="4242424242424242"
                                    value="4242424242424242" required="">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Year</label>
                                <div class="input-group has-validation">
                                    <input class="form-control" type="number" name="year" placeholder="24" value="{{ date('y')+2 }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Month</label>
                                <div class="input-group has-validation">
                                <input class="form-control" type="number" name="month" placeholder="02" value="{{ date('m') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">CVC</label>
                                <div class="input-group has-validation">
                                    <input class="form-control" type="number" name="cvc" placeholder="1234" value="1234">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn w-100" type="submit">Make Payment</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

</section>
@endsection
