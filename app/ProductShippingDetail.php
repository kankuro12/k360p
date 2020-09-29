<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductShippingDetail extends Model
{
    //
    public function shipping(){
        
        return $this->HasOne('\App\ShippingClass','id','shipping_class_id');
    }

    public function shippingprice(){
        return \App\ProductWeightClass::where('product_id',$this->product_id)->where('shipping_class_id',$this->shipping_class_id)->first();
    }
}
