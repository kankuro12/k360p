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
use App\Setting\VendorAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index($status)
    {
        $stages = OrderManager::stages;
        //where('ismainstore',1)->
        $all = [];
        $collection = OrderItem::where('stage', $status)->select(DB::raw(' order_items.*, (select name from vendors where user_id=order_items.referal_id) as referal_name'))->get()->groupBy('shipping_detail_id');
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
        return view('admin.order.index', compact('all', 'status', 'stages'));
    }

    public function status($status, Request $request)
    {
        $request->validate([
            'id.*' => 'exists:order_items,id',
            'sid' => 'exists:shipping_details,id',
            'current' => 'required'
        ]);
        OrderItem::whereIn('id', $request->id)
            ->update(['stage' => $status, 'pickedup' => 1]);

        $referal_id = OrderItem::whereIn('id', $request->id)->select('referal_id')->first()->referal_id;
        if ($referal_id == null) {
            if ($status == 1) {
                $vids = [];

                ShippingDetail::find($request->sid)->notify(new OrderComfirmation($request->id));
                foreach (OrderItem::whereIn('id', $request->id)->get() as  $order) {
                    // $order->pickedup=1;
                    // $order->save();
                    if ($order->vendor_id != null && $order->vendor_id != 0) {

                        if (!in_array($order->vendor_id, $vids)) {
                            array_push($vids, $order->vendor_id);
                        }
                    }
                }

                foreach ($vids as $vid) {
                    Vendor::find($vid)->notify(new OrderAccepted());
                }
            }
            if ($status == 2) {
                ShippingDetail::find($request->sid)->notify(new OnDelivery($request->id));
            }


            if ($status == 3) {
                ShippingDetail::find($request->sid)->notify(new OrderPickup($request->id, env('APP_NAME', 'larave;') . " Store"));
            }

            if ($status == 4) {
                ShippingDetail::find($request->sid)->notify(new OrderDelivered($request->id, env('APP_NAME', 'larave;') . " Store"));
            }
            if ($status == 5) {
                ShippingDetail::find($request->sid)->notify(new RejectOrder($request->id));
            }
        } else {
            if ($status == 4) {
                $collection = OrderItem::whereIn('id', $request->id)->get()->groupBy('shipping_detail_id');
                foreach ($collection as $key => $value) {
                    foreach ($value as $id) {
                        array_push($ids, $id->id);
                        if ($id->vendor_id != null && $id->vendor_id != 0) {
                            $account = new VendorAccount($id->vendor_id);
                            $account->addOrder($id);
                        }
                        if ($id->referal_id != null) {
                            $account = new VendorAccount($id->referal_id);
                            $account->addOrderRef($id);
                        }
                    }
                    
                }
            }
        }

        return response()->json(
            [
                'id' => $request->id,
                'count' => OrderItem::where('shipping_detail_id', $request->sid)->where('stage', $request->current)->count(),
                'sid' => $request->sid,
                'referal_id' => $referal_id
            ]
        );
    }

    public function flash($status, $id)
    {
        return redirect()->route('admin.orders', ['status' => $status])->with('id', $id);
    }

    public function receipt(Request $request)
    {
        $all = [];
        $collection = OrderItem::all()->groupBy('shipping_detail_id');
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

        return view('admin.order.receipt', compact('all'));
    }

    public function referalUsers()
    {
        $referalUsers = OrderItem::where('referal_id', '!=', null)->distinct()->get(['referal_id']);
        // dd($referalUsers);
        return view('admin.order.referal_users', compact('referalUsers'));
    }

    public function referalUserProducts($id)
    {
        $referalProduct = OrderItem::where('referal_id', $id)->get();
        return view('admin.order.referal_product', compact('referalProduct'));
    }
}
