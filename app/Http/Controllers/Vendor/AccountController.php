<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\model\admin\VendorAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //

    public function index(){

        $vendor=Auth::user()->vendor->id;
        $income=VendorAccount::where('vendor_id',$vendor->id)->get();
        
    }
}
