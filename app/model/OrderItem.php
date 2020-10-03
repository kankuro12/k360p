<?php

namespace App\model;

use App\model\admin\Product;
use App\Setting\VariantManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderItem extends Model
{
    use Notifiable;
    
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
                // dd($value);
               $str.=  $value['attribute']['name'].': '.$value['item']['name'] ;
            }
            return $str;
        }

    }
}
