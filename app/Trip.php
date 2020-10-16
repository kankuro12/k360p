<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //

    public function items(){
        return $this->hasMany(TripItem::class);
    }
}
