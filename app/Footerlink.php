<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footerlink extends Model
{
    public function head(){
        return $this->belongsTo(Footerhead::class,'id');
    }
}
