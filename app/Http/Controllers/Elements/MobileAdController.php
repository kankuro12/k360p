<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use App\MobileAd;
use App\model\admin\HomePageSection;
use Illuminate\Http\Request;

class MobileAdController extends Controller
{
    public function save(Request $request,HomePageSection $section){
        $ad = MobileAd::where('home_page_Section_id',$section->id)->first();
        $ad->image=$request->image->store('image/mobileads');
        $ad->save();
        return redirect()->back();
    }
}
