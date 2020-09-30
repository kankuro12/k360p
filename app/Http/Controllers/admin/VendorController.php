<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\vendor\Vendor;
use App\model\admin\Product;
use App\model\admin\Stocks_status;
use App\model\admin\Category;
use App\model\admin\Brand;
use App\model\Coupon;
use App\model\Coupon_setting;
use App\User;
use App\VendorMessage;

class VendorController extends Controller
{
    public function getVendor(){
        $vendors = User::where('role_id', 2)->get();
        foreach($vendors as $vendor){
            $vendordetail = Vendor::where('user_id',$vendor->id)->first();
            //dd($vendordetail->name);
            // $vendor->
            $vendor->name = $vendordetail->name;
            $vendor->phone = $vendordetail->phone_number;
            $vendor->verified = $vendordetail->verified;
        }
        //dd($vendors);
        return view('admin.vendorlist')->with(compact('vendors'));
    }
    public function setVerified(Request $request){
        //dd($request->all());
        $vendor = Vendor::where('user_id',$request->id)->update(['verified'=>$request->verified]);
        return response()->json($request->verified);
    }
    public function vendorDetails($id){
        $vendor = User::find($id);
        $vendordetails = Vendor::where('user_id',$id)->firstOrFail();
        $vendordetails->primary_email = $vendor->email;
        $vendordetails->active = $vendor->active;
        // dd($vendordetails);
        $products = Product::where('vendor_id',$vendordetails->id)->get();
        foreach($products as $product){
            if($product->brand_id!=null){

                $brand = Brand::find($product->brand_id);
                $brand_name = $brand->brand_name;
            }else{
                $brand_name="No Brand";
            }
            $product->brand_name = $brand_name;
         
        }
        $coupons = Coupon::where('vendorid', $id)->get();
        foreach($coupons as $coupon){
            $coupondetails = Coupon_setting::where('coupon_id', $coupon->id )->firstOrFail();
            // dd($coupondetails);
            $coupon->discount_type = $coupondetails->discount_type;
            $coupon->discount_value = $coupondetails->discount_value;
            $coupon->issued_number_coupon = $coupondetails->issued_number_coupon;
            $coupon->minimum_order_value = $coupondetails->minimum_order_value;
            $coupon->limit_per_customer = $coupondetails->limit_per_customer;
            $coupon->discount_percent = $coupondetails->discount_percent;
            $coupon->maximum_discount_value = $coupondetails->maximum_discount_value;
            // dd($coupon);
        }
       
        //dd($coupons);
        return view('admin.vendordetails')->with(compact('vendordetails','products','coupons'));
    }

    public function status($id,$status){
        $vendor=User::find($id);
        $vendor->active=$status;
        $vendor->save();
        return redirect()->back();
    }

    public function verification($id,$status){
        $vendor=Vendor::find($id);
        $vendor->verified=$status;
        $vendor->save();
        return redirect()->back();
    }

    public function message(Request $request){

        $msg=new VendorMessage();
        $msg->vendor_id=$request->vendor_id;
        $msg->message=$request->message;
        $msg->save();
        return response()->json($msg);
    }
}
