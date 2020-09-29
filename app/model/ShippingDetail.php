<?php

namespace App\model;

use App\District;
use App\Municipality;
use App\Province;
use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    //

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }
}
