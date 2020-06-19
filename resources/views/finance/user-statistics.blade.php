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
  搜索用户：
  <div class="layui-inline">
    <input class="layui-input" name="id" id="demoReload" autocomplete="off">
  </div>
  <button class="layui-btn" data-type="reload">搜索</button>
</div>
 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
          
<script src="/layuiadmin/layui/layui.js"></script>

<script>
layui.use('table', function(){
  var table = layui.table;
  
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
/*     ,url: '/demo/table/user/' */
    ,cols: [[
/*       {field:'id', title: 'ID', width:80, sort: true} */
      {field:'username', title: '用户名', width:120}
      ,{field:'cz', title: '真实姓名', width:120}
      ,{field:'jl', title: '存款次数', width:120}
      ,{field:'name', title: '存款总额', width:120}
      ,{field:'phone', title: '提款次数',  width:160}
      ,{field:'ip', title: '提款总额',  width:160}
      ,{field:'zctime', title: '返水总额',sort: true, width:160}
      ,{field:'dltime', title: '奖励总额', sort: true, width:160}
      ,{field:'lxtime', title: '盈亏总额', sort: true, width:160}
    ]]
    ,data: [{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "zhangsan"
      ,"cz": "张三"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
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