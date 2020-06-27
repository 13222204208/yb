<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>反馈列表</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>

  </style>
</head>

<body>




  <table class="layui-hide" id="LAY_table_user" lay-filter="user"></table>


  <script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="agree">采纳</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">已读</a>
  </script>
  <script src="/layuiadmin/layui/layui.js"></script>

  <script>
    layui.use(['table', 'laydate', 'form', 'jquery'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var $ = layui.jquery;
      laydate.render({
        elem: '#dateTime',
        range: true
      });

      table.render({
        url: "query/feedback/list",
        page: true, //开启分页
        elem: '#LAY_table_user',
        cols: [
          [

            {
              field: 'id',
              title: 'ID',
              width: 80,
              sort: true
            }, {
              field: 'account_num',
              title: '提交人帐号',
              width: 150
            }, {
              field: 'feedback_type',
              title: '反馈类型',
              width: 150
            }, {
              field: 'feedback_content',
              title: '反馈内容',
              width: 260
            }, {
              field: 'img_url',
              title: '反馈图片',
              width: 200
            }, {
              field: 'created_at',
              title: '提交时间',
              width: 160
            }, {
              field: 'state',
              title: '状态',
              sort: true,
              width: 100
            }, {
              fixed: 'right',
              title: "操作",
              width: 150,
              align: 'center',
              toolbar: '#barDemo'
            }
          ]
        ],
        parseData: function(res) { //res 即为原始返回的数据
          console.log(res);
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        },
        title: '后台用户',
        totalRow: true

      });

      table.on('tool(user)', function(obj) {
        var data = obj.data;
        if (obj.event === 'agree') {
          layer.confirm('确定采纳反馈意见', function(index) {
            $.ajax({
              url: "agree",
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
                  layer.msg("已采纳", {
                    icon: 1
                  });
                  setTimeout(function() {

                    obj.update({

                      state: "已采纳"
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
          layer.confirm('确定已经阅读', function(index) {
            $.ajax({
              url: "resuse",
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
                  layer.msg("已读", {
                    icon: 1
                  });
                  setTimeout(function() {

                    obj.update({

                      state: "已读"
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