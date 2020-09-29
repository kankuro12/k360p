<?php

namespace App\model\admin;
use Illuminate\Database\Eloquent\Model;
class BoxedItemDisplay extends Model
{
    //

    public function items(){
        return $this->hasMany('\App\model\admin\BoxedItemListDisplay');
    }
}
