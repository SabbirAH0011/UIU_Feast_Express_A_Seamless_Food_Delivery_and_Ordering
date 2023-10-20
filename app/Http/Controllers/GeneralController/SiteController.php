<?php

namespace App\Http\Controllers\GeneralController;

use App\Http\Controllers\Controller;
use App\Models\FoodShopOrder;
use App\Models\MainOrder;
use App\Models\Menue;
use App\Models\MenueSlug;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function Index(){
        $get_special_offer = Menue::join('menue_slugs', 'menues.serial', 'menue_slugs.serial')
        ->join('users', 'menues.shop_email', 'users.email')
        ->where('users.permission', 'approved')
        ->select('menues.*', 'users.name AS shop')
        ->distinct('menues.name')->limit(5)->get();
        return view('pages.frontend.home',compact('get_special_offer'));
    }

    public function ChooseRouteRegistration(){
        return new Response(view('pages.auth.login-register.helping-pages.select-user'));
    }

    public function ChooseRouteRegistrationRoute(Request $req){
        $path = $req->path;
        if(empty($path)){
            return redirect()->back()->with('showAlert', true)->with('message', 'Please select a path');
        }else{
            if($path === 'shop'){
                return redirect()->route('register.shop');
            }elseif($path === 'client'){
                return redirect()->route('register.client');
            }elseif($path === 'rider'){
                return redirect()->route('register.rider');
            }else{
                return redirect()->back()->with('showAlert', true)->with('message', 'Please select a path');
            }
        }
    }

    public function ViewShopRegForm(){
        return view('pages.auth.login-register.register-pages.seller');
    }

    public function ViewClientRegForm(){
        return view('pages.auth.login-register.register-pages.client');
    }

    public function ViewRiderRegForm(){
        return view('pages.auth.login-register.register-pages.rider');
    }

    public function SearchList(Request $req){
        $search_item = $req->get_search;
        $get_item_detail = MenueSlug::join('menues', 'menue_slugs.serial', 'menues.serial')
        ->join('users', 'menues.shop_email', 'users.email')
        ->where('menue_slugs.search_tag','LIKE',"%$search_item%")
        ->distinct()
        ->select('menues.img', 'menues.description', 'users.name', 'users.serial')
        ->get();
        return view('pages.frontend.search-list',compact('get_item_detail'));
    }

    public function SearchDetailsShop(Request $req){
        $serial = $req->serial;
        $shop_details = User::where('serial','=', $serial)->first();
        $shop_name = $shop_details->name;
        $shop_email = $shop_details->email;
        $food_list = Menue::where('shop_email', '=', $shop_email)->get();
        return view('pages.frontend.search-details', compact(
            'shop_name',
            'food_list'
        ));
    }

    public function SearchDetailsItem(Request $req){
        $menue = $req->menue;
        $food_details = Menue::where('serial','=',$menue)->first();
        return view('pages.frontend.menue-details', compact('food_details'));
    }

    public function AddItemToCart(Request $req){
        $product_serial = $req->product_serial;
        $product_name = $req->product_name;
        $total_quantity = $req->total_quantity;
        $signle_price = $req->signle_price;
        $total_price = $req->total_price;
        $old_cart_data = $req->cart_data;
        $cart_collection = collect();

        if (empty($old_cart_data)) {
            $cart_collection->push([
                'unique_id' => Str::random(16) . date('YmdHis'),
                'product_serial' => $product_serial,
                'product_name' => $product_name,
                'total_quantity' => $total_quantity,
                'signle_price' => $signle_price,
                'total_price' => $total_price,
            ]);
        } else {
            foreach (json_decode($old_cart_data, true) as $key => $old_cart) {
                $cart_collection->push([
                    'unique_id' => $old_cart['unique_id'],
                    'product_serial' => $old_cart['product_serial'],
                    'product_name' => $old_cart['product_name'],
                    'total_quantity' => $old_cart['total_quantity'],
                    'signle_price' => $old_cart['signle_price'],
                    'total_price' => $old_cart['total_price'],
                ]);
            }
            $cart_collection->push([
                'unique_id' => Str::random(16) . date('YmdHis'),
                'product_serial' => $product_serial,
                'product_name' => $product_name,
                'total_quantity' => $total_quantity,
                'signle_price' => $signle_price,
                'total_price' => $total_price,
            ]);
        }
        $total_cart_price = $cart_collection->sum('total_price');
        return response()->json([
            'status' => 'Accepted',
            'cart_data' => json_encode($cart_collection),
            'total_cart_price' => $total_cart_price
        ], 200);
    }

    public function ViewCart(){
        return view('pages.frontend.cart');
    }

    public function RemoveFromCart(Request $req)
    {
        $remove_unique_id = $req->unique_id;
        $cart_data = $req->cart_data;
        $data_collection = collect();
        $cart_collection = collect();

        foreach (json_decode($cart_data, true) as $key => $old_cart) {
            $data_collection->push([
                'unique_id' => $old_cart['unique_id'],
                'product_serial' => $old_cart['product_serial'],
                'product_name' => $old_cart['product_name'],
                'total_quantity' => $old_cart['total_quantity'],
                'signle_price' => $old_cart['signle_price'],
                'total_price' => $old_cart['total_price'],
            ]);
        }

        $filtered_collection = $data_collection->filter(function ($value, $key) use ($remove_unique_id) {
            return $value['unique_id'] != $remove_unique_id;
        });
        foreach ($filtered_collection as $key => $fc) {
            $cart_collection->push([
                'unique_id' => $fc['unique_id'],
                'product_serial' => $fc['product_serial'],
                'product_name' => $fc['product_name'],
                'total_quantity' => $fc['total_quantity'],
                'signle_price' => $fc['signle_price'],
                'total_price' => $fc['total_price'],
            ]);
        }

        $total_cart_item = $cart_collection->count('product_serial');
        $total_cart_price = $cart_collection->sum('total_price');
        return response()->json([
            'status' => 'Accepted',
            'cart_data' => json_encode($cart_collection),
            'total_cart_price' => $total_cart_price
        ], 200);
    }

    public function PostCartDetailsCheckout(Request $req){
        $path = Session::get('path');
        $access_token = Session::get('access_token');
        $client_id = User::where([
            ['path', '=', $path],
            ['access_token', '=', $access_token]
        ])->value('serial');
        $delivary_address = $req->delivary_address;
        $delivary_charge = $req->delivary_charge;
        $grand_total = $req->grand_total;
        $cart_data = $req->cart_data;
        $grand_product_collection = collect();
        $order_id = IdGenerator::generate(['table' => 'main_orders', 'field' => 'oder_id', 'length' => 25, 'prefix' => 'uiufood-' . date('dmy')]);
        $generate_payment_token = Str::random(40) . date('dmyhis');
        foreach ($cart_data as $key => $cd) {
            if ((!empty($cd['product_serial'])) &&
                (!empty($cd['product_name'])) &&
                (!empty($cd['total_quantity'])) &&
                (!empty($cd['signle_price'])) &&
                (!empty($cd['total_price']))
            ) {
                $verify_product = Menue::where('serial', '=', $cd['product_serial'])->exists();
                if ($verify_product === true) {
                    $get_product = Menue::where('serial', '=', $cd['product_serial'])->get();
                    foreach ($get_product as $gp) {
                        $product_collection = collect();

                        $shop_email = $gp->shop_email;
                        $product_collection->push([
                            'product_serial' => $gp->serial,
                            'product_name' => $gp->name,
                            'signle_price' => $gp->start_price,
                            'quantity' => $cd['total_quantity'],
                            'total_price' => $cd['total_quantity'] * $gp->start_price
                        ]);

                        $save_shop_order = new FoodShopOrder();
                        $save_shop_order->order_id = $order_id;
                        $save_shop_order->shop = $shop_email;
                        $save_shop_order->products = json_encode($product_collection);
                        $save_shop_order->save();
                    }
                    $grand_product_collection->push([
                        'product_serial' => $gp->serial,
                        'product_name' => $gp->name,
                        'signle_price' => $gp->start_price,
                        'quantity' => $cd['total_quantity'],
                        'total_price' => $cd['total_quantity'] * $gp->start_price
                    ]);
                }
            }
        }
        $total_product_price_form_collection = $grand_product_collection->sum('total_price');

        $save_order = new MainOrder();
        $save_order->oder_id = $order_id;
        $save_order->client = $client_id;
        $save_order->address = $delivary_address;
        $save_order->products = $grand_product_collection;
        $save_order->delivery_charge = $delivary_charge;
        $save_order->total_price = $total_product_price_form_collection;
        $save_order->token = $generate_payment_token;
        $save_order->status = 'Order-placed';
        $save_order->save();
        $verify_file_tracking = Storage::disk('public')->exists('tracking.json');
        $tracking_saved_decoded_collection = collect();
        if ($verify_file_tracking === true) {
            $existing_tracking_decoded = json_decode(Storage::disk('public')->get('tracking.json'), true);
            foreach ($existing_tracking_decoded as $key => $ext) {
                $tracking_saved_decoded_collection->push([
                    'order_id' => $ext['order_id'],
                    'status' => $ext['status'],
                ]);
            }
            $tracking_saved_decoded_collection->push([
                'order_id' => $order_id,
                'status' => 'Order-placed',
            ]);
        }else{
            $tracking_saved_decoded_collection->push([
                'order_id' => $order_id,
                'status' => 'Order-placed',
            ]);
        }
        Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
        return response()->json([
            'status' => 'Accepted',
            'token' => $generate_payment_token
        ], 200);
    }

    public function OrderPaymentGateway(Request $req){
        $token = $req->payment_token;
        $payment_method = $req->payment_method_select_by_user;
        $verify_token = MainOrder::where([
            ['token', '=', $token],
            ['payment_status', '=', 'Unpaid']
        ])->exists();
        if ($verify_token === true) {
            if($payment_method === 'COD'){
                MainOrder::where([
                    ['token', '=', $token],
                    ['payment_status', '=', 'Unpaid']
                ])->update([
                    'payment_method' => $payment_method,
                    'updated_at' => Carbon::now()
                ]);
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('payment_gateway.stripe',['trx' => $token]);
            }
        } else {
            return redirect()->route('welcome');
        }
    }

    public function StripePaymentView(Request $req){
        $trx = $req->trx;
        $payment = MainOrder::where([
            ['token', '=', $trx],
            ['payment_status', '=', 'Unpaid']
        ])->value('total_price');
        $converted = strval($payment * 100);
        return view('pages.frontend.stripe',compact(
            'converted',
            'trx'
        ));
    }
}
