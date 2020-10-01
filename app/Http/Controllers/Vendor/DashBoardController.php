<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\model\vendor\Vendor;
use App\VendorMessage;
use Auth;

class DashBoardController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $data = Vendor::where('user_id',$id)->first();
        return view('vendor.dashboard')->with(compact('data'));
    }

    public function message(VendorMessage $message){
        $message->seen=1;
        $message->save();
        return redirect()->back();
    }

    public function messages(){
        return view('vendor.messages');
    }
}
