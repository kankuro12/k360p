<?php

namespace App\Http\Controllers\admin;

use App\ExtraCharge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\model\admin\Product_attribute;
use App\model\ProductAttributeItem;
use App\model\ProductStock;
use App\Setting\VariantManager;
use App\model\admin\Product;
use App\model\Vendor\Vendor;
use App\Notifications\Vendor\ProductAccepted;
use App\ProductWeightClass;
use App\ShippingClass;

class VariantController extends Controller
{
    //
    public function add(Request $request, $pid)
    {
        $validator = Validator::make($request->all(), [
            'attribute' => 'required|max:255',
            'attributeitem' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', 3);
        }

        $attr = new Product_attribute();
        $attr->name = $request->attribute;
        $attr->product_id = $pid;
        $attr->save();

        $items = explode(',', $request->attributeitem);
        foreach ($items as $key => $item) {
            $itm = new ProductAttributeItem();
            $itm->product_attribute_id = $attr->id;
            $itm->name = $item;
            $itm->save();
        }
        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function del(Product_attribute $aid)
    {
        $aid->delete();
        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function del_item(ProductAttributeItem $aiid)
    {
        $aiid->delete();
        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function add_item(Request $request, $aid)
    {
        $validator = Validator::make($request->all(), [

            'attributeitem' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', 3);
        }



        $items = explode(',', $request->attributeitem);
        foreach ($items as $key => $item) {
            $itm = new ProductAttributeItem();
            $itm->product_attribute_id = $aid;
            $itm->name = $item;
            $itm->save();
        }
        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function add_stock(Request $request, $pid)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'attributes' => 'array|required',
            'attributes.*' => 'integer',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', 3);
        }

        $rules = [
            'attributes' => 'array|required',
            'attributes.*' => 'integer',
            'price' => 'numeric|required',
            'saleprice' => 'numeric|required',
            'qty' => 'numeric|required',
        ];

        foreach ($input['attributes'] as $attribute) {
            $rules['attribute_' . $attribute] = 'integer|required';
        }

        $validator1 = Validator::make($request->all(), $rules);

        if ($validator1->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', 3);
        }

        $code = VariantManager::MakeCode($input, $pid);
        $stock = ProductStock::where('code', $code)->first();
        if ($stock == null) {
            $stock = new ProductStock();
            $stock->code = $code;
        }
        $stock->price = $input['price'];
        $stock->saleprice = $input['saleprice'];
        $stock->qty = $input['qty'];
        $stock->product_id = $pid;
        $stock->save();

        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function update_Stock(ProductStock $stock, Request $request)
    {
        $input = $request->all();
        $stock->price = $input['price'];
        $stock->saleprice = $input['saleprice'];
        $stock->qty = $input['qty'];

        $stock->save();
        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function simple_Stock(Product $product, Request $request)
    {
        $validator1 = Validator::make($request->all(), [

            
            'qty' => 'required',
          
        ]);
        
        if ($validator1->fails()) {
            // dd($validator1->errors());
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 3);
        }
        $input = $request->all();
        $product->quantity = $input['qty'];
        $product->save();
        return redirect()
            ->back()
            ->with('sel', 3);
    }

    public function admin_charge(Product $product,Request $request){
        $validator1 = Validator::make($request->all(), [

            
            'cc' => 'required',
            'pc' => 'required',
            'rc' => 'required',
          
        ]);
        
        if ($validator1->fails()) {
            // dd($validator1->errors());
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 7);
        }
      
        $product->referalcharge = $request->rc;
        $product->closingcharge = $request->cc;
        $product->packagingcharge = $request->pc;
        $product->save();
        return redirect()
            ->back()
            ->with('sel', 7);
    }

    public function product_shipping(Product $product, Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'shipping_class_id' => 'required|integer',
            'weight' => 'required|numeric',
            'l' => 'required|numeric',
            'w' => 'required|numeric',
            'h' => 'required|numeric',
        ]);
        if ($validator1->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 4);
        }

        $shippingdetail = $product->shipping();
        if ($shippingdetail == null) {
            $shippingdetail = new \App\ProductShippingDetail();
            $shippingdetail->product_id = $product->product_id;
        }
        $shippingdetail->shipping_class_id = $request->shipping_class_id;
        $shippingdetail->weight = $request->weight;
        $shippingdetail->l = $request->l;
        $shippingdetail->w = $request->w;
        $shippingdetail->h = $request->h;
        $shippingdetail->save();
        $i = 0;
        $wc = ProductWeightClass::where('product_id', $request->product_id)->where('shipping_class_id', $request->shipping_class_id)->first();
        if ($wc == null) {

            $wc = new ProductWeightClass();
            $wc->product_id = $product->product_id;
            $wc->shipping_class_id = $request->shipping_class_id;
            $category = $product->category;
            $amount_0 = $category->getShippingPrice($request->weight, 0, $request->shipping_class_id);
            if ($amount_0 != null) {
                $wc->amount_0 = $amount_0->amount;
                $wc->type_0 = $amount_0->type;
            }

            $amount_1 = $category->getShippingPrice($request->weight, 1, $request->shipping_class_id);
            if ($amount_1 != null) {
                $wc->amount_1 = $amount_1->amount;
                $wc->type_1 = $amount_1->type;
            }

            $amount_2 = $category->getShippingPrice($request->weight, 2, $request->shipping_class_id);
            if ($amount_2 != null) {
                $wc->amount_2 = $amount_2->amount;
                $wc->type_2 = $amount_2->type;
            }

            $amount_2 = $category->getShippingPrice($request->weight, 2, $request->shipping_class_id);
            if ($amount_2 != null) {
                $wc->amount_2 = $amount_2->amount;
                $wc->type_2 = $amount_2->type;
            }

            $amount_3 = $category->getShippingPrice($request->weight, 3, $request->shipping_class_id);
            if ($amount_3 != null) {
                $wc->amount_3 = $amount_3->amount;
                $wc->type_3 = $amount_3->type;
            }

            $amount_4 = $category->getShippingPrice($request->weight, 4, $request->shipping_class_id);
            if ($amount_4 != null) {
                $wc->amount_4 = $amount_4->amount;
                $wc->type_4 = $amount_4->type;
            }
            $wc->save();
        }
        return redirect()
            ->back()
            ->with('sel', 4);
    }

    public function product_option(Product $product, Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'warrenty' => 'required|integer',
        ]);
        if ($validator1->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 5);
        }

        $option = $product->option();
        if ($option == null) {
            $option = new \App\ProductOption();
            $option->product_id = $product->product_id;
        }
        $option->warrenty = $request->warrenty;
        $option->warrentytime = $request->warrentytime ?? "Month";
        $option->warrentyperiod = $request->warrentyperiod ?? 0;
        $option->isrefundable = $request->isrefundable ?? 0;
        $option->refundablepolicy = $request->refundablepolicy;
        $option->save();
        return redirect()
            ->back()
            ->with('sel', 5);
    }

    public function product_verify(Product $product, $status)
    {
        $product->isverified = $status;
        if($status==1){
          Vendor::find($product->vendor_id)->notify(new ProductAccepted($product->product_id,$product->product_name));
        }
        $product->save();
        return redirect()->back();
    }

    public function product_shipping_price(Request $request)
    {
        // dd($request);
        $validator1 = Validator::make($request->all(), [
            'shipping_class_id' => 'required|integer',
            'product_id' => 'required|integer',
            'amount_0' => 'required',
            'type_0' => 'required',
            'amount_1' => 'required',
            'type_1' => 'required',
            'amount_2' => 'required',
            'type_2' => 'required',
            'amount_3' => 'required',
            'type_3' => 'required',
            'amount_4' => 'required',
            'type_4' => 'required',
        ]);
        if ($validator1->fails()) {
            // dd($validator1->errors());
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 4);
        }
        $wc = ProductWeightClass::where('product_id', $request->product_id)->where('shipping_class_id', $request->shipping_class_id)->first();
        $wc->amount_0 = $request->amount_0;
        $wc->type_0 = $request->type_0;

        $wc->amount_1 = $request->amount_1;
        $wc->type_1 = $request->type_1;

        $wc->amount_2 = $request->amount_2;
        $wc->type_2 = $request->type_2;

        $wc->amount_3 = $request->amount_3;
        $wc->type_3 = $request->type_3;

        $wc->amount_4 = $request->amount_4;
        $wc->type_4 = $request->type_4;

        $wc->save();

        // dd($wc);
        return redirect()
            ->back()
            ->with('sel', 4);
    }


    //extracharge
    public function product_extracharge(Request $request)
    {
        $validator1 = Validator::make($request->all(), [

            'product_id' => 'required|integer',
            'name' => 'required',
            'amount' => 'required'

        ]);

        if ($validator1->fails()) {
            // dd($validator1->errors());
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 6);
        }
        $extracharge = new ExtraCharge();
        $extracharge->product_id = $request->product_id;
        $extracharge->name = $request->name;
        $extracharge->amount = $request->amount;
        $extracharge->enabled = 1;
        $extracharge->save();
        return redirect()
            ->back()
            ->with('sel', 6);
    }

    public function product_extracharge_status (ExtraCharge $extracharge, $status)
    {
        $extracharge->enabled = $status;
        $extracharge->save();
        return redirect()
            ->back()
            ->with('sel', 6);
    }

    public function product_extracharge_update(ExtraCharge $extracharge, Request $request)
    {

        $validator1 = Validator::make($request->all(), [

            
            'name' => 'required',
            'amount' => 'required'

        ]);
        
        if ($validator1->fails()) {
            // dd($validator1->errors());
            return redirect()
                ->back()
                ->withErrors($validator1)
                ->with('sel', 6);
        }
        $extracharge->name = $request->name;
        $extracharge->amount = $request->amount;

        $extracharge->save();
        return redirect()
            ->back()
            ->with('sel', 6);
    }
}
