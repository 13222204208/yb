<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>角色管理 </title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
</head>

<body>

  <div class="demoTable" style="margin:30px;">
    <button class="layui-btn" data-type="reload" id="admin-management">添加新角色</button>

  </div>

  <div class="layui-row" id="layuiadmin-form-admin" style="display:none;">
    <form class="layui-form layui-from-pane" required lay-verify="required" style="margin:20px">

      <div class="layui-form-item">
        <label class="layui-form-label">角色名称</label>
        <div class="layui-input-block">
          <input type="text" name="role_name" required lay-verify="role_name" autocomplete="off" placeholder="请输入角色名称" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item ">
        <div class="layui-input-block">
          <div class="layui-footer" style="left: 0;">
            <button class="layui-btn" lay-submit="" lay-filter="create">保存</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="layui-form" lay-filter="layuiadmin-form-role" id="layuiadmin-form-role" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
      <label class="layui-form-label">角色</label>
      <div class="layui-input-block">
        <select name="rolename" lay-filter="selectRole">

        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">权限范围</label>
      <div class="layui-input-block" id="roleScope">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="用户管理" value="user">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="财务管理" value="finance">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="记录查询" value="record">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="返水管理" value="rebate">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="支付管理" value="pay">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="系统管理" value="system">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="平台管理" value="platform">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="活动管理" value="activity">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="内容管理" value="content">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="消息管理" value="news">
        <input type="checkbox" name="limits[]" lay-skin="primary" title="反馈管理" value="feedback">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">具体描述</label>
      <div class="layui-input-block">
        <textarea type="text" name="describe" lay-verify="" autocomplete="off" class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item ">
      <div class="layui-input-block">
        <div class="layui-footer" style="left: 0;">
          <button class="layui-btn" lay-submit="" lay-filter="createRole">保存</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
    </div>
  </div>

  <script src="/layuiadmin/layui/layui.js"></script>
  <script>
    layui.use(['table', 'laydate', 'jquery', 'form'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var $ = layui.jquery;
      var form = layui.form;

      $(document).on('click', '#admin-management', function() {
        layer.open({
          //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
          type: 1,
          title: "新建角色",
          area: ['420px', '200px'],
          content: $("#layuiadmin-form-admin") //引用的弹出层的页面层的方式加载修改界面表单
        });
      });

      form.verify({
        role_name: function(value) {
          if (value.length > 8) {
            return '最多只能八个字符';
          }
        }
      });

      form.on('select(selectRole)', function(data) {

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "query/role/scope",
          method: 'POST',
          data: {
            'role_name': data.value
          },
          dataType: 'json',
          success: function(res) {
            var arr = res.data
            if (res.status == 200) {
               var array = new Array('user', 'finance', 'record', 'rebate', 'pay', 'system', 'platform', 'activity', 'content', 'news', 'feedback')

              var zh = new Array('用户管理', '财务管理', '记录查询', '返水管理',
                '支付管理', '系统管理', '平台管理', '活动管理', '内容管理', '消息管理', '反馈管理');
              optionData = "";
            
              let arraySel = Object.values(arr)
              console.log(arraySel);
              for (let index = 0; index < array.length; index++) {
                const element = array[index];
                const t = zh[index];
                istrue = false;
                for (let i = 0; i < arraySel.length; i++) {
                  if (arraySel[i]== element) {
                    istrue = true;
                  }   
                }
                if (istrue) {
                  optionData += '<input type="checkbox" checked  name="limits[]" lay-skin="primary" title="' + t + '" value="' + element + '">';
                } else {
                  optionData += '<input type="checkbox"  name="limits[]" lay-skin="primary" title="' + t + '" value="' + element + '">';
                }
              }
              console.log(optionData);
              $("#roleScope").html(optionData);
              form.render(); 

            } else if (res.status == 403) {
             /*  layer.msg('获取失败', {
                offset: '15px',
                icon: 2,
                time: 3000
              }) */
            }
          }
        });
        return false;
      });
      //监听提交
      form.on('submit(create)', function(data) {

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "add/role",
          method: 'POST',
          data: data.field,
          dataType: 'json',
          success: function(res) {
            console.log(res);
            if (res.status == 200) {
              layer.msg('创建角色名称成功', {
                offset: '15px',
                icon: 1,
                time: 1000
              }, function() {
                location.href = 'permission-settings';
              })
            } else if (res.status == 403) {
              layer.msg('填写错误或角色名重复', {
                offset: '15px',
                icon: 2,
                time: 3000
              }, function() {
                location.href = 'permission-settings';
              })
            }
          }
        });
        return false;
      });

      //保存角色权限
      form.on('submit(createRole)', function(data) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "add/role/scope",
          method: 'POST',
          data: data.field,
          dataType: 'json',
          success: function(res) {
            console.log(res);
            if (res.status == 200) {
              layer.msg('保存角色权限范围成功', {
                offset: '15px',
                icon: 1,
                time: 2000
              })
            } else if (res.status == 403) {
              layer.msg('填写错误', {
                offset: '15px',
                icon: 2,
                time: 3000
              }, function() {
                location.href = 'permission-settings';
              })
            }
          }
        });
        return false;
      });

      //获取角色名称
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/role",
        method: 'get',
        dataType: 'json',
        success: function(res) {
         
          status = res.status;
          role_name = res.role_name;
          if (status == 200) {
            options = "<option value=''>选择角色</option>";
            for (var i = 0; i < role_name.length; i++) {
              var t = role_name[i];
            
              options += '<option value="' + t.role_name + '">' + t.role_name + '</option>';
            }
            console.log(options);
            $("select[name='rolename']").html(options);
            form.render('select');
          } else if (res.status == 403) {
            layer.msg('填写错误或角色名重复', {
              offset: '15px',
              icon: 2,
              time: 3000
            }, function() {
              location.href = 'permission-settings';
            })
          }
        }
      });
    })
  </script>
</body>

</html>