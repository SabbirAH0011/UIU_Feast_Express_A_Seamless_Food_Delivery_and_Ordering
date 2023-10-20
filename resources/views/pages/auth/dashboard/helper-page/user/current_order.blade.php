@php
use App\Models\User;
use App\Models\MainOrder;
use Illuminate\Support\Facades\Session;
$access_token = Session::get('access_token');
$email = Session::get('email');
$client_id = User::where([
['email','=',$email],
['access_token','=',$access_token]
])->value('serial');
$current_order = MainOrder::where([
['client','=',$client_id],
['status','!=','Delivered'],
])->orderBy('created_at','DESC')->first();
@endphp
<section class="section register d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="card mb-3">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-12" id="status"></div>
                            <div class="col-12">
                                <input type="text" name="order_id" id="order_id" value="{{ $current_order->oder_id }}" hidden>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Total Price
                                                </th>
                                                <td>
                                                    {{ $current_order->total_price }} &#x9F3;
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Payment Status
                                                </th>
                                                <td>
                                                    {{ $current_order->payment_status }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Delivery Address
                                                </th>
                                                <td>
                                                    {{ $current_order->address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Item ordered
                                                </th>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <th>Name</th>
                                                            <th>QTY</th>
                                                            <th>Price</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach(json_decode($current_order->products,true) as $key => $food)
                                                            <tr>
                                                                <td>{{ $food['product_name'] }}</td>
                                                                <td>{{ $food['quantity'] }}</td>
                                                                <td>{{ $food['total_price'] }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        FetchTrackingStatus()
         function FetchTrackingStatus() {
            const orderId = $('#order_id').val();
            $.ajax({
                 type: "GET",
                 url: "{{ route('fetch.trackinStatus') }}",
                 data: { 'orderId': orderId },
                 dataType: "json",
                 success: function (response) {
                     if (response.track_status == 'exist') {
                        $("#status").html(response.html);
                     }
                 }
             });
         }
        setInterval(FetchTrackingStatus, 5000);
    });
</script>
