<?php

namespace App\model;

use App\District;
use App\Municipality;
use App\Province;
use App\ShippingArea;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ShippingDetail extends Model
{

    use Notifiable;
    //

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

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function routeNotificationForOneSignal()
    {

        if($this->user_id==null){
            return ['email'=>$this->email];
        }else{

            return ['email' => $this->user->email];
        }
    }
    
}
