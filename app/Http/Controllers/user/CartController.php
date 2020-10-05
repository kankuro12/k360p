<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Admin;
use App\model\admin\Product;
use Illuminate\Support\Facades\Session;
use App\Setting\HomePage;
use App\model\Cart;
use App\model\Coupon;
use App\model\OrderItem;
use App\model\ProductStock;
use App\model\ShippingDetail;
use App\model\Vendor\Vendor;
use App\Notifications\admin\OrderNotification;
use Illuminate\Support\Str;


class CartController extends Controller
{
   
    public function addProduct(Request $request){
        // dd($request->all());
        // dd(\App\Setting\VariantManager::codeToString($request->varient));
        $session_id = Session::get('session_id');
        $cartCount = Cart::where(['session_id' => $session_id, 'product_id'=>$request->product_id,'type'=>$request->type,'variant_code'=>$request->varient])->count();
        if($cartCount>0){
            if($request->type == 0){
                $cartData = Cart::where(['session_id' => $session_id, 'product_id'=>$request->product_id])->first();
                $qty = $cartData->qty + 1;
                $stockCheck = Product::where('product_id',$request->product_id)->first();
                if($stockCheck->quantity>=$qty){
                    $cartData->qty = $qty;
                    $cartData->save();
                    return redirect('/viewcart')->with('success','Your order quantity has been updated!');
                }else{
                    return redirect('/viewcart')->with('warning','Your order quantity is out of stock!');
                }
            }else{
                $cartData = Cart::where(['session_id' => $session_id, 'product_id'=>$request->product_id,'variant_code'=>$request->varient])->first();
                $qty = $cartData->qty + 1;
                $stockCheck = ProductStock::where(['product_id'=>$request->product_id,'code'=>$request->varient])->first();
                if($stockCheck->qty>=$qty){
                    $cartData->qty = $qty;
                    $cartData->save();
                    return redirect('/viewcart')->with('success','Your order quantity has been updated!');
                }else{
                    return redirect('/viewcart')->with('warning','Your order quantity is out of stock!');
                }
            }
        }else{
            $cartItem = new Cart();
            if(empty($request->user_email)){
                $cartItem->user_email = '';
            }
    
            if(empty($session_id)){
                $session_id = Str::random(40);
                Session::put('session_id',$session_id);
            }
            $cartItem->product_id = $request->product_id;
            $cartItem->type = $request->type;
            $cartItem->qty = $request->qty;
            $cartItem->session_id = $session_id;
            $cartItem->variant_code = $request->varient;
            $cartItem->save();

           

            return redirect('/viewcart')->with('success','Product has been added to cart!');
        }
    }

    public function getProduct(Request $request){
        $data = Cart::getContent();
        // dd($data);
        return response()->json($data);
    }

    public function viewCart(Request $request){
        $session_id = Session::get('session_id');
        $cartItem = Cart::where('session_id',$session_id)->get();
        return view(HomePage::theme("product.cart"))->with(compact('cartItem'));
    }

    public function updateQtyOfCartItem($id, $qty){
        $cart = Cart::where('id',$id)->first();
        $updated_qty = $cart->qty + $qty;

        if($cart->variant_code == null){
            $stockCheck = Product::where('product_id',$cart->product_id)->select('quantity')->first();
            if($stockCheck->quantity>=$updated_qty){
                $cart->qty = $updated_qty;
                $cart->save();
                return redirect()->back()->with('success','Your quantity has been updated successfully!');
            }else{
                return redirect()->back()->with('warning','Your order quantity is out of stock');
            }
        }else{
            $stockCheck = ProductStock::where('product_id',$cart->product_id)->where('code',$cart->variant_code)->select('qty')->first();
            if($stockCheck->qty>=$updated_qty){
                $cart->qty = $updated_qty;
                $cart->save();
                return redirect()->back()->with('success','Your quantity has been updated successfully!');
            }else{
                return redirect()->back()->with('warning','Your order quantity is out of stock');
            }
        }

    }

    public function cartItemRemove($id){
        $cart = Cart::where('id',$id)->first();
        $cart->delete();
        return redirect()->back()->with('success','Your cart item has been removed successfull!');
    }



    // guest checkout 

    public function guestCheckout(Request $request){
        if($request->isMethod('post')){
            // dd($request->all());
            $name = $request->fname.' '.$request->lname;
            $shippingDetail = new ShippingDetail();
            $shippingDetail->name = $name;
            $shippingDetail->phone = $request->phone;
            $shippingDetail->email = $request->email;
            $shippingDetail->order_message = $request->order_message;
            $shippingDetail->province_id = $request->province_id;
            $shippingDetail->district_id = $request->district_id;
            $shippingDetail->municipality_id = $request->municipality_id;
            $shippingDetail->shipping_area_id = $request->shipping_area_id;
            $shippingDetail->save();
            $session_id = Session::get('session_id');
            $cart = Cart::where('session_id',$session_id)->get();
            $vids=[];
            foreach ($cart as $key => $value) {
                $orderItem = new OrderItem();
                $orderItem->shipping_detail_id = $shippingDetail->id;
                $orderItem->product_id = $value->product_id;
                $vendor_id=Product::where('product_id',$orderItem->product_id)->value('vendor_id');
                if($vendor_id!=null){
                $orderItem->vendor_id = $vendor_id;

                    if(!in_array($vendor_id,$vids)){
                        array_push($vids,$vendor_id);
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

            // try {
                //code...
                Admin::first()->notify(new \App\Notifications\admin\OrderNotification($shippingDetail));
                foreach ($vids as $vid) {
                    $vendor=Vendor::find($vid);
                    // dd($vendor->user);
                    $vendor->notify(new \App\Notifications\Vendor\OrderNotification($shippingDetail));
                }
            // } catch (\Throwable $th) {
            //     //throw $th;
            // }
            // dd($shippingDetail);
            return redirect('/viewcart')->with('success','Your order placed successfully!');
        }else{
            $session_id = Session::get('session_id');
            $cartItem = Cart::where('session_id',$session_id)->count();
            if($cartItem>0){
                return view(HomePage::theme("user.checkout_guest"));
            }else{
                return redirect('/viewcart')->with('warning','Your shopping cart is empty!');
            }
        }
    }


    public function applyCoupon(Request $request){
        $couponCount = Coupon::where('coupon_code',$request->coupon_code)->count();
        if($couponCount == 0){
            return redirect()->back()->with('warning','This coupon code does not exist!');
        }else{
            $couponStatus = Coupon::where('coupon_code',$request->coupon_code)->first();
            $start_date = date('yy-m-d',strtotime($couponStatus->start_time));
            dd($start_date);
        }

    }

    
}
