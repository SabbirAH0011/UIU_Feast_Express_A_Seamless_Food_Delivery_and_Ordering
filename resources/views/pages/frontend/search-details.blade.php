@extends('layouts.web-master')
@section('site_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="section_title_shop_name pt-2">{{ $shop_name }}</h4>
                <hr class="section_hr">
                <div class="row">
                    @forelse($food_list as $list)
                    <div class="col-12">
                        <div class="card" style="border: 2px dashed #038f59;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row pt-3">
                                            <div class="col">
                                                <img src="{{ asset($list->img) }}" class="img-thumbnail" alt="...">
                                            </div>
                                            <div class="col">
                                                <h4 class="category_detail">{{ $list->name }}</h4>
                                            </div>
                                            <div class="col">
                                                <p class="text-sm" id="product_price">Price: <span>{{ $list->start_price }}</span> &#2547;</p>
                                            </div>
                                            <div class="col">
                                                <p class="text-sm">{{ Illuminate\Support\Str::limit($list->description, 80, '...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end pt-2">
                                        <div class="col-12 text-center">
                                            <a href="{{ route('search.itemCart',['menue' => $list->serial]) }}" class="btn btn-primary">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card" style="border: 2px dashed #038f59;">
                            <div class="card-body">
                                <h4 class="text-center">No food available</h4>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
