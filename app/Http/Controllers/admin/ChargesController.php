<?php

namespace App\Http\Controllers\admin;

use App\ClosingCharge;
use App\Http\Controllers\Controller;
use App\model\admin\Category;
use App\PackagingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChargesController extends Controller
{
    //

    public function closingcharges(Category $category){
        return view('admin.charges.closingcharge',['category'=>$category]);
    }

    public function closingcharges_add(Category $category,Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'min' => 'required',
            'max' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }
       
        $charge=ClosingCharge::where([
            'category_id'=>$request->category_id,
            'min'=>$request->min,
            'max'=>$request->max,
        ])->first();
        if($charge==null){
            $charge=new ClosingCharge();
        }
        $charge->type = $request->type;
        $charge->category_id = $category->cat_id;
        $charge->min = $request->min;
        $charge->max = $request->max;
        $charge->amount = $request->amount;
       
        $charge->save();
        // dd($wc);
        
       
        return redirect()->back();
    }

    public function closingcharges_update(Request $request,ClosingCharge $charge){
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'min' => 'required',
            'max' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }
       
        
        $charge->type = $request->type;
        $charge->min = $request->min;
        $charge->max = $request->max;
        $charge->amount = $request->amount;
        $charge->save();
        // dd($wc);
        
       
        return redirect()->back();
    }

    public function closingcharges_del(ClosingCharge $charge){
       
        $charge->delete();
        // dd($wc);
        
       
        return redirect()->back();
    }

    public function packaging(){
        return view('admin.charges.packaging');
    }

    public function packaging_add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        $packaging=new PackagingCharge();
        $packaging->name=$request->name;
        $packaging->amount=$request->amount;
        $packaging->save();
        return redirect()->back();
    }

    public function packaging_update(Request $request,PackagingCharge $packaging){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        $packaging->name=$request->name;
        $packaging->amount=$request->amount;
        $packaging->save();
        return redirect()->back();
    }
    public function packaging_del(Request $request,PackagingCharge $packaging){
       
        
        $packaging->delete();
        return redirect()->back();
    }
}
