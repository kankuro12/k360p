<?php

namespace App\Http\Controllers\Api;

use App\APIModels\ProductWrapper;
use App\Http\Controllers\Controller;
use App\model\admin\BoxedItemDisplay;
use App\model\admin\BoxedItemListDisplay;
use App\model\admin\Category;
use App\model\admin\Product;
use App\model\admin\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sliders(){
        $sliders=Slider::select('mobile','slider_image')->get();
        return response()->json($sliders);
    }

    public function categories(){
        $categories=Category::where('parent_id',null)->get();
        return response()->json($categories);
    }

    public function category($id){
        $category=Category::find($id);
        $ids=$category->childList();
        $products=Product::whereIn('category_id',$ids)->select('product_id','product_name','product_images','mark_price')->get();
        return response()->json($products);

    }
    public function products(){
        $datas=[];
        $items=BoxedItemListDisplay::inRandomOrder()->get();
        foreach ($items as $key => $item) {
            $product=Product::where('category_id',$item->category_id)->orderBy($item->orderby,$item->order==0?"ASC":"DESC")->take($item->count)->select('product_id','product_name','product_images','mark_price')->get();
            $data=new ProductWrapper($item->title,$product);
            array_push($datas,$data);
        }

        $item1s=BoxedItemListDisplay::inRandomOrder()->get();
        foreach ($item1s as $key => $item) {
            $product=Product::where('category_id',$item->category_id)->orderBy($item->orderby,$item->order==0?"ASC":"DESC")->take($item->count)->select('product_id','product_name','product_images','mark_price')->get();
            $title=Category::find($item->category_id)->cat_name;
            $data=new ProductWrapper($title,$product);
            array_push($datas,$data);
        }
        // $products = Product::inRandomOrder()->limit(10)->get();
        return response()->json($datas);

    }

    public function product($id){
        $product=Product::find($id);
        $product->images=$product->images;
        return response()->json($product);
    }
}
