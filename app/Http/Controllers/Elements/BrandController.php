<?php

namespace App\Http\Controllers\Elements;

use App\BrandDisplay;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function save(Request $r, $section){
        if($r->brand_id == null){
            return redirect()->back()->with('flash_message', 'At least one checkbox should be checked!!');
        }else{
                foreach ($r->brand_id as $value) {
                    $count = BrandDisplay::where('home_page_section_id',$section)->where('brand_id',$value)->count();
                    if($count == 0){
                        $bd = new BrandDisplay();
                        $bd->brand_id = $value;
                        $bd->home_page_section_id = $section;
                        $bd->save();
                    }
              }
          return redirect()->back()->with('flash_message', 'Created successfully !!');
        }
    }

    public function delete($id){
        BrandDisplay::find($id)->delete();
        return redirect()->back()->with('flash_message', 'Deleted successfully !!');
    }
}
