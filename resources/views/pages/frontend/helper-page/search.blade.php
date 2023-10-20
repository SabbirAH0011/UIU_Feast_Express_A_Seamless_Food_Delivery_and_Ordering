<div class="row">
    <div class="col">

        <div class="card">
            <div class="card-body">
                <div class="mt-3">
                    <h4 class="section_title">Search result</h4>
                    <hr class="section_hr">
                    <div class="row">
                        <!-- Product holder starts -->

                        @forelse($get_special_offer as $offer_item)

                        <div class="col-md-6 col-xl-3">
                            <a href="{{ route('search.itemCart',['menue' => $offer_item->serial]) }}">
                                <div class="card category_hoolder">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-6 d-flex justify-content-star">
                                                <h5>
                                                    {{ \Illuminate\Support\Str::limit( $offer_item->name ,
                                                    20,$end='....' ) }}
                                                </h5>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <p class="price_holder">Price: {{ $offer_item->start_price }} &#x9F3;
                                                </p>
                                            </div>
                                        </div>
                                        @if($offer_item->discount === 'yes')
                                        <p class="text-danger">Discount: <span
                                                class="text-success text-decoration-line-through">
                                                {{ $offer_item->prev_price }}
                                            </span><span> {{ ceil($offer_item->discount_percent) }}%</span></p>
                                        @endif
                                        <img class="img-fluid d-flex mx-auto my-4 preview_product_img"
                                            src="{{ asset($offer_item->img) }}" alt="{{ $offer_item->name }}">

                                        <p class="text-normal">Shop: {{ $offer_item->shop }}</p>
                                        <div class="text-center">
                                            <a href="{{ route('search.itemCart',['menue' => $offer_item->serial]) }}"
                                                class="btn btn-primary">
                                                Buy now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @empty
                        <div class="col-md-12 text-center">
                            <h6 class="text-normal bd-danger text-center">No item found</h6>
                        </div>
                        @endforelse
                        <!-- Product holder ends -->
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
