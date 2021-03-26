<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\admin\Category;
use App\model\admin\Product;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    public function index(){
        $featured=Product::where('featured',1)->get();
        $cats=Category::all();
        return view('admin.featured.index',compact('featured','cats'));
    }
    public function add(Product $product){
        $product->featured=1;
        $product->save();
        return view('admin.featured.featuredproduct',compact('product'));
    }
    public function remove(Product $product){
        $product->featured=0;
        $product->save();
    }
}
