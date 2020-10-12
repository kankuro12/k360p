<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Notifications\User\OrderPickup;
use App\Notifications\Vendor\OrderPickedup;
use Illuminate\Http\Request;
use Auth;
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
            $value['shipping']->notify(new OrderPickup($value['items'],Auth::user()->point->name));
        }

        return redirect()->back();
    }
}
