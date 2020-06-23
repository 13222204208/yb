<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>申请</title>
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


  <div class="mainTop layui-clear" style="margin:20px">

    <div class="fr">
      <form class="layui-form layui-from-pane" required lay-verify="required" action="">
        <div class="layui-form-item">
          用户名：
          <div class="layui-inline">
            <input class="layui-input" name="username" autocomplete="off">
          </div>
          订单号:
          <div class="layui-inline">
            <input class="layui-input" name="order_num" autocomplete="off">
          </div>
          <div class="layui-inline">
            <label class="layui-form-label">状态：</label>
            <div class="layui-input-inline">
              <select name="state"  class="select_wd120">
                <option value="">全部</option>
                <option value="0">已拒绝</option>
                <option value="1">已同意</option>
                <option value="2">未处理</option>
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


  <script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="agree">同意</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">拒绝</a>
  </script>
  <script src="/layuiadmin/layui/layui.js"></script>

  <script>
    layui.use(['table', 'laydate', 'jquery', 'form'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var $ = layui.jquery;
      var form = layui.form;

      laydate.render({
        elem: '#startTime',
        type: 'datetime'
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

      //方法级渲染
      table.render({
        elem: '#LAY_table_user',
        url: 'query/recharge',
        cols: [
          [

            {
              field: 'id',
              title: 'ID',
              width: 80,
              sort: true
            }, {
              field: 'order_num',
              title: '订单号',
              width: 200
            }, {
              field: 'username',
              title: '用户名',
              width: 120
            }, {
              field: 'recharge_money',
              title: '充值金额',
              width: 120
            }, {
              field: 'remit_way',
              title: '汇款方式',
              width: 120
            }, {
              field: 'remit_card',
              title: '汇款卡号',
              width: 260
            }, {
              field: 'make_card',
              title: '收款卡号',
              width: 260
            }, {
              field: 'remit_time',
              title: '汇款时间',
              sort: true,
              width: 160
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
            }
          ]
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
        page: true,
        height: 700
      });

      form.on('submit(search)', function(data) {
        var data = data.field;
        console.log(data);
        //return false;
        table.render({
        elem: '#LAY_table_user',
        url: 'search/recharge',
        where:{
          order_num :data.order_num,
          username :data.username,
          state:data.state,
          startTime:data.startTime,
          stopTime:data.stopTime
        },
        cols: [
          [

            {
              field: 'id',
              title: 'ID',
              width: 80,
              sort: true
            }, {
              field: 'order_num',
              title: '订单号',
              width: 200
            }, {
              field: 'username',
              title: '用户名',
              width: 120
            }, {
              field: 'recharge_money',
              title: '充值金额',
              width: 120
            }, {
              field: 'remit_way',
              title: '汇款方式',
              width: 120
            }, {
              field: 'remit_card',
              title: '汇款卡号',
              width: 260
            }, {
              field: 'make_card',
              title: '收款卡号',
              width: 260
            }, {
              field: 'remit_time',
              title: '汇款时间',
              sort: true,
              width: 160
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
            }
          ]
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
        page: true,
        height: 700
      });
        return false;
      });

      table.on('tool(user)', function(obj) {
        var data = obj.data;
        if (obj.event === 'agree') {
          layer.confirm('确定同意申请', function(index) {
            $.ajax({
              url: "agree/recharge",
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
              url: "resuse/recharge",
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