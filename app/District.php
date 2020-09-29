<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    public function municipalities(){
        return $this->hasMany('\App\Municipality');
    }
}
