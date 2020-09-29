<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Attribute_group extends Model
{
    //Attribute_group_attribute_group_id
    protected $primaryKey = 'attribute_group_id';

    public function attributes(){
        return Attribute::where('attribute_group_id',$this->attribute_group_id)->get();
    }
    public function str_attributes(){
        $attrs= Attribute::where('attribute_group_id',$this->attribute_group_id)->select('attribute_name')->get();
        // $str=implode(',',$attrs);
        // return $str;
        $str=[];
        foreach ($attrs as $key => $item) {
           array_push($str,$item->attribute_name);
        }
        return implode(',',$str);
        
    }
}
