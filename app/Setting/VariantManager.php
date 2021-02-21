<?php

namespace App\Setting;



use Illuminate\Database\Eloquent\Model;
use App\model\admin\Product;
use App\model\admin\Product_attribute;
use App\model\ProductAttributeItem;
use App\model\ProductStock;

class VariantManager
{
    public static function codeToString(string $code){
        $split1 = explode(">", $code);   
        $var=[];
        $split2 = explode("|", $split1[1]);
        foreach ($split2 as $key => $split) {
           $split3=explode(':',$split);
           $item_id=(int)$split3[1];
           $split4=explode("_",$split3[0]);
           $attribute_id=(int)$split4[1];
            $attr=[];
           $attr['attribute']=Product_attribute::find($attribute_id)->toArray();
           $attr['item']=ProductAttributeItem::find($item_id)->toArray();
           array_push($var,$attr);
        }
      
        return $var;
    }
    
    ///
    public static function getDetail(string $code)
    {
        $split1 = explode(">", $code);
        $product_id = (int)explode("_", $split1[0])[1];
        $product=Product::find($product_id);
        $var=[];
        $split2 = explode("|", $split1[1]);
        foreach ($split2 as $key => $split) {
           $split3=explode(':',$split);
           $item_id=(int)$split3[1];
           $split4=explode("_",$split3[0]);
           $attribute_id=(int)$split4[1];
           $attr=Product_attribute::find($attribute_id)->toArray();
           $attr['item']=ProductAttributeItem::find($item_id)->toArray();
           array_push($var,$attr);
        }
        $product->variant=$var;
        return $product;
    }

    public static function getIds(string $code)
    {
        $split1 = explode(">", $code);
        $product_id = (int)explode("_", $split1[0])[1];
        $attr=[];
        $split2 = explode("|", $split1[1]);
        foreach ($split2 as $key => $split) {
            $data=[];
           $split3=explode(':',$split);
           $data['oid']=(int)$split3[1];
           $split4=explode("_",$split3[0]);
           $data['vid']=(int)$split4[1];
            array_push($attr,$data);
        //    $attr=Product_attribute::find($attribute_id)->toArray();
        //    $attr['item']=ProductAttributeItem::find($item_id)->toArray();
            
          
        }
        
        return $attr;
    }

    public static function MakeCode(array $input,$pid){
        $attr=[];
        $list=$input['attributes'];
        sort($list);
        foreach ($list as $attribute) {
            $str='attr_'.$attribute.":".$input['attribute_' . $attribute];
            array_push($attr,$str);
        }

        $semi=implode('|',$attr);
        $code="prod_".$pid .">".$semi;
        return $code;
    }

    public static function hasStock(string $variant){
       return ProductStock::where('code',$variant)->count()>0;
    }
    public static function stock(string $variant){
        return ProductStock::where('code',$variant)->first();
     }
}
