<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use App\MobileSlider;
use App\model\admin\HomePageSection;
use Illuminate\Http\Request;

class MobileSliderController extends Controller
{
    public function add(Request $request,HomePageSection $section){
        $slider = new MobileSlider();
        $slider->home_page_Section_id=$section->id;
        $slider->image=$request->image->store('image/mobileads');
        $slider->save();
        return redirect()->back();
    }

    public function update(Request $request){
        $slider=MobileSlider::find($request->id);
        $slider->image=$request->image->store('image/mobileads');
        $slider->save();
    }
    public function del(Request $request){
        $slider=MobileSlider::find($request->id);
        $slider->delete();
    }
}
