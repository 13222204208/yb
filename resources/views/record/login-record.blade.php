<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>
      
  </style>
</head>
<body> 
 
<div class="demoTable" style="margin:20px;">
  查询用户：
  <div class="layui-inline">
    <input class="layui-input" name="id" id="demoReload" autocomplete="off">
  </div>
  <button class="layui-btn" data-type="reload">查询</button>
</div>

<div class="mainTop layui-clear">

    <div class="fr">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">登陆IP：</label>
                    <div class="layui-input-inline">
                        <input class="layui-input" name="ip" id="login-ip" placeholder="请填写登录IP" autocomplete="off">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">起止时间：</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input dateIcon" id="dateTime" placeholder="请选择时间范围"
                               style="width: 240px;">
                    </div>
                    
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn layui-btn-blue">搜索</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
      
<script src="/layuiadmin/layui/layui.js"></script>

<script>
layui.use(['table','laydate'], function(){
  var table = layui.table;
  var laydate = layui.laydate;
  laydate.render({
    elem: '#dateTime'
    ,range: true
  });
  
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
/*     ,url: '/demo/table/user/' */
    ,cols: [[
      {field:'username', title: '用户名', width:200}
      ,{field:'ip', title: '登陆IP', width:220}
      ,{field:'zctime', title: '登陆时间',sort: true, width:260}
    ]]
    ,data: [{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },{
      "username": "杜甫"
      ,"ip": "192.168.1.1"
      ,"zctime": "2016-10-14"
    },]
    ,id: 'testReload'
    ,page: true
    ,height: 610
  });
  
  var $ = layui.$, active = {
    reload: function(){
      var demoReload = $('#demoReload');
      
      //执行重载
      table.reload('testReload', {
        page: {
          curr: 1 //重新从第 1 页开始
        }
        ,where: {
          key: {
            id: demoReload.val()
          }
        }
      }, 'data');
    }
  };
  
  $('.demoTable .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
});
</script>

</body>
</html>