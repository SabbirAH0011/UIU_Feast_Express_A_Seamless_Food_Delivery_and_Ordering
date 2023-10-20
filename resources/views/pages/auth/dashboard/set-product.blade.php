@extends('frontend.layouts.dashboard-master')
@section('content')
<div class="row">
@include('frontend.components.push-notification')
    <div class="col-md-4 col-sm-12">
       <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 mb-2">
                      <p class="text-normal">সিংগেল প্রাইস প্রোডাক্ট</p>
                      <button class="btn" id="single_item">Insert</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 mb-2">
                      <p class="text-normal">মাল্টি রেঞ্জ প্রাইস প্রোডাক্ট</p>
                      <button class="btn" id="multi_item">Insert</button>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header">
                <p class="text-normal">Registered Product List</h5>
            </div>
            <div class="card-body">
               <div class="mt-2 mb-2">
                <div class="table-responsive">
                    <table class="table table-bordered border-success text-normal">
                        <thead>
                            <th></th>
                            <th>Name</th>
                            <th>Starting Price</th>
                            <th>Discount Price</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @forelse($product_list as $product)
                            <tr>
                                <td><img src="{{ asset($product->img) }}" alt="{{ $product->name }}"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->start_price }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-primary">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No product found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $product_list->withQueryString()->links() }}
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="main_component">

        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $(document).on('click','#single_item',function(){
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        $.ajax({
            type: "GET",
            url: "{{ route('fetch.single_product_insert') }}",
            beforeSend:function(){
                $('.main_component').html(wait);
            },
            success: function (response) {
                function AppendLoadedHtml(){
                    $('.main_component').html('');
                    $('.main_component').html(response.html);
                }
                setTimeout(AppendLoadedHtml,500);
            }
        });
    })
    $(document).on('click', '#multi_item', function () {
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
        $.ajax({
            type: "GET",
            url: "{{ route('fetch.multi_product_insert') }}",
            beforeSend: function () {
                $('.main_component').html(wait);
            },
            success: function (response) {
                function AppendLoadedHtml() {
                    $('.main_component').html('');
                    $('.main_component').html(response.html);
                }
                setTimeout(AppendLoadedHtml, 500);
            }
        });
    })
});
</script>
@endsection
