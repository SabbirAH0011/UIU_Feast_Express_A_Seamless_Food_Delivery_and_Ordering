<!DOCTYPE html>
<html lang="en">
@include('components.head')
<body>
    @if(session('showAlert'))
    @php
    $msg = session('message');
    @endphp
    <script>
        window.onload = function () {
            alert('{{ $msg }}');
        }
    </script>
    @endif
    @include('components.navbar-dashboard')
    @include('components.sidebar-dashboard')
    <main id="main" class="main">
        @include('components.breadcrumb')
       <!--  @include('components.cart_count') -->
        <section class="section dashboard">
            <div class="row search_div" style="display: none;">
                <div class="col" id="search_content">

                </div>
            </div>
            @yield('site_content')
        </section>
    </main>
    @include('components.footer')
    <!-- @include('components.whatsapp') -->
    <div id="preloader"></div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/typed-jquery.js') }}"></script>
</body>

</html>
