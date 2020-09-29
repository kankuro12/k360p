<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function product(){
        return $this->belongsTo(\App\model\admin\Product::class,'product_id');
    }
}
