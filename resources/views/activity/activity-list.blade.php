<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>活动列表</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>
      
  </style>
</head>
<body> 
 


 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
     
  <script type="text/html" id="barDemo">

    <a class="layui-btn layui-btn-xs" lay-event="agree">开启</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">删除</a>
  </script>     
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

      {field:'id', title: 'ID', width:180, sort: true}
      ,{field:'order', title: '活动标题', width:180}
      ,{field:'username', title: '开始时间', width:120}
      ,{field:'cz', title: '停止时间', width:120}
      ,{field:'jl', title: '排序',  width:260}
      ,{field:'state', title: '状态', sort: true, width:100}
      ,{
              fixed: 'right',
              title:"操作",
              width: 150,
              align: 'center',
              toolbar: '#barDemo'
            }
    ]]
    ,data: [{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021-02-03"
      ,"jl": "首页显示"
      ,"state": "关闭"
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