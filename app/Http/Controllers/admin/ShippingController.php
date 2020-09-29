<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\admin\Category;
use App\Province;
use App\WeightClass;
use Illuminate\Http\Request;
use \App\ShippingArea;
use App\ShippingClass;
use Illuminate\Support\Facades\Validator;


class ShippingController extends Controller
{
    //shipping type
    public function list()
    {
        return view('admin.shipping.list', ['shippings' => ShippingClass::all()]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'weightclass' => 'required|string',
            'dimensionclass' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', 3);
        }
        $shipping = new ShippingClass();
        $shipping->enabled = true;
        $shipping->name = $request->name;
        $shipping->weightclass = $request->weightclass;
        $shipping->dimensionclass = $request->dimensionclass;
        $shipping->save();
        return redirect()
            ->back()->withSuccess('Shipping class added sucessfully');
    }

    public function update(Request $request, ShippingClass $shipping)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'weightclass' => 'required|string',
            'dimensionclass' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', 3);
        }

        $shipping->name = $request->name;
        $shipping->weightclass = $request->weightclass;
        $shipping->dimensionclass = $request->dimensionclass;
        $shipping->save();
        return redirect()
            ->back()->withSuccess('Shipping class updated sucessfully');
    }

    public function status(ShippingClass $shipping, $status)
    {

        $shipping->enabled = $status;
        $shipping->save();
        return redirect()
            ->back()->withSuccess('Shipping class updated sucessfully');
    }


    //shipping weight and price management
    public function manage(ShippingClass $shipping)
    {
        return view("admin.shipping.category", ['shipping' => $shipping]);
    }
    public function manage_category(ShippingClass $shipping, Category $category)
    {
        return view("admin.shipping.manage", ['shipping' => $shipping, 'category' => $category]);
    }

    public function weight(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'deliver_range' => 'required',
            'min' => 'required',
            'max' => 'required',
            'category_id' => 'required',
            'shipping_class_id' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', $request->deliver_range);
        }



        $weight=WeightClass::where([
            'min'=>$request->min,
            'max'=>$request->max,
            'category_id'=>$request->category_id,
            'shipping_class_id'=>$request->shipping_class_id,
            'deliver_range'=>$request->deliver_range
        ])->first();
        // dd($weight);s
        if($weight==null){

            $weight = new WeightClass();
        }
        $weight->type = $request->type;
        $weight->deliver_range = $request->deliver_range;
        $weight->min = $request->min;
        $weight->max = $request->max;
        $weight->amount = $request->amount;
        $weight->category_id = $request->category_id;
        $weight->shipping_class_id = $request->shipping_class_id;
        $weight->save();
        $category = Category::find($request->category_id);
        if ($category->count() > 0) {

            foreach ($category->child() as $child) {

                $wc=WeightClass::where([
                    'min'=>$request->min,
                    'max'=>$request->max,
                    'category_id'=>$child->cat_id,
                    'shipping_class_id'=>$request->shipping_class_id,
                    'deliver_range'=>$request->deliver_range
                ])->first();
                if($wc==null){

                    $wc = new WeightClass();
                }
                $wc->type = $request->type;
                $wc->deliver_range = $request->deliver_range;
                $wc->min = $request->min;
                $wc->max = $request->max;
                $wc->amount = $request->amount;
                $wc->category_id = $child->cat_id;
                $wc->shipping_class_id = $request->shipping_class_id;
                $wc->save();

                if ($child->count() > 0) {

                    foreach ($child->child() as $child1) {
                        $wc1=WeightClass::where([
                            'min'=>$request->min,
                            'max'=>$request->max,
                            'category_id'=>$child1->cat_id,
                            'shipping_class_id'=>$request->shipping_class_id,
                            'deliver_range'=>$request->deliver_range
                        ])->first();

                        if($wc1==null){
                            $wc1 = new WeightClass();
                        }
                        $wc1->type = $request->type;
                        $wc1->deliver_range = $request->deliver_range;
                        $wc1->min = $request->min;
                        $wc1->max = $request->max;
                        $wc1->amount = $request->amount;
                        $wc1->category_id = $child->cat_id;
                        $wc1->shipping_class_id = $request->shipping_class_id;
                        $wc1->save();
                    }
                }
            }
        }
        return redirect()
            ->back()
            ->with('sel', $request->deliver_range);
    }

    public function weight_update(Request $request, WeightClass $wc)
    {
        // dd($request,$wc);
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'min' => 'required',
            'max' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('sel', $wc->deliver_range);
        }

        $wc->type = $request->type;
        $wc->min = $request->min;
        $wc->max = $request->max;
        $wc->amount = $request->amount;
        $wc->save();
        // dd($wc);

        return redirect()
            ->back()
            ->with('sel', $wc->deliver_range);
    }

    public function weight_del(WeightClass $wc)
    {
        // dd($request,$wc);

        $i = $wc->deliver_range;
        $wc->delete();
        // dd($wc);

        return redirect()
            ->back()
            ->with('sel', $i);
    }


    //shipping weight management
    public function weight_type()
    {
        return view('weight');
    }

    //zone Management
    public function zones()
    {
        $provinces = Province::all();
        return view('admin.shipping.zones', ['provinces' => $provinces]);
    }

    public function zones_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'mun_id' => 'required|integer',

        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }
        $shipping = new ShippingArea();
        $shipping->name = $request->name;
        $shipping->municipality_id = $request->mun_id;
        $shipping->save();
        return response()->json(['success' => true, 'area' => $shipping]);
    }
    public function zones_del(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }
        $shipping = ShippingArea::find($request->id);

        $shipping->delete();
        return response()->json(['success' => true]);
    }
    public function zones_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }
        $shipping = ShippingArea::find($request->id);
        $shipping->name = $request->name;
        $shipping->save();
        return response()->json(['success' => true]);
    }
    public function get_shipping($id)
    {

        return response()->json(['shipping' => ShippingClass::find($id)]);
    }
}
