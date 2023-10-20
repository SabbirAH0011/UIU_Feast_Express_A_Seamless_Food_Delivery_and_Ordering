<?php

namespace App\Http\Middleware;

use App\Models\MainOrder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StripTrxVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $trx = $request->trx;
        if(empty($trx)){
            return redirect()->route('welcome');
        }else{
            $verify_trx = MainOrder::where([
                ['token', '=', $trx],
                ['payment_status', '=', 'Unpaid']
            ])->exists();
            if($verify_trx === true){
                return $next($request);
            }else{
                return redirect()->route('welcome');
            }
        }
    }
}
