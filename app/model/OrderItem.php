<?php

namespace App\model;

use App\model\admin\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
