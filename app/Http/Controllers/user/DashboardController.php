<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\model\VendorUser\VendorUser;
use Session;
use App\Setting\HomePage;
use App\Wishlist;

class DashboardController extends Controller
{
    public function dashboard(){
        return view(HomePage::theme("user.dashboard.index"));
    }


    public function recentOrder(Request $request){
        return view(HomePage::theme("user.dashboard.order"));
    }

    public function orderItem($id){
        $orderItem = OrderItem::where('shipping_detail_id',$id)->get();
        return view(HomePage::theme("user.dashboard.order_item"))->with(compact('orderItem'));
    }

    public function cancelOrder(Request $request){
        return view('user.profile.cancellation');
    }

    
    public function accountDetail(Request $request){
        if($request->isMethod('post')){
            // dd($request->all());
            $user = VendorUser::where('user_id',Auth::user()->id)->first();
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->mobile_number = $request->mobile_number;
            $user->secondary_email = $request->secondary_email;
            $user->gender = $request->gender;
            $user->province = $request->province;
            $user->dob = $request->dob;
            $user->city = $request->city;
            $user->postalcode = $request->postalcode;
            if($request->hasFile('image')){
                $user->profile_img = $request->file('image')->store('images/user');
            }
            $user->save();
            return redirect()->back()->with('success','Info has been updated');
        }else{
           return view(HomePage::theme("user.dashboard.account_detail"));
        }
    }

    public function wishlist(){
        $wishlist = Wishlist::where('user_id',Auth::user()->id)->get();
        return view(HomePage::theme("user.dashboard.wishlist"))->with(compact('wishlist'));
    }

    public function wishlistProduct($product_id){
        $countWishlist = Wishlist::where('product_id',$product_id)->where('user_id',Auth::user()->id)->count();
        if($countWishlist){
            return redirect('user/wishlist')->with('warning','This product already exists in your wishlist!');
        }else{
            $wishlist = new Wishlist();
            $wishlist->product_id = $product_id;
            $wishlist->user_id = Auth::user()->id;
            $wishlist->save();
            return redirect('user/wishlist')->with('success','Product added to your wishlist successfully!');
        }
    }

    public function wishlistProductRemove($id){
        $wishlist = Wishlist::where('id',$id)->first();
        $wishlist->delete();
        return redirect()->back()->with('success','Product has been removed successfully!');
    }

}
