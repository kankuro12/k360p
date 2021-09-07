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

class VendorController extends Controller
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
        $vendor = Vendor::where('phone_number', $request->phone)->first();
        $user=null;
        $r=null;
        if ($vendor != null) {
            $user=User::where('id',$vendor->user_id);
            $reset = $user->id . mt_rand(0000, 9999);
            $user->activation_token = $reset;
            $user->save();
        }else{
            $user = new User();
            $user->email = "xx_".$request->phone;
            $user->password = bcrypt("xx_");
            $reset = $user->id . mt_rand(0000, 9999);
            $user->role_id=2;
            $user->activation_token = $reset;
            $user->save();

            $vendor = new Vendor();
            $vendor->name = $request->phone;
            $vendor->address = "";
            $vendor->phone_number = $request->phone;
            $vendor->stage = -1;
            $vendor->user_id = $user->id;
            $vendor->save();
        }
        try {
            $r=Aakash::sendMessage( ['to'=>$vendor->phone_number,"text"=>"Your Activation Code is ".$user->activation_token]);
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'req'=>$r]);

        }
        return response()->json(['success'=>true]);
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