<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Onsell extends Model
{
    //
    protected $primaryKey = 'sell_id';

    public function sell_product(){
        return $this->hasMany(Sell_product::class,'sell_id');
    }
}
