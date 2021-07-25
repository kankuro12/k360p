<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\OrderItem;
use App\model\ShippingDetail;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\model\VendorUser\VendorUser;
use App\Rating;
use Session;
use App\Setting\HomePage;
use App\Wishlist;

class DashboardController extends Controller
{
    public function dashboard(){
        return view(HomePage::theme("user.dashboard.header"));
    }

    public function iframProfile(){

        $pendingCount = ShippingDetail::join('order_items','shipping_details.id','=','order_items.shipping_detail_id')->where('shipping_details.user_id',Auth::user()->id)->where('order_items.stage',0)->count();

        $acceptCount = ShippingDetail::join('order_items','shipping_details.id','=','order_items.shipping_detail_id')->where('shipping_details.user_id',Auth::user()->id)->where('order_items.stage',1)->count();

        $receivCount = ShippingDetail::join('order_items','shipping_details.id','=','order_items.shipping_detail_id')->where('shipping_details.user_id',Auth::user()->id)->where('order_items.stage',4)->count();

        $rejectCount = ShippingDetail::join('order_items','shipping_details.id','=','order_items.shipping_detail_id')->where('shipping_details.user_id',Auth::user()->id)->where('order_items.stage',5)->count();

        $returnCount = ShippingDetail::join('order_items','shipping_details.id','=','order_items.shipping_detail_id')->where('shipping_details.user_id',Auth::user()->id)->where('order_items.stage',6)->count();
        return view(HomePage::theme("user.dashboard.index"))->with(compact('pendingCount','acceptCount','receivCount','rejectCount','returnCount'));
    }

    public function recentOrder(Request $request){
        $shipping = ShippingDetail::where('user_id',Auth::user()->id)->get();
        $orderItems = [];
        foreach ($shipping as $key => $value) {
            $order = OrderItem::where('shipping_detail_id',$value->id)->get();
            array_push($orderItems,$order);
        }
        // dd($orderItems);
        return view(HomePage::theme("user.dashboard.order_item"))->with(compact('orderItems'));
    }

    public function orderItem($id){
        $orderItem = OrderItem::where('id',$id)->first();
        return view(HomePage::theme("user.dashboard.order"))->with(compact('orderItem'));
    }

    public function fullOrderDetail($shipping_detail_id){
        $orderItem = OrderItem::where('shipping_detail_id',$shipping_detail_id)->get();
        return view(HomePage::theme("user.dashboard.full_order"))->with(compact('orderItem'));
    }

    public function referalProduct(){
        return view(HomePage::theme('user.dashboard.referal_product'));
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


    public function userRatings(Request $r){
        // dd($r->all());
        $r->validate([
            'rating' =>'required',
        ]);

        $countRate = Rating::where('user_id',Auth::user()->id)->where('product_id',$r->product_id)->count();
        if($countRate>0){
            $rating = Rating::where('user_id',Auth::user()->id)->where('product_id',$r->product_id)->first();
            $rating->rating = $r->rating;
            $rating->title =  $r->title;
            $rating->rating_desc = $r->rating_desc;
            $rating->user_id = Auth::user()->id;
            $rating->product_id = $r->product_id;
            $rating->save();
            return redirect()->back()->with('success','Your rating has been updated successfully!!');
        }else{
            $rating = new Rating();
            $rating->rating = $r->rating;
            $rating->title =  $r->title;
            $rating->rating_desc = $r->rating_desc;
            $rating->user_id = Auth::user()->id;
            $rating->product_id = $r->product_id;
            $rating->save();
            return redirect()->back()->with('success','Your rating has been added successfully!!');
        }
    }

}
