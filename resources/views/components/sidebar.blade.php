@php
$pending_shop = App\Models\User::where([
['path','=','Shop'],
['permission','=','Pending'],
])->count();
@endphp
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
            <div class="card" id="sidebar_web">
                <div class="card-body">
                    <div class="row pt-2">
                        <div class="col">
                            <ul class="sidebar-nav" id="sidebar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('welcome') }}">
                                        <span class="{{ Request::is('/') ? 'nav_active text-white' : '' }} pe-3">
                                            <img src="{{ asset('assets/img/home.svg') }}" alt="home"
                                                class="nav_icon_size aux_icon_side pe-2">
                                            Homepage</span>
                                    </a>
                                    <div class="card" id="section_side">
                                        <div class="card-body">
                                            <ul class="pt-2">
                                                <li>
                                                    <a class="text-white" href="{{ route('cart') }}">
                                                          👉 Cart
                                                    </a><!-- End Profile Iamge Icon -->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- End Dashboard Nav -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" id="second_card_sidebar">
            <div class="card-body">
                <div class="row pt-5">
                   <div class="card" id="child_card">
                    <div class="card-body">
                        <div class="text-white">
                            Upgrade Your Accout to Get <br> Free voucher
                        </div>
                        <a href="#" class="btn bg-light text-dark">Upgrade</a>
                    </div>
                   </div>
                </div>
            </div>
        </div>
</aside><!-- End Sidebar-->
