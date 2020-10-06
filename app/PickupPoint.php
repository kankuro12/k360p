<?php

namespace App;

use App\model\admin\Product;
use App\model\OrderItem;
use App\model\ShippingDetail;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    //

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }

    public function area(){
        return $this->belongsTo(ShippingArea::class,'shipping_area_id','id');
    }

    public function undelivered(){
        $all=[];
        $collection=OrderItem::where('stage',3)->where('pickup_point_id',$this->id)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $data['items']=$value;
            $ids=[];
            foreach ($value as $id) {
               array_push($ids,$id->product_id);
            }
            $para=Product::whereIn('product_id',$ids)->select('product_name')->get()->implode('product_name',',');
            $data['search']=$para;
            $data['count']=count($value);
            array_push($all,$data);
        }
        return $all;

    }

    public function delivered(){
        $all=[];
        $collection=OrderItem::where('stage',4)->where('pickup_point_id',$this->id)->get()->groupBy('shipping_detail_id');
        foreach ($collection as $key => $value) {
            $data=[];
            $data['shipping']=ShippingDetail::find($key);
            $data['items']=$value;
            $ids=[];
            foreach ($value as $id) {
               array_push($ids,$id->product_id);
            }
            $para=Product::whereIn('product_id',$ids)->select('product_name')->get()->implode('product_name',',');
            $data['search']=$para;
           
            $data['count']=count($value);
            array_push($all,$data);
        }
        return $all;

    }

}
