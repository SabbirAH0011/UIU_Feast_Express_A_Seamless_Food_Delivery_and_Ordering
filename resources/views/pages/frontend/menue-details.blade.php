@extends('layouts.web-master')
@section('site_content')
<!-- Modal -->
<div class="modal fade" id="prompt" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center">
                    Item added to cart successfully
                </h2>
            </div>
            <div class="modal-footer">
                <a href="{{ route('cart') }}" type="button" class="btn btn-primary">Go to cart</a>
                <a href="{{ route('search.list') }}" type="button" class="btn btn-primary">Order some other item</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal end-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="conten_left" id="food_details_name">{{ $food_details->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12 text-center">
                        <img class="img-fluid d-flex mx-auto my-4 preview_food_details_img_detail img_border img_preview_details"
                            src="{{ asset($food_details->img) }}" alt="{{ $food_details->name }}">
                        <div class="col-md-4 col-sm-12">
                            <p class="text-sm">{{ Illuminate\Support\Str::limit($food_details->description, 100, '...') }}</p>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="row  justify-content-center">
                            <div class="col-12 pt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row pt-3">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn minus" data-type="minus">
                                                            -
                                                        </button>
                                                    </span>
                                                    <span class="input_holder">
                                                        <input type="text"
                                                            class="form-control input-number text-center increment_field"
                                                            id="store_bought" name="store_bought" value="0">
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn plus" data-type="plus">
                                                            +
                                                        </button>
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="col-12" id="error"></div>
                                            <div class="col-12 pt-5">
                                                <input type="text" class="form-control " id="serial" name="serial"
                                                    value="{{ $food_details->serial }}" hidden>
                                                <input type="text" class="form-control " id="product_name" name="product_name"
                                                    value="{{ $food_details->name }}" hidden>
                                                <button class="btn" id="add_to_cart">Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-3 mb-3">
                                            <div class="table responsive">
                                                <table class="table table-bordered border-success">
                                                    <tr>
                                                        <th class="fw-normal">
                                                            Total Quantity
                                                        </th>
                                                        <td class="fw-normal"><span id="total_quantity">0</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-normal">
                                                            Price
                                                        </th class="fw-normal">
                                                        <td><span id="single_price">{{ $food_details->start_price
                                                                }}</span> &#2547;</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="fw-normal">
                                                            Total
                                                        </th>
                                                        <td class="fw-normal"><span id="total_price">0</span> &#2547;
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const signle_price = parseFloat($('#single_price').text());
        const warning_not_add = `<p class="text-danger pt-3">Kindly click on plus (+) button to add product</p>`;
        const api_loading = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        <span class="pl-2">Please</span>`;
        /* On click input function */
        $('.plus').click(function () {
            let store_bought = $('#store_bought').val();
            let float_store = parseInt(store_bought);
            float_store++;
            let final_price = float_store * signle_price;

            $('#store_bought').val(float_store);
            $('#total_quantity').text(float_store);
            $('#total_price').text(final_price);
        });
        $('.minus').click(function () {
            let store_bought = $('#store_bought').val();
            let float_store = parseInt(store_bought);
            float_store--;
            let final_price = float_store * signle_price;

            if (float_store > 0) {
                $('#store_bought').val(float_store);
                $('#total_quantity').text(float_store);
                $('#total_price').text(final_price);
            } else {
                $('#store_bought').val(0);
                $('#total_quantity').text(0);
                $('#total_price').text(0);
            }
        });
        /* On blur input function */
        $('#store_bought').keyup(function () {
            let store_bought = parseInt($('#store_bought').val());
            let final_price = store_bought * signle_price;
            if (store_bought > 0) {
                $('#store_bought').val(store_bought);
                $('#total_quantity').text(store_bought);
                $('#total_price').text(final_price);
            } else {
                $('#store_bought').val(0);
                $('#total_quantity').text(0);
                $('#total_price').text(0);
            }
        });
        /* Add to cart */
        $('#add_to_cart').click(function () {
            const product_serial = $('#serial').val();
            const product_name = $('#product_name').val();
            const total_quantity = parseInt($('#total_quantity').text());
            const product_single_weight = $('#product_single_weight').text();
            const signle_price = parseInt($('#single_price').text());
            const total_price = parseInt($('#total_price').text());
            const cart_data = localStorage.getItem('uiu_foodshop_cart');
            if (total_quantity > 0) {
                $('#error').html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('add.to_cart') }}",
                    data: {
                        'product_serial': product_serial,
                        'product_name': product_name,
                        'total_quantity': total_quantity,
                        'product_single_weight': product_single_weight,
                        'signle_price': signle_price,
                        'total_price': total_price,
                        'cart_data': cart_data
                    },
                    beforeSend: function () {
                        $('#add_to_cart').prop("disabled", true);
                        $('#add_to_cart').html(api_loading);
                    },
                    success: function (response) {
                        localStorage.setItem('uiu_foodshop_cart', response.cart_data);
                        localStorage.setItem('uiu_foodshop_price', response.total_cart_price);
                        function AppendLoadedHtml() {
                            $('#add_to_cart').prop("disabled", false);
                            $('#add_to_cart').html('Order');
                            $('#store_bought').val(0);
                            $('#total_quantity').text(0);
                            $('#total_price').text(0);
                            $('#prompt').modal('show');
                        }
                        setTimeout(AppendLoadedHtml, 1500);
                    }
                });
            } else {
                $('#error').html(warning_not_add);
            }
        });
    });
</script>
@endsection
