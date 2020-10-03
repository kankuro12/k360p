<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ShippingDetail;
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
            ->update(['stage'=>$status]);

            return response()->json(
                [
                    'id'=>$request->id,
                    'count'=>OrderItem::where('shipping_detail_id',$request->sid)->where('stage',$request->current)->count(),
                    'sid'=>$request->sid
                ]);
    }
}
