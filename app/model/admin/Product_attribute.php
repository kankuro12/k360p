<?php

namespace App\model\admin;


use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model
{
    //

    public function items(){
        return $this->hasMany('\App\model\ProductAttributeItem','product_attribute_id','id');
    }
}
