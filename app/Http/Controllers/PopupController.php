<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Popup;

class PopupController extends Controller
{
    public function popupBoxInfo(Request $request){
        if($request->isMethod('post')){
            $pop = Popup::first();
            if($pop==null){
                $pop=new Popup();
            }
            if($request->hasFile('image')){
                 $pop->image = $request->file('image')->store('images/backend_images/popup');
                }
            $pop->title = $request->title;
            $pop->short_detail = $request->short_detail;
            $pop->status = $request->has('status')?1:0;
            $pop->save();
            return redirect()->back()->with('success','Popup info has been updated successfully!');
        }else{
            $pop = Popup::where('id',1)->first();
            return view('admin.popup.popup_info',compact('pop'));
        }
    }
}
