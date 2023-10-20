@extends('frontend.layouts.error-master')
@section('content')
<div class="container">

    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>403</h1>
        <h2>Access Forbidden</h2>
        <a class="go-back" href="{{ route('welcome') }}">Back to home</a>
        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid py-5" alt="Page Not Found">
    </section>

</div>
@endsection
