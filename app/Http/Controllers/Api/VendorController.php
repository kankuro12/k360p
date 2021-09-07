<?php

namespace App\Http\Controllers\Api;

use App\Channels\Aakash;
use App\Http\Controllers\Controller;
use App\model\Vendor\Vendor;
use App\model\VendorUser\VendorUser;
use App\Notifications\User\ApiPassForgot;
use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function emaillogin(Request $request)
    {
        $buyer = null;
        $user = null;
        $okk = false;
        $token = "";
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $buyer = Vendor::where('user_id', $user->id)->first();
            $okk = true;
            $token = $user->createToken('logintoken')->accessToken;
        }
        return response()->json(['acc' => $buyer, 'user' => $user, 'status' => $okk, 'token' => $token]);
    }

    public function initPhone(Request $request){
        $buyer = Vendor::where('phone_number', $request->phone)->first();
        $user=null;
        if ($buyer != null) {
            $user=User::where('id',$buyer->user_id);
            $reset = $user->id . mt_rand(0000, 9999);
            $user->activation_token = $reset;
            $user->save();
        }else{
            $user = new User();
            $user->email = "xx_98";
            $user->password = bcrypt("xx_98");
            $reset = $user->id . mt_rand(0000, 9999);
            $user->activation_token = $reset;
            $user->save();

            $buyer = new Vendor();
            $buyer->name = "";
            $buyer->address = "";
            $buyer->phone_number = "";
            $buyer->stage = -1;
            $buyer->user_id = $user->id;
            $buyer->save();
        }
        return response()->json($user);
    }
    public function phonelogin(Request $request)
    {
        $buyer = Vendor::where('phone_number', $request->phone)->first();
        $user = null;
        $okk = false;
        $token = "";
        if ($buyer != null) {
            $user = User::find($buyer->user_id);
            if ($user != null) {
                if ((Hash::check($request->password, $user->password))) {
                    $okk = true;
                    $token = $user->createToken('logintoken')->accessToken;
                    return response()->json(['acc' => $buyer, 'user' => $user, 'status' => $okk, 'token' => $token]);
                }
            }
        }
        return response()->json(['acc' => null, 'user' => null, 'status' => false, 'token' => ""]);
    }
}