@php
use Illuminate\Support\Facades\Session;
use App\Models\FoodShopOrder;
use App\Models\MainOrder;
$email = Session::get('email');
$current_order = FoodShopOrder::join('main_orders','food_shop_orders.order_id','main_orders.oder_id')
->where([
['food_shop_orders.shop','=',$email],
['main_orders.status','!=','Delivered'],
])->select('main_orders.*')->orderBy('main_orders.created_at','DESC')->paginate(10);
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-2">
                    <table class="table table-bordered">
                        <thead>
                            <th>Order ID</th>
                            <th>Order Detail</th>
                            <th>Order status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @forelse($current_order as $order)
                            <tr>
                                <td>{{ $order->oder_id }}</td>
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
                                <td>{{ $order->status }}</td>
                                <td><a href="{{ route('change.order_status',['order_id' => $order->oder_id]) }}" class="btn btn-primary">Make it complete</a></td>
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
