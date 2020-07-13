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
    Route::get('reg/code','Api\UserController@regCode');


    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('logout', 'Api\UserController@logout');

        Route::post('newpass', 'Api\UserController@newpass');
        Route::post('info', 'Api\UserController@update');//修改用户信息
        Route::post('user_head', 'Api\UserController@uploadUserHead');//上传头像
        Route::post('myActivity','Api\UserController@myActivity');//获取消息中心的活动
        Route::post('validatePasswd','Api\UserController@validatePasswd');//手势密码中验证登录密码

        Route::post('sendcode', 'Api\MailController@sendcode');//验证邮箱
        Route::post('bindmail','Api\MailController@bindmail');//绑定邮箱

        Route::post('feedback','Api\FeedBackController@feedback');//意见反馈
        Route::post('myFeedback','Api\FeedBackController@myFeedback');//获取意见反馈

        Route::post('add/card','Api\CardController@addCard');//添加银行卡
        Route::get('look/card','Api\CardController@lookCard');//添加银行卡
        Route::post('remove/card','Api\CardController@removeCard');//解除银行卡


    });
});

Route::middleware('cors')->prefix('content')->group(function (){
    Route::get('rotation','Api\ContentController@rotation');//首页轮播
    Route::get('activity','Api\ContentController@activity');//活动
    Route::get('default/head','Api\ContentController@defaultHead');//默认头像
    Route::get('support','Api\ContentController@support');//赞助

    Route::get('platform/list','Api\PlatformController@platformList');//平台名称列表
    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('affiche','Api\ContentController@affiche');
        Route::post('notice','Api\ContentController@notice');//获取消息中心的通知
        Route::get('platform/record','Api\PlatformController@platformRecord');//获取投注记录
        Route::get('transaction/record','Api\TransactionController@transactionRecord');//获取投注记录
    });
});



