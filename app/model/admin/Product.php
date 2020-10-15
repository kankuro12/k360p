<?php

namespace App\model\admin;

use App\model\Coupon;
use App\model\Coupon_setting;
use App\model\OrderItem;
use App\model\ProductAttributeItem;
use App\Rating;
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

    public function cuponprice($coupon,$currentrate,$total){
        if($this->onsale()){
            return $currentrate;
        }else{
            $now=Carbon::now();
            $couponCount = Coupon::where('coupon_code', $coupon)->where($now,['start_time','end_time'])->count();
            if($couponCount==0){
                return $currentrate;

            }else{
                $c = Coupon::where('coupon_code', $coupon)->where($now,['start_time','end_time'])->first();
                $csetting=Coupon_setting::where('coupon_id',$c->id)->first();
                if($total<$csetting->minimum_order_value || $csetting->minimum_order_valueissued_number_coupon){
                    return $currentrate;
                }

                

            }
        }
    }

    public function sale(){
        $dt = Carbon::now();
        $current =Onsell::where('started_at','<=',$dt)
        ->where('end_at','>=',$dt)->select('sell_id')
        ->get();
        return  Sell_product::where('product_id',$this->product_id)->whereIn('sell_id',$current)->first();
    }
    public function onSale(){
        $dt = Carbon::now();
        $current =Onsell::where('started_at','<=',$dt)
        ->where('end_at','>=',$dt)->select('sell_id')
        ->get();
        return  Sell_product::where('product_id',$this->product_id)->whereIn('sell_id',$current)->count()>0;
                      
    }

    public function salePrice(){
        $dt = Carbon::now();
        $current =Onsell::where('started_at','<=',$dt)
        ->where('end_at','>=',$dt)->select('sell_id')
        ->get();
        $sp=  Sell_product::where('product_id',$this->product_id)->whereIn('sell_id',$current)->first();
    
        return  round($this->mark_price - ($this->mark_price * $sp->sale_discount/100 ));
                      
    }

    public function isTop(){
        $count=env('top',100);
        return OrderItem::where('product_id',$this->product_id)->sum('qty')>$count;
    }

    public function images(){
        return $this->hasMany(Product_image::class,'product_id','product_id');
    }

    public function avgRating(){
        $avg=Rating::where('product_id',$this->product_id)->avg('rating');
        return round(($avg/5)*100);
    }

    public function reviewCount(){
        $avg=Rating::where('product_id',$this->product_id)->count();
        return $avg;
    }
}
