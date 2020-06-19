<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>登入后台</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/login.css" media="all">

</head>

<body>

  <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>后台管理</h2>
      </div>
      <form class="layui-form" lay-filter="add_form" >
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
          <input type="text" name="username" id="LAY-user-login-username" lay-verify="username" placeholder="用户名" class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="password" id="LAY-user-login-password" lay-verify="password" placeholder="密码" class="layui-input">
        </div>

        <div class="layui-form-item" style="margin-bottom: 20px;">
          <input type="checkbox" lay-filter="remember" name="remember_user" id="remember_user" lay-skin="primary" title="记住密码">

        </div>
        <div class="layui-form-item">
          <button id='hide' class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="LAY-user-login-submit">登 入</button>
        </div>

      </div>
      </form>
    </div>



    <!--<div class="ladmin-user-login-theme">
      <script type="text/html" template>
        <ul>

          <li data-theme="#03152A" style="background-color: #03152A;"></li>
          <li data-theme="#2E241B" style="background-color: #2E241B;"></li>
          <li data-theme="#50314F" style="background-color: #50314F;"></li>
          <li data-theme="#344058" style="background-color: #344058;"></li>
          <li data-theme="#20222A" style="background-color: #20222A;"></li>
        </ul>
      </script>
    </div>-->

  </div>

  <script src="/layuiadmin/layui/layui.all.js"></script>
  <script src="/layuiadmin/layui/jquery3.2.js"></script>
  <script src="/layuiadmin/layui/jquery.cookie.js"></script>
  <script>
    layui.config({
      base: '/layuiadmin/'
    }).extend({
      index: 'lib/index'
    }).use(['index', 'user', 'form','jquery'], function() {

      var form = layui.form;
      var $= layui.jquery;
    
      /*记住用户名和密码*/
      if ($.cookie("remember_user")) {
        console.log($.cookie("user_name"))
        console.log($.cookie("user_password"))
        $("#remember_user").prop("checked", true);
        form.val("add_form", {
          "username": $.cookie("user_name"),
          "password": $.cookie("user_password")
        })
      }


      form.verify({
        username: function(value) {
          if (value.length < 6) {
            return '用户名至少得6个字符啊';
          }
        },

        password: function(value) {
          if (value.length < 8) {
            return '请输入至少8位';
          }
        },
        //phone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！'],
        //email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对']
      });

      var $ = layui.$,
        setter = layui.setter,
        admin = layui.admin,
        form = layui.form,
        router = layui.router(),
        search = router.search;

      form.render();

      //提交
      form.on('submit(LAY-user-login-submit)', function(obj) {
        data = obj.field;
        console.log(data);

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{url('login/login')}}",
          method: 'POST',
          data: obj.field,
          dataType: 'json',
          success: function(res) {
            console.log(res); 
            if (res.status == 200) {
              layer.msg('登入成功', {
                offset: '15px',
                icon: 1,
                time: 1000
              }, function() {
                location.href = '/';
              })
            } else if (res.status == 403) {
              layer.msg('登录失败请确认用户密码', {
                offset: '15px',
                icon: 1,
                time: 3000
              }, function() {
                location.href = '/login';
              })
            }
          },
          error: function(error) { console.log(error); return false;
            layer.msg('登录失败请确认信息', {
              offset: '15px',
              icon: 1,
              time: 3000
            }, function() {
              location.href = '/login';
            })
          }
        }
        );

                //勾选记住密码
                if (data.remember_user == "on") {
          var user_name = data.username;
          var user_password = data.password;
          $.cookie("remember_user", "true", {
            expires: 7
          }); // 存储一个带7天期限的 cookie
          $.cookie("user_name", user_name, {
            expires: 7
          }); // 存储一个带7天期限的 cookie
          $.cookie("user_password", user_password, {
            expires: 7
          }); // 存储一个带7天期限的 cookie
        } else {
          $.cookie("remember_user", "false", {
            expires: -1
          }); // 删除 cookie
          $.cookie("user_name", '', {
            expires: -1
          });
          $.cookie("user_password", '', {
            expires: -1
          });
        }
        return false;

      });

    });
  </script>
</body>

</html>