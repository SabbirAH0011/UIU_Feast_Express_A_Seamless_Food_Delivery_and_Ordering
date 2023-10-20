<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <img src="{{ asset('assets/img/list.svg') }}" alt="মেন্যু" class="toggle-sidebar-btn nav_icon_name">
        <a href="{{ route('welcome') }}" class="logo d-flex align-items-center nav_icon_name">
            <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('siteConfig.app.name') }}">
            <span class="d-none d-lg-block">UIUFoodpanda</span>
        </a>
    </div><!-- End Logo -->

    <div class="search-bar col-lg-8">
        <form class="search-form d-flex align-items-center category_hoolder" method="get" action="{{ route('search.list') }}">
            @if(!empty(request()->get_search))
            <input type="text" id="get_search" name="get_search" placeholder="Search here" title="Search here" value="{{ request()->get_search }}">
            @else
            <input type="text" id="get_search" name="get_search" placeholder="Search here" title="এখানে সার্চ করুন">
            @endif
            <button type="submit" title="Search">
                <img src="{{ asset('assets/img/search.svg') }}" alt="menue" class="nav_icon_size aux_icon_name">
            </button>
        </form>
    </div><!-- End Search Bar -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item search_mini">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <img src="{{ asset('assets/img/search.svg') }}" alt="menu" class="nav_icon_size aux_icon_name">
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ route('cart') }}">
                    <img src="{{ asset('assets/img/basket3.svg') }}" alt="লিস্ট" class="nav_icon_size aux_icon_name">
                    <div class="mini_screen">
                        <span class="d-none d-md-block ps-2 pe-2 nave_link_font">Cart</span>
                    </div>
                </a><!-- End Profile Iamge Icon -->

            </li><!-- End Notification Nav -->

            <li class="nav-item dropdown pe-3">

                @if(session()->has('access_token'))
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ route('log.out') }}">
                    <!-- <i class="bi bi-box-arrow-in-right nav_icon_size"></i> -->
                    <img src="{{ asset('assets/img/login.svg') }}" alt="লগইন" class="nav_icon_size aux_icon_name">
                    <div class="mini_screen">
                        <span class="d-none d-md-block ps-2 nave_link_font">Log out</span>
                    </div>
                </a><!-- End Profile Iamge Icon -->

                @else

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ route('log.in') }}">
                    <!-- <i class="bi bi-box-arrow-in-right nav_icon_size"></i> -->
                    <img src="{{ asset('assets/img/login.svg') }}" alt="লগইন" class="nav_icon_size aux_icon_name">
                    <div class="mini_screen">
                        <span class="d-none d-md-block ps-2 nave_link_font">Login</span>
                    </div>
                </a><!-- End Profile Iamge Icon -->

                @endif

            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->


</header><!-- End Header -->
<script>
const wait = `<div class="card">
<div ="card-body">
<div class="m-5">
<p class="placeholder-glow">
  <span class="placeholder col-12 bg-success"></span>
   <span class="placeholder col-4 bg-success"></span>
</p>

<p class="placeholder-wave">
  <span class="placeholder w-75 col-12 bg-success"></span>
  <span class="placeholder col-12 bg-success"></span>
</p>
<p class="placeholder-glow">
  <span class="placeholder col-6 bg-success"></span>
   <span class="placeholder col-12 bg-success"></span>
</p>
<p class="placeholder-wave">
  <span class="placeholder col-12 bg-success"></span>
   <span class="placeholder w-75 col-12 bg-success"></span>
</p>
</div>
</div>
</div>`;
    $(document).ready(function () {
        $('#get_search').on('keyup', function (e) {
            e.preventDefault();
            $('.search_div').css('display','block');
            $('#search_content').html(wait)
            const element = $('#get_search').val();
            $.ajax({
                type: "GET",
                url: "{{ route('search.suggestion') }}",
                data: { 'element': element },
                beforeSend: function () {
                  $('#search_content').html(wait);
                },
                success: function (response) {
                    function AppendLoadedHtml() {
                        $('#search_content').html('');
                        $('#search_content').html(response.html);
                    }
                    setTimeout(AppendLoadedHtml, 1500);
                }
            });
        });
    });
</script>
