<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>活动申请</title>
  <meta name="renderer" content="webkit">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
    layui.use(['table', 'laydate','jquery'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var $ = layui.jquery;
      laydate.render({
        elem: '#dateTime',
        range: true
      });

      //方法级渲染
      table.render({
        elem: '#LAY_table_user',
        url: 'query/apply/list',
        cols: [
          [{
            field: 'id',
            title: 'ID',
            width: 80,
            sort: true
          }, {
            field: 'username',
            title: '申请用户',
            width: 180
          }, {
            field: 'activity_title',
            title: '申请活动',
            width: 180
          }, {
            field: 'apply_time',
            title: '申请时间',
            width: 180
          }, {
            field: 'award_num',
            title: '赠送金额',
            width: 120
          }, {
            field: 'state',
            title: '状态',
            sort: true,
            width: 100,
            templet: function(d) {
              if (d.state == 1) {
                return "已同意";
              } else if (d.state == 2) {
                return "未处理";
              } else {
                return "已拒绝";
              }
            }
          }, {
            fixed: 'right',
            title: "操作",
            width: 150,
            align: 'center',
            toolbar: '#barDemo'
          }]
        ],
        parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        },
        id: 'testReload',
        page: true

      });

      table.on('tool(user)', function(obj) {
        var data = obj.data;
        if (obj.event === 'agree') {
          layer.confirm('确定同意申请', function(index) {
            $.ajax({
              url: "agree/apply/activity",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "POST",
              data: {
                id: data.id
              },
              success: function(msg) {

                if (msg.status == 200) {
                  //关闭弹框
                  layer.msg("已同意", {
                    icon: 1
                  });
                  setTimeout(function() {

                    obj.update({

                      state: 1
                    }); //修改成功修改表格数据不进行跳转 


                    layer.closeAll(); //关闭所有的弹出层
                    //window.location.href = "/edit/horse-info";

                  }, 1000);
                } else {
                  layer.msg("失败", {
                    icon: 5
                  });
                }
              }
            });
            return false;
          });
        } else if (obj.event === 'resuse') {
          layer.confirm('确定拒绝申请', function(index) {
            $.ajax({
              url: "resuse/apply/activity",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "POST",
              data: {
                id: data.id
              },
              success: function(msg) {

                if (msg.status == 200) {
                  //关闭弹框
                  layer.msg("已拒绝", {
                    icon: 1
                  });
                  setTimeout(function() {

                    obj.update({

                      state: 0
                    }); //修改成功修改表格数据不进行跳转 


                    layer.closeAll(); //关闭所有的弹出层
                    //window.location.href = "/edit/horse-info";

                  }, 1000);
                } else {
                  layer.msg("失败", {
                    icon: 5
                  });
                }
              }
            });
            return false;
          });
        }
      });

    });
  </script>

</body>

</html>