<?php

namespace App\Setting;

use App\model\admin\Product;
use App\model\admin\VendorAccount as AdminVendorAccount;
use App\model\admin\VendorWithdrawl;
use App\model\OrderItem;
use App\model\Vendor\Vendor;
use App\OrderPayment;
use Illuminate\Database\Eloquent\Model;

class VendorAccount
{
    
    public $vendor;
    public $vendorAccount;
    public function __construct($vendor_id)
    {
        $this->vendor=Vendor::find($vendor_id);
        $this->vendorAccount=AdminVendorAccount::where('vendor_id',$vendor_id)->first();
        if($this->vendorAccount==null){
            $this->vendorAccount=new AdminVendorAccount();
            $this->vendorAccount->vendor_id=$vendor_id;
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

    public function total(){
      
        return OrderPayment::where('vendor_id',$this->vendor->id)->sum('vendoramount');
    }

    public function withdraw(){
        return $this->vendorAccount->amount;
    }

    public function withdrawls(){
        return VendorWithdrawl::where('vendor_id',$this->vendor->id)->get();

    }

    public function payments(){
        return OrderPayment::where('vendor_id',$this->vendor->id)->get();
    }
}
