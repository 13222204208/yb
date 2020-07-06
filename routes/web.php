<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('index');
})->middleware('adminLogin');

//后台登录
Route::get('login', function () {

    return view('login.login');
});
Route::get('admin/code','Login\LoginController@adminLogin');//后台登录验证码
Route::post('login/login','Login\LoginController@login');//后台登录验证

//后台登录
Route::get('logout', function (Illuminate\Http\Request $request) {
    $request->session()->flush();
    return redirect('login');
});

//后台用户基本资料
Route::get('bguser/basic/document', function () { 
    return view('bguser.basic-document');
})->middleware('adminLogin');
Route::get('bguser/basic/query/bguser/basic/document','BgUser\BasicDocumentController@basicDocument');//获取后台用户基本资料

//修改后台用户密码
Route::get('bguser/password', function () { 
    return view('bguser.password');
})->middleware('adminLogin');
Route::post('bguser/set/mypass','BgUser\BasicDocumentController@setMypass');//修改后台用户密码

//后台主页
Route::get('home/homepage', function () {
   
    return view('home.homepage');
})->middleware('adminLogin');
Route::get('home/query/today/betting/records','Home\HomePageController@todayBettingRecords');//今日投注
Route::get('home/query/today/recharge/records','Home\HomePageController@todayRechargeRecords');//今日存款
Route::get('home/query/today/withdrawal/records','Home\HomePageController@todayWithdrawalRecords');//今日提款
Route::get('home/query/today/award/records','Home\HomePageController@todayAwardRecords');//发放奖励
Route::get('home/query/today/register/user','Home\HomePageController@todayRegisterUser');//今日注册会员
Route::get('home/query/year/register/user','Home\HomePageController@yearRegisterUser');//今年注册会员
Route::get('home/query/year/cash/flow','Home\HomePageController@yearCashFlow');//今年资金流动
Route::get('home/query/year/betting/records','Home\HomePageController@yearBettingRecords');//今年平台下注情况
Route::get('home/query/money/switch/control','Home\HomePageController@moneySwitchControl');//转帐监控
Route::get('home/query/money/rollout/control','Home\HomePageController@moneyRolloutControl');//转出监控
Route::get('home/query/same/ip','Home\HomePageController@sameIp');//相同ip下登入的会员帐号

//用户管理
Route::prefix('user')->group(function () {
    //用户默认头像
    Route::get('default-head', function () {
        return view('user.default-head');
    })->middleware('adminLogin');
    Route::post('upload/default/head','User\DefaultHeadController@defaultHead');
    Route::post('create/default/head','User\DefaultHeadController@createDefaultHead');//保存默认头像
    Route::get('query/default/head','User\DefaultHeadController@queryDefaultHead');//保存默认头像
    Route::post('del/default/head','User\DefaultHeadController@delDefaultHead');//删除默认头像
    //用户列表
    Route::get('user-list', function () {
        return view('user.user-list');
    })->middleware('adminLogin');
    Route::get('query/user/list','User\UserListController@queryUserList');//获取用户列表
    Route::get('search/user/list','User\UserListController@searchUserList');//搜索用户名

    //帐号操作
    Route::get('account-operation', function () {
        return view('user.account-operation');
    })->middleware('adminLogin');
    Route::post('search/user/nickname','User\AccountOperationController@searchUserNickname');//查询用户
    Route::post('reset/user/phone','User\AccountOperationController@resetUserPhone');//重置手机号
    Route::post('reset/user/password','User\AccountOperationController@resetUserPassword');//重置密码
    Route::post('reset/user/take/password','User\AccountOperationController@resetUserTakePassword');//重置取款密码
    Route::post('update/account/status','User\AccountOperationController@updateAccountStatus');//帐号封禁 
    
    //用户追踪
    Route::get('user-tracking', function () {
        return view('user.user-tracking');
    })->middleware('adminLogin');   
    Route::get('query/tracking','User\UserTrackingController@queryTracking');//查询用户追踪
    Route::get('search/tracking','User\UserTrackingController@searchTracking');//搜索用户
    
    //流失统计
    Route::get('loss-statistics', function () {
        return view('user.loss-statistics');
    })->middleware('adminLogin');   
    Route::get('query/user/loss','User\LossStatisticsController@queryUserLoss');//流失统计
    
});


//财务管理
Route::prefix('finance')->group(function () {

    //充值申请
    Route::get('recharge-application', function () {
        return view('finance.recharge-application');
    })->middleware('adminLogin');
    Route::get('query/recharge','Finance\RechargeController@queryRecharge');//获取申请列表
    Route::post('agree/recharge','Finance\RechargeController@agreeRecharge');//同意申请
    Route::post('resuse/recharge','Finance\RechargeController@resuseRecharge');//拒绝申请
    Route::get('search/recharge','Finance\RechargeController@searchRecharge');//搜索

    //提款申请
    Route::get('withdrawal-applications', function () {
        return view('finance.withdrawal-applications');
    })->middleware('adminLogin');
    Route::get('query/withdrawal','Finance\WithdrawalController@queryWithdrawal');//获取提款申请列表
    Route::post('agree/withdrawal','Finance\WithdrawalController@agreeWithdrawal');//同意申请
    Route::post('resuse/withdrawal','Finance\WithdrawalController@resuseWithdrawal');//拒绝申请
    Route::get('search/withdrawal','Finance\WithdrawalController@searchWithdrawal');//搜索
    
    //用户统计
    Route::get('user-statistics', function () {
        return view('finance.user-statistics');
    })->middleware('adminLogin');   
    Route::get('query/user/statistics','Finance\UserStatisticsController@queryUserStatistics');//用户统计
    Route::get('search/user/statistics','Finance\UserStatisticsController@searchUserStatistics');//搜索用户

    
    //帐单统计
    Route::get('billing-statistics', function () {
        return view('finance.billing-statistics');
    })->middleware('adminLogin');

    //人工帐单
    Route::get('manual-bills', function () {
        return view('finance.manual-bills');
    })->middleware('adminLogin');
    Route::post('add/manual/bills','Finance\ManualBillsController@addManualBills');//添加人工帐单
    Route::get('query/manual/bills','Finance\BillingStatisticsController@queryManualBills');//查看本期帐单
    Route::get('query/bill/statistics','Finance\BillingStatisticsController@queryBillStatistics');//查看帐单统计
    
    //历史帐单
    Route::get('historical-billing', function () {
        return view('finance.historical-billing');
    })->middleware('adminLogin');    
    Route::get('del/historical/bill','Finance\BillingStatisticsController@delHistoricalBill');//删除帐单统计
    
});

//记录查询
Route::prefix('record')->group(function () {

    //投注记录
    Route::get('betting-records', function () {
        return view('record.betting-records');
    })->middleware('adminLogin');
    Route::get('query/betting','Record\BettingController@queryBetting');//投注记录列表
    Route::get('query/platform/name','Record\BettingController@queryPlatformName');//获取平台名字
    Route::get('search/betting','Record\BettingController@searchBetting');//搜索

    //登录记录
    Route::get('login-record', function () {
        return view('record.login-record');
    });
    Route::get('query/login/record','Record\LoginRecordController@queryLoginRecord');//查询登陆记录
    Route::get('search/login/record','Record\LoginRecordController@searchLoginRecord');//搜索登陆记录
    
    //交易记录
    Route::get('transaction-records', function () {
        return view('record.transaction-records');
    });   
    Route::get('query/transaction','Record\TransactionController@queryTransaction');//查询交易记录
    Route::get('query/business/type','Record\TransactionController@queryBusinessType');//查询交易类型
    Route::get('search/transaction','Record\TransactionController@searchTransaction');//搜索交易记录
    
});

//返水管理
Route::get('rebate/rebate-rate', function () {
   //返水等级
    return view('rebate.rebate-rate');
})->middleware('adminLogin');
Route::post('rebate/create/rebate','Rebate\RebateRateController@createRebate');//新建返水
Route::get('rebate/query/rebate','Rebate\RebateRateController@queryRebate');//返水列表

//支付管理
Route::prefix('pay')->group(function () {

    //支付开放
    Route::get('pay-clear', function () {
        return view('pay.pay-clear');
    })->middleware('adminLogin');

    Route::post('update/open/state','Pay\PayClearController@updateOpenState');//更新支付开放状态
    Route::get('query/open/state','Pay\PayClearController@queryOpenState');//更新支付开放状态

    //银行卡
    Route::get('bank-card', function () {
        return view('pay.bank-card');
    })->middleware('adminLogin');

    Route::post('add/bank/card','Pay\BankCardController@addBankCard');//增加银行卡
    Route::get('query/bank/card','Pay\BankCardController@queryBankCard');//银行卡列表
    Route::post('del/bank/card','Pay\BankCardController@delBankCard');//银行卡列表
    Route::post('update/bank/card','Pay\BankCardController@updateBankCard');//更新银行卡
    
    //微信支付
    Route::get('wechat-pay', function () {
        return view('pay.wechat-pay');
    })->middleware('adminLogin'); 
    Route::post('upload/wechat/img','Pay\WechatPayController@uploadWechatImg');//上传微信二维码  
    Route::post('create/wechat/pay','Pay\WechatPayController@createWechatPay');//保存微信
    Route::get('query/wechat','Pay\WechatPayController@queryWechat');//微信列表
    Route::post('del/wechat','Pay\WechatPayController@delWechat');//删除一个微信
    Route::post('update/wechat','Pay\WechatPayController@updateWechat');//更新一个微信
    
    //支付宝支付
    Route::get('alipay-pay', function () {
        return view('pay.alipay-pay');
    })->middleware('adminLogin');
    Route::post('upload/alipay/img','Pay\AlipayController@uploadAlipayImg');//上传支付宝二维码
    Route::post('create/alipay','Pay\AlipayController@createAlipay');//保存支付宝
    Route::get('query/alipay','Pay\AlipayController@queryAlipay');//支付宝列表
    Route::post('del/alipay','Pay\AlipayController@delAlipay');//删除一个支付宝
    Route::post('update/alipay','Pay\AlipayController@updateAlipay');//更新一个支付宝
    
});


//系统管理
Route::prefix('system')->group(function () {

    //参数设置
    Route::get('parameter-setting', function () {
        return view('system.parameter-setting');
    })->middleware('adminLogin');

    Route::post('update/member/recharge','System\ParameterSettingController@updateMemberRecharge');//更新会员充值
    Route::get('query/member/recharge','System\ParameterSettingController@queryMemberRecharge');//查看会员充值

    Route::post('update/member/draw/money','System\ParameterSettingController@updateDrawMoney');//更新会员提款
    Route::get('query/member/draw/money','System\ParameterSettingController@queryDrawMoney');//查看会员提款

    //后台帐号
    Route::get('background-account', function () {
        return view('system.background-account');
    })->middleware('adminLogin');

    Route::post('add/account','System\BackgroundAccountController@addAccount');//添加后台管理帐号
    Route::get('query/account','System\BackgroundAccountController@queryAccount');//添加后台管理帐号
    Route::get('query/account/{account_num}/','System\BackgroundAccountController@queryOneAccount');
    Route::get('query/account/role/{role}','System\BackgroundAccountController@queryAccountRole');
    Route::post('del/account','System\BackgroundAccountController@delAccount');//删除一个帐号
    Route::post('update/account','System\BackgroundAccountController@updateAccount');//更新帐号信息
    
    //权限设置
    Route::get('permission-settings', function () {
        return view('system.permission-settings');
    })->middleware('adminLogin');    
    
    
    Route::get('query/role','System\PermissionSettingsController@queryRole');//查询角色名称
    Route::post('add/role/scope','System\PermissionSettingsController@addRoleScope');//编辑角色权限范围
    Route::post('query/role/scope','System\PermissionSettingsController@queryRoleScope');//获取角色权限范围

    //角色设置
    Route::get('role-settings', function () {
        return view('system.role-settings');
    })->middleware('adminLogin');   
    Route::post('add/role','System\PermissionSettingsController@addRole');//添加角色名称
    Route::get('query/role/describe','System\PermissionSettingsController@queryRoleDescribe');//查询角色详情
    Route::post('del/role','System\PermissionSettingsController@delRole');//删除角色
    Route::post('update/role','System\PermissionSettingsController@updateRole');//更新角色
});

//平台管理
Route::prefix('platform')->group(function () {
        Route::get('platform-list', function () { 
            //平台列表
            return view('platform.platform-list');
        })->middleware('adminLogin');
        ROute::get('query/platform','Platform\PlatformListController@queryPlatform');//查看平台列表
        ROute::post('update/platform','Platform\PlatformListController@updatePlatform');//编辑平台

        Route::get('add-platform', function () { 
            //添加平台
            return view('platform.add-platform');
        })->middleware('adminLogin');
        ROute::post('upload/platform/img','Platform\PlatformListController@uploadPlatformImg');//上传平台 入口图
        ROute::post('create/platform','Platform\PlatformListController@createPlatform');//添加平台信息
});

//活动管理
Route::prefix('activity')->group(function () {

    //活动列表
    Route::get('activity-list', function () {
        return view('activity.activity-list');
    })->middleware('adminLogin');
    Route::get('query/activity/list','Activity\ActivityController@queryActivityList');//活动列表
    Route::post('update/activity','Activity\ActivityController@updateActivity');//更新活动
    Route::post('del/activity','Activity\ActivityController@delActivity');//更新活动

    //新增活动
    Route::get('add-activity', function () {
        return view('activity.add-activity');
    })->middleware('adminLogin');
    Route::post('upload/activity/img','Activity\ActivityController@uploadActivityImg');//上传活动图片
    Route::post('create/activity','Activity\ActivityController@createActivity');//上传活动
    
    //申请列表
    Route::get('ask-list', function () {
        return view('activity.ask-list');
    })->middleware('adminLogin');     
    Route::get('query/apply/list','Activity\ApplyActivityController@queryApplyList');//查看活动申请列表
    Route::post('agree/apply/activity','Activity\ApplyActivityController@agreeApplyActivity');//同意活动申请
    Route::post('resuse/apply/activity','Activity\ApplyActivityController@resuseApplyActivity');//拒绝活动申请
});

//内容管理
Route::prefix('content')->group(function () {

    //轮播图
    Route::get('rotation-chart', function () {
        return view('content.rotation-chart');
    })->middleware('adminLogin');

    Route::post('/upload/rotation/img','Content\RotationChartController@uploadRotationImg');//上传轮播图片
    Route::post('create/chart','Content\RotationChartController@createChart');//创建轮播图片
    Route::get('query/rotation/list','Content\RotationChartController@queryRotationList');//轮播列表
    Route::post('del/rotation/chart','Content\RotationChartController@delRotationChart');//删除一个轮播图
    Route::post('update/rotation/chart','Content\RotationChartController@updateRotationChart');//更新一个轮播图

    //跑马灯
    Route::get('running-horse-lamp', function () {
        return view('content.running-horse-lamp');
    })->middleware('adminLogin'); 

    Route::post('create/running/horse','Content\RunningHorseLampController@createRunHorse');//创建跑马灯
    Route::get('query/running/horse','Content\RunningHorseLampController@queryRunHorse');//查看跑马灯列表

    //赞助
    Route::get('support', function () {
        return view('content.support');
    })->middleware('adminLogin'); 
    Route::post('create/support','Content\SupportController@createSupport');//新建赞助
    Route::get('query/support','Content\SupportController@querySupport');//查看赞助
    Route::post('update/support','Content\SupportController@updateSupport');//更新赞助
    Route::post('del/support','Content\SupportController@delSupport');//更新赞助
});

//消息管理
Route::prefix('news')->group(function () {
    Route::get('inside-the-station', function () {
        //站内信
         return view('news.inside-the-station');
     })->middleware('adminLogin');

     Route::get('affiche', function () {
        //公告
         return view('news.affiche');
     })->middleware('adminLogin');

     Route::post('send/news','News\SendNewsController@sendNews');
     Route::post('send/affiche','News\SendNewsController@sendAffiche');//发送公告
     Route::get('query/affiche','News\SendNewsController@queryAffiche');//获取公告
     Route::post('del/affiche','News\SendNewsController@delAffiche');//删除公告
});


//反馈管理
Route::get('feedback/feedback-list', function () {
   //反馈列表
    return view('feedback.feedback-list');
})->middleware('adminLogin');

Route::get('feedback/query/feedback/list','Feedback\FeedbackListController@feedbackList');
Route::post('feedback/agree','Feedback\FeedbackListController@feedbackAgree');
Route::post('feedback/resuse','Feedback\FeedbackListController@feedbackResuse');

Route::get('404', function () {

    return view('404');
});
