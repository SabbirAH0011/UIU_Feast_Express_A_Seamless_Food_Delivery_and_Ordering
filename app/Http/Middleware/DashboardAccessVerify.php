<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DashboardAccessVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $req, Closure $next): Response
    {
        if(Session::has('email') && Session::has('access_token')){
            $email = Session::get('email');
            $access_token = Session::get('access_token');
            $verify_session = User::where([
                ['email', '=', $email],
                ['access_token', '=', $access_token],
                ['time_limit', '>=', Carbon::now()],
            ])->exists();
            if($verify_session === true){
                return $next($req);
            }else{
                Session::flush();
                return redirect()->route('log.in');
            }
        }else{
            return redirect()->route('log.in');
        }
    }
}
