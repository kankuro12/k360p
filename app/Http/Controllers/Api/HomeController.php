<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\model\admin\Category;
use App\model\admin\Product;
use App\model\admin\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sliders(){
        $sliders=Slider::select('mobile')->get();
        return response()->json($sliders);
    }

    public function categories(){
        $categories=Category::where('parent_id',null)->get();
        return response()->json($categories);
    }

    public function products(){
        $products = Product::inRandomOrder()->limit(10)->get();
        return response()->json($products);

    }
}
