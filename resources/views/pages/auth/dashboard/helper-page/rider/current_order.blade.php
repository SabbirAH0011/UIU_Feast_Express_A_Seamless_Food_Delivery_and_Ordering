@php
use Illuminate\Support\Facades\Session;
use App\Models\FoodShopOrder;
use App\Models\MainOrder;
$email = Session::get('email');
$pending_order = MainOrder::join('food_shop_orders','main_orders.oder_id','food_shop_orders.order_id')
->join('users','food_shop_orders.shop','users.email')
->whereNull('main_orders.delivery_man')
->where('main_orders.status','!=','Delivered')
->select('main_orders.*','users.name As shop_name')
->orderBy('main_orders.created_at','DESC')->get();
$current_order = MainOrder::join('food_shop_orders','main_orders.oder_id','food_shop_orders.order_id')
->join('users','food_shop_orders.shop','users.email')
->where([
['main_orders.delivery_man','=',$email],
['main_orders.status','!=','Delivered']
])
->select('main_orders.*','users.name As shop_name')
->orderBy('main_orders.created_at','DESC')->paginate(10);
@endphp
<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="row mb-5">

                @forelse($pending_order as $order)
                <div class="col-md-6 col-xl-4">


                        <div class="card category_hoolder">
                            <div class="card-body">
                                <div class="row pt-3">
                                    <div class="col-6">
                                        <h4 class="category_detail">{{ $order->oder_id}}</h4><br>
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-bordered">
                                        <thead>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($order->products,true) as $key => $food)
                                            <tr>
                                                <td>{{ $food['product_name'] }}</td>
                                                <td>{{ $food['quantity'] }}</td>
                                                <td>{{ $food['total_price'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <p>Shop: {{ $order->shop_name}}</p>
                                    </div>
                                    <div class="col-6">
                                        <p>Delivery Address: {{ $order->address}}</p>
                                    </div>
                                    <div class="col-6">
                                        <p>Total: {{ $order->total_price}} &#x9F3;</p>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('rider_change.order_status',['order_id' => $order->oder_id]) }}" class="btn btn-primary">Pick this order</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
                @empty
                <div class="col-12 text-center">
                    No search is available
                </div>
                @endforelse

            </div>

        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-2">
                    <table class="table table-bordered">
                        <thead>
                            <th>Order ID</th>
                            <th>Order Detail</th>
                            <th>Address</th>
                            <th>Total</th>
                            <th>Payment status</th>
                            <th>Order status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @forelse($current_order as $order)
                            <tr>
                                <td>{{ $order->oder_id }}</td>
                                <td>{{ $order->address }}</td>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($order->products,true) as $key => $food)
                                            <tr>
                                                <td>{{ $food['product_name'] }}</td>
                                                <td>{{ $food['quantity'] }}</td>
                                                <td>{{ $food['total_price'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td>{{ $order->total_price }} &#x9F3;</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->status }}</td>
                                <td><a href="{{ route('rider_complete.order_status',['order_id' => $order->oder_id]) }}"
                                        class="btn btn-primary">Make it complete</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No order</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $current_order->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
