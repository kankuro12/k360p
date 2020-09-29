<?php

namespace App\model\admin;

use App\model\ProductAttributeItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    protected $primaryKey = 'product_id';

    public function reviews(){
        return $this->hasMany('Review');
    }

    public function shipping(){
        return \App\ProductShippingDetail::where('product_id',$this->product_id)->first();
    }

    public function option(){
        return \App\ProductOption::where('product_id',$this->product_id)->first();
    }

    public function category(){
        return $this->belongsTo('\App\model\admin\Category','category_id','cat_id');
    }

    public function extracharges(){
        return $this->hasMany('\App\ExtraCharge','product_id','product_id');
    }

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }

    public function variants(){
        $variants=Product_attribute::where('product_id',$this->product_id)->get();
      
        foreach ($variants as $key => $value) {
            $value->options=ProductAttributeItem::where('product_attribute_id',$value->id)->get();
        }
        return $variants;
    }

    public function isnew(){
        
        $dayToCheck = Carbon::now()->subDays(7);
        if($this->created_at>$dayToCheck){
            return true;
        }else{
            return false;
        }
    }
}
