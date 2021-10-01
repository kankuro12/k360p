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
        $vendors=Vendor::where('stage','>',2)->get();
        
        return view('admin.account.index',compact('vendors'));
    }

    public function withdrawl($id){
        $account=new VendorAccount($id);
        $attributes=explode(',',env('withdrawldetails',"bank,account"));
        return view('admin.account.withdrawl',compact('account','attributes'));
    }

    public function withdrawl1($id,Request $request){
        $account=new VendorAccount($id);
       
        $all=$request->all();
        // dd($all);
        $attributes=explode(',',env('withdrawldetails',"bank,account"));
        if(!in_array("Order_Date",$attributes)){
            array_push($attributes,"Order_Date");
        }
        return view('admin.account.withdrawl1',compact('account','attributes','all'));
    }
    public function list($id){

    }
    public function detail($id){
        $attributes=explode(',',env('withdrawldetails',"bank,account"));
        $account=new VendorAccount($id);
        $withdrawls=VendorWithdrawl::where('vendor_id',$id)->get();
        if(env('paymentstyle',0)==0){
            
            return view('admin.account.detail',compact('withdrawls','attributes','id','account'));
        }else{
            
            if(!in_array("Order_Date",$attributes)){
                array_push($attributes,"Order_Date");
            }
            $data=OrderPayment::where('vendor_id',$id)->where('paid',0)-> get()->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->toDateString();
            });
           
            return view('admin.account.detail1',compact('data','attributes','id','account','withdrawls'));
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
        if($account->amount<0){
            $account->amount=0;
        }
        $account->save();


        return redirect()->route('admin.detail',['id'=>$id]);

    }

    public function saveWithdrawl1($id,Request $request){
        // dd($request);

        $all=$request->all();
        $attributes=explode(',',env('withdrawldetails',"bank,account"));
        if(!in_array("Order_Date",$attributes)){
            array_push($attributes,"Order_Date");
        }
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


        OrderPayment::whereIn('id',$request->ids)
        ->update(['paid'=>1]);

      

        $account=AdminVendorAccount::where('vendor_id',$id)->first();
        $account->amount-=$request->amount;
        $account->save();

        return redirect()->route('admin.detail',['id'=>$id]);
    }
}
