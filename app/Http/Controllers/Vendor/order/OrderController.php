<?php

namespace App\Http\Controllers\Vendor\order;

use App\Http\Controllers\Controller;
use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Notifications\User\OrderComfirmation;
use App\Notifications\User\RejectOrder;
use App\Setting\OrderManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($status)
    {
        $vendor = Auth::user()->vendor;
        $stages = OrderManager::stages;
        //where('ismainstore',1)->
        $all = [];
        $collection = OrderItem::where('vendor_id', $vendor->id)->where('stage', $status)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data = [];
            $data['shipping'] = ShippingDetail::find($key);
            $data['items'] = $value;
            $ids = [];
            foreach ($value as $id) {
                array_push($ids, $id->product_id);
            }
            $para = Product::whereIn('product_id', $ids)->select('product_name')->get()->implode('product_name', ',');
            $data['search'] = $para;
            $data['count'] = count($value);
            array_push($all, $data);
        }
        // dd($all);
        return view('vendor.order.index', compact('all', 'status', 'stages'));
    }

    public function status($status, Request $request)
    {
        $request->validate([
            'id.*' => 'exists:order_items,id',
            'sid' => 'exists:shipping_details,id',
            'current' => 'required'
        ]);
       
        OrderItem::whereIn('id', $request->id)
            ->update(['stage' => $status]);
        $referal_id=OrderItem::whereIn('id', $request->id)->select('referal_id')->first()->referal_id;
        if($referal_id==null){
            if ($status == 1) {
                ShippingDetail::find($request->sid)->notify(new OrderComfirmation($request->id));
            }
            if ($status == 5) {
                ShippingDetail::find($request->sid)->notify(new RejectOrder($request->id));
            }
        }

        return response()->json(
            [
                'id' => $request->id,
                'count' => OrderItem::where('vendor_id', $request->user()->vendor->id)->where('shipping_detail_id', $request->sid)->where('stage', $request->current)->count(),
                'sid' => $request->sid,
                'referal_id'=>$referal_id
            ]
        );
    }

    public function flash($status, $id)
    {
        return redirect()->route('vendor.orders', ['status' => $status])->with('id', $id);
    }
}
