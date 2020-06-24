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
  搜索帐号：
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
  var $= layui.jquery;
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
   ,url: 'query/tracking'
    ,cols: [[
      
      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:120}
      ,{field:'login_ip', title: '登录IP',  width:160}
      ,{field:'platform_name', title: '在玩平台', width:180}
      ,{field:'game_name', title: '在玩游戏', width:180}
      ,{field:'room_num', title: '房间号', width:180}
    ]],
    parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        }
    ,id: 'testReload'
    ,page: true
  });
  
  
  $('.demoTable .layui-btn').on('click', function(){
    var username = $('#demoReload').val();
    table.render({
    elem: '#LAY_table_user'
   ,url: 'search/tracking'
   ,where:{
     username:username
   }
    ,cols: [[
      
      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:120}
      ,{field:'login_ip', title: '登录IP',  width:160}
      ,{field:'platform_name', title: '在玩平台', width:180}
      ,{field:'game_name', title: '在玩游戏', width:180}
      ,{field:'room_num', title: '房间号', width:180}
    ]],
    parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        }
    ,id: 'testReload'
    ,page: true
    ,height:600
  });
  });
});
</script>

</body>
</html>