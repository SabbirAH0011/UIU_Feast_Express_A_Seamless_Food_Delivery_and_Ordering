<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Middleware\DashboardAccessVerify;
use App\Models\MainOrder;
use App\Models\Menue;
use App\Models\MenueSlug;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator as IDGen;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as IMG;

class ShopController extends Controller
{
    protected $email;
    protected $access_token;
    protected $path;

    public function __construct(){
        $this->middleware(function ($req, $next) {
            $this->email = Session::get('email');
            $this->access_token = Session::get('access_token');
            $this->path = Session::get('path');

            if ($this->path === 'Shop') {
                $verify_approval = User::where([
                    ['email', '=', $this->email],
                    ['access_token', '=', $this->access_token],
                    ['path', '=', $this->path],
                    ['permission', '=', 'Pending']
                ])->exists();

                if ($verify_approval) {
                    Session::flush();
                    return redirect()->route('log.in')->with('showAlert', true)->with('message', 'Admin did not approve your access. Please wait for admin approval and then try to log in');
                }
            }

            return $next($req);
        });
        $this->middleware(DashboardAccessVerify::class);
    }

    public function StoreSetMenue(Request $req){
        $name = $req->name;
        $main_image = $req->img;
        $start_price = $req->start_price;
        $prev_price = $req->prev_price;
        $description = $req->description;
        $search_tag = $req->search_tag;
        $is_discount = $req->is_discount;
        if ((!empty($is_discount)) && (!empty($prev_price))) {
            $discount_product = 'yes';
            $deduction = $prev_price - $start_price;
            $discount_precentage = intval((($deduction * 100) / $start_price));
        } else {
            $discount_product = 'no';
            $discount_precentage = 0;
        }
        $serial = IDGen::generate(['table' => 'menues', 'field' => 'serial', 'length' => 15, 'prefix' => 'SM-']);
        if (!empty($main_image)) {
            $file_name_gen = hexdec(uniqid()) . '.' . $main_image->getClientOriginalExtension();
            $path = public_path('assets/img/products/' . $file_name_gen);

            $image = IMG::make($main_image)->resize(200, 200);

            $watermarkPath = public_path('assets/img/favicon.png');
            if (file_exists($watermarkPath)) {
                $watermark = IMG::make($watermarkPath);
                $watermark->opacity(50);
                $image->insert($watermark, 'bottom-right', 10, 10);
            }

            $image->save($path);

            $final_product_img = '/public/assets/img/products/' . $file_name_gen;
        } else {
            $final_product_img = NULL;
        }

        for ($i = 0; $i < count($search_tag); $i++) {
            $save_single_product_slug = new MenueSlug();
            $save_single_product_slug->serial = $serial;
            $save_single_product_slug->search_tag = $search_tag[$i];
            $save_single_product_slug->save();
        }

        $save_single_product_slug = new MenueSlug();
        $save_single_product_slug->serial = $serial;
        $save_single_product_slug->search_tag = $name;
        $save_single_product_slug->save();

        $save_single_product = new Menue();
        $save_single_product->serial = $serial;
        $save_single_product->shop_email = $this->email;
        $save_single_product->name = $name;
        $save_single_product->img = $final_product_img;
        $save_single_product->description = $description;
        $save_single_product->start_price = $start_price;
        $save_single_product->discount = $discount_product;
        $save_single_product->discount_percent = $discount_precentage;
        $save_single_product->prev_price = $prev_price;
        $save_single_product->save();

        return redirect()->back()->with('showAlert', true)->with('message', 'Item saved to menu');
    }

    public function ChangeOrderStatusShop(Request $req){
        $order_id = $req->order_id;
        $status = 'Order-prepared';
        MainOrder::where('oder_id','=', $order_id)->update([
            'status' => $status,
            'updated_at' => Carbon::now()
        ]);
        $verify_file_tracking = Storage::disk('public')->exists('tracking.json');
        $tracking_saved_decoded_collection = collect();
        if ($verify_file_tracking === true) {
            $existing_tracking_decoded = json_decode(Storage::disk('public')->get('tracking.json'), true);
            $temp_tracking_collection = collect();
            foreach ($existing_tracking_decoded as $key => $ext) {
                $temp_tracking_collection->push([
                    'order_id' => $ext['order_id'],
                    'status' => $ext['status'],
                ]);
            }
            $orderIndex = $temp_tracking_collection->search(function ($order) use ($order_id) {
                return $order['order_id'] === $order_id;
            });
            if ($orderIndex !== false) {
                $temp_tracking_collection->forget($orderIndex);
                if($temp_tracking_collection->isNotEmpty()){
                    foreach(json_decode($temp_tracking_collection,true) as $key => $ttex){
                        $tracking_saved_decoded_collection->push([
                            'order_id' => $ttex['order_id'],
                            'status' => $ttex['status'],
                        ]);
                    }
                    $tracking_saved_decoded_collection->push([
                        'order_id' => $order_id,
                        'status' => $status,
                    ]);
                }else{
                    $tracking_saved_decoded_collection->push([
                        'order_id' => $order_id,
                        'status' => $status,
                    ]);
                }
                Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
            }
        }else{
            $tracking_saved_decoded_collection->push([
                'order_id' => $order_id,
                'status' => $status,
            ]);
            Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
        }
        return redirect()->back()->with('showAlert', true)->with('message', 'Order status updated');
    }
}
