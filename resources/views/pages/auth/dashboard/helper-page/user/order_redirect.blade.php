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
$current_order_validate = MainOrder::where([
['client','=',$client_id],
['status','!=','Delivered'],
])->exists();
@endphp
@if($current_order_validate === true)
@include('pages.auth.dashboard.helper-page.user.current_order')
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">No order available</h1>
            </div>
        </div>
    </div>
</div>
@endif
