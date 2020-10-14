<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\model\Vendor\Vendor;
use App\Notifications\User\OnDelivery;
use App\Notifications\User\OrderComfirmation;
use App\Notifications\User\OrderPickup;
use App\PickupPoint;
use App\Trip;
use App\TripItem;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    //

    public function index(){

       
        return view('admin.order.pickup.index');
    }

    public function load(Request $request){
       $order=OrderItem::whereNotNull('vendor_id')->where('stage',1)->where('pickedup',0)->where('id',$request->id)->first();
       
       if($order!=null){
           
           $sid=$order->shoipping_detail_id;
           return view('admin.order.pickup.singleorder1',compact('order','sid'));
       }else{
           echo "<h3 ><strong > Order No #".$request->id." Cannot Be Picked </strong></h3>";
       }
    }

    public function loadDelivery(Request $request){
        $order=OrderItem::where('stage',1)->where('pickedup',1)->where('id',$request->id)->first();
        
        if($order!=null){
            $sid=$order->shipping_detail_id;
            $shipping=ShippingDetail::find($sid);
            $other=OrderItem::where('shipping_detail_id',$sid)->get();
           
            foreach ($other as $key => $value) {
                if($value->pickedup==0){
                    return response( " Order No #".$request->id." Cannot Be Add to delivery Other items in shippinggroup is not Picked",404);
                }
            }
            return view('admin.order.pickup.singleorder2',compact('order','sid'));
        }else{
            return response( " Order No #".$request->id." Cannot Be Add to delivery ",404);
        }
     }
 

    public function pickup(Request $request){
        $order=OrderItem::find($request->id);
        $order->pickedup=1;
        $order->save();
        if($order->vendor_id!=null){
            Vendor::find($order->vendor_id)->notify(new \App\Notifications\Vendor\OrderPickedup($order));
        }
        return response()->json($order);
    }

    public function order(Request $request){

    }

    public function group(Request $request){

    }

    public function picked(){
        $orders=[];
        $collection=OrderItem::where('stage',1)->where('pickedup',1)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $data['items']=$value;
            $ids=[];
            foreach ($value as $id) {
               array_push($ids,$id->product_id);
            }
            $data['ids']=implode(',',$ids);
            $para=Product::whereIn('product_id',$ids)->select('product_name')->get()->implode('product_name',',');
            $data['search']=$para;
            $data['count']=count($value);
            array_push($orders,$data);
        }
        $status=1;
        // dd($orders);
        
        return view('admin.order.pickup.view',compact('orders','status'));
    }

    public function delivery(){
        $points=PickupPoint::all();
        return view('admin.order.delivery',compact('points'));
    }

    public function ondelivery(Request $request){
       
        $trip=new Trip();
        $point=PickupPoint::find($request->pickup_point_id);
        $trip->name=$point->name;
        $trip->pickup_point_id=$request->pickup_point_id;
        $trip->code=$request->code;
        $trip->save();

        foreach ($request->id as $id) {
            $tripitem=new TripItem();
            $tripitem->order_item_id=$id;
            $tripitem->trip_id=$trip->id;
            $tripitem->save();
        }

        OrderItem::whereIn('id',$request->id)
        ->update(['stage'=>2]);

        $all=[];
        $collection=OrderItem::whereIn('id',$request->id)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $ids=[];
            foreach ($value as $id) {
                array_push($ids,$id->id);
            }
            $data['items']=$ids;
            array_push($all,$data);
        }


        foreach ($all as $key => $value) {
            $value['shipping']->notify(new onDelivery ($value['items']));
        }

        return redirect()->back();
    }
}
