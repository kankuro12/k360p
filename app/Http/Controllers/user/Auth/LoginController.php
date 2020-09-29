<?php

namespace App\Http\Controllers\user\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\User;
use Session;

class LoginController extends Controller
{
    public function getLogin(){
    	return view('user.auth.login');
    }
    public function postLogin(Request $request){
		$validator=Validator::make($request->all(),[	        
	        'email' => 'required|email|max:255',
	        'password' => 'required',
	    ]);
	     if ($validator->passes()) {
	     	    	$email=$request->email;
	     	    	$password=$request->password;
	     	    	$rememberToken=$request->remember;
	     	    	
	     			if (Auth::guard()->attempt(['email' => $email, 'password' => $password], $rememberToken)) {
						return redirect('/viewcart');
	     			}else{
						return redirect('customer-signup')->with('warning','Invalid Username and Password');
	     			}
	     }else{
	     	return redirect()->back()->with(['errors' => $validator->errors()]);
	     }
    	
	}
	
	public function userLogout(Request $request){
		// auth()->guard()->logout();
		// $request->session()->flush();
		Auth::logout();
    	// return redirect('/');
	}

    public function getLogout(){
		// $this->gaurd()->logout();
    	Auth::logout();
    	return redirect('/');
    }
    public function signupActivate($confirmation_code){
    	if( ! $confirmation_code)
    	{
    	    throw new InvalidConfirmationCodeException;
    	}

    	$verifyUser = User::where('activation_token', $confirmation_code)->first();



    	if(isset($verifyUser) ){
    	    $user = $verifyUser->user;
    	    if(!$verifyUser->active) {
    	        $verifyUser->active = 1;
    	        $verifyUser->activation_token = '';
    	        $verifyUser->save();
    	        $status = "Your e-mail is verified. You can now login.";
    	    }else{
    	        $status = "Your e-mail is already verified. You can now login.";
    	    }    	    
    	}else{
    	    return redirect('/user/login')->with('message', "Sorry your email cannot be identified.");
    	}

    	Session::flash('message',$status);

    	return redirect('/user/login');
    }
}
