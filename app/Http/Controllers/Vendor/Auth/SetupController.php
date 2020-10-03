<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Vendor\SetupFinished;
use Illuminate\Http\Request;
use App\User;
use App\VendorOptions;
use App\VendorVerification;

class SetupController extends Controller
{
    //
    public function step1(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'code' => 'required',

            ]);


            $verifyUser = User::where('activation_token', $request->code)->first();
            if (isset($verifyUser)) {
                $verifyUser->active = 1;
                $verifyUser->activation_token = '';
                $verifyUser->save();
                $vendor = $verifyUser->vendor;
                $vendor->stage = 1;
                $vendor->save();
                return redirect()->route('vendor.step-2');
            } else {
                return redirect()->back()->withErrors(['Inorrect Verification Code']);
            }
        } else {
            $user = $request->user();
            if ($user->status() == 1) {
                return redirect()->route('vendor.step-2');
            } elseif ($user->status() == 2) {
                return redirect()->route('vendor.step-3');
            }
            return view('vendor.auth.step1');
        }
    }

    public function step2(Request $request)
    {
        $user = $request->user();
        if ($request->method() == 'POST') {
            $request->validate([
                'landmark'=>'required',
                'province_id'=>'required|integer',
                'district_id'=>'required|integer',
                'municipality_id'=>'required|integer',
                'shipping_area_id'=>'required|integer',
                'deliver_range'=>'required|integer',
            ]);
            $vendor=$user->vendor;
            $option=VendorOptions::where('vendor_id',$vendor->id)->first();
            if($option==null){
                $option=new VendorOptions();

            }
            $option->deliver_range=$request->deliver_range;
            $option->landmark=$request->landmark;
            $option->address=$request->address;
            $option->province_id=$request->province_id;
            $option->district_id=$request->district_id;
            $option->municipality_id=$request->municipality_id;
            $option->shiping_area_id=$request->shipping_area_id;
            $option->deliver_range=$request->deliver_range;
            $option->bulksell=$request->bulksell??false;
            $option->bulkbuy=$request->bulkbuy??false;
            $option->vendor_id=$vendor->id;
            $option->save();
            $vendor->stage=2;
            $vendor->save();
            return redirect()->route('vendor.step-3');
        
        } else {
            if ($user->status() == 0) {
                return redirect()->route('vendor.step-1');
            }
            return view('vendor.auth.step2');
        }
    }

    public function step3(Request $request)
    {
        $user = $request->user();
        if ($request->method() == 'POST') {
            $request->validate([
                'bankname'=>'required',
                'bankaccount'=>'required',
                'image'=>'image',
                'image1'=>'image',
                
            ]);

            $vendor=$user->vendor;
            $verification=VendorVerification::where('vendor_id',$vendor->id)->first();
            if($verification==null){
                $verification=new VendorVerification();
            }
            $verification->bankaccount=$request->bankaccount;
            $verification->bankname=$request->bankname;
            $verification->vendor_id=$vendor->id;
            if($request->hasFile('image')){
                $verification->registration=$request->file('image')->store('images/vendor_images/verification');
            }
            if($request->hasFile('image1')){
                $verification->citizenship=$request->file('image1')->store('images/vendor_images/verification');
            }
            $verification->save();
            $vendor->stage=3;
            $vendor->save();
            try {
                
                $user->notify(new SetupFinished($user));
            } catch (\Throwable $th) {
                //throw $th;
                
            }
            return response()->redirectToRoute('vendor.dashboard');
            
        }else{

            if ($user->status() == 1) {
                return redirect()->route('vendor.step-2');
            }
            if ($user->status() == 0) {
                return redirect()->route('vendor.step-1');
            }
            return view('vendor.auth.step3');
        }

    }

    public function back(Request $request)
    {

        $user = $request->user();
        $vendor = $user->vendor;
        $vendor->stage = 1;
        $vendor->save();
        return redirect()->route('vendor.step-1');
    }

    public function addlater(Request $request){
        $user = $request->user();
        $vendor=$user->vendor;
        $vendor->stage=3;
        $vendor->save();
        return response()->redirectToRoute('vendor.dashboard');

    }

    public function launch(Request $request){
        $user = $request->user();
        $vendor=$user->vendor;
        $vendor->islaunched=1;
        $vendor->save();
        return response()->redirectToRoute('vendor.dashboard');
    }
}
