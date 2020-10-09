<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\model\VendorUser\VendorUser;
use App\Notifications\User\SignupActivate;
use App\Setting\HomePage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function getRegister(){
       
    	return view(HomePage::theme("user.register"));
    }
    public function postRegister(Request $request){
        // dd($request->all());
    	$validator=Validator::make($request->all(),[
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'mobile_number' => 'required|size:10|regex:/^[0-9]+$/i',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ],[
            'fname.required' => 'Firstname is mandatoy',
            'lname.required'  => 'Lastname is mandatory',
            'phone.required'  => 'Phone is mandatory',
            'phone.size'  => 'Phone must be 10 digit',
            'phone.unique'  => 'Phone number already exist',
            'phone.regex'   => 'Invalid phone',
            'email.required'  => 'Email is mandatory',
            'email.unique'  => 'Email already exist',
            'email.regwx' => 'Invalid email',
            'gender.required'   => 'Please select gender',
            'password.required'  => 'Password is mandatory',
        ]);

        $input = $request->all();

        if ($validator->passes()) {

            $user = new User([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id'=>1,
                'activation_token' => Str::random(60),
            ]);
            $user->save();
            $vendor=VendorUser::create([
	            'fname'=>$request->fname,
                'lname'=>$request->lname,
	            'mobile_number'=>$request->mobile_number,	            
	            'user_id'=>$user->id,
            ]);
            // $user->notify(new SignupActivate($user));
            if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                return redirect('/viewcart');
             }else{
                return redirect('customer-signup')->with('warning','Invalid Username and Password');
             }
           
        }
        
        return redirect()->back()->with(['errors' => $validator->errors()]);
    }
    public function resend(Request $request){
        $user = User::byEmail($request->email)->firstOrFail();
              
        if($user->hasVerifiedEmail()) {
            return redirect('vendor/login')->withInfo('Your email has already been verified');
        }
        $user->active=0;
        $user->activation_token=str_random(40);   
        $user->save();        
  
        $user->notify(new SignupActivate($user));      

        return redirect('vendor/login')->with('msg','Verification email resent. Please check your inbox');
    }
}
