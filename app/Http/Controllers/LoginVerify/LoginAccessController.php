<?php

namespace App\Http\Controllers\LoginVerify;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class LoginAccessController extends Controller
{
    public function ViewLoginPage(){
        return view('pages.auth.login-register.login');
    }

    public function VerifyUser(Request $req){
        $validatedInputData = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $req->email;
        $password = $req->password;

        $user = User::where('email', $email)->first();

        if ($user) {
            $savedPassword = $user->password;

            if (Hash::check($password, $savedPassword)) {
                $name = $user->name;
                $path = $user->path;
                $access_token = Str::random(60);

                $user->update([
                    'access_token' => $access_token,
                    'time_limit' => Carbon::now()->addDay(),
                ]);

                Session::put([
                    'name' => $name,
                    'email' => $email,
                    'access_token' => $access_token,
                    'path' => $path
                ]);

                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('showAlert', true)->with('message', 'Your credentials did not match');
            }
        } else {
            return redirect()->back()->with('showAlert', true)->with('message', 'Your email address is not in our records');
        }
    }


    public function Logout(){
        Session::flush();
        return redirect()->route('log.in');
    }
}
