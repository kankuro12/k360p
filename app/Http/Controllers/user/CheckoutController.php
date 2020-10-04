<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Admin;
use App\model\admin\Product;
use App\model\Cart;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Setting\HomePage;
use App\model\ProductStock;
use App\model\Vendor\Vendor;
use App\Notifications\admin\OrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function index(Request $request){
        if($request->isMethod('post')){
            $name = $request->fname.' '.$request->lname;
            $shippingDetail = new ShippingDetail();
            $shippingDetail->name = $name;
            $shippingDetail->phone = $request->phone;
            $shippingDetail->email = $request->email;
            $shippingDetail->order_message = $request->order_message;
            $shippingDetail->user_id = Auth::user()->id;
            $shippingDetail->province_id = $request->province_id;
            $shippingDetail->district_id = $request->district_id;
            $shippingDetail->municipality_id = $request->municipality_id;
            $shippingDetail->shipping_area_id = $request->shipping_area_id;
            $shippingDetail->save();
            $session_id = Session::get('session_id');

            $vids=[];
            $cart = Cart::where('session_id',$session_id)->get();
            foreach ($cart as $key => $value) {
                $orderItem = new OrderItem();
                $orderItem->shipping_detail_id = $shippingDetail->id;
                $orderItem->product_id = $value->product_id;
                $vendor_id=Product::where('id',$orderItem->product_id)->value('vendor_id');
                if($vendor_id!=null){
                    $orderItem->vendor_id = $vendor_id;
                    if(!in_array($vendor_id,$vids)){
                        array_push($vendor_id,$vids);
                    }
                }
                $orderItem->qty = $value->qty;
                $orderItem->variant_code = $value->variant_code;
                if($value->variant_code != null){
                    $variantStock = ProductStock::where('product_id',$value->product_id)->where('code',$value->variant_code)->select('qty')->first();
                    $variantStock->qty = $variantStock->qty - $value->qty;
                    $variantStock->save();
                }else{
                  $stockStatus = Product::where('product_id',$value->product_id)->select('quantity')->first();
                  $stockStatus->quantity = $stockStatus->quantity - $value->qty;
                  $stockStatus->save();
                }
                $orderItem->save();
            }
            
            try {
                //code...
                Admin::first()->notify(new \App\Notifications\admin\OrderNotification($shippingDetail));
                foreach ($vids as $vid) {
                    $vendor=Vendor::find($vid);
                    $vendor->notify(new \App\Notifications\vendor\OrderNotification($shippingDetail));
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            Cart::where('user_email',Auth::user()->email)->delete();
            return redirect('/viewcart')->with('success','Your order placed successfully!');
        }else{
            $session_id = Session::get('session_id');
            $cartItem = Cart::where('session_id',$session_id)->count();
            if($cartItem>0){
                Cart::where('session_id',$session_id)->update(['user_email'=>Auth::user()->email]);
                return view(HomePage::theme("user.checkout"));
            }else{
                return redirect('/viewcart')->with('warning','Your shopping cart is empty!');
            }
        }
    }

    
}
