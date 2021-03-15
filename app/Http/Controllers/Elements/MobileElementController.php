<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use App\MobileAd;
use App\MobileSlider;
use App\model\admin\Category;
use App\model\admin\HomePageSection;
use Illuminate\Http\Request;

/**
 * Manage Home Page Section For Mobile device 
 */
class MobileElementController extends Controller
{
    public function index()
    {
        $sections = HomePageSection::where('type', '>', '6')->orderBy('order', 'asc')->get();
        $sectiontypes = \App\Setting\HomePage::mobileSectonType;
        return view('admin.elements.mobile.element', compact('sections', 'sectiontypes'));
    }

    public function add(Request $request)
    {
        $section = new HomePageSection();
        $section->name = $request->name;
        $section->type = $request->type;
        $section->order = $request->order;
        $section->parent_id = 0;
        $section->save();
        $section->addElement();
        return redirect()->back();
    }
    public function edit(Request $request, HomePageSection $section)
    {
        $section->name = $request->name;
        // $section->type = $request->type;
        $section->order = $request->order;
        $section->save();

        return redirect()->back();
    }
    public function del(HomePageSection $section)
    {
        $section->delete();
        return redirect()->back();
    }
    public function manage(HomePageSection $section)
    {
        /*
        *Load View According to D
        */

        switch ($section->type) {

            case 7:
                // $products=Product::select('product_id','product_name','product_images')->get();
                $cats = Category::where('parent_id', 0)->orWhereNull("parent_id")->get();
                return view('admin.elements.custom', compact('section', 'cats'));
                break;
            case 8:
                // $products=Product::select('product_id','product_name','product_images')->get();
                $ad = MobileAd::where('home_page_Section_id', $section->id)->first();
                return view('admin.elements.mobile.ad', compact('section', 'ad'));
                break;
            case 9:
                // $products=Product::select('product_id','product_name','product_images')->get();
                $sliders = MobileSlider::where('home_page_Section_id', $section->id)->get();
                return view('admin.elements.mobile.slider', compact('section', 'sliders'));
                break;
            default:
                # code...
                break;
        }
        return redirect()->back();
    }
}
