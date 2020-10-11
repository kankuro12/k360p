<?php

namespace App\model\admin;

use App\SliderGroup;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //

    public function group(){
        return $this->belongsTo(SliderGroup::class,'slider_group_id','id');
    }
}
