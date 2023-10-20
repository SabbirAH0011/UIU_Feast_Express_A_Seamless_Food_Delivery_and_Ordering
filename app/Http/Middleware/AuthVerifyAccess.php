<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;

class AuthVerifyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('email') && Session::has('access_token')){
            $access_token = Session::get('access_token');
            $validate_access_token = User::where([
                ['access_token','=', $access_token],
                ['time_limit','>=', Carbon::now()]
                ])->exists();
                if($validate_access_token === true){
                    return $next($request);
                }else{
                    return redirect()->route('log.in');
                }
        } else {
            return redirect()->route('log.in');
        }
    }
}
