<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>后台帐号</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>

  </style>
</head>

<body>

  <div class="layui-row" >
    <form class="layui-form layui-from-pane" required lay-verify="required" style="margin:20px">

      <div class="layui-form-item">
        <label class="layui-form-label">帐号</label>
        <div class="layui-input-block">
          <input type="text" name="account_num" style="width:300px" value="" class="layui-input" disabled>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">昵称</label>
        <div class="layui-input-block">
          <input type="text" name="nickname" style="width:300px" value="" class="layui-input" disabled>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-block">
          <input type="text" name="role" style="width:300px" value="" class="layui-input" disabled>
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
          <input type="text" name="state" style="width:300px" value="" class="layui-input " disabled>
        </div>
      </div>
    </form>
  </div>


 


  <script src="/layuiadmin/layui/layui.js"></script>

  <script>
    layui.use(['jquery', 'form'], function() {
 
      var $ = layui.jquery;
      var form = layui.form;

      //获取角色名称
      $.ajax({
        url: "query/bguser/basic/document",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          //data = res.data;
          if (res.status == 200) {
            $(" input[ name='account_num' ] ").val(res.data.account_num);
              $(" input[ name='nickname' ] ").val(res.data.nickname);
              $(" input[ name='role' ] ").val(res.data.role);
              $(" input[ name='state' ] ").val(res.data.state);
       
            form.render();
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });
 

    });
  </script>

</body>

</html>