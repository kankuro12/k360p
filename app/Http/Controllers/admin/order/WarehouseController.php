<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\model\Vendor\Vendor;
use App\Notifications\User\OrderPickup;
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
        $collection=OrderItem::whereNotNull('vendor_id')->where('stage',1)->where('pickedup',1)->get()->groupBy('shipping_detail_id');
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

        return view('admin.order.pickup.view',compact('orders','status'));
    }
}
