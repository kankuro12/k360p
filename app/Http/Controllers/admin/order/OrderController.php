<?php

namespace App\Http\Controllers\admin\order;

use App\Http\Controllers\Controller;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Setting\OrderManager;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($status){
        $stages=OrderManager::stages;
        
        $collection=ShippingDetail::where('shipping_status',$status)->get();
        return view('admin.order.index',compact('collection','status','stages'));
    }
}
