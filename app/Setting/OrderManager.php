<?php

namespace App\Setting;

use Illuminate\Database\Eloquent\Model;

class OrderManager 
{
    const stages=['Pending','Accecpted','OnDelivery','Delivered','Rejected','Returned'];
    const paymentstatus=['Pending','Completed','refunded'];
    
}
