@extends('frontend.layouts.auth-master')
@section('content')
<section class="section register d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">আপনার ডেশবোর্ডে প্রবেশ করুন</h5>
                            <p class="text-center small">ডেশবোর্ডে প্রবেশ করতে আপনার রেজিস্টার্ড ফোন নাম্বার ও পাসওয়ার্ড দিন</p>
                        </div>

                        <form class="row g-3 needs-validation" action="{{ route('store.user_registration') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="name" class="form-label">আপনার নাম</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="name" name="name" required="" value="{{ request()->old('name') }}">
                                    <div class="invalid-feedback">আপনার নাম লিখুন</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="yourUsername" class="form-label">ফোন নাম্বার</label>
                                <div class="input-group has-validation">
                                    <input type="number" name="phone" class="form-control" id="phone"
                                        required="" value="{{ request()->old('phone') }}">
                                    <div class="invalid-feedback">আপনার ফোন নাম্বার লিখুন</div>
                                </div>
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="yourUsername" class="form-label">ইমেইল অ্যাড্রেস <span class="text-success">(ঐচ্ছিক *** পাসওয়ার্ড রিকভারির জন্য প্রযোজ্য)</span></label>
                                <div class="input-group has-validation">
                                    <input type="email" name="email" class="form-control" id="email" value="{{ request()->old('email') }}"s>
                                </div>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">পাসওয়ার্ড</label>
                                <input type="password" name="password" class="form-control text-center" id="password"
                                    required="">
                                <div class="invalid-feedback">আপনার পাসওয়ার্ড লিখুন</div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="see_password" value="true" id="see_password">
                                    <label class="form-check-label" for="see_password">পাসওয়ার্ড দেখুন</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn w-100" type="submit">রেজিস্টার করুন</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

</section>
@endsection
