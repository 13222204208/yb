<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>投注记录</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>

  </style>
</head>
<body>

<div class="mainTop layui-clear" style="margin:20px">

<div class="fr">
  <form class="layui-form layui-from-pane" required lay-verify="required" action="">
    <div class="layui-form-item">
      用户名：
      <div class="layui-inline">
        <input class="layui-input" name="username" autocomplete="off">
      </div>

      <div class="layui-inline">
        <label class="layui-form-label">游戏平台：</label>
        <div class="layui-input-inline">
          <select name="platform_name"  class="select_wd120">
            <option value="">全部</option>

          </select>
        </div>
      </div>
      <div class="layui-inline">
        <label class="layui-form-label">开始时间：</label>
        <div class="layui-input-inline">

          <input type="text" name="startTime" class="layui-input" id="startTime" placeholder="yyyy-MM-dd HH:mm:ss">
        </div>

      </div>

      <div class="layui-inline">
        <label class="layui-form-label">结束时间：</label>
        <div class="layui-input-inline">
          <input type="text" class="layui-input" name="stopTime" id="stopTime" placeholder="yyyy-MM-dd HH:mm:ss">
        </div>

      </div>
      <div class="layui-inline">
        <div class="layui-input-inline">
          <button type="button" class="layui-btn layui-btn-blue" lay-submit=""  lay-filter="search">搜索</button>
        </div>
      </div>
    </div>

  </form>
</div>
</div>

<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table>


<script src="/layuiadmin/layui/layui.js"></script>

<script>
   layui.use(['table', 'laydate', 'jquery', 'form'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var $ = layui.jquery;
      var form = layui.form;
      laydate.render({
        elem: '#startTime',
        type: 'datetime',
        max: getNowFormatDate()
      });
      //日期时间范围
      laydate.render({
        elem: '#stopTime',
        type: 'datetime',
        max: getNowFormatDate()
      });


      function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "-";
        var seperator2 = ":";
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
          month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
          strDate = "0" + strDate;
        }
        var currentdate = date.getFullYear() + seperator1 + month +
          seperator1 + strDate + " " + date.getHours() + seperator2 +
          date.getMinutes() + seperator2 + date.getSeconds();
        return currentdate;
      }

  $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/platform/name",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          status = res.status;
          platform_name = res.data;console.log(platform_name);
          if (status == 200) {
            options = "";
            for (var i = 0; i < platform_name.length; i++) {
              var t = platform_name[i];

              options += '<option value="' + t.platform_name + '">' + t.platform_name + '</option>';
            }

            $("select[name='platform_name']").html(options);
            form.render('select');
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      form.on('submit(search)', function(data) {
        var data = data.field;
        console.log(data);return false;
        table.render({
        elem: '#LAY_table_user'
        ,url: 'search/betting'
        ,where:{
          platform_name :data.platform_name,
          username :data.username,
          startTime:data.startTime,
          stopTime:data.stopTime
        }
        ,cols: [[
          {field:'id', title: 'ID', width:80, sort: true}
          ,{field:'username', title: '用户名', width:120}
          ,{field:'platform_name', title: '游戏平台', width:160}
          ,{field:'game_name', title: '游戏名', width:160}
          ,{field:'bottom_pour', title: '下注金额', width:160}
          ,{field:'group_money', title: '派彩金额',  width:160}
          ,{field:'bottom_pour_time', title: '下注时间',sort: true, width:200}
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
        return false;
      });


  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
    ,url: 'query/betting'
    ,cols: [[
      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:120}
      ,{field:'platform_name', title: '游戏平台', width:160}
      ,{field:'game_name', title: '游戏名', width:160}
      ,{field:'bottom_pour', title: '下注金额', width:160}
      ,{field:'group_money', title: '派彩金额',  width:160}
      ,{field:'bottom_pour_time', title: '下注时间',sort: true, width:200}
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
