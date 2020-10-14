<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Setting\VendorAccount;
use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
    //

    public function index(){

        $vendor=Auth::user()->vendor;

        $account=new VendorAccount($vendor->id);
        $attributes=explode(',',env('withdrawldetails',"bank,account"));

        return view('vendor.account.index',compact('account','attributes'));
        // dd($account,$account->withdraw(),$account->total(),$account->withdrawls(),$account->payments());
        
    }
}
