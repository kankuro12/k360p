<?php

namespace App\Http\Controllers\Elements;

use App\BlogDisplay;
use App\BrandDisplay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function save(Request $r, $section)
    {
        if ($r->brand_id == null) {
            return redirect()->back()->with('flash_message', 'At least one checkbox should be checked!!');
        } else {
            foreach ($r->brand_id as $value) {
                $count = BrandDisplay::where('home_page_section_id', $section)->where('brand_id', $value)->count();
                if ($count == 0) {
                    $bd = new BrandDisplay();
                    $bd->brand_id = $value;
                    $bd->home_page_section_id = $section;
                    $bd->save();
                }
            }
            return redirect()->back()->with('flash_message', 'Created successfully !!');
        }
    }

    public function delete($id)
    {
        BrandDisplay::find($id)->delete();
        return redirect()->back()->with('flash_message', 'Deleted successfully !!');
    }


    // blog displays

    public function blogSave(Request $r, $section)
    {
        if ($r->blog_id == null) {
            return redirect()->back()->with('flash_message', 'At least one checkbox should be checked!!');
        } else {
            foreach ($r->blog_id as $value) {
                $count = BlogDisplay::where('home_page_section_id', $section)->where('blog_id', $value)->count();
                if ($count == 0) {
                    $bd = new BlogDisplay();
                    $bd->blog_id = $value;
                    $bd->home_page_section_id = $section;
                    $bd->save();
                }
            }
            return redirect()->back()->with('flash_message', 'Created successfully !!');
        }
    }


    public function blogDelete($id){
        BlogDisplay::find($id)->delete();
        return redirect()->back()->with('flash_message', 'Deleted successfully !!');
    }

}
