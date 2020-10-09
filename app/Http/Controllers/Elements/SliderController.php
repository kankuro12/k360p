<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use App\model\admin\Brand;
use App\model\admin\Category;
use App\model\admin\Collection;
use App\model\admin\Onsell;
use App\model\admin\Slider;
use App\Setting\HomePage;
use App\SliderGroup;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //

    public function add(SliderGroup $group)
    {
        $collections = Collection::all();
        $onsells = Onsell::all();
        $brands = Brand::all();
        $categories = Category::all();
        //dd($brands);
        return view('admin.elements.addslider')->with(compact('collections', 'onsells', 'brands', 'categories', 'group'));
    }

    public function save(SliderGroup $group, Request $request)
    {

        // dd($group);
        $slider = new Slider();
        $slider->primary_text = $request->primary_text;
        $slider->secondary_text = $request->secondary_text;
        $slider->button_text = $request->button_text;
        $slider->button_bg = $request->button_bg;
        $slider->button_color = $request->button_color;
        $slider->slider_group_id=$group->id;
   
        $slider->slider_image = $request->file('image')->store('back/sliders');
        $slider->mobile = $request->file('mobile')->store('back/sliders');
        
        switch ($request->linkradio) {
            case 1:
                $slider->link_text = $request->link;
                break;
            case 2:
                $slider->link_text = HomePage::brandurl . $request->link;
                break;
            case 3:
                $slider->link_text = HomePage::collectionurl . $request->link;
                break;
            case 4:
                $slider->link_text = HomePage::saleurl . $request->link;
                break;
            case 5:
                $slider->link_text = HomePage::categoryurl . $request->link;
                break;
            default:
                $slider->link_text = "#";
                break;
        }

        $slider->save();
        return redirect()->route('elements.manage',['section'=>$group->home_page_section_id]);
    }

    public function del(Slider  $slider){
        $slider->delete();
        return redirect()->back();
    }
}
