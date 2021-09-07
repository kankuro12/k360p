<?php

namespace App\Http\Controllers\Api;

use App\APIModels\ProductWrapper;
use App\CustomListDisplayItem;
use App\Http\Controllers\Controller;
use App\MobileAd;
use App\model\admin\BoxedItemDisplay;
use App\model\admin\BoxedItemListDisplay;
use App\model\admin\Category;
use App\model\admin\Collection;
use App\model\admin\Collection_product;
use App\model\admin\HomePageSection;
use App\model\admin\Onsell;
use App\model\admin\Product;
use App\model\admin\Product_attribute;
use App\model\admin\Sell_product;
use App\model\admin\Slider;
use App\model\OrderItem;
use App\model\ProductAttributeItem;
use App\model\ProductStock;
use App\model\Review;
use App\Rating;
use App\Setting\ProductManager;
use App\Setting\VariantManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function allproducts(){
        $allproducts=Product::all();
        $p=[];
        foreach ($allproducts as $key => $value) {
            array_push($p,ProductManager::addDetail($value));
        }
        return response()->json($p);
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
        $product->onsale=$onsale;
        $product->ratings=Rating::where('product_id',$id)->join('vendor_users',"ratings.user_id","=","vendor_users.user_id")->select('ratings.*','vendor_users.fname','vendor_users.lname','vendor_users.profile_img')->get();
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
                $variant->options=ProductAttributeItem::where('product_attribute_id',$variant->id)->get();
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
                $stock->variantdetail=VariantManager::getIds($stock->code);
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
        $product->recom=Product::where('category_id',$product->category_id)->where('product_id','<>',$product->product_id)->take(8)->get();
        return response()->json($product);
    }


    
    
    public function search(Request $request){
        $keyword=$request->keyword;
        return response()->json(Product::where('product_name','like','%'.$keyword.'%')->get());
    }


    public function listproducts($step){
        $products=Product::where('product_id','>',0);
        if($step==0){
            $products=$products->take(24);
        }else{
            $products=$products->skip(24*$step)->take(24);
        }
        $pp=$products->get();
        $p=[];
        foreach ($pp as $key => $value) {
            array_push($p,ProductManager::addDetail($value));
        }
        $data=[];
        $data['hasmore']=Product::count()>(24*($step+1));
        $data['products']=$p;
        return response()->json((object)$data);
    }

    public function homePage(){
        $sections=HomePageSection::where('type','>',6)->orderBy('order','asc')->get();
        $data=[];
        foreach ($sections as $key => $section) {
            if($section->type==7){

                $customlist =\App\CustomListDisplay::where('home_page_Section_id',$section->id)->first();
                $ids=CustomListDisplayItem::where('custom_list_display_id',$customlist->id)->pluck('product_id')->toArray();
                // dd($ids);
                $section->products=[];
                if(count($ids)>0){
                    $pps=[];
                    $products=Product::wherein('product_id',$ids)->get();
                    foreach ($products as $product) {
                        array_push($pps,ProductManager::addDetail($product));
                    }
                    $section->products=$pps;
                }
                if(count( $section->products)>0){
    
                    array_push($data,$section);
                }
            }elseif($section->type==8){
                $section->ad=\App\MobileAd::where('home_page_Section_id',$section->id)->first();
                array_push($data,$section);

            }
            elseif($section->type==9){
                $section->sliders=\App\MobileSlider::where('home_page_Section_id',$section->id)->get();
                if($section->sliders->count()>0){
                    array_push($data,$section);
                }

            }
        }

        return response()->json($data);
    }

    public function collections(){
        return response()->json(Collection::all());
    }

    public function collectionsSummary(){
        $collections=Collection::all();
        $data=[];
        foreach ($collections as $key => $collection) {
            # code...
            $collection->products=Collection_product::join('products','products.product_id','=','collection_products.product_id')->where('collection_products.collection_id',$collection->collection_id)->select("products.product_id","products.product_name","products.product_images")->get();
            array_push($data,$collection);
        }
        return response()->json($data);
        // $allData=[];
        // foreach ($$collections as $key =>$collection) {
        //     $ids=Collection_product::where('collection_id',$id)->pluck('product_id');
        //     $collection->data=Product::whereIn('product_id',$ids)->select('->get()
        // }

    }

    public function collection($id){
        $collection=Collection::find($id);
        $ids=Collection_product::where('collection_id',$id)->pluck('product_id');

        $data=[];
        $products=Product::whereIn('product_id',$ids)->get();;
        foreach ($products as $product) {
            array_push($data,ProductManager::addDetail($product));
        }
        $collection->products=$data;
        return response()->json($collection);
    }

    public function categoryWiseProduct($id){
        $category=Category::where('cat_id',$id)->first();
        $ids=$category->childList();
        $products = Product::whereIn('category_id',$ids)->get();
        return response()->json(['products'=>$products,'cate'=>$category]);
    }

    public function featured(){
        $products=Product::where('featured',1)->get();
        $pp=[];
        foreach ($products as $key => $product) {
            array_push($pp,ProductManager::addDetail($product));
        }
        return response()->json($pp);
    }

    public function top($count=8){
        // $products=Product::join('order_items','order_items.product_id','=',"products.product_id")->select(
        //     DB::raw('order_items.product_id,sum(order_items.qty) as sold')
        // )->groupBy('order_items.product_id')->orderBy('sold')->take($count)->get();
        $tops=OrderItem::select(DB::raw("sum(qty) as sold,product_id"))->groupBy('product_id')->orderBy('sold','desc')->take($count);
        $products=Product::joinSub($tops,'tops', function ($join) {
            $join->on('products.product_id', '=', 'tops.product_id');
        })->select('products.*','tops.sold')->get();
        

        return response()->json($products);
    }

    public function cartDetail(Request $request){
        $arr=[];
        $products=Product::whereIn('product_id',$request->products)->select('product_name','product_id','sell_price','mark_price','stocktype')->get();
        foreach ($products as $key => $product) {
            $onsale=$product->onsale();
            $product->onsale=$onsale;
            $selper=0;
            $product->variants=[];
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
            array_push($arr,$product);
        }

        return response()->json($arr);
    }
   

    


}
