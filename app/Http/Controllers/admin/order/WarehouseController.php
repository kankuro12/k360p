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
            $data['orders']=$value;
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

        return redirect()->route('admin.orders-trip',['id'=>$trip->id]);
        // return redirect()->back();
    }

    public function trips(){
        $all=Trip::orderBy('created_at')->get();
        return view('admin.order.trips',compact('all'));
    }

    public function trip($id){
        $trip=Trip::find($id);
        // dd($all->items);
        $all=[];
        $data=TripItem::join('order_items','trip_items.order_item_id','=','order_items.id')
        ->join('products','order_items.product_id','=','products.product_id')
        ->join('shipping_details','order_items.shipping_detail_id','=','shipping_details.id')
        ->where('trip_items.trip_id',$id)
        ->select('trip_items.id','products.product_name','order_items.id as order_id','order_items.shipping_detail_id','order_items.qty')
        ->get()->groupBy('shipping_detail_id');
       
        foreach ($data as $key=> $value) {
            $d=[];
            $d['shipping']=ShippingDetail::find($key);
            $d['orders']=[];
            foreach ($value as $order) {
               array_push( $d['orders'],("#".$order->order_id ." ".$order->product_name ." X ".$order->qty));
            }
            
            array_push($all,$d);
        }
       
        return view('admin.order.trip',compact('all','trip'));
    }

    public function singlePrint(ShippingDetail $shipping){
        $all=[];$data=[];
        // dd($shipping);
        $data['shipping']=$shipping;
        $data['orders']=OrderItem::where('shipping_detail_id',$shipping->id)->get();
        array_push($all,$data);
        return view('admin.order.receipt',compact('all'));
    }

    public function multiplePrint(Request $request){
        // dd($request);
        $all=[];
        foreach ($request->ids as $id) {
           
            $data=[];
            // dd($shipping);
            $data['shipping']=ShippingDetail::find($id);
            $data['orders']=OrderItem::where('shipping_detail_id',$id)->get();
            array_push($all,$data);
        }
        return view('admin.order.receipt',compact('all'));
    }

    public function tripPrint($id){
        $all=[];
        $trip=Trip::find($id);
        // dd($all->items);
        $all=[];
        $ids=TripItem::where('trip_items.trip_id',$id)->pluck('order_item_id')->toArray();
        // dd($data);
        $collection=OrderItem::whereIn('id',$ids)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $data['orders']=$value;
            $ids=[];
            foreach ($value as $id) {
                array_push($ids,$id->id);
            }
            $data['items']=$ids;
            array_push($all,$data);
        }
        return view('admin.order.receipt',compact('all','trip'));
    }
}
