<?php

use Illuminate\Foundation\Inspiring;
use App\Setting\VendorOption;
use \App\Province;
use \App\District;
use App\model\Admin;
use App\model\ShippingDetail;
use \App\Municipality;
use App\Notifications\TestNotification;
use App\Notifications\User\OrderComfirmation;
use App\Notifications\Vendor\SetupFinished;
use \App\Notifications\Vendor\SignupActivate;
use \App\ShippingArea;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');



Artisan::command('test:notification',function(){
    $user=\App\User::find(7);
    // $vendor=$user->vendor;
    // $url="https://aakashsms.com/admin/public/sms/v3/send";
    // $token="e3d8dccc23900f6d19cd76bcd4f7b5157de6e7312335d2da81c258037bbef9b4";
    // $data= ['to'=>$vendor->phone_number,"text"=>"Your Activation Code is ".$user->activation_token];
    // $data['auth_token']=$token;
    // $response = Http::post($url,$data);
    // dd($response);
    // $user->notify(new SignupActivate($user));
    // $user->notify(new SetupFinished($user));
    // Admin::first()->notify(new TestNotification());
    ShippingDetail::find(1)->notify(new OrderComfirmation([1,2]));

});
Artisan::command('insert:zone', function () {
    foreach (VendorOption::province as $key => $province) {
        $pro=new Province();
        $pro->name=$province;
        $pro->save();
        $this->line('Province '.$province." Added");
        foreach (VendorOption::districtsOfProvince[$key] as $key => $district) {
            $dis=new District();
            $dis->name=$district;
            $dis->province_id=$pro->id;
            $dis->save();
            $this->line('________ District '.$district." Added");

            foreach (VendorOption::localBodies[$district] as $key => $value) {
                $mun=new Municipality();
                $mun->name=$value;
                $mun->district_id=$dis->id;
                $mun->save();
                $this->line('_________________ Municipality '.$value." Added");

                $area=new ShippingArea();
                $area->name="Whole ".$value;
                $area->municipality_id=$mun->id;
                $area->save();
                $this->line('_________________________ Shipping area '.$area->name." Added");

            }
        }
    }
})->describe('Adding all sectors');

