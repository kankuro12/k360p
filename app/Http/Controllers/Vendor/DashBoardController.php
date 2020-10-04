<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\Coupon;
use App\model\OrderItem;
use App\User;
use App\model\vendor\Vendor;
use App\VendorMessage;
use Auth;

class DashBoardController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $data = Vendor::where('user_id',$id)->first();

        $productcount=Product::where('vendor_id',$data->id)->count();
        $verifiedcount=Product::where('vendor_id',$data->id)->where('isverified',1)->count();
        $unverifiedcount=Product::where('vendor_id',$data->id)->where('isverified',0)->count();
        $featuredcount=Product::where('vendor_id',$data->id)->where('featured',1)->count();


        $couponcount=Coupon::where('vendorid',$data->id)->count();

        $latest=OrderItem::where('vendor_id',$data->id)->orderBy('created_at', 'desc')->take(5)->get();

        return view('vendor.dashboard')->with(compact('latest','data','productcount','verifiedcount','unverifiedcount','couponcount','featuredcount'));
        
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
