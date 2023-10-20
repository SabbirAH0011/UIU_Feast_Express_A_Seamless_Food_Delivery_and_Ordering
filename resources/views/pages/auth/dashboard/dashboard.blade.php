@extends('layouts.dashboard-master')
@section('site_content')
<div class="main-div">
    @if(session()->get('path') === 'Admin')
    @elseif(session()->get('path') === 'Shop')
    @include('pages.auth.dashboard.helper-page.seller.order_list')
    @elseif(session()->get('path') === 'User')
    @include('pages.auth.dashboard.helper-page.user.order_redirect')
    @elseif(session()->get('path') === 'Rider')
    @include('pages.auth.dashboard.helper-page.rider.current_order')
    @else
    @endif
</div>
@endsection
