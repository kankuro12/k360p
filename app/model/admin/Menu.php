<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //

    public function originalName(){
        if($this->type==0){
            return Brand::find($this->parent_id)->brand_name;
        }elseif($this->type==1){
            return Category::find($this->parent_id)->cat_name;

        }elseif($this->type==2){
            return Collection::find($this->parent_id)->collection_name;

        }elseif($this->type==3){
            return Onsell::find($this->parent_id)->sell_name;

        }else{
            return "";
        }
    }
}
