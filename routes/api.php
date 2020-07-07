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

        Route::post('newpass', 'Api\UserController@newpass');
        Route::post('info', 'Api\UserController@update');//修改用户信息
        Route::post('user_head', 'Api\UserController@uploadUserHead');//上传头像
        Route::post('myActivity','Api\UserController@myActivity');//获取消息中心的活动

        Route::post('sendcode', 'Api\MailController@sendcode');//验证邮箱
        Route::post('bindmail','Api\MailController@bindmail');//绑定邮箱

        Route::post('feedback','Api\FeedBackController@feedback');//意见反馈
        Route::post('myFeedback','Api\FeedBackController@myFeedback');//获取意见反馈

        
    });
});

Route::middleware('cors')->prefix('content')->group(function (){
    Route::get('rotation','Api\ContentController@rotation');//首页轮播
    Route::get('activity','Api\ContentController@activity');//活动
    Route::get('default/head','Api\ContentController@defaultHead');//默认头像
    Route::get('support','Api\ContentController@support');//赞助
    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('affiche','Api\ContentController@affiche');
    }); 
});



