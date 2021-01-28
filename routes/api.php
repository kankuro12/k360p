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

Route::group(['middleware' => ['cors']], function () {
    Route::name('api.')->group(function(){
        Route::get('sliders','Api\HomeController@sliders')->name('sliders');
    });
});
