<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class BoxedItemListDisplay extends Model
{
    //

    public function products(){
        $data=Product::where('product_id','>',0);
        if($this->hascategory==1){
            $data=$data->where('category_id',$this->category_id);

        }
        if($this->hasquery==1 && $this->query!=""){
            $data=$data->whereRaw($this->query);

        }

        $products=$data->orderBy($this->orderby,$this->order==0?"asc":"desc")->take($this->count)->get();
        return $products;
    }
}
