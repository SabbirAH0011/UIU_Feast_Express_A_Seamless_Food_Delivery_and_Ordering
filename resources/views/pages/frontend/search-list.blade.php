@extends('layouts.web-master')
@section('site_content')
<div class="col-lg-12">
    <h4 class="section_title">We have got for 👉 {{ request()->get_search }}</h4>
    <hr class="section_hr">

    <div class="row mb-5">

        @forelse($get_item_detail as $item)
        <div class="col-md-6 col-xl-4">

            <a href="{{ route('search.shop_details', ['serial' => $item->serial]) }}">
                <div class="card category_hoolder">
                    <div class="card-body">
                        <div class="row pt-3">
                            <div class="col-6">
                                <h4 class="category_detail">{{ $item->name }}</h4><br>
                            </div>
                            <div class="col-6">
                                <img src="{{ asset($item->img) }}" class="category_icon"
                                    alt="...">
                            </div>
                            <div class="col-6">
                                <p class="text-sm">{{ Illuminate\Support\Str::limit($item->description, 40, '...') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        @empty
        <div class="col-12 text-center">
            No search is available
        </div>
        @endforelse

    </div>

</div>
@endsection
