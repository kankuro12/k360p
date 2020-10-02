<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('admin.blog.index');
    }

    public function store(Request $request){
        // dd($request->all());
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->post_by = $request->post_by;
        $blog->tag = $request->tag;
        $blog->desc = $request->desc;
        $blog->published = $request->date;
        $blog->image = $request->file('image')->store('images/backend_images/blog');
        $blog->save();
        return redirect()->back()->with('flash_message','New blog has been added successfully !!!');
    }

    public function blogEdit(Request $request, $id){
       if($request->isMethod('post')){
        //  dd($request->all());

         $blog = Blog::where('id',$id)->first();
         $blog->title = $request->title;
         $blog->post_by = $request->post_by;
         $blog->tag = $request->tag;
         $blog->desc = $request->desc;
         $blog->published = $request->date;
         if($request->hasFile('image')){
             $blog->image = $request->file('image')->store('images/backend_images/blog');
          }
         $blog->save();
         return redirect()->back()->with('flash_message','Blog has been updated successfully !!!');
       }else{
           $blog = Blog::where('id',$id)->first();
          return view('admin.blog.edit')->with(compact('blog'));
       }
    }


    public function blogDelete($id){
        $blog = Blog::where('id',$id)->first();
        $blog->delete();
        return redirect()->back()->with('flash_message','Blog has been deleted successfully !!!');
    }

}
