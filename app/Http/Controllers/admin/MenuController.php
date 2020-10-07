<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\admin\Brand;
use App\model\admin\Menu;
use App\model\admin\Category;
use App\model\admin\Onsell;

class MenuController extends Controller
{
    public function manageMenu()
    {
        $categories = Category::whereNull('parent_id')->get();

        $menus = Menu::get();
        $collections = \App\model\admin\Collection::all();
        $onsells = Onsell::all();
        $brands = Brand::all();

       
        return view('admin.managemenu')->with(compact('categories', 'menus', 'brands', 'collections', 'onsells'));
    }



    public function addMenu(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|integer',
            'type' => 'required|integer',
            'menu_name' => 'required',

        ]);
        $data = $request->all();
        // dd($data);
        // $result = Category::descendantsAndSelf($data['category_id'])->toTree()->first();
        // dd($result->children);
        $menu = new Menu;
        $menu->menu_name = $data['menu_name'];
        $menu->parent_id = $data['parent_id'];
        $menu->type = $data['type'];
        $menu->save();
        return redirect()->back();
    }
}
