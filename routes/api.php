<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//testkits
Route::get('test', function () {
    echo bcrypt("admin");
});

Route::name('api.')->group(function () {

    Route::post('/custom/search', 'Elements\CustomListController@searchProduct')->name('elements.customlist-save');

    Route::get('homepage', 'Api\HomeController@homePage')->name('homePage');
    Route::get('featured', 'Api\HomeController@featured')->name('featured');
    Route::get('top/{count?}', 'Api\HomeController@top')->name('top');
    Route::get('new/{count?}', 'Api\HomeController@new')->name('new');
    Route::get('sliders', 'Api\HomeController@sliders')->name('sliders');

    Route::get('collections', 'Api\HomeController@collections')->name('collections');
    Route::get('collection/{id}', 'Api\HomeController@collection')->name('collection');
    Route::get('collectionssummary', 'Api\HomeController@collectionsSummary')->name('collectionssummary');

    Route::get('categories', 'Api\HomeController@categories')->name('cat');
    Route::get('category/{id}', 'Api\HomeController@categoryWiseProduct');

    //XXX Cart Detail
    Route::post('cart-detail1','Api\HomeController@cartDetail' );
    // Route::get('category/{id}','Api\HomeController@category')->name('cate');
    Route::get('products', 'Api\HomeController@products')->name('products');
    Route::get('listproducts/{step}', 'Api\HomeController@listproducts')->name('listproducts');
    Route::get('allproducts', 'Api\HomeController@allproducts')->name('allproducts');
    Route::get('product/{id}', 'Api\HomeController@product')->name('product');
    // Route::get('product/{id}','Api\HomeController@product')->name('product');

    Route::match(['POST', 'GET'], 'search', 'Api\HomeController@search')->name('search');
    Route::match(['POST', 'GET'], 'newsearch', 'Api\HomeController@newsearch')->name('search');

    route::prefix('booking')->group(function () {
        Route::middleware(['auth:api'])->group(function () {
            Route::post('checkout', "Api\OrderController@checkout");
            Route::get('orders', "Api\OrderController@orders");
            Route::match(['GET','POST'],'orders/{type}', "Api\OrderController@ordersType");
            Route::get('order/{id}', "Api\OrderController@order");
        });
    });
    route::prefix('auth')->group(function () {
        route::post('loginbyemail', "Api\AuthController@emaillogin");
        route::post('loginbyphone', "Api\AuthController@phonelogin");
        route::post('signup', "Api\AuthController@signup");

        route::post('forgotpasswordPhone', "Api\AuthController@forgotPhone");
        route::post('resetpasswordPhone', "Api\AuthController@resetPhone");

        route::post('forgotpasswordEmail', "Api\AuthController@forgotEmail");
        route::post('resetpasswordEmail', "Api\AuthController@resetEmail");

        Route::middleware(['auth:api'])->group(function () {
            Route::get('user', "Api\AuthController@user");
            Route::post('ProfileImage', "Api\AuthController@profileImage");
            // Route::post('updateUser',"Api\AuthController@updateUser"); 
            Route::post('updateUserInfo', "Api\AuthController@updateUser");
            route::post('changepass', "Api\AuthController@changepass");
            Route::post('addReview', "Api\AuthController@addRreview");
            Route::get('myReview', "Api\AuthController@myRreview");
        });
    });

    route::prefix('vendor')->group(function () {
        Route::middleware(['auth:api'])->group(function () {
            Route::post('checkout', "Api\VendorController@checkout");
            Route::get('orders/{status}', "Api\VendorController@orders");
            Route::get('account/withdraw', "Api\VendorController@withdraw");
            Route::post('ProfileImage', "Api\VendorController@profileImage");

        });
        
        route::prefix('auth')->group(function () {
            Route::post('init', "Api\VendorController@initPhone");
            Route::post('verify-otp', "Api\VendorController@verifyOTP");
            Route::middleware(['auth:api'])->group(function () {
                Route::post('setup', "Api\VendorController@vendorSetup");
                Route::get('user', "Api\VendorController@vendorUser");
            });
        });
    });
});
