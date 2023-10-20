<?php

namespace App\Http\Controllers\LoginVerify;

use App\Http\Controllers\Controller;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator As IDGen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function SellerRegister(Request $req){
        $validateInputData = $req->validate([
            'email' => 'required|email|unique:users,email',
        ]);
        $name = $req->name;
        $email = $req->email;
        $password = Hash::make($req->password);
        $serial = IDGen::generate(['table' => 'users', 'field'=>'serial', 'length' => 6, 'prefix' => Date('Y')]);

        $save_user = new User();
        $save_user->serial = $serial;
        $save_user->name = $name;
        $save_user->email  = $email;
        $save_user->password  = $password;
        $save_user->path = 'Shop';
        $save_user->permission = 'Pending';
        $save_user->save();

        return redirect()->route('log.in')->with('showAlert', true)->with('message', 'You have successfully registered.Please wait for admin approval and then try to log in');
    }
    public function ClientRegister(Request $req){
        $validateInputData = $req->validate([
            'email' => 'required|email|unique:users,email',
        ]);
        $name = $req->name;
        $email = $req->email;
        $password = Hash::make($req->password);
        $serial = IDGen::generate(['table' => 'users', 'field'=>'serial', 'length' => 6, 'prefix' => Date('Y')]);

        $save_user = new User();
        $save_user->serial = $serial;
        $save_user->name = $name;
        $save_user->email  = $email;
        $save_user->password  = $password;
        $save_user->path = 'User';
        $save_user->save();

        return redirect()->route('log.in')->with('showAlert', true)->with('message', 'You have successfully registered.Please log in here');
    }

    public function RiderRegister(Request $req){
        $validateInputData = $req->validate([
            'email' => 'required|email|unique:users,email',
        ]);
        $name = $req->name;
        $email = $req->email;
        $password = Hash::make($req->password);
        $serial = IDGen::generate(['table' => 'users', 'field' => 'serial', 'length' => 6, 'prefix' => Date('Y')]);

        $save_user = new User();
        $save_user->serial = $serial;
        $save_user->name = $name;
        $save_user->email  = $email;
        $save_user->password  = $password;
        $save_user->path = 'Rider';
        $save_user->save();

        return redirect()->route('log.in')->with('showAlert', true)->with('message', 'You have successfully registered.Please log in here');
    }
}
