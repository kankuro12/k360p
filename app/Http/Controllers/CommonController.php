<?php

namespace App\Http\Controllers;

use App\model\admin\Collection_product;
use App\model\admin\Sell_product;
use App\Setting\HomePage;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    public function collectionProduct(){
        return view(HomePage::theme("collection.collection"));
    }

    public function collectionProductDetail($id){
        $collection_group = Collection_product::where('collection_id',$id)->get();
        // dd($collection_group);
        return view(HomePage::theme("collection.collection_group"))->with(compact('collection_group'));
    }

    public function saleProduct(){
        return view(HomePage::theme("collection.sale"));
    }

    public function saleProductDetail($id){
        $onsale_group = Sell_product::where('sell_id',$id)->get();
        return view(HomePage::theme("collection.sale_group"))->with(compact('onsale_group'));
    }
}
