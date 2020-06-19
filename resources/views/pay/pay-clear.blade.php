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
        <button class="layui-btn" data-type="reload">银行卡</button>
      </div>

      <div class="demoTable" style="margin:20px;">
        <button class="layui-btn" data-type="reload">微信支付</button>
      </div>

      <div class="demoTable" style="margin:20px;">
        <button class="layui-btn" data-type="reload">支付宝</button>
      </div>

      <div class="demoTable" style="margin:20px;">
        <button class="layui-btn" data-type="reload">第三方支付</button>
      </div>
              
          
<script src="/layuiadmin/layui/layui.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
 
<script>
layui.use('table', function(){
  var table = layui.table;
  
 
});
</script>

</body>
</html>