<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Session;
use Auth;

class AuthController extends Controller
{
    //

    public function login()
    {
        $email="delivery@gmail.com";
        // $password = $request->password;
        $password = "admin@123";
        // dd($email,$password);
        if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
            return redirect()->route('delivery.dashboard');
        }
        // return view('delivery.auth.login');
    }

    public function dologin(Request $request)
    {
        // dd($request->all());

        // $email = $request->email;
        $email="delivery@gmail.com";
        // $password = $request->password;
        $password = "admin@123";
        // dd($email,$password);
        if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
            return redirect()->route('delivery.dashboard');
        }
        Session::flash('message', "Wrong Email or Password !!!");
        return redirect()->back();
    }
    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('delivery.login');
    }
}
