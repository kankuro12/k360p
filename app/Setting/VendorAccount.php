<?php

namespace App\Setting;

use App\model\admin\Product;
use App\model\admin\VendorAccount as AdminVendorAccount;
use App\model\admin\VendorWithdrawl;
use App\model\OrderItem;
use App\model\Vendor\Vendor;
use App\OrderPayment;
use App\ReferalPayment;
use Illuminate\Database\Eloquent\Model;

class VendorAccount
{
    
    public $vendor;
    public $vendorAccount;
    public function __construct($vendor_id,$ref=false)
    {
        if($ref){
            $this->vendor=Vendor::where('user_id',$vendor_id)->first();

        }else{

            $this->vendor=Vendor::find($vendor_id);
        }
        $this->vendorAccount=AdminVendorAccount::where('vendor_id',$this->vendor->id)->first();
        if($this->vendorAccount==null){
            $this->vendorAccount=new AdminVendorAccount();
            $this->vendorAccount->vendor_id=$this->vendor->id;
            $this->vendorAccount->amount=0;
            $this->vendorAccount->save();
        }
    }

    public function addOrder(OrderItem $order){
        // dd($order);
        $product=Product::find($order->product_id);

        $payment=new OrderPayment();
        $payment->vendor_id=$this->vendor->id;
        $payment->order_item_id=$order->id;
        

        $payment->amount=$order->rate*$order->qty;
        $payment->extracharge=$order->extraCharges();
        $payment->referal=$payment->amount*$product->referalcharge;
        $payment->closing=$order->qty*$product->closingcharge;
        $payment->packaging=$order->qty*$product->packagingcharge;
        $payment->shipping=$order->shippingcharge;
        $payment->detail='';
        $payment->vendoramount=(($payment->amount-$payment->referal-$payment->closing-$payment->packaging)+$payment->extracharge);
        $payment->save();

        $this->vendorAccount->amount+=   $payment->vendoramount;
        $this->vendorAccount->save();


    }

    public function addOrderRef(OrderItem $order){
        // dd($order);
        
        $referal_per=Product::where('product_id',$order->product_id)->select('referal_per')->first()->referal_per;
        $ref=new ReferalPayment();
        $ref->amount=  (int)((($order->qty*$order->rate)*$referal_per)/100);
        $ref->vendor_id=$this->vendor->id;
        $ref->save();


    }

    public function total(){
        return OrderPayment::where('vendor_id',$this->vendor->id)->sum('vendoramount');
    }

    public function withdraw(){
        $currentDate = \Carbon\Carbon::now();
        $old = $currentDate->subDays(7);
        $ref = ReferalPayment::where('created_at','<=',$old)->sum('amount') - VendorWithdrawl::where('vendor_id',$this->vendor->id)->sum('amount');
        return $this->vendorAccount->amount + $ref;
    }

    public function pending(){
        $currentDate = \Carbon\Carbon::now();
        $old = $currentDate->subDays(7);
        return ReferalPayment::where('created_at','>',$old)->sum('amount') ;
    }

    public function withdrawls(){
        return VendorWithdrawl::where('vendor_id',$this->vendor->id)->get();

    }

    public function payments(){
        return OrderPayment::where('vendor_id',$this->vendor->id)->get();
    }
}
