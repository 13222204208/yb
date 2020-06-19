<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>帐单统计</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
    <div class="demoTable" style="margin:20px;">
        <button class="layui-btn" data-type="reload">本期帐单：</button>
      </div>
      
<table class="layui-hide" id="test"></table>

<div class="demoTable" style="margin:20px;"><br>
    <button class="layui-btn" data-type="reload">帐单统计：</button>
  </div>
  
<table class="layui-hide" id="billing"></table>
              
          
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
      {field:'time', width:180, title: '时间', sort: true}
      ,{field:'type', width:140, title: '交易类型'}
      ,{field:'card', width:180, title: '银行卡号'}
      ,{field:'ren', width:120, title: '操作人'}
      ,{field:'content', width:320, title: '备注'}

    ]],data: [{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },{
      "time": "2020-05-03 18:30"
      ,"type": "银行转帐"
      ,"card": "645678946546546"
      ,"ren": "管理员"
      ,"content": "床前明月光，一二三四王，上山打老虎"
    },]
  });

  table.render({
    elem: '#billing'
/*     ,url: '/demo/table/user/' */
    ,cols: [[
/*       {field:'id', title: 'ID', width:80, sort: true} */
      {field:'username', title: '充值次数', width:120}
      ,{field:'cz', title: '充值总额', width:120}
      ,{field:'phone', title: '提款次数',  width:160}
      ,{field:'ip', title: '提款总额',  width:160}
      ,{field:'jl', title: '奖励次数', width:120}
      ,{field:'dltime', title: '奖励总额', sort: true, width:160}
      ,{field:'name', title: '返水次数', width:120}
      ,{field:'zctime', title: '返水总额',sort: true, width:160}
      ,{field:'lxtime', title: '本期收益', sort: true, width:160}
    ]]
    ,data: [{
      "username": "13"
      ,"cz": "15606"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "13"
      ,"cz": "15606"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "13"
      ,"cz": "15606"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "13"
      ,"cz": "15606"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "13"
      ,"cz": "15606"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "13"
      ,"cz": "15606"
      ,"jl": "23"
      ,"name": "234234"
      ,"phone": "11"
      ,"ip": "19218"
      ,"zctime": "1234"
      ,"dltime": "6541"
      ,"lxtime": "12356"
    },{
      "username": "13"
      ,"cz": "15606"
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
});
</script>

</body>
</html>