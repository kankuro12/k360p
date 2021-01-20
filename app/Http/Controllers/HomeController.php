<?php

namespace App\Http\Controllers;

use App\Blog;
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
use App\model\admin\Category;
use App\Setting\HomePage;
use App\Setting\VariantManager;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{

    public function success(){
        return view(HomePage::theme("sucess"));
    }

    public function getProducts(Request $request){
        $products=Product::skip(12*$request->page)->take(12);
        $data=[];
        if($products->count()>0){
            $data['hasview']=true;
            $data['view']=view(HomePage::theme("product.mobile_list_category"),compact('products'))->render();
        }else{
            $data['hasview']=false;

        }

        if(Product::count()>(12*($request->page+1))){
            $data['hasmore']=true;
        }else{
            $data['hasmore']=false;

        }

        return response()->json($data);
    }

    public function search(Request $request){
        // dd($request);
        $products=Product::where('isverified',1);
        if($request->cat!=null){
            $cat=Category::find($request->cat);
            $ids=$cat->childList();
            $products=$products->whereIn('category_id',$ids);
        }

        $all=$request->all();

        $products=$products->where('product_name', 'LIKE', '%' . $request->q . '%')->orWhereRaw(" lower(`tags`) LIKE '%". strtolower ($request->q ). "%'");
        $products=$products->orWhereIn('category_id',Category::where('cat_name', 'LIKE', '%' . $request->q . '%')->pluck('cat_id')->toArray())->paginate(24);

        return view(HomePage::theme("product.search"),compact("products",'all'));

    }

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

    public function shops(Request $request){
        $max=Product::max('mark_price');
        $min=Product::min('mark_price');
        $p=Product::where('isverified',1);

        $categories=[];
        $_min=$min;
        $_max=$max;
        if($request->filled("categories")){
            $cats=[];
            $categories=$request->categories;
            foreach($categories as $cat){

                $_cat=Category::find($cat);
                $ids=$_cat->childList();
                foreach($ids as $id){

                    array_push($cats,$id);
                }
            }
            $p=$p->whereIn('category_id',$cats);
        }
        if($request->filled("min")){
            $_min=$request->min;
            $p=$p->where('mark_price','>=',$request->min);
        }

        if($request->filled("max")){
            $_max=$request->max;


            $p=$p->where('mark_price','<=',$request->max);
        }



        $products=$p->paginate(24)->appends($request->all());
        // dd($products->links());
        return view(HomePage::theme("product.shop"),compact("products","max","min",'_min','_max','categories'));
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

    public function category(Request $request, $id){
        $cat=Category::find($id);
        $ids=$cat->childList();


        $max=Product::max('mark_price');
        $min=Product::min('mark_price');
        $p=Product::where('isverified',1);

        $categories=[];
        $_min=$min;
        $_max=$max;
        if($request->filled("categories")){
            $categories=$request->categories;
        }
        //     $cats=[];
        //     foreach($categories as $cat){

        //         $_cat=Category::find($cat);
        //         $ids=$_cat->childList();
        //         foreach($ids as $id){

        //             array_push($cats,$id);
        //         }
        //     }
        //     $p=$p->whereIn('category_id',$cats);
        // }
        if($request->filled("min")){
            $_min=$request->min;
            $p=$p->where('mark_price','>=',$request->min);
        }

        if($request->filled("max")){
            $_max=$request->max;


            $p=$p->where('mark_price','<=',$request->max);
        }



        $products=$p->paginate(12)->appends($request->all());



        // $products=Product::where('isverified',1)->whereIn('category_id',$ids)->paginate(12);
        return view(HomePage::theme("product.category"),compact("cat","products","max","min",'_min','_max','categories'));
    }


    public function brand($id){
        $brand = Brand::find($id);
        $products = Product::where('isverified',1)->where('brand_id',$id)->paginate(12);
        return view(HomePage::theme("product.brand"),compact('brand','products'));
    }

    public function latest(){
        $dayToCheck = Carbon::now()->subDays(env('newtag',7));
        $products=Product::where('isverified',1)->where('created_at','>',$dayToCheck)->paginate(12);
        return view(HomePage::theme("product.shop"),compact('products'));

    }

    public function about(){
        return view(HomePage::theme("about"));
    }

    public function contact(){
        return view(HomePage::theme("contact"));
    }

    public function ctnc(){
        return view(HomePage::theme("ctnc"));

    }

    public function vtnc(){
        return view(HomePage::theme("vtnc"));

    }
    public function pp(){
        return view(HomePage::theme("pp"));

    }

    public function blogList(){
        return view(HomePage::theme("blog.list"));
    }

    public function blogDetail($id){
        $blog = Blog::find($id);
        return view(HomePage::theme("blog.single"))->with(compact('blog'));
    }

    public function categories(){
        $categories=Category::where('parent_id',null)->get();
        return view(HomePage::theme("categories"))->with(compact('categories'));
    }

    public function mobCategories(Request $request){
        $category=Category::find($request->cat_id);
        $ids=$category->childList();
        $products=Product::whereIn('category_id',$ids)->get();
        return view(HomePage::theme("product.mobile_list_category"))->with(compact('products'));

    }
}


// gjhgjhgjhghjhj

