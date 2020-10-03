<?php

namespace App\model\admin;

use App\model\ProductAttributeItem;
use App\Setting\VendorOption;
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
        return env('slackuser','');
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

    public function ownerShipping(){
        if($this->vendor_id==null){
            $data= DefaultShipping::first();
            
        }else{
            $data=VendorOption::where('vendor_id',$this->vendor_id)->first();
            

            
        }

        if($data!=null){
            return [
                'p_id'=>$data->province_id,
                'd_id'=>$data->district_id,
                'm_id'=>$data->municipality_id,
                'a_id'=>$data->shipping_area_id,
            ];
        }else{
            return null;
        }
    }
}
