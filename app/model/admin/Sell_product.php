<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Sell_product extends Model
{
    //
    protected $primaryKey = 'sell_product_id';

    public function onsale(){
        return $this->belongsTo(Onsell::class,'sell_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
