<?php

namespace App\Setting;

use App\model\admin\Onsell;
use App\model\admin\Product;
use App\model\admin\Product_attribute;
use App\model\admin\Sell_product;
use App\model\ProductAttributeItem;
use App\model\ProductStock;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductManager extends Model
{
    //
    const warrenty=[
        1=>'No Warranty',
        2=>'Local Warranty',
        3=>'Manufacturer Warrenty'
    ];


    public static function addDetail(Product $product){
        $product->images=$product->images;
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

        return $product;
    }
}
