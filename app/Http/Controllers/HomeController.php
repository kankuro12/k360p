<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\admin\Brand;
use App\model\admin\Collection;
use App\model\admin\Collection_product;
use App\model\admin\Product;
use App\model\admin\Contactinfo;
use App\model\admin\Product_image;
use App\model\admin\Product_attribute;
use App\model\admin\Attribute;
use App\model\admin\Attribute_group;
use App\Setting\HomePage;
use App\Setting\VariantManager;
use Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    


    public function home1(){
        //dd(Auth::user()->id);
       $products = Product::where('featured',1)->get();
     
    
           return view(HomePage::theme("home.app"));
       
    }

    public function home(){
        //dd(Auth::user()->id);
        $products = Product::where('featured',1)->get();
        if(env('usebuilder',0)==1){
            return view(HomePage::theme("home.app"));
         }else{
             return view(HomePage::theme("home.index"));
 
        }
    }

    public function shops(){
        return view(HomePage::theme("product.shop"));
    }

    public function productDetail($id){
        $product = Product::where('product_id',$id)->firstOrFail();
        return view(HomePage::theme("product.single"))->with(compact('product'));
    }

    public function getStock(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'attributes' => 'array|required',
            'attributes.*' => 'integer',
            'product_id'=>'integer|required'
        ]);

        if ($validator->fails()) {
            return response()->json(['sucess'=>false,'data'=>$validator->errors(),"type"=>0]);
        }

        $rules = [
            'attributes' => 'array|required',
            'attributes.*' => 'integer',
        ];

        foreach ($input['attributes'] as $attribute) {
            $rules['attribute_' . $attribute] = 'integer|required';
        }
    
        $validator1 = Validator::make($request->all(), $rules);

        if ($validator1->fails()) {
            return response()->json(['sucess'=>false,'data'=>$validator1->errors(),'type'=>'0']);

        }

        $code=VariantManager::MakeCode($input,$input['product_id']);
        if(VariantManager::hasStock($code)){
            $stock=VariantManager::stock($code);
            if($stock->qty>0){

                return response()->json(['sucess'=>true,'data'=>$stock,'type'=>'1']);
            }else{
                return response()->json(['sucess'=>false,'data'=>"Stock Not Available",'type'=>'1']);

            }

        }else{
            return response()->json(['sucess'=>false,'data'=>"Stock Not Available",'type'=>'1']);

        }

    }
}
