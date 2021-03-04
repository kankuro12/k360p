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

    Route::name('api.')->group(function(){
        
        Route::post('/custom/search','Elements\CustomListController@searchProduct' )->name('elements.customlist-save');

        Route::get('homepage','Api\HomeController@homePage')->name('homePage');
        Route::get('sliders','Api\HomeController@sliders')->name('sliders');

        Route::get('collections','Api\HomeController@collections')->name('collections');
        Route::get('collection/{id}','Api\HomeController@collection')->name('collection');

        Route::get('categories','Api\HomeController@categories')->name('cat');
        Route::get('category/{id}','Api\HomeController@categoryWiseProduct');

        Route::get('category/{id}','Api\HomeController@category')->name('cate');
        Route::get('products','Api\HomeController@products')->name('products');
        Route::get('listproducts/{step}','Api\HomeController@listproducts')->name('listproducts');
        Route::get('allproducts','Api\HomeController@allproducts')->name('allproducts');
        Route::get('product/{id}','Api\HomeController@product')->name('product');
        // Route::get('product/{id}','Api\HomeController@product')->name('product');

        Route::match(['POST','GET'],'search','Api\HomeController@search')->name('search');

        route::prefix('booking')->group(function(){
            Route::middleware(['auth:api'])->group(function () {     
                Route::post('checkout',"Api\OrderController@checkout");
                Route::get('orders', "Api\OrderController@orders"); 
                Route::get('orders/{type}', "Api\OrderController@ordersType"); 
                Route::get('order/{id}', "Api\OrderController@order");
         });
        });
        route::prefix('auth')->group(function(){
            route::post('loginbyemail',"Api\AuthController@emaillogin");
            route::post('loginbyphone',"Api\AuthController@phonelogin");
            route::post('signup',"Api\AuthController@signup");
            Route::middleware(['auth:api'])->group(function () {
                Route::get('user',"Api\AuthController@user"); 
                route::post('changepass',"Api\AuthController@changepass");
         });
        });
        
    });


