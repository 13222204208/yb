<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户统计</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>
<body> 
 
<div class="demoTable" style="margin:20px;">
  搜索用户：
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
    ,url: 'query/user/statistics' 
    ,cols: [[
       {field:'id', title: 'ID', width:80, sort: true} 
      ,{field:'username', title: '用户名', width:120}
      ,{field:'true_name', title: '真实姓名', width:120}
      ,{field:'deposit_num', title: '存款次数', width:120}
      ,{field:'deposit_sum', title: '存款总额', width:120}
      ,{field:'draw_money_num', title: '提款次数',  width:160}
      ,{field:'draw_money_sum', title: '提款总额',  width:160}
      ,{field:'backwater_sum', title: '返水总额',sort: true, width:160}
      ,{field:'reward_sum', title: '奖励总额', sort: true, width:160}
      ,{field:'profit_loss_sum', title: '盈亏总额', sort: true, width:160}
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
    table.render({
    elem: '#LAY_table_user'
    ,url: 'search/user/statistics' 
    ,where:{
      username:username
    }
    ,cols: [[
       {field:'id', title: 'ID', width:80, sort: true} 
      ,{field:'username', title: '用户名', width:120}
      ,{field:'true_name', title: '真实姓名', width:120}
      ,{field:'deposit_num', title: '存款次数', width:120}
      ,{field:'deposit_sum', title: '存款总额', width:120}
      ,{field:'draw_money_num', title: '提款次数',  width:160}
      ,{field:'draw_money_sum', title: '提款总额',  width:160}
      ,{field:'backwater_sum', title: '返水总额',sort: true, width:160}
      ,{field:'reward_sum', title: '奖励总额', sort: true, width:160}
      ,{field:'profit_loss_sum', title: '盈亏总额', sort: true, width:160}
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