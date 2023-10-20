@php
$pending_shop = App\Models\User::where([
['path','=','Shop'],
['permission','=','Pending'],
])->count();
@endphp
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('welcome') }}">
                <img src="{{ asset('assets/img/home.svg') }}" alt="home" class="nav_icon_size aux_icon_side pe-3">
                <span class="{{ Request::is('/') ? 'nav_active text-white' : '' }}">Homepage</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if(Illuminate\Support\Facades\Session::get('path') === 'Admin')
        <hr style=" border-top: 2px dashed #0a7151;">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/pending-approval') ? 'text-white' : '' }}"
                style="{{ Request::is('dashboard/pending-approval') ? 'background: #0a7151;' : '' }}"
                href="{{ route('get.pending_approval') }}">
                Pending Shop Approval <span class="pb-2 badge bg-secondary">{{ $pending_shop }}</span>
            </a>
        </li>
        @endif
        @if(Illuminate\Support\Facades\Session::get('path') === 'Shop')
        <hr style=" border-top: 2px dashed #0a7151;">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/set-menu') ? 'text-white' : '' }}"
                style="{{ Request::is('dashboard/set-menu') ? 'background: #0a7151;' : '' }}"
                href="{{ route('set.menu') }}">
                Set menu
            </a>
        </li>
        @endif
    </ul>

</aside><!-- End Sidebar-->
