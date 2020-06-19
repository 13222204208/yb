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
 


 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
     
  <script type="text/html" id="barDemo">

    <a class="layui-btn layui-btn-xs" lay-event="agree">同意</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">拒绝</a>
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

      {field:'id', title: '申请用户', width:180, sort: true}
      ,{field:'order', title: '申请活动', width:180}
      ,{field:'username', title: '申请时间', width:120}
      ,{field:'cz', title: '赠送金额', width:120}
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
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
    },{
      "id": "9527"
      ,"order": "多玩多赚"
      ,"username": "2018-02-03"
      ,"cz": "2021"
      ,"state": "已拒绝"
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