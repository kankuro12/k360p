<?php

namespace App\Http\Controllers\Api;

use App\Channels\Aakash;
use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\admin\VendorAccount as AdminVendorAccount;
use App\model\admin\VendorWithdrawl;
use App\model\OrderItem;
use App\model\ProductStock;
use App\model\ShippingDetail;
use App\model\Vendor\Vendor;
use App\model\VendorUser\VendorUser;
use App\Notifications\User\ApiPassForgot;
use App\Rating;
use App\ReferalPayment;
use App\User;
use App\VendorVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Setting\HomePage;
use App\Setting\VendorAccount;

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
                $user->save();
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
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
        // return $r;
    }

    public function initPhonePass(Request $request)
    {
        $phone=strval($request->phone);
        $vendor = Vendor::where('phone_number',$phone)->first();
        $user = null;
        $r = null;
        if ($vendor != null) {
            // $user = User::where('id', $vendor->user_id)->first();
            // $reset = $user->id . mt_rand(0000, 9999);
            // $user->activation_token = $reset;
            // $user->save();
            return response()->json(['status' => false,'message'=>"Vendor Already Exist"]);

        } else {
            $buyer = VendorUser::where('mobile_number', $phone)->first();
            $vendor = new Vendor();
            $vendor->phone_number = $phone;
            if ($buyer == null) {
                $user = new User();
                $user->email = "xx_" . $phone;
                $user->password = bcrypt($request->password);
                $user->role_id = 2;
                $user->save();
                $reset = $user->id . mt_rand(0000, 9999);
                $user->activation_token = $reset;
                $user->save();

                $vendor->name = $phone;
                $vendor->address = "";
            } else {
                $user = User::where('id', $buyer->user_id)->first();
                $vendor->name = $buyer->fname . ' ' . $buyer->lname;
                $vendor->address = $buyer->address;
            }
            $vendor->phone_number = $phone;
            $vendor->stage = -1;
            $vendor->user_id = $user->id;
            $vendor->save();
            $token = $user->createToken('logintoken')->accessToken;

            return $this->getData($token,$user);
        }
        // try {
        //     $r = Aakash::sendMessage(['to' => $vendor->phone_number, "text" => "Your Activation Code is " . $user->activation_token]);
        // } catch (\Throwable $th) {
        //     return response()->json(['status' => false]);
        // }
        // return $r;
    }

    private function getData($token,$user){
        $vendor=Vendor::where('user_id',$user->id)->first();
        $verification = VendorVerification::where('vendor_id', $vendor->id)->first();
        if($verification!=null){

            $vendor->bankaccount = $verification->bankaccount;
            $vendor->bankname = $verification->bankname;
            $vendor->citi = $verification->citizenship;
        }else{
            $vendor->bankaccount ='';
            $vendor->bankname = '';
        }
        $account=AdminVendorAccount::where('vendor_id',$vendor->id)->first();
        return response()->json(['status' => true,  'user' => $user, 'vendor' => $vendor,'acc'=>$account,'token'=>$token]);
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
            // $user->activation_token = "";
            // $user->save();
            $token = $user->createToken('logintoken')->accessToken;
        }
        $verification = VendorVerification::where('vendor_id', $vendor->id)->first();
        if($verification!=null){

            $vendor->bankaccount = $verification->bankaccount;
            $vendor->bankname = $verification->bankname;
        }else{
            $vendor->bankaccount ='';
            $vendor->bankname = '';
        }
        return response()->json(['status' => true, 'token' => $token, 'user' => $user, 'vendor' => $vendor]);
    }



    public function phonelogin(Request $request)
    {
        $vendor = Vendor::where('phone_number', strval($request->phone))->first();
        $user = null;
        $okk = false;
        $token = "";
        $psw=bcrypt($request->password);
        if ($vendor != null) {
            $user = User::find($vendor->user_id);
            if ($user != null) {

                if ((Hash::check($request->password, $user->password))) {
                    $token = $user->createToken('logintoken')->accessToken;
                    $verification = VendorVerification::where('vendor_id', $vendor->id)->first();
                    if($verification!=null){
            
                        $vendor->bankaccount = $verification->bankaccount;
                        $vendor->bankname = $verification->bankname;
                    }else{
                        $vendor->bankaccount ='';
                        $vendor->bankname = '';
                    }
                    return response()->json(['status' => true, 'token' => $token, 'user' => $user, 'vendor' => $vendor]);
                }
            }
        }
        //'data'=>$psw,'res'=>$request->all(),
        return response()->json(['acc' => $vendor, 'user' => $user, 'status' => $okk, 'token' => $token]);
    }

    public function profileImage(Request $request)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();
        if ($request->hasFile('image')) {
            $vendor->logo = $request->image->store('vendor/profilepics');
        }
        $vendor->save();
        return response()->json(['status' => true]);
    }
    public function vendorSetup(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, "message" => "Please Login"]);
        } else {
            $user = Auth::user();
            $vendor = Vendor::where('user_id', $user->id)->first();
            $vendor->name = $request->name;
            $vendor->address = $request->address;
            $vendor->storename = $request->storename;
            if($vendor->stage<3){
                $vendor->logo="vendorlogo.png";
            }
            $verification = VendorVerification::where('vendor_id', $vendor->id)->first();
            if ($verification == null) {
                $verification = new VendorVerification();
            }
            $verification->bankaccount = $request->bankaccount;
            $verification->bankname = $request->bankname;
            $verification->vendor_id = $vendor->id;
            if ($request->hasFile('reg')) {
                $verification->registration = $request->file('reg')->store('images/vendor_images/verification');
            } else {
                $verification->registration = '';
            }
            if ($request->hasFile('citi')) {
                $verification->citizenship = $request->file('citi')->store('images/vendor_images/verification');
            } else {
                $verification->citizenship = '';
            }
            $verification->save();
            $vendor->stage = 3;
            $vendor->save();
            return response()->json(['status' => true, "message" => "Vendor Updated Sucessfully"]);
        }
    }

    public function order($id)
    {
        $user = Auth::user();
        $order = ShippingDetail::where('id', $id)->first();
        if ($order == null) {
            return response("Order Not Found", 404);
        }

        return response()->json($order);
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => false, "message" => "Please Login"]);
        } else {

            $user = Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->first();
            if($vendor->stage<3){
                return response()->json(['status'=>false,'msg'=>"You Cannot Use This feature Yet"]);
            }
            if($vendor->verified==0){
                return response()->json(['status'=>false,'msg'=>"Account Not Verified"]);

            }
            $shipping = new ShippingDetail();
            if($request->filled('me')){
                
                $shipping->user_id = $user->id;
            }
            $shipping->email = $request->email??'';
            $shipping->name = $request->name;
            $shipping->phone = $request->phone;
            $shipping->order_message = $request->order_message ?? "";
            $shipping->streetaddress = $request->streetaddress;
            $shipping->province_id = $request->province_id;
            $shipping->district_id = $request->district_id;
            $shipping->municipality_id = $request->municipality_id;
            $shipping->shipping_area_id = $request->shipping_area_id;
            $shipping->shipping_charge = $request->shipping_charge ?? 0;
            $shipping->otp = mt_rand(00000, 99999);
            $shipping->save();
            $vids = [];
            // dd($request->items);
            foreach ($request->items as $item) {
                $value = (object)$item;
                $productDetail = Product::where('product_id', $value->id)->first();
                $orderItem = new OrderItem();
                $orderItem->shipping_detail_id = $shipping->id;

                $orderItem->product_id = $value->id;
                $orderItem->qty = $value->qty;
                $orderItem->variant_code = $value->variant_code;
                $vendor_id = $productDetail->vendor_id;
                if ($vendor_id != null && $vendor_id != 0) {
                    $orderItem->vendor_id = $vendor_id;

                    if (!in_array($vendor_id, $vids)) {
                        array_push($vids, $vendor_id);
                    }
                } else {
                    $orderItem->ismainstore = 1;
                }

                $orderItem->stage = 0;
                $orderItem->issimple = $productDetail->stocktype;
                $orderItem->rate = $value->rate;

                $orderItem->discount = 0;
                $orderItem->deliverytype = $request->delivery_type ?? 0;

                if ($value->variant_code != null) {
                    $variantStock = ProductStock::where('product_id', $value->id)->where('code', $value->variant_code)->first();
                    $variantStock->qty = $variantStock->qty - $value->qty;
                    $variantStock->save();
                } else {
                    $stockStatus = Product::where('product_id', $value->id)->first();
                    $stockStatus->quantity = $stockStatus->quantity - $value->qty;
                    $stockStatus->save();
                }
                if(!$request->filled('me')){
                    $orderItem->referal_id=$user->id;
                }
                $orderItem->save();
            }
            return response()->json(['order' => $shipping]);
        }
    }

    public function vendorUser(){
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->first();
        $verification = VendorVerification::where('vendor_id', $vendor->id)->first();
        if($verification!=null){

            $vendor->bankaccount = $verification->bankaccount;
            $vendor->bankname = $verification->bankname;
            $vendor->citi = $verification->citizenship;
        }else{
            $vendor->bankaccount ='';
            $vendor->bankname = '';
        }
        $account=AdminVendorAccount::where('vendor_id',$vendor->id)->first();
        return response()->json(['status' => true,  'user' => $user, 'vendor' => $vendor,'acc'=>$account]);

    }

    public function withdraw(){
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->first();
        $account=new VendorAccount($user->id);
        $withdraws=VendorWithdrawl::where('vendor_id',$vendor->id)->get();
        return response()->json(['status' => true, 'withdraws' => $withdraws,'acc'=>[
            'amount'=>$account->withdraw(),
            'pending'=>$account->pending(),
        ]]);

    }
}
