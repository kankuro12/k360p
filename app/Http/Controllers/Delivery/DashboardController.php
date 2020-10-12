<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Notifications\User\OrderPickup;
use App\Notifications\Vendor\OrderPickedup;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('delivery.home.index');
    }

    public function pickup(){
        return view('delivery.home.pickup');
    }

    public function order(Request $request){
        $order=OrderItem::find($request->id);
        if($order==null){
            return response("Order Not Found",404);
        }else{
            if($order->stage!=2){
                return response("Order Not Found",404);

            }else{
                return  view('delivery.home.single',compact('order'));
            }
        }
    }

    public function setPickup(Request $request){
        OrderItem::whereIn('id',$request->id)
        ->update([
            'stage'=>3,
            'pickup_point_id'=>Auth::user()->point->id,
            'pickup_point_time'=>Carbon::now()
        ]);

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
            $value['shipping']->notify(new OrderPickup($value['items'],Auth::user()->point->name));
        }

        return redirect()->back();
    }

    public function warehouse(){
        $collection=OrderItem::where('pickup_point_id',Auth::user()->point->id,)->where('stage',3)->get()->groupBy('shipping_detail_id');
        dd($collection);

    }

    public function delivered(){
        return view('delivery.home.delivery');
    }

    public function otp(Request $request){
        $collection=OrderItem::whereIn('id',$request->id)->get()->groupBy('shipping_detail_id');
        if($collection->count()>1){
            return response('Orders Contain Multiple Shipping. Please Try Them separately.',404);
        }
        $shipping=ShippingDetail::find($collection->first()->first()->shipping_detail_id);
        if($request->otp==$shipping->otp){
            return response("ok");
        }else{
            return response("OTP Didn't Match.",404);

        }
    }

    public function deliveredCompleted(Request $request){
        dd($request);
    }

    public function deliveredOrder(Request $request){
        $order=OrderItem::find($request->id);
        if($order==null){
            return response("Order Not Found",404);
        }else{
            if($order->stage!=3){
                return response("Order Not Found",404);

            }elseif($order->pickup_point_id!=Auth::user()->point->id){
                return response("Order Not Found",404);
            }
            else{
                return  view('delivery.home.single',compact('order'));
            }
        }
    }
}
