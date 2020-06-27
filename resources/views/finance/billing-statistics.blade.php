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
   ,url:'query/manual/bills'
    ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
    ,cols: [[
      {field:'time', width:180, title: '时间', sort: true}
      ,{field:'business_type', width:140, title: '交易类型'}
      ,{field:'bank_card', width:180, title: '银行卡号'}
      ,{field:'operation', width:120, title: '操作人'}
      ,{field:'remarks', width:320, title: '备注'}

    ]],parseData: function(res) { //res 即为原始返回的数据
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

  table.render({
    elem: '#billing'
     ,url: 'query/bill/statistics' 
    ,cols: [[
/*       {field:'id', title: 'ID', width:80, sort: true} */
      {field:'deposit_num', title: '充值次数', width:120}
      ,{field:'deposit_sum', title: '充值总额', width:120}
      ,{field:'draw_money_num', title: '提款次数',  width:160}
      ,{field:'draw_money_sum', title: '提款总额',  width:160}
      ,{field:'reward_num', title: '奖励次数', width:120}
      ,{field:'reward_sum', title: '奖励总额', sort: true, width:160}
      ,{field:'backwater_num', title: '返水次数', width:120}
      ,{field:'backwater_sum', title: '返水总额',sort: true, width:160}
      ,{field:'profit_loss_sum', title: '本期收益', sort: true, width:160}
    ]]
    ,parseData: function(res) { //res 即为原始返回的数据
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
});
</script>

</body>
</html>