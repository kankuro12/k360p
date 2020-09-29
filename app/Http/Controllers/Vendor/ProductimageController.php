<?php

namespace App\Http\Controllers\vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\admin\Product_image;


class ProductimageController extends Controller
{
    //
    public function del(Product_image $image){
        $pid=$image->product_id;
        $image->delete();
    
        return redirect()->route('vendor.view-product', ['id' => $pid])->with('sel',2);
    }
    public function add(Request $request,$pid){
      
     
        foreach($request->product_images as $product_image){
            //dd($product_image);
            if($product_image->isValid()){
                $productimages = new Product_image;
                $productimages->product_id = $pid;
                $productimages->image = $product_image->store('images/backend_images/products/');
                $productimages->save();
            }
        }
        return redirect('vendor/view-product/'.$pid)->with('sel',2);
    }
}
