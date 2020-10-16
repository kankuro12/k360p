<?php

namespace App\Http\Controllers\user;

use App\ExatraChargeCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Admin;
use App\model\admin\Product;
use App\model\Cart;
use App\model\OrderItem;
use App\model\OrderItemCharge;
use App\model\ShippingDetail;
use App\Setting\HomePage;
use App\model\ProductStock;
use App\model\Vendor\Vendor;
use App\Setting\OrderManager;
use App\Setting\VendorOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function index(Request $request){
        // dd($request);
        if($request->isMethod('post')){
            // dd($request->shipping_charge);
            $name = $request->fname.' '.$request->lname;
            $shippingDetail = new ShippingDetail();
            $shippingDetail->name = $name;
            $shippingDetail->phone = $request->phone;
            $shippingDetail->email = $request->email;
            $shippingDetail->order_message = $request->order_message;
            $shippingDetail->user_id = Auth::user()->id;
            $shippingDetail->discount = Session::get('couponAmount', 0);

            $shippingDetail->province_id = $request->province_id;
            $shippingDetail->district_id = $request->district_id;
            $shippingDetail->municipality_id = $request->municipality_id;
            $shippingDetail->shipping_area_id = $request->shipping_area_id;
            $shippingDetail->shipping_charge = $request->shipping_charge;
            $shippingDetail->otp = mt_rand(00000,99999);

            // dd($shippingDetail);
            $request->session()->forget('couponAmount');
            $shippingDetail->save();
            $session_id = Session::get('session_id');
            $cart = Cart::where('session_id',$session_id)->get();
            $vids = [];
            $all=$request->all();
            foreach ($cart as $key => $value) {
                $productDetail = Product::where('product_id',$value->product_id)->where('isverified',1)->first();
                $orderItem = new OrderItem();
                $orderItem->shipping_detail_id = $shippingDetail->id;

                $orderItem->bundleid =$all['bundle_'.$value->product_id];
                $orderItem->shippingcharge = $all['shipping_'.$value->product_id];

                $orderItem->shipping_detail_id = $shippingDetail->id;
                $orderItem->product_id = $value->product_id;
                $orderItem->qty = $value->qty;
                $orderItem->variant_code = $value->variant_code;

                $vendor_id = $productDetail->vendor_id;
                if ($vendor_id != null && $vendor_id!=0) {
                    $orderItem->vendor_id = $vendor_id;

                    if (!in_array($vendor_id, $vids)) {
                        array_push($vids, $vendor_id);
                    }
                }else{
                    $orderItem->ismainstore=1;
                }

                $orderItem->stage = 0;
                $orderItem->issimple = $productDetail->stocktype;
                $orderItem->rate = $value->rate;

                $orderItem->discount = 0;
                $orderItem->deliverytype = $request->delivery_type;

                if($value->variant_code != null){
                    $variantStock = ProductStock::where('product_id',$value->product_id)->where('code',$value->variant_code)->first();
                    $variantStock->qty = $variantStock->qty - $value->qty;
                    $variantStock->save();
                }else{
                  $stockStatus = Product::where('product_id',$value->product_id)->first();
                  $stockStatus->quantity = $stockStatus->quantity - $value->qty;
                  $stockStatus->save();
                }
                $orderItem->save();

                $extraChargeCount = ExatraChargeCart::where('cart_id',$value->id)->count();
                if($extraChargeCount>0){
                    $extraCharge = ExatraChargeCart::where('cart_id',$value->id)->get();
                    foreach ($extraCharge as $key => $ec) {
                        $orderCharge = new OrderItemCharge();
                        $orderCharge->amount = $ec->amount;
                        $orderCharge->title = $ec->title;
                        $orderCharge->extra_charge_id = $ec->extra_charge_id;
                        $orderCharge->order_item_id = $orderItem->id;
                        $orderCharge->save();
                    }
                }
            }
            Cart::where('user_email',Auth::user()->email)->delete();
            Admin::first()->notify(new \App\Notifications\admin\OrderNotification($shippingDetail));	                
            foreach ($vids as $vid) {
                $vendor=Vendor::find($vid);	                        
                // dd($vendor->user);	                        
                $vendor->notify(new \App\Notifications\Vendor\OrderNotification($shippingDetail));
            }
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


    public function getShippingCharge($p_id,$d_id,$m_id,$shipping_area_id){
        $session_id = Session::get('session_id');
        $cartItem = Cart::where('session_id',$session_id)->get();
        $charge = [];
        $charge_1 = [];
        $charge_2 = [];
        $bundle=[];
        $bundle_1=[];
        $i=0;

        foreach ($cartItem as $value) {
            $shippingCharge = OrderManager::getShipping($value->product_id,$p_id,$d_id,$m_id,$shipping_area_id);
            $c=[];
            $c['product']=Product::where('product_id',$value->product_id)->select('product_name','product_id','canbundle','vendor_id')->first()->toArray();
            if($c['product']['vendor_id']==null){
                $c['product']['vendor_id']=0; 
            }
            if($shippingCharge['type']=='s101'){
                $c['type']="Free Shipping";
                $c['price']=0;
                $c['show']="0 X ". $value->qty;
            }elseif($shippingCharge['type']=='s102'){
                $c['type']="Flat Shipping";
                $c['price']=$shippingCharge['Price'];
                $c['show']=" -- ";
            }elseif($shippingCharge['type']=='s103'){
                $c['type']="% Shipping";
                $c['price']=$value->qty * $value->rate *$shippingCharge['Price']/100;
                $c['show']=$shippingCharge['Price']."% of ".($value->qty *10);
            }elseif($shippingCharge['type']=='s104'){
                $c['type'] = 'Per Unit Shipping';
                $c['price'] = $value->qty * $shippingCharge['Price'];
                $c['show']=$shippingCharge['Price']." X ".$value->qty;
            }elseif($shippingCharge['type']=='s105'){
                $c['type'] = 'Minimal Shipping';
                $c['price']=$shippingCharge['Price'];
                $c['show']=" -- ";
            }elseif($shippingCharge['type']=='s106'){
                $c['type'] = 'Minimal Shipping';
                $c['price'] = $value->qty * $shippingCharge['Price'];
                $c['show']=$shippingCharge['Price']." X ".$value->qty;
            }
            if($c['product']['canbundle']==1){
                array_push($charge_1,$c);
                
            }else{
                $c['bundleid']=$i;
                array_push($charge_2,$c);
                $bundle['bundle'.$i]=[];
                $bundle['bundle'.$i]['shipping']=$c['price'];
                $bundle['bundle'.$i]['product']=[];
                array_push($bundle['bundle'.$i]['product'],$c);
                $i+=1;
            }
            array_push($charge,$c);
        }

       
        if(count($charge_1)>0){

            $max=0;
            foreach ($charge_1 as $cc) {
                if($cc['price']>$max){
                    $max=$cc['price'];
                }
            }
    
            if(count($bundle)>0){
                $max=$max/2;
            }
    
            $bundle['bundle'.$i]=[];
            $bundle['bundle'.$i]['shipping']=$max;
            $bundle['bundle'.$i]['product']=[];
            foreach ($charge_1 as $cc) {
                $cc['bundleid']=$i;
                array_push( $bundle['bundle'.$i]['product'],$cc);
            }
        }




        // dd($bundle);
        // return view('themes.molla.user.dashboard.shipping',['charges'=>$charge]);
        return view('themes.molla.user.dashboard.newshipping',['bundles'=>$bundle]);
    }

    
}
