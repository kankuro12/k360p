<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footerhead extends Model
{
    public function link(){
        return $this->hasMany(Footerlink::class);
    }
}
