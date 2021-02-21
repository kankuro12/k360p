<?php

namespace App\Http\Controllers\Elements;

use App\CustomListDisplayItem;
use App\elements\Section;
use App\Http\Controllers\Controller;
use App\model\admin\HomePageSection;
use App\model\admin\Product;
use Illuminate\Http\Request;

class CustomListController extends Controller
{
    public function searchProduct(Request $request){
        $products=[];
        if($request->category!=-1){
            $products=Product::where('product_name','like','%'.$request->name."%")->where('category_id',$request->category)->get();
        }else{
            $products=Product::where('product_name','like','%'.$request->name."%")->get();
        }
        return view('admin.elements.snippets.customproduct',compact('products'));
    }

    public function save(HomePageSection $section,Request $request){
        $customlist =\App\CustomListDisplay::where('home_page_Section_id',$section->id)->first();
        if(CustomListDisplayItem::where('custom_list_display_id',$customlist->id)->where('product_id',$request->id)->count()>0){
            return response('');
        }else{
            $customitem=new CustomListDisplayItem();
            $customitem->custom_list_display_id=$customlist->id;
            $customitem->product_id=$request->id;
            $customitem->save();
            return view('admin.elements.snippets.customitem',['item'=>$customitem]);
        }

    }

    public function remove(CustomListDisplayItem $item){
        // dd($item);
        $item->delete();
    }
    
}
