<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\model\VendorUser\VendorUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function emaillogin(Request $request){
        $buyer=null;
        $user=null;
        $okk=false;
        $token="";
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user=Auth::user();
            $buyer=VendorUser::where('user_id',$user->id)->first();
            $okk=true;
            $token = $user->createToken('logintoken')->accessToken;
        }
        return response()->json(['acc'=>$buyer,'user'=>$user,'status'=>$okk,'token'=>$token]);

    }

    public function phonelogin(Request $request){
        $buyer=VendorUser::where('mobile_number',$request->phone)->first();
        $user=null;
        $okk=false;
        $token="";
        if($buyer!=null){
            $user=User::find($buyer->user_id);
            if($user!=null){
                if((Hash::check($request->password, $user->password)) ){
                    $okk=true;
                    $token = $user->createToken('logintoken')->accessToken;
                    return response()->json(['acc'=>$buyer,'user'=>$user,'status'=>$okk,'token'=>$token]);
                }
            }
        }
        return response()->json(['acc'=>null,'user'=>null,'status'=>false,'token'=>""]);

    }

    public function user(){
        $user=Auth::user();
        $buyer=VendorUser::where('user_id',$user->id)->first();
        return response()->json(['acc'=>$buyer,'user'=>$user]);
    }

    public function signup(Request $request){

        $buyer=VendorUser::where('mobile_number',$request->phone)->first();
        if($buyer!=null){
            return response()->json(['status'=>false,"message"=>"The Phone no is Already Used"]);
        }
        $email=$request->email;
        if($request->filled('email')){
            $user=User::where("email",$request->email)->first();
            if($user!=null){
                return response()->json(['status'=>false,"message"=>"The Email is Already Used"]);
            }
        }else{
            $email=$request->phone."@some.com";
        }
        // if()
        $user=new User();
        $user->email=$request->email??$email;
        $user->password=bcrypt($request->password);
        $user->save();

        // if()
        $buyer=new VendorUser();
        $buyer->fname=$request->fname;
        $buyer->lname=$request->lname;
        $buyer->address=$request->address;
        $buyer->mobile_number=$request->phone;
        $buyer->user_id=$user->id;
        $buyer->save();
        $token = $user->createToken('logintoken')->accessToken;
        return response()->json(['acc'=>$buyer,'user'=>$user,'status'=>true,'token'=>$token]);

    }

    public function changepass(Request $request){
        $user=Auth::user();
        if(Hash::check($request->password, $user->password)){
            $user->password=bcrypt($request->newpassword);
            return response()->json(['status'=>true,'message'=>"Password Changed Sucessfully"]);
        }else{
            return response()->json(['status'=>false,"message"=>"Old Password Not Match"]);
        }
    }

    public function forgot(Request $request){
        $buyer=VendorUser::where('mobile_number',$request->phone)->first();
        if($buyer==null){
            return response('Mobile No Not Found',401);
        }
        $user=User::find($buyer->user_id);
        $user->activation_token=mt_rand(0000,9999);
        $user->save();
        return response('ok');
    }

    
}
