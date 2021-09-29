<?php

namespace App\Http\Controllers\Delivery;

use App\DeliveryImage;
use App\Http\Controllers\Controller;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Notifications\User\OrderDelivered;
use App\Notifications\User\OrderPickup;
use App\Notifications\Vendor\OrderPickedup;
use App\Setting\VendorAccount;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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
        OrderItem::whereIn('id',$request->id)
        ->update([
            'stage'=>4
        ]);
        $sid=1;
        $all=[];
        $collection=OrderItem::whereIn('id',$request->id)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $sid=$key;
            $data['shipping']=ShippingDetail::find($key);
            $ids=[];
           
            foreach ($value as $id) {
                array_push($ids,$id->id);
                if($id->vendor_id!=null && $id->vendor_id!=0){
                    $account=new VendorAccount($id->vendor_id);
                    $account->addOrder($id);
                    

                }
                if($id->referal_id!=null){
                    $account=new VendorAccount($id->referal_id);
                    $account->addOrderRef($id);
                }
            }
            $data['items']=$ids;
            array_push($all,$data);
        }
        foreach ($all as $key => $value) {
            $value['shipping']->notify(new OrderDelivered($value['items'],Auth::user()->point->name));
        }

        foreach ($request->image as  $image) {
            $i=new DeliveryImage();
            $i->image=$image->store('image/delivery');
            $i->shipping_detail_id=$sid;
            $i->save();
        }
        return redirect()->back();
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
