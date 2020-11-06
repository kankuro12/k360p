<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use App\model\admin\Brand;
use App\model\admin\Category;
use App\model\admin\Collection;
use App\model\admin\HomePageSection;
use App\model\admin\Onsell;
use App\SliderGroup;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ElementController extends Controller
{
    public function index()
    {
        return view('admin.elements.homepage');
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $r = new HomePageSection();
        $r->name = $request->name;
        $r->type = $request->type;
        $r->order = $request->order;
        $r->parent_id = $request->parent_id;
        $r->boxed = $request->boxed;
        $r->row = $request->parent_id == -1 ? 12 : $request->row;
        $r->save();
        $r->addElement();
        return response()->json(['data' => $r]);
    }

    public function del(HomePageSection $section)
    {
        $data = $section->childDel();
        HomePageSection::whereIn('id', $data)->delete();
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $section = HomePageSection::find($request->id);
        $section->name = $request->name;
        $section->row = $request->row;
        $section->order = $request->order;
        $section->save();
        return response()->json($section);
    }

    public function manage(HomePageSection $section)
    {
        switch ($section->type) {
            case 1:
                return view('admin.elements.slider', ['section' => $section]);
                break;
            case 2:
                $collections = Collection::all();
                $onsells = Onsell::all();
                $brands = Brand::all();
                $categories = Category::all();
                //dd($brands);
                return view('admin.elements.ad')->with(compact('collections', 'onsells', 'brands', 'categories', 'section'));
                break;
            case 3:

                $categories = Category::all();
                $columns = DB::getSchemaBuilder()->getColumnListing('products');
                //dd($brands);
                return view('admin.elements.category')->with(compact('categories', 'section', 'columns'));
                break;
            case 4:

                $categories = Category::all();
                $columns = DB::getSchemaBuilder()->getColumnListing('products');
                //dd($brands);
                return view('admin.elements.boxeddisplay')->with(compact('categories', 'section', 'columns'));
                break;
            case 5:
                $brands = Brand::all();
                return view('admin.elements.brand')->with(compact('brands','section'));
                break;
                
            default:
                # code...
                break;
        }
    }
}
