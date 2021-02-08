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
    public function allproducts(){
        $allproducts=Product::all();
        return response()->json($allproducts);
    }
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
        $onsale=$product->onsale();
        $product->onsale=$product->onsale;
        $selper=0;
        if($onsale){
            $dt = Carbon::now();
            $current =Onsell::where('started_at','<=',$dt)
            ->where('end_at','>=',$dt)->select('sell_id')
            ->get();
            $selper=  Sell_product::where('product_id',$product->product_id)->whereIn('sell_id',$current)->first()->sale_discount;
        }
        if($product->stocktype==1){
            $variants=[];
            foreach (Product_attribute::where('product_id',$product->product_id)->get() as $key => $variant) {
                $variant->options=ProductAttributeItem::where('product_attribute_id',$variant->id);
                array_push($variants,$variant);
            }
            $product->variants=$variants;
            $stocks=[];
            foreach (ProductStock::where('product_id',$product->product_id)->get() as $key => $stock) {
                if($onsale){
                    $stock->newprice=round($stock->price - ($stock->price * $selper/100 ));
                    $stock->oldprice=$stock->price;
                }else{
                    $stock->newprice=$stock->price;
                }
                array_push($stocks,$stock);

            }
            $product->stocks=$stocks;
        }else{
            if($onsale){
                $product->newprice=round($product->mark_price - ($product->mark_price * $selper/100 ));
                $product->oldprice=$product->mark_price;
            }else{
                $product->newprice=$product->mark_price;
            }
        }
        return response()->json($product);
    }

    public function search(Request $request){
        $keyword=$request->keyword;
        return response()->json(Product::where('product_name','like','%'.$keyword.'%')->get());
    }
}