<?php

namespace App\Http\Controllers\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Models\MainOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Exception;

class StripeController extends Controller
{
    protected $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
    }
    public function MakePayment(Request $req){
        try {
            $trx = $req->trx;
            $total_price = $req->total_price;
            $card_number = $req->card_number;
            $year = $req->year;
            $month = $req->month;
            $cvc = $req->cvc;
            $description = 'Transaction amount of '. ceil($total_price/100) .' BDT has added as payment. TrxID:' . $trx . '. UIU Foodpanda';
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $card_number,
                    'exp_month' => $month,
                    'exp_year' => $year,
                    'cvc' => $cvc
                ]
            ]);
            $charge = $this->stripe->charges->create([
                'amount' => $total_price,
                'currency' => 'usd',
                'source' => $token,
                'description' => $description
            ]);
            if ($charge->status === 'succeeded') {
                MainOrder::where([
                    ['token', '=', $trx],
                    ['payment_status', '=', 'Unpaid']
                ])->update([
                    'payment_method' => 'Stripe',
                    'payment_status' => 'Paid',
                    'updated_at' => Carbon::now()
                ]);
                return redirect()->route('dashboard');
            }else{
                echo 'Card payment failed';
                sleep(5);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            $line = $e->getLine();
            sleep(5);
            echo $error.'occured at '.$line;
            return redirect()->route('dashboard');
        }
    }
}
