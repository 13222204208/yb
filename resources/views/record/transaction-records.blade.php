<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>交易记录</title>
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
      订单号:
      <div class="layui-inline">
        <input class="layui-input" name="order_num" autocomplete="off">
      </div>
      <div class="layui-inline">
        <label class="layui-form-label">交易类型：</label>
        <div class="layui-input-inline">
          <select name="business_type"  class="select_wd120">
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
        url: "query/business/type",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          status = res.status;
          business_type = res.data; console.log(business_type);
          if (status == 200) {
            options = "<option value=''>全部</option>";
            for (var i = 0; i < business_type.length; i++) {
             // var business_type= business_type[i];

              options += '<option value="' + business_type[i] + '">' + business_type[i] + '</option>';
            }

            $("select[name='business_type']").html(options);
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
        console.log(data);
        //return false;
        table.render({
        elem: '#LAY_table_user',
        url: 'search/transaction',
        where:{
          order_num :data.order_num,
          username :data.username,
          business_type:data.business_type,
          startTime:data.startTime,
          stopTime:data.stopTime
        },
        cols: [[
      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:150}
      ,{field:'order_num', title: '订单号', width:360}
      ,{field:'business_mode', title: '交易方式', width:180,
            templet: function(d) {
                switch (d.business_mode) {
                    case 10101:
                        return '网关支付';
                    case 10108:
                        return '支付宝宝转卡(扫码)';
                    case 10109:
                        return '支付宝宝转卡(H5)';
                    default:
                        break;
                }
              }}
      ,{field:'business_money', title: '交易金额', width:120}
     // ,{field:'balance', title: '钱包余额', width:120}
      ,{field:'business_state', title: '交易状态',  width:160}
      ,{field:'ask_time', title: '申请时间',  width:260}
     // ,{field:'auditing_time', title: '审核时间',sort: true, width:260}
    ]],
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
      });
        return false;
      });

  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
  ,url: 'query/transaction'
    ,cols: [[
        {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'username', title: '用户名', width:150}
      ,{field:'order_num', title: '订单号', width:360}
      ,{field:'business_mode', title: '交易方式', width:180,
        templet: function(d) {
                switch (d.business_mode) {
                    case 10101:
                        return '网关支付';
                    case 10108:
                        return '支付宝宝转卡(扫码)';
                    case 10109:
                        return '支付宝宝转卡(H5)';
                    default:
                        break;
                }
              }}
      ,{field:'business_money', title: '交易金额', width:120}
     // ,{field:'balance', title: '钱包余额', width:120}
      ,{field:'business_state', title: '交易状态',  width:160}
      ,{field:'ask_time', title: '申请时间',  width:260}
     // ,{field:'auditing_time', title: '审核时间',sort: true, width:260}

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
