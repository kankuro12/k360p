<?php

namespace App\Http\Controllers\vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Image;
use Session;
use App\model\admin\Product;
use App\model\admin\Stocks_status;
use App\model\admin\Category;
use App\model\admin\Brand;
use App\model\admin\Attribute_group;
use App\model\admin\Attribute;
use App\model\admin\Product_image;
use App\model\admin\Product_attribute;
use App\User;
use App\model\vendor\Vendor;
use App\Notifications\Vendor\ProductAdded;
use App\ProductWeightClass;
use App\Setting\ChargesManager;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function addProduct()
    {
        $id = Auth::user()->id;
        $data = Vendor::where('user_id', $id)->firstOrFail();
        $stockstatus = Stocks_status::get();
        $categories = Category::get();
        $brands = Brand::get();
        $attribute_groups = Attribute_group::get();
        $branddropdown = "";
        $statusdropdown = "";
        $categorydropdown = "";

        foreach ($stockstatus as $status) {
            $statusdropdown .= "<option value='" . $status->status_id . "'>" . $status->status_name . "</option>";
        }
        foreach ($brands as $brand) {
            $branddropdown .= "<option value='" . $brand->brand_id . "'>" . $brand->brand_name . "</option>";
        }

        foreach ($categories as $category) {
            if ($category->parent_id == Null) {
                $categorydropdown .= "<option value='" . $category->cat_id . "'>" . $category->cat_name . "</option>";
            } else {
                $child = $category->cat_id;
                $parents = Category::defaultOrder()->ancestorsOf($child);
                //dd(json_decode($parents));
                $parentlists = "";
                foreach ($parents as $parent) {
                    $parentlist = $parent->cat_name;
                    $parentlists .= $parentlist . " > ";
                }
                $parentlists .= $category->cat_name;
                $categorydropdown .= "<option value='" . $category->cat_id . "'>" . $parentlists . "</option>";
            }
        }
        return view('vendor.addproduct')->with(compact('categorydropdown', 'branddropdown', 'statusdropdown', 'data'));
    }

    public function createProduct(Request $request)
    {
        //dd($request->all());
        if ($request->isMethod('post')) {
            $data = $request->all();
            $product = new Product;
            $product->isverified = 0;
            $product->vendor_id = Auth::user()->id;
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->stocktype = $data['stocktype'];
            $product->product_name = $data['product_name'];
            $product->product_description = $data['product_description'];
            $product->product_short_description = $data['product_short_description'];
            $product->product_sku = $data['product_sku'];
            $product->mark_price = $data['mark_price'];
            $product->sell_price = $data['sell_price'];
            $product->quantity = $data['quantity'];
            $product->tags = $data['tags'];
            $product->status = "";
            $product->product_images = $request->file('product_main_images')->store('images/backend_images/products/main_image/');
            $cc = ChargesManager::getClosing($product->category_id, $product->mark_price);
            $product->closingcharge = $cc != null ? $cc->amount : 0;
            $product->save();

            if ($request->hasFile('product_images')) {
                foreach ($request->product_images as $product_image) {
                    //dd($product_image);
                    if ($product_image->isValid()) {
                        $productimages = new Product_image;
                        $productimages->product_id = $product->product_id;
                        $productimages->image = $product_image->store('images/backend_images/products/');
                        $productimages->save();
                    }
                }
            }

            //shippingdetail

            $shippingdetail = new \App\ProductShippingDetail();
            $shippingdetail->product_id = $product->product_id;
            $shippingdetail->shipping_class_id = $request->shipping_class_id;
            $shippingdetail->weight = $request->weight;
            $shippingdetail->l = $request->l;
            $shippingdetail->w = $request->w;
            $shippingdetail->h = $request->h;
            $shippingdetail->save();

            //addshipping
            $wc = new ProductWeightClass();
            $wc->product_id = $product->product_id;
            $wc->shipping_class_id = $request->shipping_class_id;
            $category = $product->category;
            $amount_0 = ChargesManager::getShipping($product->category_id, $request->weight, 0, $request->shipping_class_id);
            if ($amount_0 != null) {
                $wc->amount_0 = $amount_0->amount;
                $wc->type_0 = $amount_0->type;
            }

            $amount_1 = ChargesManager::getShipping($product->category_id, $request->weight, 1, $request->shipping_class_id);
            if ($amount_1 != null) {
                $wc->amount_1 = $amount_1->amount;
                $wc->type_1 = $amount_1->type;
            }

            $amount_2 = ChargesManager::getShipping($product->category_id, $request->weight, 2, $request->shipping_class_id);
            if ($amount_2 != null) {
                $wc->amount_2 = $amount_2->amount;
                $wc->type_2 = $amount_2->type;
            }

            // $amount_2 = $category->getShippingPrice($request->weight, 2, $request->shipping_class_id);
            // if ($amount_2 != null) {
            //     $wc->amount_2 = $amount_2->amount;
            //     $wc->type_2 = $amount_2->type;
            // }

            $amount_3 = ChargesManager::getShipping($product->category_id, $request->weight, 3, $request->shipping_class_id);
            if ($amount_3 != null) {
                $wc->amount_3 = $amount_3->amount;
                $wc->type_3 = $amount_3->type;
            }

            $amount_4 = ChargesManager::getShipping($product->category_id, $request->weight, 4, $request->shipping_class_id);;
            if ($amount_4 != null) {
                $wc->amount_4 = $amount_4->amount;
                $wc->type_4 = $amount_4->type;
            }
            $wc->save();
            // dd($wc);


            $product->notify(new ProductAdded($product));

            return redirect()->route('vendor.manage-product')->with('msg', 'Product Added Successfully . . .');
        }
    }

    public function getAttribute(Request $request)
    {
        $groupid = $request->attribute_group_id;
        $attribute = Attribute::where('attribute_group_id', $groupid)->get();
        $attributedropdown = "<option selected value=''>Select Attribute</option>";
        foreach ($attribute as $attr) {
            $attributedropdown .= "<option value='" . $attr->attribute_id . "'>" . $attr->attribute_name . "</option>";
        }
        return response()->json($attributedropdown);
    }

    public function manageProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->get();
        foreach ($products as $product) {
            if ($product->brand_id != null) {


                $product->brand_name = Brand::find($product->brand_id)->brand_name;
            } else {
                $product->brand_name = "No Brand";
            }

            $product->stock_status_name = $product->isverified == 1 ? "verified" : "Verification Pending";
        }



        return view('vendor.manageproduct')->with(compact('products'));
    }

    public function getcategoryProduct(Request $request)
    {
        $data = $request->all();
        //dd($data['cat_id']);
        $catid = $data['cat_id'];
        $products = Product::where('category_id', $catid)->where('vendorid', Auth::user()->id)->get()->toArray();
        //dd(json_encode($products));
        return response()->json($products);
    }

    public function viewProduct($id, Request $request)
    {
        $categories = Category::get();
        $brands = Brand::get();
        $branddropdown = "";
        $categorydropdown = "";
        $productdetail = Product::where('product_id', $id)->first();
        $vendor = $request->user()->vendor;
        // dd($vendor,$productdetail);

        if ($vendor->id != $productdetail->vendor_id) {
            return redirect()->route('vendor.manage-product');
        }
        $productimages = Product_image::where('product_id', $id)->get();

        $category = Category::where('cat_id', $productdetail->category_id)->firstOrFail();
        $parents = Category::defaultOrder()->ancestorsOf($category->cat_id);
        $plists = "";
        foreach ($parents as $parent) {
            $plist = $parent->cat_name;
            $plists .= $plist . " > ";
        }
        $plists = $plists . "" . $category->cat_name;
        foreach ($categories as $category) {
            $sel=($productdetail->category_id==$category->cat_id?"selected":"");
            if ($category->parent_id == Null) {
                $categorydropdown .= "<option value='" . $category->cat_id . "' ".$sel.">" . $category->cat_name . "</option>";
            } else {
                $child = $category->cat_id;
                $parents = Category::defaultOrder()->ancestorsOf($child);
                //dd(json_decode($parents));
                $parentlists = "";
                foreach ($parents as $parent) {
                    $parentlist = $parent->cat_name;
                    $parentlists .= $parentlist . " > ";
                }
                $parentlists .= $category->cat_name;
                $categorydropdown .= "<option value='" . $category->cat_id . "' ".$sel.">" . $parentlists . "</option>";
            }
        }

        foreach ($brands as $brand) {
            $selbrand=$brand->brand_id==$productdetail->brand_id?"selected" :"";
            $branddropdown .= "<option value='" . $brand->brand_id . "' ".$selbrand.">" . $brand->brand_name . "</option>";
        }

        // dd($categorydropdown);
        $productdetail->parent_category = $plists;
        // dd($productdetail,$category);
        // $stockstatus = Stocks_status::where('status_id', $productdetail->stock_status_id)->firstOrFail();
        // $productdetail->stockstatus = $stockstatus->status_name;
        if ($productdetail->brand_id != null) {

            $productdetail->brand_name  = Brand::where('brand_id', $productdetail->brand_id)->first()->brand_name;
        } else {
            $productdetail->brand_name = "No Brand";
        }


        // dd(compact('productdetail','productimages'));
        return view('vendor.viewproduct')->with(compact('productdetail', 'productimages','categorydropdown','branddropdown'));
    }

    public function update(Product $product,Request $request){
        $data=$request->all();
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id']??null;
        $product->stocktype = $data['stocktype'];
        $product->product_name = $data['product_name'];
        $product->product_description = $data['product_description']??'';
        $product->product_short_description = $data['product_short_description'];
        // $product->product_sku = $data['product_sku'];
        $product->mark_price = $data['mark_price'];
        $product->sell_price = $data['sell_price'];
        $product->tags = $data['tags'];
        $product->featured = $data['featured']??0;
        if($data['quantity']!=null){

            $product->quantity = $data['quantity'];
        }
        $product->save();

        return redirect()->back();
    }
}
