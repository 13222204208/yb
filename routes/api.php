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
        Route::post('amount','Api\UserController@amount');//钱包余额

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
        Route::get('affiche','Api\ContentController@affiche');//公告
        Route::post('notice','Api\ContentController@notice');//获取消息中心的通知
        Route::get('platform/record','Api\PlatformController@platformRecord');//获取投注记录
        Route::get('transaction/record','Api\TransactionController@transactionRecord');//获取投注记录
    });
});

Route::middleware('cors')->prefix('game')->group(function (){
/*     Route::get('/player/check/{account}','Api\CheckAccountController@checkAccount');//验证帐号
    Route::post('/transaction/game/bet','Api\CheckAccountController@gameBet');//老虎机下注
    Route::post('/transaction/game/endround','Api\CheckAccountController@gameEndround');//结束回合并统整该回合赢分
    Route::post('/transaction/game/rollout','Api\CheckAccountController@gameRollout');//此API是为牌桌及渔机游戏 ，转出一定额度而调用
    Route::post('/transaction/game/takeall','Api\CheckAccountController@gameTakeall');//玩家所有的钱领出，转入渔机游戏
    Route::post('/transaction/game/rollin','Api\CheckAccountController@gameRollin');//牌桌/渔机一场游戏结束，将金额转入钱包
    Route::post('/transaction/game/debit','Api\CheckAccountController@gameDebit');//针对完成的订单做扣款
    Route::post('/transaction/game/credit','Api\CheckAccountController@gameCredit');//针对完成的订单做补款
    Route::post('/transaction/game/bonus','Api\CheckAccountController@gameBonus');//游戏红利
    Route::post('/transaction/user/payoff','Api\CheckAccountController@userPayoff');//活动派彩
    Route::post('/transaction/game/refund','Api\CheckAccountController@gameRefund');//押注退还
    Route::get('/transaction/record/{mtcode}','Api\CheckAccountController@gameRecord');//查询交易记录
    Route::get('/transaction/balance/{account}','Api\CheckAccountController@gameBalance');//取得钱包余额 */

    Route::post('/tc/gameList','Api\TCApiController@gameList');//天成游戏列表

    Route::post('/yb/gameList','Api\YBApiController@gameList');//亚博查询游戏列表

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::post('/fast/register','Api\FastApiController@register');//注册
        Route::post('/fast/login','Api\FastApiController@login');//登入
        Route::post('/fast/balance','Api\FastApiController@balance');//获取会员钱包余额
        Route::post('/fast/transfer','Api\FastApiController@transfer');//转帐
        Route::post('/fast/checkTransfer','Api\FastApiController@checkTransfer');//检查转帐

        Route::post('/tc/CRegister','Api\TCApiController@CRegister');//创建/确认玩家接口
        Route::post('/tc/launchGame','Api\TCApiController@launchGame');//启动游戏
        Route::post('/tc/balance','Api\TCApiController@balance');//获取余额
        Route::post('/tc/transfer','Api\TCApiController@transfer');//奖金转帐
        Route::post('/tc/checkTransaction','Api\TCApiController@checkTransaction');//检查交易状态

        Route::post('/yb/launchGame','Api\YBApiController@launchGame');//亚博登陆注册
        Route::post('/yb/transferIn','Api\YBApiController@transferIn');//亚博上分
        Route::post('/yb/transferOut','Api\YBApiController@transferOut');//亚博下分
        Route::post('/yb/queryOrderStatus','Api\YBApiController@queryOrderStatus');//亚博查询订单状态
        Route::post('/yb/queryBalance','Api\YBApiController@queryBalance');//亚博查询玩家额度
        Route::post('/yb/updateMemberPwd','Api\YBApiController@updateMemberPwd');//亚博修改玩家密码

    });
});



