<?php

namespace App;

use App\model\admin\Product;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
