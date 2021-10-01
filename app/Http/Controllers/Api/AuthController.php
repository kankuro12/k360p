<?php

namespace App\Http\Controllers\Api;

use App\Channels\Aakash;
use App\Http\Controllers\Controller;
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
            $buyer = VendorUser::where('user_id', $user->id)->first();
            $okk = true;
            $token = $user->createToken('logintoken')->accessToken;
        }
        return response()->json(['acc' => $buyer, 'user' => $user, 'status' => $okk, 'token' => $token]);
    }

    public function phonelogin(Request $request)
    {
        $buyer = VendorUser::where('mobile_number', $request->phone)->first();
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

    public function user()
    {
        $user = Auth::user();
        $buyer = VendorUser::where('user_id', $user->id)->first();
        return response()->json(['acc' => $buyer, 'user' => $user]);
    }

    public function signup(Request $request)
    {

        $buyer = VendorUser::where('mobile_number', $request->phone)->first();
        if ($buyer != null) {
            return response()->json(['status' => false, "message" => "The Phone no is Already Used"]);
        }
        $email = $request->email;
        if ($request->filled('email')) {
            $user = User::where("email", $request->email)->first();
            if ($user != null) {
                return response()->json(['status' => false, "message" => "The Email is Already Used"]);
            }
        } else {
            $email = $request->phone . "@some.com";
        }
        // if()
        $user = new User();
        $user->email = $request->email ?? $email;
        $user->password = bcrypt($request->password);
        $user->save();

        // if()
        $buyer = new VendorUser();
        $buyer->fname = $request->fname;
        $buyer->lname = $request->lname;
        $buyer->address = $request->address;
        $buyer->mobile_number = $request->phone;
        $buyer->user_id = $user->id;
        $buyer->save();
        $token = $user->createToken('logintoken')->accessToken;
        return response()->json(['acc' => $buyer, 'user' => $user, 'status' => true, 'token' => $token]);
    }

    public function changepass(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $user->password = bcrypt($request->newpassword);
            $user->save();
            return response()->json(['status' => true, 'message' => "Password Changed Sucessfully"]);
        } else {
            return response()->json(['status' => false, "message" => "Old Password Not Match"]);
        }
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $buyer = VendorUser::where('user_id', $user->id)->first();
        $buyer->fname = $request->fname;
        $buyer->lname = $request->lname;
        $buyer->address = $request->address;
        $user->save();
        $buyer->save();
        return response()->json(['status' => true]);
    }

    public function addRreview(Request $r)
    {
        $r->validate([
            'rating' => 'required',
        ]);

        $rating = Rating::where('user_id', Auth::user()->id)->where('product_id', $r->product_id)->first();
        if ($rating == null) {
            $rating = new Rating();
        }
        $buyer = VendorUser::where('user_id', Auth::user()->id)->first();

        $rating->rating = $r->rating;
        $rating->title =  $r->title;
        $rating->rating_desc = $r->rating_desc;
        $rating->user_id = Auth::user()->id;
        $rating->product_id = $r->product_id;
        $rating->save();
        $rating->fname = $buyer->fname;
        $rating->lname = $buyer->lname;
        $rating->profile_img = $buyer->profile_img;
        return response()->json(['status' => true, 'rating' => $rating]);
    }

    public function profileImage(Request $request)
    {
        $user = Auth::user();
        $buyer = VendorUser::where('user_id', $user->id)->first();
        if ($request->hasFile('image')) {
            $buyer->profile_img = $request->image->store('profilepics');
        }
        $buyer->save();
        return response()->json(['status' => true]);
    }


    public function forgotPhone(Request $request)
    {
        $buyer=null;
        if($request->isset('vendor')){

            $buyer = Vendor::where('phone_number', $request->phone)->first();
        }else{
            $buyer = VendorUser::where('mobile_number', $request->phone)->first();

        }
        if ($buyer == null) {
            return response()->json(['status' => false, "message" => "Mobile No Not Found"]);
        }
        $user = User::find($buyer->user_id);
        $reset = $user->id . mt_rand(0000, 9999);
        $user->activation_token = $reset;
        $user->save();

        $data =  ['to' => $request->phone, "text" => $reset . "\n is Your Password reset Code. Do Not Share it With Unknown Person.\n-" . env('APP_NAME', 'laravel')];
        Aakash::sendMessage($data);

        // $user->notify(new ApiPassForgot($reset,$request->phone));

        return response()->json(['status' => true]);
    }



    public function resetPhone(Request $request)
    {
        $buyer=null;
        if($request->isset('vendor')){

            $buyer = Vendor::where('phone_number', $request->phone)->first();
        }else{
            $buyer = VendorUser::where('mobile_number', $request->phone)->first();

        }

        if ($buyer == null) {
            return response()->json(['status' => false, "message" => "Mobile No Not Found"]);
        }        
        $user = User::find($buyer->user_id);
        if ($user->activation_token != $request->token) {
            return response()->json(['status' => false, "message" => "Token Expired"]);
        } else {
            $user->password = bcrypt($request->password);
            $user->activation_token = "";
            $user->save();
        }

        // $user->notify(new ApiPassForgot($reset,$request->phone));

        return response()->json(['status' => true]);
    }

    public function forgotEmail(Request $request)
    {


        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return response('User with email: ' . $request->email . ' Not Found', 401);
        }
        $reset = $user->id . mt_rand(0000, 9999);
        $user->activation_token = $reset;
        $user->save();

        $data =  ['to' => $request->phone, "text" => $reset . "\n is Your Password reset Code. Do Not Share it With Unknown Person.\n-" . env('APP_NAME', 'laravel')];
        Aakash::sendMessage($data);

        // $user->notify(new ApiPassForgot($reset,$request->phone));

        return response('ok');
    }

    public function resetEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return response('User with email: ' . $request->email . ' Not Found', 401);
        }
        if ($user->activation_token != $request->token) {
            return response('Token Missmatch', 401);
        } else {
            $user->password = bcrypt($request->password);
            $user->activation_token = "";
            $user->save();
        }

        // $user->notify(new ApiPassForgot($reset,$request->phone));

        return response('ok');
    }

    public function myRreview(){
        return response()->json(['success'=>true,'ratings'=>Rating::where('user_id', Auth::user()->id)->get()]);
    }
}
