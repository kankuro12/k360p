<?php

namespace App;

use App\model\admin\Brand;
use Illuminate\Database\Eloquent\Model;

class BrandDisplay extends Model
{
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
