<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardRedirectController extends Controller
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
    }

    public function DashboardRender(){
        return view('pages.auth.dashboard.dashboard');
    }
    public function ShopPendingApproval(){
        $get_shop = User::where('path', 'Shop')->get();
        return view('pages.auth.dashboard.helper-page.admin.seller-approval', compact('get_shop'));
    }

    public function SetMenue(){
        $get_menu = Menue::where('shop_email',Session::get('email'))->paginate(10);
        return view('pages.auth.dashboard.helper-page.seller.set-menue', compact('get_menu'));
    }
}
