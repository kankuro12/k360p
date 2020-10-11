<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\admin\Brand;
use App\model\admin\Menu;
use App\model\admin\Category;
use App\model\admin\Onsell;
use App\Setting\HomePage;

class MenuController extends Controller
{
    public function manageMenu()
    {
        $categories = Category::whereNull('parent_id')->get();

        $menus = Menu::get();
        $collections = \App\model\admin\Collection::all();
        $onsells = Onsell::all();
        $brands = Brand::all();
        $all= HomePage::menutype;
       
        return view('admin.managemenu')->with(compact('all','categories', 'menus', 'brands', 'collections', 'onsells'));
    }



    public function addMenu(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|integer',
            'type' => 'required|integer',
            'menu_name' => 'required',
            'order'=>'required|integer'


        ]);
        $data = $request->all();
        // dd($data);
        // $result = Category::descendantsAndSelf($data['category_id'])->toTree()->first();
        // dd($result->children);
        $menu = new Menu;
        $menu->menu_name = $data['menu_name'];
        $menu->parent_id = $data['parent_id'];
        $menu->type = $data['type'];
        $menu->order = $data['order'];
        $menu->save();
        return redirect()->back();
    }

    public function updateMenu(Menu $menu,Request $request)
    {
        $request->validate([
           
            
            'menu_name' => 'required',
            'order'=>'required|integer'
        ]);
        $data = $request->all();
        // dd($data);
        // $result = Category::descendantsAndSelf($data['category_id'])->toTree()->first();
        // dd($result->children);
       
        $menu->menu_name = $data['menu_name'];
       
        $menu->order = $data['order'];
        $menu->save();
        return redirect()->back();
    }

    public function delMenu(Menu $menu){
        $menu->delete();
        return redirect()->back();
    }
}
