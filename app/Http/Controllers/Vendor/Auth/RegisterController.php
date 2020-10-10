<?php

namespace App\Http\Controllers\vendor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\User;
use App\model\vendor\Vendor;
use App\Notifications\Vendor\SignupActivate;
use Auth;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('vendor.auth.register');
    }
    public function postRegister(Request $request)
    {

        $request->validate([
            'vname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'phone_number' => 'required|size:10|regex:/^[0-9]+$/i',
        ]);
        $input = $request->all();

     
        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),


        ]);

        $user->role_id = 2;
        $user->active = 1;
        $user->activation_token = Str::random(8);
        $user->save();

        $vendor = Vendor::create([
            'name' => $request->vname,
            'phone_number' => $request->phone_number,
            'user_id' => $user->id,
        ]);
        $user->notify(new SignupActivate($user));

        Auth::logout();
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password, 'active' => 1])) {
            return redirect()->route('vendor.step-1');
        }
        return redirect()->back();
    }
    public function resend(Request $request)
    {
        $user = User::byEmail($request->email)->firstOrFail();

        if ($user->hasVerifiedEmail()) {
            return redirect('vendor/login')->withInfo('Your email has already been verified');
        }
        $user->active = 0;
        $user->activation_token = random_int(10000, 99999);
        $user->save();

        $user->notify(new SignupActivate($user));

        return redirect('vendor/login')->with('msg', 'Verification email resent. Please check your inbox');
    }
}
