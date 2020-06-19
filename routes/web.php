<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   
    return view('index');
});

//后台登录
Route::get('login', function () {
   
    return view('login.login');
});

Route::post('login/login','Login\LoginController@login');//后台登录验证

//后台主页
Route::get('home/homepage', function () {
   
    return view('home.homepage');
});

//用户管理
Route::prefix('user')->group(function () {
    //用户列表
    Route::get('user-list', function () {
        return view('user.user-list');
    });

    //帐号操作
    Route::get('account-operation', function () {
        return view('user.account-operation');
    });
    
    //用户追踪
    Route::get('user-tracking', function () {
        return view('user.user-tracking');
    });   
    
    //流失统计
    Route::get('loss-statistics', function () {
        return view('user.loss-statistics');
    });   
    
});


//财务管理
Route::prefix('finance')->group(function () {

    //充值申请
    Route::get('recharge-application', function () {
        return view('finance.recharge-application');
    });

    //提款申请
    Route::get('withdrawal-applications', function () {
        return view('finance.withdrawal-applications');
    });
    
    //用户统计
    Route::get('user-statistics', function () {
        return view('finance.user-statistics');
    });   
    
    //帐单统计
    Route::get('billing-statistics', function () {
        return view('finance.billing-statistics');
    });

    //人工帐单
    Route::get('manual-bills', function () {
        return view('finance.manual-bills');
    });
    
    //历史帐单
    Route::get('historical-billing', function () {
        return view('finance.historical-billing');
    });    
    
});

//记录查询
Route::prefix('record')->group(function () {

    //投注记录
    Route::get('betting-records', function () {
        return view('record.betting-records');
    });

    //登录记录
    Route::get('login-record', function () {
        return view('record.login-record');
    });
    
    //交易记录
    Route::get('transaction-records', function () {
        return view('record.transaction-records');
    });   
    
});

//返水管理
Route::get('rebate/rebate-rate', function () {
   //返水等级
    return view('rebate.rebate-rate');
});

//支付管理
Route::prefix('pay')->group(function () {

    //支付开放
    Route::get('pay-clear', function () {
        return view('pay.pay-clear');
    });

    //银行卡
    Route::get('bank-card', function () {
        return view('pay.bank-card');
    });
    
    //微信支付
    Route::get('wechat-pay', function () {
        return view('pay.wechat-pay');
    });   
    
    //支付宝支付
    Route::get('alipay-pay', function () {
        return view('pay.alipay-pay');
    });   
    
});


//系统管理
Route::prefix('system')->group(function () {

    //参数设置
    Route::get('parameter-setting', function () {
        return view('system.parameter-setting');
    });

    //后台帐号
    Route::get('background-account', function () {
        return view('system.background-account');
    });
    
    //权限设置
    Route::get('permission-settings', function () {
        return view('system.permission-settings');
    });     
    
});

//平台管理
Route::get('platform/platform-list', function () { 
    //平台列表
    return view('platform.platform-list');
});

//活动管理
Route::prefix('activity')->group(function () {

    //活动列表
    Route::get('activity-list', function () {
        return view('activity.activity-list');
    });

    //新增活动
    Route::get('add-activity', function () {
        return view('activity.add-activity');
    });
    
    //申请列表
    Route::get('ask-list', function () {
        return view('activity.ask-list');
    });     
    
});

//内容管理
Route::prefix('content')->group(function () {

    //轮播图
    Route::get('rotation-chart', function () {
        return view('content.rotation-chart');
    });

    //跑马灯
    Route::get('running-horse-lamp', function () {
        return view('content.running-horse-lamp');
    }); 
    
});

//消息管理
Route::get('news/inside-the-station', function () {
   //站内信
    return view('news.inside-the-station');
});


//反馈管理
Route::get('feedback/feedback-list', function () {
   //反馈列表
    return view('feedback.feedback-list');
});
