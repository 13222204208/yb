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
</head>
<body> 
 
<div class="demoTable" style="margin:20px;">
  搜索用户名：
  <div class="layui-inline">
    <input class="layui-input" name="id" id="demoReload" autocomplete="off">
  </div>
  <button class="layui-btn" data-type="reload">搜索</button>
</div>
 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
          
<script src="/layuiadmin/layui/layui.js"></script>

<script>
layui.use(['table','jquery'], function(){
  var table = layui.table;
  var $ = layui.jquery;
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
    ,url: 'query/user/list' 
    ,cols: [[

      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:120}
      ,{field:'recharge_account', title: '充值帐户', width:120}
      ,{field:'reward_account', title: '奖励帐户', width:120}
      ,{field:'true_name', title: '真实姓名', width:120}
      ,{field:'phone', title: '手机号',  width:160}
      ,{field:'register_ip', title: '注册IP',  width:160}
      ,{field:'register_time', title: '注册时间',sort: true, width:160}
      ,{field:'login_time', title: '上次登录时间', sort: true, width:160}
      ,{field:'off_time', title: '上次离线时间', sort: true, width:160}
      ,{field:'state', title: '是否在线', sort: true, width:135,
        templet: function(d) {
                if (d.state === 0) {
                  return "离线";
                }else if(d.state === 1){
                  return "在线";
                }else{
                  return "未知";
                }
              }
      }
    ]]
    , parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        }
    ,id: 'testReload'
    ,page: true
    ,height: 610
  });
  
  $('.demoTable .layui-btn').on('click', function(){
    var username = $('#demoReload').val();
    console.log(username);
    table.render({
    elem: '#LAY_table_user'
    ,url: 'search/user/list' 
    ,where:{
      username:username
    }
    ,cols: [[
      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:120}
      ,{field:'recharge_account', title: '充值帐户', width:120}
      ,{field:'reward_account', title: '奖励帐户', width:120}
      ,{field:'true_name', title: '真实姓名', width:120}
      ,{field:'phone', title: '手机号',  width:160}
      ,{field:'register_ip', title: '注册IP',  width:160}
      ,{field:'register_time', title: '注册时间',sort: true, width:160}
      ,{field:'login_time', title: '上次登录时间', sort: true, width:160}
      ,{field:'off_time', title: '上次离线时间', sort: true, width:160}
      ,{field:'state', title: '是否在线', sort: true, width:135,
        templet: function(d) {
                if (d.state === 0) {
                  return "离线";
                }else if(d.state === 1){
                  return "在线";
                }else{
                  return "未知";
                }
              }
      }
    ]]
    , parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        }
    ,id: 'testReload'
    ,page: true
    ,height: 610
  });
  });
});
</script>

</body>
</html>