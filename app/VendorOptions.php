<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorOptions extends Model
{
    //
    public function province(){
        return $this->belongsTo('\App\Province');
    }

    public function district(){
        return $this->belongsTo('\App\District');
    }

    public function municipality(){
        return $this->belongsTo('\App\Municipality');
    }
    public function shippingarea(){
        return $this->belongsTo('\App\ShippingArea','shiping_area_id','id');
    }
}
