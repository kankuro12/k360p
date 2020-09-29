<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderGroup extends Model
{
    //

    public function sliders(){
        return $this->hasMany('\App\model\admin\Slider','slider_group_id','id');
    }
}
