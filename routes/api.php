<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware('cors')->prefix('user')->group(function (){
    Route::post('register','Api\UserController@register');
    Route::post('login','Api\UserController@login');

    
    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('logout', 'Api\UserController@logout');

        //Route::get('info', 'Api\UserController@getAuthUser');
        Route::put('info/{username}', 'Api\UserController@update');//修改用户信息
        Route::post('user_head', 'Api\UserController@uploadUserHead');//上传头像
    });
});



