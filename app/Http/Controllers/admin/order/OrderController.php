<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\model\Vendor\Vendor;
use App\Notifications\User\OnDelivery;
use App\Notifications\User\OrderComfirmation;
use App\Notifications\User\OrderDelivered;
use App\Notifications\User\OrderPickup;
use App\Notifications\User\RejectOrder;
use App\Notifications\Vendor\OrderAccepted;
use App\Notifications\Vendor\OrderPickedup;
use App\Setting\OrderManager;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($status){
        $stages=OrderManager::stages;
        //where('ismainstore',1)->
        $all=[];
        $collection=OrderItem::where('stage',$status)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $data['items']=$value;
            $ids=[];
            foreach ($value as $id) {
               array_push($ids,$id->product_id);
            }
            $para=Product::whereIn('product_id',$ids)->select('product_name')->get()->implode('product_name',',');
            $data['search']=$para;
            $data['count']=count($value);
            array_push($all,$data);
        }
        // dd($all);
        return view('admin.order.index',compact('all','status','stages'));
    }

    public function status($status , Request $request){
        $request->validate([
                'id.*' => 'exists:order_items,id',
                'sid'=> 'exists:shipping_details,id',
                'current'=>'required'
            ]);
            OrderItem::whereIn('id',$request->id)
            ->update(['stage'=>$status,'pickedup'=>1]);

            if($status==1){
                $vids=[];
                ShippingDetail::find($request->sid)->notify(new OrderComfirmation($request->id));
                foreach (OrderItem::whereIn('id',$request->id)->get() as  $order) {
                    $order->pickedup=1;
                    $order->save();
                    if($order->vendor_id!=null && $order->vendor_id!=0){

                        if(!in_array($order->vendor_id,$vids)){
                            array_push($vids,$order->vendor_id);
                        }
                    }
                }

                foreach ($vids as $vid) {
                   Vendor::find($vid)->notify(new OrderAccepted());
                }


                
            }
            if($status==2){
                ShippingDetail::find($request->sid)->notify(new OnDelivery($request->id));
            }


            if($status==3){
                ShippingDetail::find($request->sid)->notify(new OrderPickup($request->id,env('APP_NAME','larave;')." Store"));
            }

            if($status==4){
                ShippingDetail::find($request->sid)->notify(new OrderDelivered($request->id,env('APP_NAME','larave;')." Store"));

            }
            if ($status == 5) {
                ShippingDetail::find($request->sid)->notify(new RejectOrder($request->id));
            }
            return response()->json(
                [
                    'id'=>$request->id,
                    'count'=>OrderItem::where('shipping_detail_id',$request->sid)->where('stage',$request->current)->count(),
                    'sid'=>$request->sid
                ]);
    }

    public function flash($status,$id){
        return redirect()->route('admin.orders',['status'=>$status])->with('id',$id);
    }

    public function receipt(Request $request){
        $all=[];
        $collection=OrderItem::all()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $data['items']=$value;
            $ids=[];
            foreach ($value as $id) {
               array_push($ids,$id->product_id);
            }
            $para=Product::whereIn('product_id',$ids)->select('product_name')->get()->implode('product_name',',');
            $data['search']=$para;
            $data['count']=count($value);
            array_push($all,$data);
        }
        
        return view('admin.order.receipt',compact('all'));
    }
}
