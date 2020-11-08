<?php

namespace App\Http\Controllers;

use App\Clearfix;
use App\Footerhead;
use App\Footerlink;
use Illuminate\Http\Request;

class FooterheadController extends Controller
{
    public function index(){
        return view('admin.footer.index');
    }

    public function update(Request $req, $id){
        // dd($req->all());
        Footerhead::where('id',$id)->update(['title' => $req->title]);
        return redirect()->back()->with('flash_message','Title has been updated successfully !!!');
    }

    public function footerLinkStore(Request $r){
        // dd($r->all());

        $link = new Footerlink();
        $link->title = $r->title;
        $link->footerhead_id = $r->footerhead_id;
        if($r->linkradio == 1){
            $link->link = $r->custom_link;
        }

        if($r->linkradio == 2){
            $link->link = 'shop-by-brand/'.$r->brands;
        }

        if($r->linkradio == 3){
            $link->link = 'collection-product/'.$r->collections;
        }

        if($r->linkradio == 4){
            $link->link = 'sale-product/'.$r->sales;
        }

        if($r->linkradio == 5){
            $link->link = 'shop-by-category/'.$r->categories;
        }

        $link->save();
        return redirect()->back()->with('flash_message','New link has been created successfully !!!');

    }

    public function footerLinkDelete($id){
        $link = Footerlink::where('id',$id)->first();
        $link->delete();
        return redirect()->back()->with('flash_message','Link has been deleted successfully !!!');
    }


    // clear fix

    public function showItems(){
        return view('admin.footer.clearfix');
    }

    public function showItemsUpdate(Request $r, $id){
        $clear = Clearfix::find($id);
        $clear->title = $r->title;
        $clear->link_title = $r->link_title;
        $clear->link = $r->link;
        $clear->save();
        return redirect()->back()->with('flash_message','Updated successfully !!!');
    }
}
