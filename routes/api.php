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
Route::post('test', function (Request $request) {
   echo Str::uuid();
});

    Route::name('api.')->group(function(){
        Route::get('sliders','Api\HomeController@sliders')->name('sliders');
        Route::get('categories','Api\HomeController@categories')->name('cat');
        Route::get('category/{id}','Api\HomeController@category')->name('cate');
        Route::get('products','Api\HomeController@products')->name('products');
        Route::get('listproducts/{step}','Api\HomeController@listproducts')->name('listproducts');
        Route::get('allproducts','Api\HomeController@allproducts')->name('allproducts');
        Route::get('product/{id}','Api\HomeController@product')->name('product');

        Route::match(['POST','GET'],'search','Api\HomeController@search')->name('search');
    });


