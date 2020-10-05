<?php

namespace App\Setting;

use App\model\admin\Category;

class ChargesManager 
{
    public static function getShipping($cat_id,$weight,$range,$shipping_class_id){
        $semicat_id=$cat_id;
        $semicat=Category::find($cat_id);
        while ($semicat->parent_id!=null) {
            $semicat_id=$semicat->parent_id;
            $semicat=Category::find($semicat_id);
        }
        if($semicat_id==null){
            $semicat_id=$cat_id;
        }

       return \App\WeightClass::where('category_id',$semicat_id)
            ->where('min','<=',$weight)
            ->where('max','>=',$weight)
            ->where('deliver_range',$range)
            ->where('shipping_class_id',$shipping_class_id)
            ->first();
    }
    public static function getClosing($cat_id,$price){
        $semicat_id=$cat_id;
        $semicat=Category::find($cat_id);
        while ($semicat->parent_id!=null) {
            $semicat_id=$semicat->parent_id;
            $semicat=Category::find($semicat_id);
        }
        if($semicat_id==null){
            $semicat_id=$cat_id;
        }
        // dd($semicat);    
        $data= \App\ClosingCharge::where('category_id',$semicat_id)
            ->where('min','<=',$price)
            ->where('max','>=',$price)
            ->first();
        // dd($data);
        return $data;
    }
}
