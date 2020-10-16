<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\admin\Product;
use Illuminate\Support\Facades\Session;
use App\Setting\HomePage;
use App\model\Cart;
use App\model\Coupon;
use App\model\OrderItem;
use App\model\ProductStock;
use App\model\ShippingDetail;
use App\ExatraChargeCart;
use App\ExtraCharge;
use App\model\Admin;
use App\model\Coupon_setting;
use App\model\OrderItemCharge;
use App\model\Vendor\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CartController extends Controller
{

    public function addProduct(Request $request)
    {
        // dd($request->all());
        // dd(\App\Setting\VariantManager::codeToString($request->varient));
        $session_id = Session::get('session_id');
        // dd($request);
        $cartCount = Cart::where(['session_id' => $session_id, 'product_id' => $request->product_id, 'type' => $request->type, 'variant_code' => $request->varient])->count();
        if ($cartCount > 0) {
            if ($request->type == 0) {
                $cartData = Cart::where(['session_id' => $session_id, 'product_id' => $request->product_id])->first();
                $qty = $cartData->qty + 1;
                $stockCheck = Product::where('product_id', $request->product_id)->first();
                if ($stockCheck->quantity >= $qty) {
                    $cartData->qty = $qty;
                    $cartData->save();
                    // extra feature update 
                    if ($request->has('extracharge')) {
                        foreach ($request->extracharge as $key => $value) {
                            $chargeCount = ExatraChargeCart::where('extra_charge_id', $value)->where('cart_id', $cartData->id)->count();
                            if ($chargeCount == 0) {
                                $getChargeDetail = ExtraCharge::where('id', $value)->where('product_id', $request->product_id)->where('enabled', 1)->first();
                                $charge = new ExatraChargeCart();
                                $charge->amount = $getChargeDetail->amount;
                                $charge->title = $getChargeDetail->name;
                                $charge->extra_charge_id = $value;
                                $charge->cart_id = $cartData->id;
                                $charge->save();
                            }
                        }
                    }

                    return redirect('/viewcart')->with('success', 'Your order quantity has been updated!');
                } else {
                    return redirect('/viewcart')->with('warning', 'Your order quantity is out of stock!');
                }
            } else {
                $cartData = Cart::where(['session_id' => $session_id, 'product_id' => $request->product_id, 'variant_code' => $request->varient])->first();
                $qty = $cartData->qty + 1;
                $stockCheck = ProductStock::where(['product_id' => $request->product_id, 'code' => $request->varient])->first();
                if ($stockCheck->qty >= $qty) {
                    $cartData->qty = $qty;


                    $cartData->save();

                    // extra feature update 
                    if ($request->has('extracharge')) {
                        foreach ($request->extracharge as $key => $value) {
                            $chargeCount = ExatraChargeCart::where('extra_charge_id', $value)->where('cart_id', $cartData->id)->count();
                            if ($chargeCount == 0) {
                                $getChargeDetail = ExtraCharge::where('id', $value)->where('product_id', $request->product_id)->where('enabled', 1)->first();
                                $charge = new ExatraChargeCart();
                                $charge->amount = $getChargeDetail->amount;
                                $charge->title = $getChargeDetail->name;
                                $charge->extra_charge_id = $value;
                                $charge->cart_id = $cartData->id;
                                $charge->save();
                            }
                        }
                    }

                    return redirect('/viewcart')->with('success', 'Your order quantity has been updated!');
                } else {
                    return redirect('/viewcart')->with('warning', 'Your order quantity is out of stock!');
                }
            }
        } else {
            $cartItem = new Cart();
            if (empty($request->user_email)) {
                $cartItem->user_email = '';
            }

            if (empty($session_id)) {
                $session_id = Str::random(40);
                Session::put('session_id', $session_id);
            }
            $cartItem->product_id = $request->product_id;
            $cartItem->type = $request->type;
            $cartItem->qty = $request->qty;
            $cartItem->rate = $request->rate;
            $cartItem->session_id = $session_id;
            $cartItem->variant_code = $request->varient;
            $cartItem->save();

            if ($request->has('extracharge')) {
                foreach ($request->extracharge as $key => $value) {
                    $getChargeDetail = ExtraCharge::where('id', $value)->where('product_id', $request->product_id)->where('enabled', 1)->first();
                    $charge = new ExatraChargeCart();
                    $charge->amount = $getChargeDetail->amount;
                    $charge->title = $getChargeDetail->name;
                    $charge->extra_charge_id = $value;
                    $charge->cart_id = $cartItem->id;
                    $charge->save();
                }
            }
            return redirect('/viewcart')->with('success', 'Product has been added to cart!');
        }
    }

    public function getProduct(Request $request)
    {
        $data = Cart::getContent();
        // dd($data);
        return response()->json($data);
    }

    public function viewCart(Request $request)
    {
        $session_id = Session::get('session_id');
        $cartItem = Cart::where('session_id', $session_id)->get();
        // dd($cartItem);
        return view(HomePage::theme("product.cart"))->with(compact('cartItem'));
    }

    public function updateQtyOfCartItem($id, $qty)
    {
        $cart = Cart::where('id', $id)->first();
        $updated_qty = $cart->qty + $qty;

        if ($cart->variant_code == null) {
            $stockCheck = Product::where('product_id', $cart->product_id)->select('quantity')->first();
            if ($stockCheck->quantity >= $updated_qty) {
                $cart->qty = $updated_qty;
                $cart->save();
                return redirect()->back()->with('success', 'Your quantity has been updated successfully!');
            } else {
                return redirect()->back()->with('warning', 'Your order quantity is out of stock');
            }
        } else {
            $stockCheck = ProductStock::where('product_id', $cart->product_id)->where('code', $cart->variant_code)->select('qty')->first();
            if ($stockCheck->qty >= $updated_qty) {
                $cart->qty = $updated_qty;
                $cart->save();
                return redirect()->back()->with('success', 'Your quantity has been updated successfully!');
            } else {
                return redirect()->back()->with('warning', 'Your order quantity is out of stock');
            }
        }
    }

    public function cartItemRemove($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();
        return redirect()->back()->with('success', 'Your cart item has been removed successfull!');
    }

    public function cartFeatureItemRemove($id)
    {
        $item = ExatraChargeCart::where('id', $id)->first();
        $item->delete();
        return redirect()->back()->with('success', 'Feature item has been removed successfull!');
    }



    // guest checkout 

    public function guestCheckout(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd($request->all());
            $name = $request->fname . ' ' . $request->lname;
            $shippingDetail = new ShippingDetail();
            $shippingDetail->name = $name;
            $shippingDetail->phone = $request->phone;
            $shippingDetail->email = $request->email;
            $shippingDetail->discount = Session::get('couponAmount', 0);
            $shippingDetail->order_message = $request->order_message;
            $shippingDetail->province_id = $request->province_id;
            $shippingDetail->district_id = $request->district_id;
            $shippingDetail->municipality_id = $request->municipality_id;
            $shippingDetail->shipping_area_id = $request->shipping_area_id;
            $shippingDetail->otp = mt_rand(00000,99999);
            $shippingDetail->shipping_charge = $request->shipping_charge;
            $shippingDetail->save();
            $request->session()->forget('couponAmount');
            $session_id = Session::get('session_id');
            $cart = Cart::where('session_id', $session_id)->get();
            $vids = [];
            $all=$request->all();
            foreach ($cart as $key => $value) {
                $productDetail = Product::where('product_id', $value->product_id)->first();
                $orderItem = new OrderItem();
                $orderItem->shipping_detail_id = $shippingDetail->id;
                $orderItem->product_id = $value->product_id;
                $orderItem->qty = $value->qty;
                $orderItem->variant_code = $value->variant_code;
                $vendor_id = $productDetail->vendor_id;
                if ($vendor_id != null) {
                    $orderItem->vendor_id = $vendor_id;

                    if (!in_array($vendor_id, $vids)) {
                        array_push($vids, $vendor_id);
                    }
                }else{
                    $orderItem->ismainstore=1;
                }
                // $orderItem->shippingcharge = $request->shipping_charge;
                $orderItem->bundleid =$all['bundle_'.$value->product_id];
                $orderItem->shippingcharge = $all['shipping_'.$value->product_id];
                $orderItem->stage = 0;
                $orderItem->issimple = $productDetail->stocktype==0?1:0;
                $orderItem->rate = $value->rate;

                $orderItem->discount = 0;
                $orderItem->deliverytype = $request->delivery_type;

                if ($value->variant_code != null) {
                    $variantStock = ProductStock::where('product_id', $value->product_id)->where('code', $value->variant_code)->first();
                    $variantStock->qty = $variantStock->qty - $value->qty;
                    $variantStock->save();
                } else {
                    $stockStatus = Product::where('product_id', $value->product_id)->first();
                    $stockStatus->quantity = $stockStatus->quantity - $value->qty;
                    $stockStatus->save();
                }
                $orderItem->save();

                $extraChargeCount = ExatraChargeCart::where('cart_id', $value->id)->count();
                if ($extraChargeCount > 0) {
                    $extraCharge = ExatraChargeCart::where('cart_id', $value->id)->get();
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
            Admin::first()->notify(new \App\Notifications\admin\OrderNotification($shippingDetail));	                
            foreach ($vids as $vid) {
                $vendor=Vendor::find($vid);	                        
                // dd($vendor->user);	                        
                $vendor->notify(new \App\Notifications\Vendor\OrderNotification($shippingDetail));
            }
            Cart::where('session_id', $session_id)->delete();
            return redirect('/viewcart')->with('success', 'Your order placed successfully!');
        } else {
            $session_id = Session::get('session_id');
            $cartItem = Cart::where('session_id', $session_id)->count();
            if ($cartItem > 0) {
                return view(HomePage::theme("user.checkout_guest"));
            } else {
                return redirect('/viewcart')->with('warning', 'Your shopping cart is empty!');
            }
        }
    }


    public function applyCoupon(Request $request){
        $couponCount = Coupon::where('coupon_code',$request->coupon_code)->count();
        if($couponCount == 0){
            return redirect()->back()->with('warning','This coupon code does not exist!');
        }else{
            $couponExpire = Coupon::join('coupon_settings','coupons.id','=','coupon_settings.coupon_id')->
            where('coupons.coupon_code',$request->coupon_code)->first();
            
            if(!Carbon::now()->between($couponExpire->start_time,$couponExpire->end_time)){
                return redirect()->back()->with('warning','This coupon code is expired!');
            }else{
                $session_id = Session::get('session_id');
                $userCart = Cart::where('session_id',$session_id)->get();
                $total=Cart::where('session_id',$session_id)->sum(DB::raw('rate * qty'));
                if($total<$couponExpire->minimum_order_value || $couponExpire->minimum_order_valueissued_number_coupon){
                    return redirect()->back()->with('warning','Your total amount is not applicable! The mininum required amount is Rs.'.$couponExpire->minimum_order_value);
                }else{

                    $issuedTimes = Coupon_setting::where('coupon_id',$couponExpire->id)->first();
                    // dd($issuedTimes);
                    if($issuedTimes->issued_number_coupon>0){
                        if ($couponExpire->discount_type == 1) {
                            $discountAmount = $couponExpire->discount_value;

                            $issuedTimes->issued_number_coupon =  $issuedTimes->issued_number_coupon - 1;
                            $issuedTimes->save();
                        } else {
                            $discountAmount = ($total * $couponExpire->discount_percent) / 100;
                            
                            $issuedTimes->issued_number_coupon =  $issuedTimes->issued_number_coupon - 1;
                            $issuedTimes->save();
                        }
                    }else{
                       return redirect()->back()->with('success','This coupon already used!');
                    }
                    Session::put('couponAmount',$discountAmount);
                    return redirect()->back()->with('success','Coupon code applied successfully!');
                }
            }
           
        }

    }
}
