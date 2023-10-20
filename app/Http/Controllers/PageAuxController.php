<?php

namespace App\Http\Controllers;

use App\Models\Menue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageAuxController extends Controller
{
    public function SearchSuggestion(Request $req)
    {
        $search_element = $req->element;
        if (!empty($search_element)) {
            $verify_search_existance = Menue::join('menue_slugs', 'menues.serial', 'menue_slugs.serial')
            ->where('menue_slugs.search_tag', 'LIKE', "%$search_element%")->exists();
            if ($verify_search_existance === true) {
                $get_special_offer = Menue::join('menue_slugs', 'menues.serial', 'menue_slugs.serial')
                ->join('users', 'menues.shop_email', 'users.email')
                ->where('menue_slugs.search_tag', 'LIKE', "%$search_element%")->select('menues.*', 'users.name AS shop')
                ->distinct('menues.name')->limit(5)->get();
                return response()->json([
                    'status' => 'Accepted',
                    'query' => 'exists',
                    'html' => view('pages.frontend.helper-page.search', compact('get_special_offer'))->render()
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Accepted',
                    'query' => 'not exists'
                ], 200);
            }
            return response()->json([
                'status' => 'Accepted',
                'query' => $verify_search_existance
            ], 200);
        } else {
            return response()->json([
                'status' => 'Accepted',
                'query' => 'not exists'
            ], 200);
        }
    }

    public function FetchTrackingStatus(Request $req){
        $orderId = $req->orderId;
        $verify_file_tracking = Storage::disk('public')->exists('tracking.json');
        if ($verify_file_tracking === true) {
            $tracking_saved_decoded_collection = collect();
            $existing_tracking_decoded = json_decode(Storage::disk('public')->get('tracking.json'), true);
            foreach ($existing_tracking_decoded as $key => $ext) {
                $tracking_saved_decoded_collection->push([
                    'order_id' => $ext['order_id'],
                    'status' => $ext['status'],
                ]);
            }
                $fetchOrder = $tracking_saved_decoded_collection->firstWhere('order_id', $orderId);
                if($fetchOrder){
                    $status = $fetchOrder['status'];
                    if($status === 'Order-placed'){
                        return response()->json([
                            'track_status' => 'exist',
                            'html' => view('components.status.order_placed')->render()
                        ], 200);
                    } elseif ($status === 'Order-prepared') {
                        return response()->json([
                            'track_status' => 'exist',
                            'html' => view('components.status.order_prepared')->render()
                        ],200);
                    } elseif ($status === 'Order-pickedup') {
                        return response()->json([
                            'track_status' => 'exist',
                            'html' => view('components.status.rider_picked')->render()
                        ],200);
                    }else{
                        return response()->json([
                            'track_status' => 'exist',
                            'html' => view('components.status.delivered')->render()
                        ], 200);
                    }
                }else{
                    return response()->json([
                        'track_status' => 'exist',
                        'html' => view('components.status.delivered')->render()
                    ], 200);
                }
        }else{
            return response()->json([
                'track_status' => 'exist',
                'html' => view('components.status.delivered')->render()
            ], 200);
        }
    }
}
