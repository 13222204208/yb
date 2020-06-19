<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>流失统计</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
           
<table class="layui-hide" id="test"></table>
              
          
<script src="/layuiadmin/layui/layui.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
 
<script>
layui.use('table', function(){
  var table = layui.table;
  
  table.render({
    elem: '#test'
 /*    ,url:'/demo/table/user/' */
    ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
    ,cols: [[
      {field:'id', width:80, title: 'ID', sort: true}
      ,{field:'username', width:140, title: '用户名'}
      ,{field:'day', width:180, title: '流失天数', sort: true}
      ,{field:'time', width:180, title: '最后登录时间'}

    ]],data: [{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"day": "十五天"
      ,"time": "2020-05-03 18:30"
    },]
  });
});
</script>

</body>
</html>