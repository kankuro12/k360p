<?php

namespace App;

use App\model\admin\Product;
use Illuminate\Database\Eloquent\Model;

class CustomListDisplayItem extends Model
{
    //

    public function product(){
        return $this->hasOne(Product::class,'product_id','product_id');
    }
}
