

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>后台管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  

</head>
<body class="layui-layout-body">
  
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
 <!--          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="http://www.layui.com/admin/" target="_blank" title="前台">
              <i class="layui-icon layui-icon-website"></i>
            </a>
          </li> -->
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
<!--           <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search" layadmin-event="serach" lay-action="template/search?keywords="> 
          </li> -->
        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
          
<!--           <li class="layui-nav-item" lay-unselect>
            <a lay-href="app/message/index" layadmin-event="message" lay-text="消息中心">
              <i class="layui-icon layui-icon-notice"></i>  
              <span class="layui-badge-dot"></span>
            </a>
          </li> -->
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="theme">
              <i class="layui-icon layui-icon-theme"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="note">
              <i class="layui-icon layui-icon-note"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="fullscreen">
              <i class="layui-icon layui-icon-screen-full"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
              <cite>{{session('nickname')}}</cite>
            </a>
            <dl class="layui-nav-child">
              <dd><a lay-href="bguser/basic/document">基本资料</a></dd>
              <dd><a lay-href="bguser/password">修改密码</a></dd>
              <hr>
              <dd layadmin-event="" style="text-align: center;" ><a onclick="logout()">退出</a></dd>
            </dl>
          </li>
          <script>
              function logout(){
                top.location.href="/logout";
              }
          </script>
          
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
           <!--  <a href="javascript:;" layadmin-event="about"><i class="layui-icon layui-icon-more-vertical"></i></a> -->
          </li>
          <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
            <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
        </ul>
      </div>

      <div class="layui-row" id="popUpdateTest" style="display:none;">
    <form class="layui-form layui-from-pane" required lay-verify="required" lay-filter="formUpdate" style="margin:20px">



      <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
          <input type="text" name="nickname" required lay-verify="required" autocomplete="off" placeholder="" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-block">
          <select name="role" lay-filter="aihao">

          </select>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
          <input type="text" name="state"  autocomplete="off" placeholder="" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item ">
        <div class="layui-input-block">
          <div class="layui-footer" style="left: 0;">
            <button class="layui-btn" lay-submit="" lay-filter="editAccount">修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </div>
    </form>
  </div>
      
      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="home/homepage">
            <span>后台管理</span>
          </div>
          
          <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
              <a href="javascript:;" lay-tips="主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>主页</cite>
              </a>
              <dl class="layui-nav-child">
       
                <dd data-name="console">
                  <a lay-href="home/homepage">主页</a>
                </dd>
              </dl>
            </li>

            <li data-name="user" class="layui-nav-item">
              <a href="javascript:;" lay-tips="用户管理" lay-direction="2">
                <i class="layui-icon layui-icon-user"></i>
                <cite>用户管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd>
                  <a lay-href="user/user-list">用户列表</a>
                </dd>
                <dd>
                  <a lay-href="user/account-operation">账号操作</a>
                </dd>
                <dd>
                  <a lay-href="user/user-tracking">用户追踪</a>
                </dd>
                <dd>
                  <a lay-href="user/loss-statistics">流失统计</a>
                </dd>
              </dl>
            </li>
    
            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="财务管理" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>财务管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="finance/recharge-application">充值申请</a></dd>
                <dd><a lay-href="finance/withdrawal-applications">提款申请</a></dd>
                <dd><a lay-href="finance/user-statistics">用户统计</a></dd>
                <dd><a lay-href="finance/billing-statistics">账单统计</a></dd>
                <dd><a lay-href="finance/manual-bills">人工帐单</a></dd>
                <dd><a lay-href="finance/historical-billing">历史帐单</a></dd>
              </dl>
            </li>

            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="记录查询" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>记录查询</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="record/betting-records">投注记录</a></dd>
                <dd><a lay-href="record/login-record">登录记录</a></dd>
                <dd><a lay-href="record/transaction-records">交易记录</a></dd>
              </dl>
            </li>
 
           
            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="返水管理" lay-direction="2">
                <i class="layui-icon layui-icon-senior"></i>
                <cite>返水管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="rebate/rebate-rate">返水等级</a></dd>

              </dl>
            </li>

            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="支付管理" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>支付管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="pay/pay-clear">支付开放</a></dd>
                <dd><a lay-href="pay/bank-card">银行卡</a></dd>
                <dd><a lay-href="pay/wechat-pay">微信支付</a></dd>
                <dd><a lay-href="pay/alipay-pay">支付宝支付</a></dd>
              </dl>
            </li>
    
            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="系统管理" lay-direction="2">
                <i class="layui-icon layui-icon-set"></i>
                <cite>系统管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="system/parameter-setting">参数设置</a></dd>
                <dd><a lay-href="system/background-account">后台帐号</a></dd>
                <dd><a lay-href="system/permission-settings">权限设置</a></dd>
                <dd><a lay-href="system/role-settings">角色设置</a></dd>
              </dl>
            </li>

            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="平台管理" lay-direction="2">
                <i class="layui-icon layui-icon-set"></i>
                <cite>平台管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="platform/platform-list">平台列表</a></dd>
                <dd><a lay-href="platform/add-platform">添加平台</a></dd>
              </dl>
            </li>

            
            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="活动管理" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>活动管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="activity/activity-list">活动列表</a></dd>
                <dd><a lay-href="activity/add-activity">新增活动</a></dd>
                <dd><a lay-href="activity/ask-list">申请列表</a></dd>
              </dl>
            </li>

            
            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="内容管理" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>内容管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="content/rotation-chart">轮播图</a></dd>
                <dd><a lay-href="content/running-horse-lamp">跑马灯</a></dd>
              </dl>
            </li>

            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="消息管理" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>消息管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="news/inside-the-station">站内信</a></dd>
              </dl>
            </li>

            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="反馈管理" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>反馈管理</cite>
              </a>
              <dl class="layui-nav-child">
                <dd><a lay-href="feedback/feedback-list">反馈列表</a></dd>
              </dl>
            </li>


          </ul>
        </div>
      </div>

      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="home/homepage" lay-attr="home/homepage" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
          </ul>
        </div>
      </div>
      
      
      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="home/homepage" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>

  <script src="/layuiadmin/layui/layui.js"></script>
  <script>
  layui.config({
    base: '/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index']),function(){
     

    
  };
  </script>
</body>
</html>


