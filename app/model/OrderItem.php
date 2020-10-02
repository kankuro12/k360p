<?php

namespace App\model;

use App\model\admin\Product;
use App\Setting\VariantManager;
use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function variant(){
        if($this->variant_code==null){
            return "Default";
        }else{
            $variant=VariantManager::codeToString($this->variant_code);
            $str='';
            foreach ($variant as $key => $value) {
               $str.=  $value['attribute']->name.': '.$value['item']->name ;
            }
            return $str;
        }

    }
}
