<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\admin\VendorAccount as AdminVendorAccount;
use App\model\admin\VendorWithdrawl;
use App\model\Vendor\Vendor;
use App\OrderPayment;
use App\Setting\VendorAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index(){
        $vendors=Vendor::all();
        
        return view('admin.account.index',compact('vendors'));
    }

    public function withdrawl($id){
        $account=new VendorAccount($id);
        $attributes=explode(',',env('withdrawldetails',"bank,account"));
        return view('admin.account.withdrawl',compact('account','attributes'));
    }

    public function list($id){

    }
    public function detail($id){
        if(env('paymentstyle',0)==0){
            
            $withdrawls=VendorWithdrawl::where('vendor_id',$id)->get();
            $attributes=explode(',',env('withdrawldetails',"bank,account"));
            $account=new VendorAccount($id);
            return view('admin.account.detail',compact('withdrawls','attributes','id','account'));
        }else{
            
            $data=OrderPayment::where('paid',0)-> get()->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->toDateString();
            });
           
            return view('admin.account.detail1',compact('data','attributes','id','account'));
        }
    }

    public function saveWithdrawl ($id,Request $request){
        $arr=[];
        // dd($request);
        $all=$request->all();
        $attributes=explode(',',env('withdrawldetails',"bank,account"));
        foreach ($attributes as $attribute) {
            $arr[$attribute]=$request[$attribute];
        }
        $withdrawl=new VendorWithdrawl();
        $withdrawl->amount=$request->amount;
        $withdrawl->paymentdetails=$arr;
        $withdrawl->stage=2;
        $date=Carbon::now();
        $withdrawl->requesteddate=$date;
        $withdrawl->accecpteddate=$date;
        $withdrawl->completeddate=$date;
        $withdrawl->vendor_id=$id;
        $withdrawl->image=$request->file('image')->store('images/withdrawl');
        $withdrawl->save();

        // $withdrawl->date=$date;

        $account=AdminVendorAccount::where('vendor_id',$id)->first();
        $account->amount-=$request->amount;
        $account->save();


        return redirect()->route('admin.detail',['id'=>$id]);

    }
}
