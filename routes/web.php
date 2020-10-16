<?php

use App\model\admin\Onsell;
use App\model\admin\Sell_product;
use App\model\OrderItem;
use App\model\ShippingDetail;
use App\Notifications\User\OrderComfirmation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('testo', function () {


    // $shipping=ShippingDetail::find(51);
    // $orders=OrderItem::where('shipping_detail_id',$shipping->id)->get();

    // return view('email.order.receipt',compact('shipping','orders'));
    // dd($shipping,$orders);

    Auth::logout();

    // foreach (Onsell::all() as $key => $value) {
    //     $value->time();
    // }

    // DB::enableQueryLog();

    // $dt = Carbon::now();
    // $current = Onsell::where('started_at','<=',$dt)
    //     ->where('end_at','>=',$dt)->select('sell_id')
    //     ->get();
    // dd($current->toArray(),$dt,DB::getQueryLog()); 
    // $date = \Carbon\Carbon::today()->subDays(7);
    // $orders=DB::table('order_items')->where('created_at', '>=', \Carbon\Carbon::now()->subDays(7))
    // ->groupBy('date')
    // ->orderBy('date', 'DESC')
    // ->get(array(
    //     DB::raw('Date(created_at) as date'),
    //     DB::raw('COUNT(*) as "views"')
    // ));
    // dd($orders,$date);
});

Route::get('grid/{id}', function ($id) {
    session(['isgrid' => $id]);
    // dd(session('isgrid'));
    return redirect()->back();
})->name('grid');

Route::get('/', [
    'uses' => 'HomeController@home',
    'as' => 'public.home'
]);

Route::get('/search', [
    'uses' => 'HomeController@search',
    'as' => 'public.search'
]);

Route::get('/home1', [
    'uses' => 'HomeController@home1',
    'as' => 'public.home1'
]);

Route::get('/home', function(){
    return redirect()->route('public.home');
});

Route::get('/about', [
    'uses' => 'HomeController@about',
    'as' => 'public.about'
]);

Route::get('/ctnc', [
    'uses' => 'HomeController@ctnc',
    'as' => 'public.ctnc'
]);

Route::get('/vtnc', [
    'uses' => 'HomeController@ctnc',
    'as' => 'public.ctnc'
]);

Route::get('/pp', [
    'uses' => 'HomeController@pp',
    'as' => 'public.pp'
]);

Route::get('/contact', [
    'uses' => 'HomeController@contact',
    'as' => 'public.contact'
]);
Route::get('/shops', [
    'uses' => 'HomeController@shops',
    'as' => 'shops'
]);

Route::get('/shop-by-category/{id}', [
    'uses' => 'HomeController@category',
    'as' => 'shop-by-category'
]);

Route::get('/latest/', [
    'uses' => 'HomeController@latest',
    'as' => 'latest'
]);


Route::get('/product/{id}', [
    'uses' => 'HomeController@productDetail',
    'as' => 'product.detail'
]);

Route::post('product/stock/get/', [
    'uses' => 'HomeController@getStock',
    'as' => 'product.stock'
]);

Route::match(['get', 'post'], '/cart', [
    'as' => 'public.cart',
    'uses' => 'user\CartController@addProduct'
]);
Route::match(['get', 'post'], '/getcart', [
    'as' => 'public.getcart',
    'uses' => 'user\CartController@getProduct'
]);
Route::match(['get', 'post'], '/viewcart', [
    'as' => 'public.viewcart',
    'uses' => 'user\CartController@viewCart'
]);


Route::get('shipping/charge/{p_id}/{d_id}/{m_id}/{shipping_area_id}', 'user\CheckoutController@getShippingCharge');
Route::get('remove/feature/item/{id}', 'user\CartController@cartFeatureItemRemove');
Route::get('cart/update-qty/{id}/{qty}', 'user\CartController@updateQtyOfCartItem');
Route::get('remove/cart/item/{id}', 'user\CartController@cartItemRemove');

// Route::match(['get', 'post'], '/checkout', [
//     'as' => 'public.checkout',
//     'uses' => 'user\CartController@checkout'
// ]);

Route::match(['get', 'post'], '/checkout', [
    'as' => 'public.checkout',
    'uses' => 'user\CheckoutController@checkout'
]);

Route::match(['get', 'post'], '/checkout-as-a-guest', [
    'as' => 'guest.checkout',
    'uses' => 'user\CartController@guestCheckout'
]);

Route::match(['get', 'post'], '/apply-coupon', [
    'as' => 'apply.coupon',
    'uses' => 'user\CartController@applyCoupon'
]);

//collections

Route::match(['get', 'post'], '/collection-product', [
    'as' => 'public.collection',
    'uses' => 'CommonController@collectionProduct'
]);

Route::match(['get', 'post'], '/collection-product/{id}', [
    'as' => 'collection.detail',
    'uses' => 'CommonController@collectionProductDetail'
]);

Route::match(['get', 'post'], '/sale-product', [
    'as' => 'public.sale',
    'uses' => 'CommonController@saleProduct'
]);

Route::match(['get', 'post'], '/sale-product/{id}', [
    'as' => 'public.sale.detail',
    'uses' => 'CommonController@saleProductDetail'
]);
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function () {
    Route::get('/', [
        'as' => 'admin',
        'uses' => 'admin\LoginController@index'
    ]);
    Route::get('login', [
        'as' => 'admin.getlogin',
        'uses' => 'admin\LoginController@showLoginForm'
    ]);
    Route::post('login', [
        'as' => 'admin.postlogin',
        'uses' => 'admin\LoginController@login'
    ]);
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {


    Route::match(['GET', 'POST'], 'popup-info', 'PopupController@popupBoxInfo')->name('popup.info');

    Route::match(['get', 'post'], 'dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'admin\DashboardController@index'
    ]);
    Route::get('logout', [
        'as' => 'admin.logout',
        'uses' => 'admin\LoginController@logout'
    ]);
    Route::match(['get', 'post'], 'add-category', [
        'as' => 'admin.add-category',
        'uses' => 'admin\CategoryController@addCategory'
    ]);
    Route::get('del-category/{cat}', 'admin\CategoryController@delCategory')->name('admin.del-category');
    Route::match(['get', 'post'], 'manage-category', [
        'as' => 'admin.manage-category',
        'uses' => 'admin\CategoryController@manageCategory'
    ]);
    Route::match(['get', 'post'], '/edit-category/{id}', [
        'as' => 'admin.edit-category',
        'uses' => 'admin\CategoryController@editCategory'
    ]);

    Route::match(['get', 'post'], '/edit-category1/{id}', [
        'as' => 'admin.edit-category1',
        'uses' => 'admin\CategoryController@editCategory1'
    ]);

    Route::get('manage-category1','admin\CategoryController@manageCategory1' )->name('admin.manage-category1');
    Route::get('manage-subcategory/{id}','admin\CategoryController@subcategory' )->name('admin.manage-subcategory');
    Route::post('add-category1','admin\CategoryController@addcategory1' )->name('admin.add-category1');

    Route::match(['get', 'post'], '/update-category', [
        'as' => 'admin.update-category',
        'uses' => 'admin\CategoryController@updateCategory'
    ]);
    Route::match(['get', 'post'], '/manage-attribute-group', [
        'as' => 'admin.manage-attribute-group',
        'uses' => 'admin\AttributegroupController@manageAttributegroup'
    ]);
    Route::match(['get', 'post'], '/add-attribute-group', [
        'as' => 'admin.add-attribute-group',
        'uses' => 'admin\AttributegroupController@addAttributegroup'
    ]);
    Route::match(['get', 'post'], '/edit-attribute-group', [
        'as' => 'admin.edit-attribute-group',
        'uses' => 'admin\AttributegroupController@editAttributegroup'
    ]);
    Route::match(['get', 'post'], '/delete-attribute-group', [
        'as' => 'admin.delete-attribute-group',
        'uses' => 'admin\AttributegroupController@deleteAttributegroup'
    ]);
    Route::match(['get', 'post'], '/manage-attributes/{group}', [
        'as' => 'admin.manage-attributes',
        'uses' => 'admin\AttributeController@manageAttribute'

    ]);
    Route::match(['get', 'post'], '/add-attribute', [
        'as' => 'admin.add-attribute',
        'uses' => 'admin\AttributeController@addAttribute'
    ]);
    Route::match(['get', 'post'], '/delete-attribute', [
        'as' => 'admin.delete-attribute',
        'uses' => 'admin\AttributeController@deleteAttribute'
    ]);
    Route::match(['get', 'post'], '/edit-attribute', [
        'as' => 'admin.edit-attribute',
        'uses' => 'admin\AttributeController@editAttribute'
    ]);
    Route::match(['get', 'post'], '/add-brand', [
        'as' => 'admin.add-brand',
        'uses' => 'admin\BrandController@addBrand'
    ]);
    Route::match(['get', 'post'], '/manage-brand', [
        'as' => 'admin.manage-brand',
        'uses' => 'admin\BrandController@manageBrand'
    ]);
    Route::match(['get', 'post'], '/delete-brand', [
        'as' => 'admin.delete-brand',
        'uses' => 'admin\BrandController@deleteBrand'
    ]);
    Route::match(['get', 'post'], '/edit-brand', [
        'as' => 'admin.edit-brand',
        'uses' => 'admin\BrandController@editBrand'
    ]);
    Route::match(['get', 'post'], 'add-product', [
        'as' => 'admin.add-product',
        'uses' => 'admin\ProductController@addProduct'
    ]);
    Route::match(['get', 'post'], 'manage-product', [
        'as' => 'admin.manage-product',
        'uses' => 'admin\ProductController@manageProduct'
    ]);
    Route::match(['get', 'post'], 'edit-product/{id}', [
        'as' => 'admin.edit-product',
        'uses' => 'admin\ProductController@editProduct'
    ]);
    Route::match(['get', 'post'], '/get-attribute', [
        'uses' => 'admin\ProductController@getAttribute'
    ]);
    Route::match(['get', 'post'], '/create-product', [
        'as' => 'admin.create-product',
        'uses' => 'admin\ProductController@createProduct'
    ]);
    Route::match(['get', 'post'], '/view-product/{id}', [
        'as' => 'admin.view-product',
        'uses' => 'admin\ProductController@viewProduct'
    ]);
    Route::match(['get', 'post'], '/manage-collection', [
        'as' => 'admin.manage-collection',
        'uses' => 'admin\CollectionController@manageCollection'
    ]);
    Route::match(['get', 'post'], '/add-collection', [
        'as' => 'admin.add-collection',
        'uses' => 'admin\CollectionController@addCollection'
    ]);
    Route::match(['get', 'post'], '/edit-collection', [
        'as' => 'admin.edit-collection',
        'uses' => 'admin\CollectionController@editCollection'
    ]);
    Route::match(['get', 'post'], '/delete-collection', [
        'as' => 'admin.delete-collection',
        'uses' => 'admin\CollectionController@deleteCollection'
    ]);
    Route::match(['get', 'post'], '/collection-products', [
        'as' => 'admin.collection-products',
        'uses' => 'admin\CollectionController@collectionProducts'
    ]);
    Route::get('/collection-product/{id}', [
        'as' => 'admin.collection-product',
        'uses' => 'admin\CollectionController@collectionProduct'
    ]);
    Route::match(['get', 'post'], '/get-category-products', [
        'as' => 'admin.get-category-products',
        'uses' => 'admin\ProductController@getcategoryProduct'
    ]);
    Route::match(['get', 'post'], '/add-collection-products', [
        'as' => 'admin.add-collection-products',
        'uses' => 'admin\Collection_productController@addCollectionproducts'
    ]);
    Route::match(['get', 'post'], '/edit-collection-products/{id}', [
        'as' => 'admin.edit-collection-products',
        'uses' => 'admin\Collection_productController@editCollectionproduct'
    ]);
    Route::match(['get', 'post'], '/delete-collection-product', [
        'as' => 'admin.delete-collection-product',
        'uses' => 'admin\Collection_productController@deleteCollectionproduct'
    ]);
    Route::match(['get', 'post'], '/manage-sales', [
        'as' => 'admin.manage-sales',
        'uses' => 'admin\OnsellController@manageSell'
    ]);
    Route::match(['get', 'post'], '/add-sales', [
        'as' => 'admin.add-sales',
        'uses' => 'admin\OnsellController@addSell'
    ]);
    Route::match(['get', 'post'], '/delete-sale', [
        'as' => 'admin.delete-sale',
        'uses' => 'admin\OnsellController@deleteSell'
    ]);
    Route::match(['get', 'post'], '/update-sale', [
        'as' => 'admin.update-sale',
        'uses' => 'admin\OnsellController@updateSell'
    ]);
    Route::match(['get', 'post'], '/sale-products', [
        'as' => 'admin.sale-products',
        'uses' => 'admin\OnsellController@saleProducts'
    ]);
    Route::match(['get', 'post'], '/get-sale-category-product', [
        'as' => 'admin.get-sale-category-product',
        'uses' => 'admin\ProductController@getsellProduct'
    ]);
    Route::match(['get', 'post'], '/add-sale-products/{id}', [
        'as' => 'admin.add-sale-products',
        'uses' => 'admin\OnsellController@addsaleProducts'
    ]);
    Route::match(['get', 'post'], '/edit-sale-products/{id}', [
        'as' => 'admin.edit-sale-products',
        'uses' => 'admin\Sell_productController@editsaleProduct'
    ]);
    Route::match(['get', 'post'], '/create-sale-products', [
        'as' => 'admin.create-sale-products',
        'uses' => 'admin\Sell_productController@createsellProduct'
    ]);
    Route::match(['get', 'post'], '/delete-sale-product', [
        'as' => 'admin.delete-sale-product',
        'uses' => 'admin\Sell_productController@deletesellProduct'
    ]);
    Route::match(['get', 'post'], '/add-slider', [
        'as' => 'admin.add-slider',
        'uses' => 'admin\SliderController@addSlider'
    ]);
    Route::match(['get', 'post'], '/insert-slider', [
        'as' => 'admin.insert-slider',
        'uses' => 'admin\SliderController@insertSlider'
    ]);
    Route::match(['get', 'post'], '/manage-menu', [
        'as' => 'admin.manage-menu',
        'uses' => 'admin\MenuController@manageMenu'
    ]);
    Route::match(['get', 'post'], '/add-menu', [
        'as' => 'admin.add-menu',
        'uses' => 'admin\MenuController@addMenu'
    ]);
    Route::match(['get', 'post'], '/del-menu/{menu}', [
        'as' => 'admin.del-menu',
        'uses' => 'admin\MenuController@delMenu'
    ]);
    Route::match(['get', 'post'], '/update-menu/{menu}', [
        'as' => 'admin.update-menu',
        'uses' => 'admin\MenuController@updateMenu'
    ]);
    Route::match(['get', 'post'], '/create-contactinfo', [
        'as' => 'admin.create-contactinfo',
        'uses' => 'admin\ContactinfoController@createContactinfo'
    ]);
    Route::match(['get', 'post'], '/add-contactinfo', [
        'as' => 'admin.add-contactinfo',
        'uses' => 'admin\ContactinfoController@addContactinfo'
    ]);
    Route::match(['get', 'post'], '/vendor-list', [
        'as' => 'admin.vendor-list',
        'uses' => 'admin\VendorController@getVendor'
    ]);
    Route::match(['get', 'post'], '/manage-coupon', [
        'as' => 'admin.manage-coupon',
        'uses' => 'admin\CouponController@manageCoupon'
    ]);
    Route::match(['get', 'post'], '/add-coupon', [
        'as' => 'admin.add-coupon',
        'uses' => 'admin\CouponController@addCoupon'
    ]);
    Route::match(['get', 'post'], '/insert-coupon', [
        'as' => 'admin.insert-coupon',
        'uses' => 'admin\CouponController@insertCoupon'
    ]);
    Route::match(['get', 'post'], '/setfeatured', [
        'as' => 'admin.setfeatured',
        'uses' => 'admin\ProductController@setFeature'
    ]);
    Route::match(['get', 'post'], '/setverified', [
        'as' => 'admin.setverified',
        'uses' => 'admin\VendorController@setVerified'
    ]);
    Route::match(['get', 'post'], '/vendor-details/{id}', [
        'as' => 'admin.vendor-details',
        'uses' => 'admin\VendorController@vendorDetails'
    ]);
    Route::match(['get', 'post'], '/vendor-status/{id}/status/{status}', [
        'as' => 'admin.vendor-status',
        'uses' => 'admin\VendorController@status'
    ]);

    Route::match(['get', 'post'], '/vendor-verification/{id}/verification/{status}', [
        'as' => 'admin.vendor-verification',
        'uses' => 'admin\VendorController@verification'
    ]);

    Route::post('/message', 'admin\VendorController@message')->name('admin.vendor-message');

    Route::match(['get', 'post'], '/manage-tag', [
        'as' => 'admin.manage-tag',
        'uses' => 'admin\TagController@manageTags'
    ]);
    Route::match(['get', 'post'], '/add-tag', [
        'as' => 'admin.add-tag',
        'uses' => 'admin\TagController@addTag'
    ]);
    Route::match(['get', 'post'], '/delete-tag', [
        'as' => 'admin.delete-tag',
        'uses' => 'admin\TagController@deleteTag'
    ]);
    Route::match(['get', 'post'], '/update-tag', [
        'as' => 'admin.update-tag',
        'uses' => 'admin\TagController@updateTag'
    ]);

    Route::match(['get', 'post'], '/about', [
        'as' => 'admin.about',
        'uses' => 'admin\DashboardController@about'
    ]);
    Route::match(['get', 'post'], '/tnc', [
        'as' => 'admin.tnc',
        'uses' => 'admin\DashboardController@tnc'
    ]);

    

    //shipping settings
    Route::get('/shippings', 'admin\ShippingController@list')->name('admin.shippings');
    Route::get('/get-shipping/{id}', 'admin\ShippingController@get_shipping')->name('admin.get-shipping');
    Route::post('/shippings/add', 'admin\ShippingController@add')->name('admin.shipping-add');
    Route::post('/shippings/update/{shipping}', 'admin\ShippingController@update')->name('admin.shipping-update');
    Route::post('/shippings/{shipping}/status/{status}', 'admin\ShippingController@status')->name('admin.shipping-status');
    Route::get('/shippings/manage/{shipping}', 'admin\ShippingController@manage')->name('admin.shipping-manage');
    Route::get('/shippings/manage/{shipping}/category/{category}', 'admin\ShippingController@manage_category')->name('admin.shipping-manage-category');

    Route::post('/shippings/weight', 'admin\ShippingController@weight')->name('admin.shipping-weight');
    Route::post('/shippings/weight/update/{wc}', 'admin\ShippingController@weight_update')->name('admin.shipping-weight-update');
    Route::post('/shippings/weight/del/{wc}', 'admin\ShippingController@weight_del')->name('admin.shipping-weight-del');
    Route::get('/shippings/weight/add', 'admin\ShippingController@manage')->name('admin.shipping-weight-add');
    Route::get('/shippings/weight/price', 'admin\ShippingController@manage')->name('admin.shipping-weight-add');

    Route::get('/shippings/weight-type', 'admin\ShippingController@weight_type')->name('admin.weight-type');
    Route::post('/shippings/weight-type/add', 'admin\ShippingController@weight_type_add')->name('admin.weight-type-add');
    Route::post('/shippings/weight-type/del/{type}', 'admin\ShippingController@weight_type_del')->name('admin.weight-type-del');
    Route::post('/shippings/weight-type/update/{type}', 'admin\ShippingController@weight_type_update')->name('admin.weight-type-update');


    Route::get('/shipping-zones', 'admin\ShippingController@zones')->name('admin.shipping-zones');
    Route::post('/shipping-zones-add', 'admin\ShippingController@zones_add')->name('admin.shipping-zones-add');
    Route::post('/shipping-zones-del', 'admin\ShippingController@zones_del')->name('admin.shipping-zones-del');
    Route::post('/shipping-zones-update', 'admin\ShippingController@zones_update')->name('admin.shipping-zones-update');

    //charges setting
    Route::get('closingcharges/{category}', 'admin\ChargesController@closingcharges')->name('admin.closingcharges');
    Route::post('closingcharges/add/{category}', 'admin\ChargesController@closingcharges_add')->name('admin.closingcharges-add');
    Route::post('closingcharges/update/{charge}', 'admin\ChargesController@closingcharges_update')->name('admin.closingcharges-update');
    Route::post('closingcharges/del/{charge}', 'admin\ChargesController@closingcharges_del')->name('admin.closingcharges-del');

    //Packaging Charge
    Route::get('packaging', 'admin\ChargesController@packaging')->name('admin.packaging');
    Route::post('packaging/add', 'admin\ChargesController@packaging_add')->name('admin.packaging-add');
    Route::post('packaging/update/{packaging}', 'admin\ChargesController@packaging_update')->name('admin.packaging-update');
    Route::post('packaging/del/{packaging}', 'admin\ChargesController@packaging_del')->name('admin.packaging-del');
    //product gallery image
    Route::get('product-image/del/{image}', 'admin\ProductimageController@del');
    Route::post('product-image/add/{pid}', 'admin\ProductimageController@add');
    //variant product manager
    Route::post('product-attribute/add/{pid}', 'admin\VariantController@add');
    Route::get('product-attribute/del/{aid}', 'admin\VariantController@del');
    Route::post('product-attribute-item/add/{aid}', 'admin\VariantController@add_item');
    Route::get('product-attribute-item/del/{aiid}', 'admin\VariantController@del_item');
    Route::post('product-stock/add/{pid}', 'admin\VariantController@add_Stock');
    Route::post('product-stock/update/{stock}', 'admin\VariantController@update_Stock');
    Route::post('product-simple/stock/{product}', 'admin\VariantController@simple_stock')->name('admin.simpe-stock');

    Route::post('product-admin-charge/{product}', 'admin\VariantController@admin_charge')->name('admin.admin-charge');
    //product shipping manager
    Route::post('product-shipping/{product}', 'admin\VariantController@product_shipping');
    Route::post('product-option/{product}', 'admin\VariantController@product_option');
    Route::get('product-verify/{product}/status/{status}', 'admin\VariantController@product_verify');
    Route::post('product-shipping-price', 'admin\VariantController@product_shipping_price')->name('admin.product-shipping-price');

    //product Extra charges
    Route::post('product-extracharge', 'admin\VariantController@product_extracharge')->name('admin.product-extracharge');
    Route::post('product-extracharge/update/{extracharge}', 'admin\VariantController@product_extracharge_update')->name('admin.product-extracharge-update');
    Route::post('product-extracharge/{extracharge}/status/{status}', 'admin\VariantController@product_extracharge_status')->name('admin.product-extracharge-status');

    Route::post('product/update/{product}', 'admin\ProductController@update')->name('admin.update-product');


    //Store Shipping Address
    Route::match(['get', 'post'], '/shipping', [
        'as' => 'admin.store-shipping',
        'uses' => 'admin\DashboardController@shipping'
    ]);
    // blog routes
    Route::get('blogs', 'BlogController@index');
    Route::post('blog/store', 'BlogController@store')->name('blog.store');
    Route::match(['GET', 'POST'], 'blog/edit/{id}', 'BlogController@blogEdit')->name('blog.edit');
    Route::get('blog/delete/{id}', 'BlogController@blogDelete')->name('blog.delete');

    // footer head and link
    Route::get('footer-head', 'FooterheadController@index');
    Route::post('footer-head/{id}', 'FooterheadController@update')->name('header.update');
    Route::post('footer-link', 'FooterheadController@footerLinkStore')->name('link.store');
    Route::get('footer-link-delete/{id}', 'FooterheadController@footerLinkDelete')->name('link.delete');


});

// Route::group(['prefix'=>'user','middleware'=>'guest'],function(){
//   Route::get('register',[
// 		'uses'=>'user\Auth\RegisterController@getRegister',
// 		'as'=>'user.getRegister'
// 	]);
// 	Route::post('register',[
// 		'uses'=>'user\Auth\RegisterController@postRegister',
// 		'as'=>'user.postRegister'
// 	]);
// 	Route::get('auth/register/activate/{token}',[
// 		'uses'=>'user\Auth\LoginController@signupActivate',
// 		'as'=>'user.signupActivate'
// 	]);
// 	Route::get('login',[
// 		'uses'=>'user\Auth\RegisterController@getRegister',
// 		'as'=>'user.getLogin'
// 	]);
// 	Route::post('login',[
// 		'uses'=>'user\Auth\LoginController@postLogin',
// 		'as'=>'user.postLogin'
//     ]);
//     Route::get('auth/resend-verification',[
// 		'as' => 'user.resend_verification',
// 	    'uses' => 'user\Auth\RegisterController@resend'
// 	]);

// });

// Route::group(['prefix'=>'user','middleware'=>['authen','type'],'type'=>['user']],function(){
// 	Route::get('logout',[
// 		'uses'=>'user\Auth\LoginController@getLogout',
// 		'as'=>'user.getLogout'
// 	]);
// 	Route::get('profile',[
// 		'uses'=>'user\DashboardController@index',
// 		'as'=>'user.profile'
//     ]);
//     Route::match(['get', 'post'], 'order', [
//         'uses' => 'user\DashboardController@recentOrder',
//         'as' => 'user.order'
//     ]);
//     Route::match(['get', 'post'], 'cancelled-order', [
//         'uses' => 'user\DashboardController@cancelOrder',
//         'as' => 'user.cancelled-order'
//     ]);
//     Route::post('review', [
//         'uses' =>'ReviewController@addReview',
//         'as' => 'user.review'
//     ]);
// 	Route::post('profile/update',[
// 		'uses'=>'user\DashboardController@updateProfile',
// 		'as'=>'user.update_profile'
// 	]);
// 	Route::match(['get', 'post'], '/checkout', [
//         'uses' => 'user\CheckoutController@index',
//         'as' => 'user.checkout'
//     ]);
//     Route::match(['get', 'post'], '/postcheckout', [
//         'uses' => 'user\CheckoutController@postCheckout',
//         'as' => 'user.postcheckout'
//     ]);

// });


Route::group(['prefix' => 'user', 'middleware' => 'guest'], function () {
    Route::get('register', [
        'uses' => 'user\Auth\RegisterController@getRegister',
        'as' => 'user.getRegister'
    ]);
    Route::post('register', [
        'uses' => 'user\Auth\RegisterController@postRegister',
        'as' => 'user.postRegister'
    ]);
    Route::get('auth/register/activate/{token}', [
        'uses' => 'user\Auth\LoginController@signupActivate',
        'as' => 'user.signupActivate'
    ]);
    Route::get('login', [
        'uses' => 'user\Auth\RegisterController@getRegister',
        'as' => 'user.getLogin'
    ]);
    Route::post('login', [
        'uses' => 'user\Auth\LoginController@postLogin',
        'as' => 'user.postLogin'
    ]);
    Route::get('auth/resend-verification', [
        'as' => 'user.resend_verification',
        'uses' => 'user\Auth\RegisterController@resend'
    ]);
});

Route::group(['prefix' => 'user', 'middleware' => ['authen', 'type'], 'type' => ['user']], function () {
    Route::get('logout', [
        'uses' => 'user\Auth\LoginController@getLogout',
        'as' => 'user.getLogout'
    ]);

    Route::get('dashboard', [
        'uses' => 'user\DashboardController@dashboard',
        'as' => 'user.account'
    ]);

    Route::match(['get', 'post'], 'account-detail', [
        'uses' => 'user\DashboardController@accountDetail',
        'as' => 'account.detail'
    ]);


    Route::get('profile', [
        'uses' => 'user\DashboardController@index',
        'as' => 'user.profile'
    ]);

    Route::match(['get', 'post'], 'order', [
        'uses' => 'user\DashboardController@recentOrder',
        'as' => 'user.order'
    ]);

    Route::match(['get', 'post'], 'order/item/{id}', [
        'uses' => 'user\DashboardController@orderItem',
        'as' => 'user.order.item'
    ]);

    Route::match(['get', 'post'], 'full/order/{shipping_detail_id}', [
        'uses' => 'user\DashboardController@fullOrderDetail',
        'as' => 'user.full.order'
    ]);


    Route::match(['get', 'post'], 'cancelled-order', [
        'uses' => 'user\DashboardController@cancelOrder',
        'as' => 'user.cancelled-order'
    ]);
    Route::post('review', [
        'uses' => 'ReviewController@addReview',
        'as' => 'user.review'
    ]);
    Route::post('profile/update', [
        'uses' => 'user\DashboardController@updateProfile',
        'as' => 'user.update_profile'
    ]);

    Route::match(['get', 'post'], '/checkout', [
        'uses' => 'user\CheckoutController@index',
        'as' => 'user.checkout'
    ]);

    Route::match(['get', 'post'], '/postcheckout', [
        'uses' => 'user\CheckoutController@postCheckout',
        'as' => 'user.postcheckout'
    ]);

    Route::match(['get', 'post'], '/wishlist', [
        'uses' => 'user\DashboardController@wishlist',
        'as' => 'user.wishlist.page'
    ]);

    Route::match(['get', 'post'], '/wishlist/{product_id}', [
        'uses' => 'user\DashboardController@wishlistProduct',
        'as' => 'user.wishlist'
    ]);

    Route::match(['get', 'post'], '/wishlist/remove/{id}', [
        'uses' => 'user\DashboardController@wishlistProductRemove',
        'as' => 'user.wishlist.remove'
    ]);

    Route::match(['get', 'post'], '/ratings', [
        'uses' => 'user\DashboardController@userRatings',
        'as' => 'user.ratings'
    ]);
});

Route::group(['prefix' => 'vendor', 'middleware' => 'guest'], function () {
    Route::get('register', [
        'uses' => 'Vendor\Auth\RegisterController@getRegister',
        'as' => 'vendor.getRegister'
    ]);
    Route::post('register', [
        'uses' => 'Vendor\Auth\RegisterController@postRegister',
        'as' => 'vendor.postRegister'
    ]);
    Route::get('login', [
        'uses' => 'Vendor\Auth\LoginController@getLogin',
        'as' => 'vendor.getLogin'
    ]);
    Route::post('login', [
        'uses' => 'Vendor\Auth\LoginController@postLogin',
        'as' => 'vendor.postLogin'
    ]);
    Route::get('auth/register/activate/{token}', [
        'uses' => 'Vendor\Auth\LoginController@signupActivate',
        'as' => 'vendor.signupActivate'
    ]);
    Route::get('auth/resend-verification', [
        'as' => 'vendor.resend_verification',
        'uses' => 'Vendor\Auth\RegisterController@resend'
    ]);
});


Route::group(['prefix' => 'vendor', 'middleware' => ['authen', 'type'], 'type' => ['vendor']], function () {
    Route::get('logout', [
        'uses' => 'Vendor\Auth\LoginController@getLogout',
        'as' => 'vendor.getLogout'
    ]);
    Route::match(['get', 'post'], '/edit-profile/{id}', [
        'as' => 'vendor.edit-profile',
        'uses' => 'Vendor\ProfileController@editProfile'
    ]);
    Route::match(['get', 'post'], '/update-profile', [
        'as' => 'vendor.update-profile',
        'uses' => 'Vendor\ProfileController@updateProfile'
    ]);
    Route::match(['get', 'post'], '/setting', [
        'as' => 'vendor.setting',
        'uses' => 'Vendor\ProfileController@changePassword'
    ]);
    Route::match(['get', 'post'], '/matchpassword', [
        'as' => 'vendor.matchpassword',
        'uses' => 'Vendor\ProfileController@matchPassword'
    ]);
    Route::match(['get', 'post'], '/update-password', [
        'as' => 'vendor.update-password',
        'uses' => 'Vendor\ProfileController@updatePassword'
    ]);
    Route::get('dashboard', [
        'uses' => 'Vendor\DashBoardController@index',
        'as' => 'vendor.dashboard'
    ]);
    Route::match(['get', 'post'], '/add-product', [
        'as' => 'vendor.add-product',
        'uses' => 'Vendor\ProductController@addProduct'
    ]);
    Route::match(['get', 'post'], '/create-product', [
        'as' => 'vendor.create-product',
        'uses' => 'Vendor\ProductController@createProduct'
    ]);
    Route::match(['get', 'post'], '/manage-product', [
        'as' => 'vendor.manage-product',
        'uses' => 'Vendor\ProductController@manageProduct'
    ]);
    Route::match(['get', 'post'], '/view-product/{id}', [
        'as' => 'vendor.view-product',
        'uses' => 'vendor\ProductController@viewProduct'
    ]);
    Route::match(['get', 'post'], '/get-attribute', [
        'as' => 'vendor.get-attribute',
        'uses' => 'Vendor\ProductController@getAttribute'
    ]);
    Route::match(['get', 'post'], '/get-profile', [
        'as' => 'vendor.get-profile',
        'uses' => 'Vendor\ProfileController@getProfile'
    ]);
    Route::match(['get', 'post'], '/manage-coupon', [
        'as' => 'vendor.manage-coupon',
        'uses' => 'Vendor\CouponController@manageCoupon'
    ]);
    Route::match(['get', 'post'], '/add-coupon', [
        'as' => 'vendor.add-coupon',
        'uses' => 'Vendor\CouponController@addCoupon'
    ]);
    Route::match(['get', 'post'], '/insert-coupon', [
        'as' => 'vendor.insert-coupon',
        'uses' => 'Vendor\CouponController@insertCoupon'
    ]);
    Route::match(['get', 'post'], '/sale-products', [
        'as' => 'vendor.sale-products',
        'uses' => 'Vendor\OnsellController@sellProducts'

    ]);
    Route::match(['get', 'post'], '/add-sale-products/{id}', [
        'as' => 'vendor.add-sale-products',
        'uses' => 'Vendor\OnsellController@addProducts'
    ]);
    Route::match(['get', 'post'], '/edit-sale-products/{id}', [
        'as' => 'vendor.edit-sale-products',
        'uses' => 'Vendor\Sell_productController@editProduct'
    ]);
    Route::match(['get', 'post'], '/get-category-products', [
        'as' => 'vendor.get-category-products',
        'uses' => 'Vendor\ProductController@getcategoryProduct'
    ]);

    Route::match(['get', 'post'], '/step-1', [
        'as' => 'vendor.step-1',
        'uses' => 'Vendor\Auth\SetupController@step1'
    ]);
    Route::match(['get', 'post'], '/step-2', [
        'as' => 'vendor.step-2',
        'uses' => 'Vendor\Auth\SetupController@step2'
    ]);
    Route::match(['get', 'post'], '/step-3', [
        'as' => 'vendor.step-3',
        'uses' => 'Vendor\Auth\SetupController@step3'
    ]);

    Route::get('step-3/addlater', 'Vendor\Auth\SetupController@addlater')->name('vendor.step-3.skip');
    Route::get('launch', 'Vendor\Auth\SetupController@launch')->name('vendor.launch');

    Route::match(['get', 'post'], '/shipping', [
        'as' => 'vendor.shipping',
        'uses' => 'Vendor\ProfileController@shipping'
    ]);
    Route::match(['get', 'post'], '/verification', [
        'as' => 'vendor.verification',
        'uses' => 'Vendor\ProfileController@verification'
    ]);

    //product gallery image
    Route::get('product-image/del/{image}', 'vendor\ProductimageController@del');
    Route::post('product-image/add/{pid}', 'vendor\ProductimageController@add');
    //variant product manager
    Route::post('product-attribute/add/{pid}', 'vendor\VariantController@add');
    Route::get('product-attribute/del/{aid}', 'vendor\VariantController@del');
    Route::post('product-attribute-item/add/{aid}', 'vendor\VariantController@add_item');
    Route::get('product-attribute-item/del/{aiid}', 'vendor\VariantController@del_item');
    Route::post('product-stock/add/{pid}', 'vendor\VariantController@add_Stock');
    Route::post('product-stock/update/{stock}', 'vendor\VariantController@update_Stock');
    Route::post('simple-stock/{product}', 'Vendor\VariantController@simple_Stock')->name('vendor.simple-stock');

    Route::post('product-shipping/{product}', 'Vendor\VariantController@product_shipping');
    Route::post('product-option/{product}', 'Vendor\VariantController@product_option');

    Route::post('product/update/{product}', 'Vendor\ProductController@update')->name('vendor.update-product');

    //extracharge
    //product Extra charges
    Route::post('product-extracharge', 'Vendor\VariantController@product_extracharge')->name('vendor.product-extracharge');
    Route::post('product-extracharge/update/{extracharge}', 'Vendor\VariantController@product_extracharge_update')->name('vendor.product-extracharge-update');
    Route::post('product-extracharge/{extracharge}/status/{status}', 'Vendor\VariantController@product_extracharge_status')->name('vendor.product-extracharge-status');

    Route::post('/message/seen/{message}', 'Vendor\DashBoardController@message')->name('vendor.markread-message');
    Route::get('/messages', 'Vendor\DashBoardController@messages')->name('vendor.messages');
});

//Password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('fpass');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/success', 'Auth\ResetPasswordController@success')->name('reset.send');
Route::get('password/success/message', 'HomeController@success')->name('reset.success');




//homepage setting
Route::group(['prefix' => 'admin/element', 'middleware' => 'admin_auth'], function () {
    Route::get('', 'Elements\ElementController@index')->name('elements');
    Route::post('/add', 'Elements\ElementController@add')->name('elements.add');
    Route::get('/del/{section}', 'Elements\ElementController@del')->name('elements.del');
    Route::post('/edit', 'Elements\ElementController@edit')->name('elements.edit');
    Route::get('/manage/{section}', 'Elements\ElementController@manage')->name('elements.manage');

    //sliders
    Route::get('/slider/add/{group}', 'Elements\SliderController@add')->name('elements.add-slider');
    Route::post('/slider/save/{group}', 'Elements\SliderController@save')->name('elements.save-slider');
    Route::post('/slider/del/{slider}', 'Elements\SliderController@del')->name('elements.del-slider');
    Route::get('/slider/edit/{slider}', 'Elements\SliderController@edit')->name('elements.edit-slider');
    Route::post('/slider/update/{slider}', 'Elements\SliderController@update')->name('elements.update-slider');

    //ad

    Route::post('/ad/save/{section}', 'Elements\AdController@save')->name('elements.save-ad');
    Route::post('/category/save/{section}', 'Elements\AdController@saveCategory')->name('elements.save-category');

    //boxeditem
    Route::post('/boxed/add/{section}', 'Elements\AdController@saveBoxed')->name('elements.save-boxed');
    Route::post('/boxed/update/{item}', 'Elements\AdController@updateBoxed')->name('elements.update-boxed');
    Route::get('/boxed/del/{item}', 'Elements\AdController@delBoxed')->name('elements.del-boxed');
});

//admin ordermanagement
Route::group(['prefix' => 'admin/orders', 'middleware' => 'admin_auth'], function () {
    Route::get('/{status}', 'admin\order\OrderController@index')->name('admin.orders');
    Route::get('/{status}/flash/{id}', 'admin\order\OrderController@flash')->name('admin.orders-flash');

    Route::post('/status/{status}', 'admin\order\OrderController@status')->name('admin.set-status');

    Route::get('/data/receipt','admin\order\OrderController@receipt')->name('admin.receit');


    Route::get('/data/pickup', 'admin\order\WarehouseController@index')->name('admin.orders-pickup');

    Route::post('/data/pickup/load', 'admin\order\WarehouseController@load')->name('admin.load-pickup');
    Route::post('/data/pickup/pickup', 'admin\order\WarehouseController@pickup')->name('admin.pickup-pickup');
    Route::get('/data/pickup/picked', 'admin\order\WarehouseController@picked')->name('admin.pickup-pickup');


    //sendtodelivery
    Route::get('/data/delivery', 'admin\order\WarehouseController@delivery')->name('admin.orders-delivery');
    Route::post('/data/delivery/load', 'admin\order\WarehouseController@loadDelivery')->name('admin.orders-load-delivery');
    Route::post('/data/ondeliver', 'admin\order\WarehouseController@ondelivery')->name('admin.orders-ondelivery');
    
    Route::get('/data/trips', 'admin\order\WarehouseController@trips')->name('admin.orders-trips');
    Route::get('/data/trip/{id}', 'admin\order\WarehouseController@trip')->name('admin.orders-trip');
    Route::get('/data/print/single/{shipping}', 'admin\order\WarehouseController@singlePrint')->name('admin.orders-singlePrint');
    Route::get('/data/print/trip/{id}', 'admin\order\WarehouseController@tripPrint')->name('admin.orders-tripPrint');
    Route::post('/data/print/multiple', 'admin\order\WarehouseController@multiplePrint')->name('admin.orders-multiplePrint');
    

    
});

Route::group(['prefix' => 'admin/account', 'middleware' => 'admin_auth'], function () {
    Route::get('', 'admin\AccountController@index')->name('admin.account');
    Route::get('/withdrawl/{id}', 'admin\AccountController@withdrawl')->name('admin.withdrawl');
    Route::post('/save/withdrawl/{id}', 'admin\AccountController@saveWithdrawl')->name('admin.savewithdrawl');

    Route::post('/withdrawl1/{id}', 'admin\AccountController@withdrawl1')->name('admin.withdrawl1');
    Route::post('/save/withdrawl1/{id}', 'admin\AccountController@saveWithdrawl1')->name('admin.savewithdrawl1');

    Route::get('/detail/{id}', 'admin\AccountController@detail')->name('admin.detail');
});


Route::group(['prefix' => 'admin/pickuppoint', 'middleware' => 'admin_auth'], function () {

    //pickupby admin

    Route::get('', 'admin\order\PickupController@index')->name('admin.pickup');
    Route::get('/add', 'admin\order\PickupController@add')->name('admin.add-pickup');
    Route::post('/add', 'admin\order\PickupController@add')->name('admin.save-pickup');
    Route::get('/manage/{point}', 'admin\order\PickupController@manage')->name('admin.manage-pickup');
    Route::post('/update/{point}', 'admin\order\PickupController@edit')->name('admin.update-pickup');

    
});

Route::group(['prefix' => 'vendor/orders', 'middleware' => ['authen', 'type'], 'type' => ['vendor']], function () {
    Route::get('/{status}', 'Vendor\order\OrderController@index')->name('vendor.orders');
    Route::get('/{status}/flash/{id}', 'Vendor\order\OrderController@flash')->name('vendor.orders-flash');
    Route::post('status/{status}', 'Vendor\order\OrderController@status')->name('vendor.set-status');
});

Route::group(['prefix' => 'vendor/accounts', 'middleware' => ['authen', 'type'], 'type' => ['vendor']], function () {
    Route::get('/', 'Vendor\AccountController@index')->name('vendor.accounts');
});

Route::group(['prefix' => 'delivery'], function () {
    Route::get('login', 'Delivery\AuthController@login')->name('delivery.login');
    Route::post('login', 'Delivery\AuthController@dologin')->name('delivery.do-login');
});

Route::group(['prefix' => 'delivery', 'middleware' => ['authen', 'type'], 'type' => ['delivery']], function () {
    Route::get('dashboard', 'Delivery\DashboardController@index')->name('delivery.dashboard');
    Route::get('pickup', 'Delivery\DashboardController@pickup')->name('delivery.pickup');

    Route::post('pickup/set', 'Delivery\DashboardController@setPickup')->name('delivery.set-pickup');

    Route::post('order', 'Delivery\DashboardController@order')->name('delivery.order');

    Route::get('warehouse', 'Delivery\DashboardController@warehouse')->name('delivery.warehouse');

    Route::get('delivered', 'Delivery\DashboardController@delivered')->name('delivery.delivered');
    Route::post('delivered/order', 'Delivery\DashboardController@deliveredOrder')->name('delivery.delivered-order');
    Route::post('delivered/complete', 'Delivery\DashboardController@deliveredCompleted')->name('delivery.delivered-complete');

    Route::post('check-otp', 'Delivery\DashboardController@otp')->name('delivery.check-otp');
});

Route::group(['prefix' => 'account'], function () {
    Route::get('login', 'Delivery\AuthController@login')->name('delivery.login');
    Route::post('login', 'Delivery\AuthController@dologin')->name('delivery.do-login');
});
Route::group(['prefix' => 'delivery', 'middleware' => ['authen', 'type'], 'type' => ['delivery']], function () {
    Route::get('dashboard', 'Delivery\DashboardController@index')->name('delivery.dashboard');
    Route::get('pickup', 'Delivery\DashboardController@pickup')->name('delivery.pickup');

    Route::post('pickup/set', 'Delivery\DashboardController@setPickup')->name('delivery.set-pickup');

    Route::post('order', 'Delivery\DashboardController@order')->name('delivery.order');

    Route::get('warehouse', 'Delivery\DashboardController@warehouse')->name('delivery.warehouse');

    Route::get('delivered', 'Delivery\DashboardController@delivered')->name('delivery.delivered');
    Route::post('delivered/order', 'Delivery\DashboardController@deliveredOrder')->name('delivery.delivered-order');
    Route::post('delivered/complete', 'Delivery\DashboardController@deliveredCompleted')->name('delivery.delivered-complete');

    Route::post('check-otp', 'Delivery\DashboardController@otp')->name('delivery.check-otp');
});

