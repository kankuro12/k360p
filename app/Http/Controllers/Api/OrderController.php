<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ProductStock;
use App\model\ShippingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request){
        if(!Auth::check()){
            return response()->json(['status'=>false,"message"=>"Please Login"]);
        }else{
            $user=Auth::user();
            $shipping =new ShippingDetail();
            $shipping->email=$request->email;
            $shipping->user_id=$user->id;
            $shipping->name=$request->name;
            $shipping->phone=$request->phone;
            $shipping->order_message=$request->order_message??"";
            $shipping->streetaddress=$request->streetaddress;
            $shipping->province_id = $request->province_id;
            $shipping->district_id = $request->district_id;
            $shipping->municipality_id = $request->municipality_id;
            $shipping->shipping_area_id = $request->shipping_area_id;
            $shipping->shipping_charge = $request->shipping_charge??0;
            $shipping->otp = mt_rand(00000,99999);
            $shipping->save();
            $vids=[];
            // dd($request->items);
            foreach($request->items as $item){
                $value=(object)$item;
                    $productDetail = Product::where('product_id',$value->id)->first();
                    $orderItem = new OrderItem();
                    $orderItem->shipping_detail_id = $shipping->id;
                   
                    $orderItem->product_id = $value->id;
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
                    $orderItem->deliverytype = $request->delivery_type??0;
    
                    if($value->variant_code != null){
                        $variantStock = ProductStock::where('product_id',$value->id)->where('code',$value->variant_code)->first();
                        $variantStock->qty = $variantStock->qty - $value->qty;
                        $variantStock->save();
                    }else{
                      $stockStatus = Product::where('product_id',$value->id)->first();
                      $stockStatus->quantity = $stockStatus->quantity - $value->qty;
                      $stockStatus->save();
                    }
                    $orderItem->save();
            }
            return response()->json(['order'=>$shipping]);
        }
    }

    public function orders(){
        $user=Auth::user();
        $orders=ShippingDetail::where('user_id',$user->id)->get();
        $data=[];
        foreach ($orders as $key => $value) {
            $items=OrderItem::where('shipping_detail_id',$value->id)->get();
            $d=[];
            foreach ($items as $key => $orderitem) {
                $orderitem->product= Product::where('product_id',$orderitem->product_id)->first();
                array_push($d,$orderitem);
            }
            if(count($items)>0){
                $value->items=$d;
                array_push($data,$value);
            }

        }
        return response()->json($data);
    }

    public function ordersType(Request $request,$type){
        $user=Auth::user();
        $orders=[];
        $order_query=OrderItem::where('stage',$type)->join('products','products.product_id','=','order_items.product_id');
        if($request->filled('vendor')){
            $orders=$order_query->where('referal_id',$user->id)
            ->select('order_items.*','products.product_images','products.product_name')
            ->get()->groupBy('shipping_detail_id');
        }else{
            $orders=$order_query->join('shipping_details','shipping_details.id','=','order_items.shipping_detail_id')->where('shipping_details.user_id',$user->id)
            ->select('order_items.*','products.product_images','products.product_name')
            ->get()->groupBy('shipping_detail_id');
        }
        $data=[];
        foreach ($orders as $key => $value) {
            $shipping=ShippingDetail::where('id',$key)->orderBy('id','desc')->first();
            $shipping->items=$value;
            array_push($data,$shipping);
        }
        return response()->json($data);
    }

    public function order($id){
        $user=Auth::user();
        $order=ShippingDetail::where('user_id',$user->id)->where('id',$id)->first();
        if($order==null){
            return response("Order Not Found",404);
        }

        return response()->json($order);
    }

    
}
