<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class BoxedItemListDisplay extends Model
{
    //

    public function products(){
        $data=Product::where('isverified',1);
        $category=\App\model\admin\Category::find($this->category_id);
        $categories=$category->childList();
        if($this->hascategory==1){
            $data=$data->whereIn('category_id',$categories);

        }
        if($this->hasquery==1 && $this->query!=""){
            $data=$data->whereRaw($this->query);

        }

        $products=$data->orderBy($this->orderby,$this->order==0?"asc":"desc")->take($this->count)->get();
        // dd($products);
        return $products;
    }
}
