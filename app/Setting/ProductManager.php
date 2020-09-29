<?php

namespace App\Setting;

use Illuminate\Database\Eloquent\Model;

class ProductManager extends Model
{
    //
    const warrenty=[
        1=>'No Warranty',
        2=>'Local Warranty',
        3=>'Manufacturer Warrenty'
    ];
}
