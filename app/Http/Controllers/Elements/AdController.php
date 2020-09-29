<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use App\model\admin\AdDisplay;
use App\model\admin\BoxedItemDisplay;
use App\model\admin\BoxedItemListDisplay;
use App\model\admin\CategoryDisplay;
use App\model\admin\HomePageSection;
use App\Setting\HomePage;
use Illuminate\Http\Request;

class AdController extends Controller
{
    //

    public function save(HomePageSection $section,Request $request){
        $ad=$section->getElement();
        // dd($request,$ad);
        if($ad==null){
            $ad=new AdDisplay();
            $ad->home_page_section_id=$section->id;
        }
        $ad->link2=$request->link2;
        if($request->has('linkradio')){

            switch ($request->linkradio) {
                case 1:
                    $ad->link1 = $request->link;
                    break;
                case 2:
                    $ad->link1 = HomePage::brandurl . $request->link;
                    break;
                case 3:
                    $ad->link1 = HomePage::collectionurl . $request->link;
                    break;
                case 4:
                    $ad->link1 = HomePage::saleurl . $request->link;
                    break;
                case 5:
                    $ad->link1 = HomePage::categoryurl . $request->link;
                    break;
                default:
                    $ad->link1 = "#";
                    break;
            }
        }
        if($request->hasFile('image')){

            $ad->image1 = $request->file('image')->store('back/ad');
        }
        $ad->save();
       return redirect()->back();
    }

    public function saveCategory(HomePageSection $section,Request $request){
        $data=$section->getElement();
        // dd($request);
        if($data==null){
            $data=new CategoryDisplay();
            $data->home_page_section_id=$section->id;
        }
        $data->category_id=$request->category_id;
        $data->orderby=$request->orderby;
        $data->order=$request->order;
        $data->count=$request->count;
        $data->save();
        return redirect()->back();
    }

    public function saveBoxed(BoxedItemDisplay $section,Request $request){
  
        // dd($request);
        $data=new BoxedItemListDisplay();
        $data->boxed_item_display_id=$section->id;
        $data->query=$request->mquery??'';
        $data->hasquery=$request->hasquery??0;
        $data->hascategory=$request->hascategory??0;
        $data->category_id=$request->category_id;
        $data->title=$request->title;
        $data->category_id=$request->category_id;
        $data->orderby=$request->orderby;
        $data->order=$request->order;
        $data->count=$request->count;

        $data->save();

        return redirect()->back();

    }

    public function updateBoxed(BoxedItemListDisplay $item,Request $request){
        
    //    dd($request);
        $item->query=$request->mquery??'';
        $item->hasquery=$request->hasquery??0;
        $item->hascategory=$request->hascategory??0;
        $item->category_id=$request->category_id;
        $item->title=$request->title;
        $item->category_id=$request->category_id;
        $item->orderby=$request->orderby;
        $item->order=$request->order;
        $item->count=$request->count;

        $item->save();

        return redirect()->back();

    }

    public function delBoxed(BoxedItemListDisplay $item,Request $request){
        
        //    dd($request);
           
    
            $item->delete();
    
            return redirect()->back();
    
        }
}
