<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Collection_product extends Model
{
    //
    public function collection(){
        return $this->belongsTo(Collection::class,'collection_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
