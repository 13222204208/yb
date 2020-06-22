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

    Route::post('update/open/state','Pay\PayClearController@updateOpenState');//更新支付开放状态
    Route::get('query/open/state','Pay\PayClearController@queryOpenState');//更新支付开放状态

    //银行卡
    Route::get('bank-card', function () {
        return view('pay.bank-card');
    });

    Route::post('add/bank/card','Pay\BankCardController@addBankCard');//增加银行卡
    Route::get('query/bank/card','Pay\BankCardController@queryBankCard');//银行卡列表
    Route::post('del/bank/card','Pay\BankCardController@delBankCard');//银行卡列表
    Route::post('update/bank/card','Pay\BankCardController@updateBankCard');//更新银行卡
    
    //微信支付
    Route::get('wechat-pay', function () {
        return view('pay.wechat-pay');
    }); 
    Route::post('upload/wechat/img','Pay\WechatPayController@uploadWechatImg');//上传微信二维码  
    Route::post('create/wechat/pay','Pay\WechatPayController@createWechatPay');//保存微信
    Route::get('query/wechat','Pay\WechatPayController@queryWechat');//微信列表
    Route::post('del/wechat','Pay\WechatPayController@delWechat');//删除一个微信
    
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

    Route::post('update/member/recharge','System\parameterSettingController@updateMemberRecharge');//更新会员充值
    Route::get('query/member/recharge','System\parameterSettingController@queryMemberRecharge');//查看会员充值

    Route::post('update/member/draw/money','System\parameterSettingController@updateDrawMoney');//更新会员提款
    Route::get('query/member/draw/money','System\parameterSettingController@queryDrawMoney');//查看会员提款

    //后台帐号
    Route::get('background-account', function () {
        return view('system.background-account');
    });

    Route::post('add/account','System\BackgroundAccountController@addAccount');//添加后台管理帐号
    Route::get('query/account','System\BackgroundAccountController@queryAccount');//添加后台管理帐号
    Route::get('query/account/{account_num}/','System\BackgroundAccountController@queryOneAccount');
    Route::get('query/account/role/{role}','System\BackgroundAccountController@queryAccountRole');
    Route::post('del/account','System\BackgroundAccountController@delAccount');//删除一个帐号
    Route::post('update/account','System\BackgroundAccountController@updateAccount');//更新帐号信息
    
    //权限设置
    Route::get('permission-settings', function () {
        return view('system.permission-settings');
    });    
    
    Route::post('add/role','System\permissionSettingsController@addRole');//添加角色名称
    Route::get('query/role','System\permissionSettingsController@queryRole');//查询角色名称
    Route::post('add/role/scope','System\permissionSettingsController@addRoleScope');//编辑角色权限范围
    
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
    Route::get('query/activity/list','Activity\ActivityController@queryActivityList');//活动列表
    Route::post('update/activity','Activity\ActivityController@updateActivity');//更新活动
    Route::post('del/activity','Activity\ActivityController@delActivity');//更新活动

    //新增活动
    Route::get('add-activity', function () {
        return view('activity.add-activity');
    });
    Route::post('upload/activity/img','Activity\ActivityController@uploadActivityImg');//上传活动图片
    Route::post('create/activity','Activity\ActivityController@createActivity');//上传活动
    
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

    Route::post('/upload/rotation/img','Content\RotationChartController@uploadRotationImg');//上传轮播图片
    Route::post('create/chart','Content\RotationChartController@createChart');//创建轮播图片
    Route::get('query/rotation/list','Content\RotationChartController@queryRotationList');//轮播列表
    Route::post('del/rotation/chart','Content\RotationChartController@delRotationChart');//删除一个轮播图
    Route::post('update/rotation/chart','Content\RotationChartController@updateRotationChart');//更新一个轮播图

    //跑马灯
    Route::get('running-horse-lamp', function () {
        return view('content.running-horse-lamp');
    }); 

    Route::post('create/running/horse','Content\RunningHorselampController@createRunHorse');//创建跑马灯
    Route::get('query/running/horse','Content\RunningHorselampController@queryRunHorse');//查看跑马灯列表
    
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

Route::get('feedback/query/feedback/list','Feedback\FeedbackListController@feedbackList');
Route::post('feedback/agree','Feedback\FeedbackListController@feedbackAgree');
Route::post('feedback/resuse','Feedback\FeedbackListController@feedbackResuse');
