<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MainOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RiderController extends Controller
{
    public function ChangeOrderStatusRider(Request $req){
        $order_id = $req->order_id;
        $status = 'Order-pickedup';
        $email = Session::get('email');
        MainOrder::where('oder_id', '=', $order_id)->update([
            'delivery_man' => $email,
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
                if ($temp_tracking_collection->isNotEmpty()) {
                    foreach (json_decode($temp_tracking_collection, true) as $key => $ttex) {
                        $tracking_saved_decoded_collection->push([
                            'order_id' => $ttex['order_id'],
                            'status' => $ttex['status'],
                        ]);
                    }
                    $tracking_saved_decoded_collection->push([
                        'order_id' => $order_id,
                        'status' => $status,
                    ]);
                } else {
                    $tracking_saved_decoded_collection->push([
                        'order_id' => $order_id,
                        'status' => $status,
                    ]);
                }
                Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
            }
        } else {
            $tracking_saved_decoded_collection->push([
                'order_id' => $order_id,
                'status' => $status,
            ]);
            Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
        }
        return redirect()->back()->with('showAlert', true)->with('message', 'Order status updated');
    }
    public function CompleteOrderStatusRider(Request $req){
        $order_id = $req->order_id;
        $status = 'Delivered';
        $email = Session::get('email');
        MainOrder::where([
            ['delivery_man' ,'=', $email],
            ['oder_id', '=', $order_id]
            ])->update([
            'status' => $status,
            'payment_status' => 'Paid',
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
                if ($temp_tracking_collection->isNotEmpty()) {
                    foreach (json_decode($temp_tracking_collection, true) as $key => $ttex) {
                        $tracking_saved_decoded_collection->push([
                            'order_id' => $ttex['order_id'],
                            'status' => $ttex['status'],
                        ]);
                    }
                    $tracking_saved_decoded_collection->push([
                        'order_id' => $order_id,
                        'status' => $status,
                    ]);
                } else {
                    $tracking_saved_decoded_collection->push([
                        'order_id' => $order_id,
                        'status' => $status,
                    ]);
                }
                Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
            }
        } else {
            $tracking_saved_decoded_collection->push([
                'order_id' => $order_id,
                'status' => $status,
            ]);
            Storage::disk('public')->put('tracking.json', json_encode($tracking_saved_decoded_collection));
        }
        return redirect()->back()->with('showAlert', true)->with('message', 'Order status updated');
    }
}
