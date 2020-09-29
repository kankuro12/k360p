<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //

    public function areas()
    {
        return $this->hasMany('\App\Shippingarea');
    }
}
