<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>轮播图</title>
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
</head>

<body>

  <table id="billing" lay-filter="test"></table>
  <script type="text/html" id="barDemo">

<!--     <a class="layui-btn layui-btn-xs" lay-event="agree">查看</a> -->

    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
  </script>     

  </div>


 



  <script src="/layuiadmin/layui/layui.js"></script>
  <script src="/layuiadmin/layui/jquery3.2.js"></script>
  <script>
    layui.use(['table', 'form', 'laydate', 'util', 'jquery'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var form = layui.form;
      var util = layui.util;
      var $ = layui.jquery;





      $(document).on('click', '#task-management', function() {
        layer.open({
          //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
          type: 1,
          title: "新增微信二维码",
          area: ['620px', '480px'],
          content: $("#popCreateTask") //引用的弹出层的页面层的方式加载修改界面表单
        });
      });

      //第一个实例
      table.render({
        elem: '#billing'
        ,url: 'query/bill/statistics' 
    ,cols: [[
     {field:'id', title: 'ID', width:80, sort: true} 
    ,{field:'deposit_num', title: '充值次数', width:120}
      ,{field:'deposit_sum', title: '充值总额', width:120}
      ,{field:'draw_money_num', title: '提款次数',  width:160}
      ,{field:'draw_money_sum', title: '提款总额',  width:160}
      ,{field:'reward_num', title: '奖励次数', width:120}
      ,{field:'reward_sum', title: '奖励总额', sort: true, width:160}
      ,{field:'backwater_num', title: '返水次数', width:120}
      ,{field:'backwater_sum', title: '返水总额',sort: true, width:160}
      ,{field:'profit_loss_sum', title: '本期收益', sort: true, width:160}
      ,{
              fixed: 'right',
              title:"操作",
              width: 150,
              align: 'center',
              toolbar: '#barDemo'
            }
    ]]
    ,parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        },
    page:true
    ,
        parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        },
        toolbar: '#toolbarDemo',
        title: '后台广告管理',
        totalRow: true

      });


      table.on('tool(test)', function(obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）
console.log(data);
              if (layEvent === 'del') { //删除
                  layer.confirm('真的删除行么', function(index) {
                    $.ajax({
                      url: "del/historical/bill",
                      type: 'get',
                      datatype: 'json',
                      data: {
                        'id': data.id
                      }, //向服务端发送删除的id
                      success: function(res) {
                        console.log(res);
                        if (res.status == 200) {
                          obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                          layer.close(index);
                          console.log(index);
                          layer.msg("删除成功", {
                            icon: 1
                          });
                        } else {
                          layer.msg("删除失败", {
                            icon: 5
                          });
                        }
                      }
                    });
                    layer.close(index);
                    //向服务端发送删除指令
                  });
                }else if (layEvent === 'LAYTABLE_TIPS') {
          layer.alert('Hi，头部工具栏扩展的右侧图标。');
        }
      });
    });
  </script>
</body>

</html>