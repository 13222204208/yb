<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>任务管理</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
</head>

<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">

          <div class="layui-card-body" pad15>

            <div class="layui-form" lay-filter="">
              <div class="layui-card-body">
                <div class="layui-upload">
                  <button type="button" class="layui-btn" id="task-management">新建返水等级</button>

                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <table id="demo" lay-filter="test"></table>

  <div class="layui-row" id="popCreateTask" style="display:none;">
    <form class="layui-form layui-from-pane" required lay-verify="required" style="margin:20px">

      <div class="layui-form-item">
        <label class="layui-form-label">返水等级</label>
        <div class="layui-input-block">
          <input type="text" name="rebate_grade" required lay-verify="required" autocomplete="off" placeholder="请输入等级 例如 一级" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">游戏类型</label>
        <div class="layui-input-inline">
          <select name="game_type" required id="f_mission_event">
            <option value="体育">体育</option>
            <option value="竞技">竞技</option>
            <option value="棋牌">棋牌</option>
          </select>
        </div>

      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">返水名称</label>
        <div class="layui-input-block">
          <input type="text" name="rebate_name" required lay-verify="required" autocomplete="off" placeholder="请输入返水名称" class="layui-input">
        </div>
      </div>


      <div class="layui-form-item">
        <label class="layui-form-label">额度</label>
        <div class="layui-input-block">
          <input type="number" name="money" required lay-verify="required" autocomplete="off" placeholder="请输入额度" class="layui-input">
        </div>
      </div>


      <div class="layui-form-item">
        <label class="layui-form-label">返水比例(%)</label>
        <div class="layui-input-block">
          <input type="number" name="rebate_scale" required lay-verify="required" autocomplete="off" placeholder="请输入返水比例" class="layui-input">
        </div>
      </div>

      

      <div class="layui-form-item ">
        <div class="layui-input-block">
          <div class="layui-footer" style="left: 0;">
            <button class="layui-btn" lay-submit="" lay-filter="createTask">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </div>
    </form>
  </div>


 



  <script src="/layuiadmin/layui/layui.js"></script>
 <!--  <script src="/layuiadmin/layui/jquery3.2.js"></script> -->
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
          title: "新建返水等级",
          area: ['620px', '480px'],
          content: $("#popCreateTask") //引用的弹出层的页面层的方式加载修改界面表单
        });
      });

      form.on('submit(createTask)', function(data) {
        var data = data.field;
        console.log(data);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "create/rebate",
          method: 'POST',
          data: data,
          success: function(res) {
            console.log(res);
            if (res.status == 200) {
              layer.msg('保存成功', {
                offset: '15px',
                icon: 1,
                time: 3000
              });
              setTimeout(function() {

                layer.closeAll(); //关闭所有的弹出层
                location.href="rebate-rate";

              }, 2000);
            } else {
              console.log(res);
              layer.msg('保存失败', {
                offset: '15px',
                icon: 2,
                time: 3000
              })
            }
          }
        });
        return false;
      });

      //第一个实例
      table.render({
        elem: '#demo',
        height: 600,
        url:'query/rebate',
        page: true //开启分页
          ,
        cols: [
          [ //表头
            {
              field: 'id',
              title: 'ID',
              width: 80,
              align: 'center',
              sort: true
            },
            {
              field: 'rebate_grade',
              title: '返水等级',
              width: 180,
              align: 'center',
    
            },
            {
              field: 'game_type',
              title: '游戏类型',
              align: 'center',
              width: 220
            },
            {
              field: 'rebate_name',
              title: '返水名称',
              align: 'center',
              width: 180,
            }, {
              field: 'money',
              title: '额度',
              width: 110,
              align: 'center',
              sort: true
            }, {
              field: 'rebate_scale',
              title: '返水比例',
              align: 'center',
              width: 130,
              sort: true
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
        toolbar: '#toolbarDemo',
        title: '后台广告管理',
        totalRow: true

      });



    });
  </script>
</body>

</html>