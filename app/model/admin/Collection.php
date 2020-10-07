<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $primaryKey = 'collection_id';

    public function items(){
        return $this->hasMany(Collection_product::class,'collection_id','collection_id');
    }
}
