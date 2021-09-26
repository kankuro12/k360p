<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\model\admin\Category;
use Illuminate\Http\Request;

class MakeAOrderController extends Controller
{
    public function index(){
        $cats = Category::where('parent_id', 0)->orWhereNull("parent_id")->get();
        return view('vendor.make_a_order.index',compact('cats'));
    }
}
