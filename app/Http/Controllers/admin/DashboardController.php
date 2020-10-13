<?php

namespace App\Http\Controllers\admin;

use App\AboutUs;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Admin;
use App\model\admin\Brand;
use App\model\admin\Product;
use App\model\admin\Category;
use App\model\admin\Collection;
use App\model\admin\DefaultShipping;
use App\model\OrderItem;
use App\model\vendor\Vendor;

class DashboardController extends Controller
{
    //
    public function index(){
        $brands = Brand::get();
        $brandno = count($brands);
        $product = Product::get();
        $productno = count($product);
        $category = Category::get();
        $categoryno = count($category);
        $collection = Collection::get();
        $collectionno = count($collection);
        $vendor = Vendor::get();
        $vendorno = count($vendor);
        $featpro = Product::where('featured',1)->get();
        $featno = count($featpro);
        $latest=OrderItem::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard')->with(compact('latest','brandno','productno','categoryno','collectionno','vendorno','featno'));
    }

    public function shipping(Request $request){
       if($request->getMethod()=="GET"){
            return view('admin.shipping.address');
       }else{
            $option=DefaultShipping::first();
            if($option==null){
                $option=new DefaultShipping();

            }
            $option->province_id=$request->province_id;
            $option->district_id=$request->district_id;
            $option->municipality_id=$request->municipality_id;
            $option->shipping_area_id=$request->shipping_area_id;
            $option->isdefault=1;
            $option->save();
            return redirect()->back();
       }
    }

    public function about(Request $request){
        $about=AboutUs::first();
        if($request->method()=="POST"){
            if($about==null){
                $about=new AboutUs();
            }
            $about->mini=$request->mini;
            $about->full=$request->full;
            $about->save();
            return redirect()->back();
        }else{
            return view('admin.elements.about');
        }
    }
}
