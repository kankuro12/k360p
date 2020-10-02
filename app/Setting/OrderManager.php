<?php

namespace App\Setting;

use App\model\admin\Product;
use App\ProductWeightClass;
use Illuminate\Database\Eloquent\Model;

class OrderManager 
{
    const stages=['Pending','Accecpted','On Delivery','Pickup','Delivered','Rejected','Returned'];
    const stageicons=['pending_actions','assignment_turned_in','local_shipping','pin_drop','verified','cancel','360'];
    const paymentstatus=['Pending','Completed','refunded'];
 
    
    public static function getShipping($product_id,$p_id,$d_id,$m_id,$a_id){
        $product=Product::find($product_id);
        $shipping=$product->ownerShipping();
        $shippingprice=ProductWeightClass::where('product_id',$product->product_id)->first();
        if($shipping==null){
            return ['shipping'=>"All Nepal","Price"=>0,'type'=>'s101'];
        }else{
            $i=0;
            if($shipping['p_id']!=$p_id){
                return ['shipping'=>"Outside Province","Price"=>$shippingprice->amount_4,'type'=>$shippingprice->type_4];

            }
            if($shipping['d_id']!=$d_id){
                return ['shipping'=>"inside Province","Price"=>$shippingprice->amount_3,'type'=>$shippingprice->type_3];

            }
            if($shipping['m_id']!=$m_id){
                return ['shipping'=>"inside District","Price"=>$shippingprice->amount_2,'type'=>$shippingprice->type_2];

            }
            if($shipping['a_id']!=$a_id){
                return ['shipping'=>"Inside Municipality","Price"=>$shippingprice->amount_1,'type'=>$shippingprice->type_1];

            }
            return ['shipping'=>"Inside Zone","Price"=>$shippingprice->amount_0,'type'=>$shippingprice->type_0];

        }
    }
}
