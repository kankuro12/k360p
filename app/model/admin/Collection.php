<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $primaryKey = 'collection_id';

    public function menuItems(){
        return Collection_product::where('collection_id',$this->collection_id)->inRandomOrder()->limit(5)->get();
    }
}
