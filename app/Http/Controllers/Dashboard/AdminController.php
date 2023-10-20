<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Middleware\DashboardAccessVerify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware([DashboardAccessVerify::class]);
    }

    public function UpdateShopPendingApproval(Request $req){
        $email = $req->email;
        $permission = $req->permission;

        User::where('email','=',$email)->update([
            'permission' => $permission,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back()->with('showAlert', true)->with('message', 'Shop approval changed');
    }
}
