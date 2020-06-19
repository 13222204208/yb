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
 
<div class="demoTable" style="margin:20px;">
  搜索帐号：
  <div class="layui-inline">
    <input class="layui-input" name="id" id="demoReload" autocomplete="off">
  </div>
  <button class="layui-btn" data-type="reload">查询</button>
</div>

<div class="mainTop layui-clear">

    <div class="fr">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">选择角色：</label>
                    <div class="layui-input-inline">
                        <select name="city" lay-verify="required" class="select_wd120">
                          <option value="">全部</option>
                            <option value="0">角色1</option>
                            <option value="1">角色2</option>
                            <option value="2">角色3</option>
                        </select>
                    </div>
                </div>

                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn layui-btn-blue" id="admin-management">新建帐号</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="layui-row" id="layuiadmin-form-admin" style="display:none;">
    <form class="layui-form layui-from-pane" required lay-verify="required" style="margin:20px">

      <div class="layui-form-item">
        <label class="layui-form-label">帐号</label>
        <div class="layui-input-block">
          <input type="text" name="f_mission_content" required lay-verify="required" autocomplete="off" placeholder="请输入帐号" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">密码</label>
        <div class="layui-input-block">
          <input type="password" name="f_mission_content" required lay-verify="required" autocomplete="off" placeholder="请输入密码" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-block">
          <input type="text" name="f_mission_content" required lay-verify="required" autocomplete="off" placeholder="请输入名称" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">角色</label>
        <div class="layui-input-block">
          <select name="interest" lay-filter="aihao">
            <option value="0">角色1</option>
            <option value="1">角色2</option>
          </select>
        </div>
      </div>
      
     
      

      <div class="layui-form-item ">
        <div class="layui-input-block">
          <div class="layui-footer" style="left: 0;">
            <button class="layui-btn" lay-submit="" lay-filter="createTask">保存</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </div>
    </form>
  </div>


 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
<script type="text/html" id="barDemo">

    <a class="layui-btn layui-btn-xs" lay-event="agree">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">删除</a>
  </script>  
               
      
<script src="/layuiadmin/layui/layui.js"></script>

<script>
layui.use(['table','laydate','jquery'], function(){
  var table = layui.table;
  var laydate = layui.laydate;
  var $ = layui.jquery;

  $(document).on('click', '#admin-management', function() {
        layer.open({
          //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
          type: 1,
          title: "新建帐号",
          area: ['620px', '400px'],
          content: $("#layuiadmin-form-admin") //引用的弹出层的页面层的方式加载修改界面表单
        });
      });

  laydate.render({
    elem: '#dateTime'
    ,range: true
  });
  
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
/*     ,url: '/demo/table/user/' */
    ,cols: [[

      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '帐号', width:120}
      ,{field:'cz', title: '名称', width:120}
      ,{field:'jl', title: '角色', width:120}
      ,{field:'name', title: '状态', width:160}
      ,{
              fixed: 'right',
              title:"操作",
              width: 150,
              align: 'center',
              toolbar: '#barDemo'
            }
    ]]
    ,data: [{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
    },{
      "id": "10001"
      ,"username": "yangpanda"
      ,"cz": "杨大虎"
      ,"jl": "管理员"
      ,"name": "使用中"
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