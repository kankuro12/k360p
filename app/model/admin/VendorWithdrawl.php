<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class VendorWithdrawl extends Model
{
    //
    protected $casts = [
        'paymentdetails' => 'array'
    ];
}
