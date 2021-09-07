<?php

namespace App\Http\Controllers\Api;

use App\Channels\Aakash;
use App\Http\Controllers\Controller;
use App\model\Vendor\Vendor;
use App\model\VendorUser\VendorUser;
use App\Notifications\User\ApiPassForgot;
use App\Rating;
use App\User;
use App\VendorVerification;
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

    public function initPhone(Request $request)
    {
        $vendor = Vendor::where('phone_number', $request->phone)->first();
        $user = null;
        $r = null;
        if ($vendor != null) {
            $user = User::where('id', $vendor->user_id)->first();
            $reset = $user->id . mt_rand(0000, 9999);
            $user->activation_token = $reset;
            $user->save();
        } else {
            $buyer = VendorUser::where('mobile_number', $request->phone)->first();
            $vendor = new Vendor();
            $vendor->phone_number = $request->phone;
            if ($buyer == null) {
                $user = new User();
                $user->email = "xx_" . $request->phone;
                $user->password = bcrypt("xx_");
                $reset = $user->id . mt_rand(0000, 9999);
                $user->role_id = 2;
                $user->activation_token = $reset;
                $user->save();
                $vendor->name = $request->phone;
                $vendor->address = "";
            } else {
                $user = User::where('id', $buyer->user_id)->first();
                $vendor->name = $buyer->fname . ' ' . $buyer->lname;
                $vendor->address = $buyer->address;
            }


            $vendor->stage = -1;
            $vendor->user_id = $user->id;
            $vendor->save();
        }
        try {
            $r = Aakash::sendMessage(['to' => $vendor->phone_number, "text" => "Your Activation Code is " . $user->activation_token]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true]);
        // return $r;
    }

    public function verifyOTP(Request $request)
    {
        $vendor = Vendor::where('phone_number', $request->phone)->first();
        $token = '';
        $user = "";
        if ($vendor == null) {
            return response()->json(['status' => false, "message" => "Mobile Number Not Found"]);
        }
        $user = User::find($vendor->user_id);
        if ($user->activation_token != $request->token) {
            return response()->json(['status' => false, "message" => "Token Expired"]);
        } else {
            $user->password = bcrypt($request->password);
            $user->activation_token = "";
            $user->save();
            $token = $user->createToken('logintoken')->accessToken;
        }
        return response()->json(['status' => true, 'token' => $token, 'user' => $user, 'vendor' => $vendor]);
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

    public function vendorSetup(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, "message" => "Please Login"]);
        } else {
            $user = Auth::user();
            $vendor = Vendor::where('user_id', $user->id);
            $vendor->name = $request->name;
            $vendor->address = $request->address;
            $vendor->storename = $request->storename;

            $verification = VendorVerification::where('vendor_id', $vendor->id)->first();
            if ($verification == null) {
                $verification = new VendorVerification();
            }
            $verification->bankaccount = $request->bankaccount;
            $verification->bankname = $request->bankname;
            $verification->vendor_id = $vendor->id;
            if ($request->hasFile('reg')) {
                $verification->registration = $request->file('image')->store('images/vendor_images/verification');
            } else {
                $verification->registration = '';
            }
            if ($request->hasFile('citi')) {
                $verification->citizenship = $request->file('image1')->store('images/vendor_images/verification');
            } else {
                $verification->citizenship = '';
            }
            $verification->save();
            $vendor->stage = 3;
            $vendor->save();
            return response()->json(['status' => true, "message" => "Vendor Updated Sucessfully"]);
        }
    }
}
