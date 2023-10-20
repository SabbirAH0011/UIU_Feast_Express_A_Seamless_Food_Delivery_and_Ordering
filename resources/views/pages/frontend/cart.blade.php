@extends('layouts.web-master')
@section('site_content')
<!-- Modal -->
<div class="modal fade" id="payment_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4 style="color: #0a7151;">Select payment method</h4>
                    </div>
                    <form action="{{ route('post.cart_payment_gateway') }}" method="GET">
                        <div class="col-12" id="payment_method">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">Confirm order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal end-->
<div id="no-item" style="display: none;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="warning py-5 text-center">
                        <h4 style="color: #0a7151;">
                            <img src="{{ asset('assets/img/basket3.svg') }}" alt="home"
                                class="nav_icon_size aux_icon_side pe-3"> No Item available
                        </h4>
                        <a href="{{ route('search.list') }}" type="button" class="btn btn-primary">Order food now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="cart-product" style="display: block;">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="header_text-normal">Cart Item </h5>
                </div>
                <div class="card-body">
                    <div class="mt-3" id="cart_item_fetch">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="header_text-normal">Your delivery address</h5>
                        </div>
                        <div class="card-body">
                            <div class="mt-3">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Write your delivery address" id="delivary_address"
                                            name="delivary_address" style="height: 100px" required></textarea>
                                        <label for="floatingTextarea2">Delivery address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="header_text-normal">Calculate</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered border-success">
                                            <tr>
                                                <th class="fw-normal">
                                                    Total Product price
                                                </th>
                                                <td class="fw-normal"><span id="total_product_price">0</span> &#2547;
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="fw-normal">
                                                    Delivery Charge
                                                </th>
                                                <td class="fw-normal"><span id="delivary_charge">{{ config('siteConfig.app.delivery_charge') }}</span> &#2547;</td>
                                            </tr>
                                            <tr class="bg-success text-white">
                                                <th class="fw-normal">
                                                    Grand total
                                                </th>
                                                <td class="fw-normal"><span id="grand_total">0</span> &#2547;</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="d-grid gap-2">
                                        <button class="btn" id="submit_purchase" type="button">Procced to payment</button>
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
        $(window).on('load', function () {
                const cartData = localStorage.getItem('uiu_foodshop_cart');
                const cartArray = JSON.parse(cartData);
                if (!localStorage.getItem('uiu_foodshop_cart') || $.isEmptyObject(cartArray)) {
                    $('#no-item').css('display', 'block');
                    $('#cart-product').css('display', 'none');
                } else {
                    $('#no-item').css('display', 'none');
                    $('#cart-product').css('display', 'block');
                }
                $('#cart_item_fetch').html(wait);
                function FetchItem() {
                    $('#cart_item_fetch').html('');
                    const total_product_price = parseInt(localStorage.getItem('uiu_foodshop_price'));
                    const delivary_charge = parseInt($('#delivary_charge').text());
                    const grand_total = total_product_price + delivary_charge;
                    $('#total_product_price').html(total_product_price);
                    $('#grand_total').html(grand_total);
                    const cart_data = jQuery.parseJSON(localStorage.getItem('uiu_foodshop_cart'));
                    $.each(cart_data, function (index, item) {
                        const cart_value = `<div class="card shadow-lg">
                    <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="mt-3">
                               <ul class="list-group">
                                 <li class="list-group-item">Name: `+ item.product_name + `</li>
                                 <li class="list-group-item">Price: `+ item.signle_price + ` &#2547;</li>
                                 <li class="list-group-item">Total quantity: `+ item.total_quantity + `</li>
                                 <li class="list-group-item">Total price:`+ item.total_price + `</li>
                               </ul>
                                <span class="float-end pt-3">
                                 <button class="btn btn-danger cart_item_remove"
                                 value="`+ item.unique_id + `"
                                  id="cart_item_remove">
                                     Remove from cart
                                 </button>
                                </span>
                            </div>
                        </div>
                    </div>`;
                        $('#cart_item_fetch').append(cart_value);
                    });
                }
                setTimeout(FetchItem, 2500);
            });
            $(document).ready(function(){
                const total_product_price = parseInt(localStorage.getItem('uiu_foodshop_price'));
                const api_loading = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="pl-2">Please wait</span>`;
                const delivary_charge = parseInt($('#delivary_charge').text());
                const grand_total = total_product_price + delivary_charge;
                function FetchItem() {
                    $('#cart_item_fetch').html(wait);
                    function DataSort() {
                        $('#cart_item_fetch').html('');
                        $('#total_product_price').html(total_product_price);
                        $('#grand_total').html(grand_total);
                        const cart_data = jQuery.parseJSON(localStorage.getItem('uiu_foodshop_cart'));
                        $.each(cart_data, function (index, item) {
                            const cart_value = `<div class="card shadow-lg">
                                        <div class="card-header">
                                           <h5 class="header_text-normal">`+ item.product_name.slice(0, 50) + ` (` + item.single_product_weight + `)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mt-3">
                                                   <ul class="list-group">
                                                     <li class="list-group-item">Name: `+ item.product_name + `</li>
                                                     <li class="list-group-item">Price: `+ item.signle_price + ` &#2547;</li>
                                                     <li class="list-group-item">Total quantity: `+ item.total_quantity + `</li>
                                                     <li class="list-group-item">Total price:`+ item.total_price + `</li>
                                                   </ul>
                                                    <span class="float-end pt-3">
                                                     <button class="btn btn-danger cart_item_remove"
                                                     value="`+ item.unique_id + `"
                                                      id="cart_item_remove">
                                                         Remove from cart
                                                     </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>`;
                            $('#cart_item_fetch').append(cart_value);
                        });
                    }
                    setTimeout(DataSort, 1500);

                }
                $(document).on('click', '.cart_item_remove', function () {
                    const unique_id = $(this).val();
                    const cart_data = localStorage.getItem('uiu_foodshop_cart');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('remove.from_cart') }}",
                        data: {
                            'unique_id': unique_id,
                            'cart_data': cart_data
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('.cart_item_remove').prop("disabled", true);
                            $('.cart_item_remove').html(api_loading);
                        },
                        success: function (response) {
                            localStorage.setItem('uiu_foodshop_cart', response.cart_data);
                            localStorage.setItem('uiu_foodshop_price', response.total_cart_price);
                            function AppendLoadedHtml() {
                                const total_product_price = parseInt(localStorage.getItem('uiu_foodshop_price'));
                                const delivary_charge = parseInt($('#delivary_charge').text());
                                const grand_total = total_product_price + delivary_charge;
                                $('#total_product_price').html(total_product_price);
                                if (total_product_price > 0) {
                                    $('#grand_total').html(grand_total);
                                } else {
                                    $('#delivary_charge').html(0);
                                    $('#grand_total').html(0);
                                }
                                $('#cart_item_fetch').html(wait);
                                function CartRefresh() {
                                    $('#cart_item_fetch').html('');
                                    const cart_data = jQuery.parseJSON(localStorage.getItem('uiu_foodshop_cart'));
                                    $.each(cart_data, function (index, item) {
                                        const cart_value = `<div class="card shadow-lg">
                                            <div class="card-header">
                                            </div>
                                            <div class="card-body">
                                                <div class="mt-3">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Name: `+ item.product_name + `</li>
                                                        <li class="list-group-item">Price: `+ item.signle_price + ` &#2547;</li>
                                                        <li class="list-group-item">Total quantity: `+ item.total_quantity + `</li>
                                                        <li class="list-group-item">Total price:`+ item.total_price + `</li>
                                                    </ul>
                                                    <span class="float-end pt-3">
                                                        <button class="btn btn-danger cart_item_remove"
                                                            value="`+ item.unique_id + `"
                                                            id="cart_item_remove">
                                                            Remove from cart
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>`;
                                        $('#cart_item_fetch').append(cart_value);
                                    });
                                    $('.cart_item_remove').prop("disabled", false);
                                    $('.cart_item_remove').html('');
                                }
                                setTimeout(CartRefresh, 2000);
                            }
                            setTimeout(AppendLoadedHtml, 1500);
                        }
                    });
                });
                 $(document).on('click', '#submit_purchase', function (e) {
                    e.preventDefault();
                    const delivary_address = $('#delivary_address').val();
                    const delivary_charge = parseInt($('#delivary_charge').text());
                    const cart_data = jQuery.parseJSON(localStorage.getItem('uiu_foodshop_cart'));
                    const grand_total = total_product_price + delivary_charge;
                    if (delivary_address.length === 0) {
                        alert('Write your address');
                        return;
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('post.cart_checkout') }}",
                        data: {
                            'delivary_address': delivary_address,
                            'delivary_charge': delivary_charge,
                            'grand_total': grand_total,
                            'cart_data': cart_data,
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('#submit_purchase').html(api_loading);
                            $('#submit_purchase').prop("disabled", true);
                        },
                        success: function (response) {
                            $('#submit_purchase').html('Checkout');
                            $('#submit_purchase').prop("disabled", false);
                            localStorage.removeItem('uiu_foodshop_cart');
                            localStorage.removeItem('uiu_foodshop_price');
                            const token = response.token;
                            $('#payment_method').html(`
                                            <div class="form-check">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <input type="text" value="`+ token + `" name="payment_token" id="payment_token" hidden>
                                    <div class="p-3">
                                        <input class="form-check-input" type="radio" name="payment_method_select_by_user" id="payment_method_select_by_user" value="COD" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <img src="{{ asset('assets/img/cod.png') }}" class="payment_method_icon px-2" alt="COD">
                                            Cash on delivery
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="p-3">
                                        <input class="form-check-input" type="radio" name="payment_method_select_by_user" id="payment_method_select_by_user" value="card">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <img src="{{ asset('assets/img/stripe-v2.svg') }}" class="payment_method_icon px-2" alt="card">
                                            Onlie Payment
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                            $('#payment_modal').modal('show');
                        },
                        error: function (xhr, status, error) {
                           /*  alert('Future project development'); */
                            console.log(error);
                        }
                    });
                });
            });
</script>
@endsection
