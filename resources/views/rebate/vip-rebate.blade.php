<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>VIP返利</title>
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
                  <button type="button" class="layui-btn" id="task-management">新建vip返水</button>

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
        <label class="layui-form-label">vip级别</label>
        <div class="layui-input-block">
          <input type="text" name="vip" required lay-verify="required" autocomplete="off" placeholder="请输入等级 例如 1" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">每日提款次数</label>
        <div class="layui-input-block">
          <input type="number" name="day_num" required lay-verify="required" autocomplete="off" placeholder="请输入次数" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">每日提款额度</label>
        <div class="layui-input-block">
          <input type="number" name="balance" required lay-verify="required" autocomplete="off" placeholder="请输入次数" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">升级礼金</label>
        <div class="layui-input-block">
          <input type="number" name="cash_gift" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">每月红包</label>
        <div class="layui-input-block">
          <input type="number" name="red_packet" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">最低转帐</label>
        <div class="layui-input-block">
          <input type="number" name="min_transfer" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">红利比例</label>
        <div class="layui-input-block">
          <input type="number" name="bonus" required lay-verify="required" autocomplete="off" placeholder="百分比" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">最高奖金</label>
        <div class="layui-input-block">
          <input type="number" name="max_bonus" required lay-verify="required" autocomplete="off" placeholder="最高奖金" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">流水倍数</label>
        <div class="layui-input-block">
          <input type="number" name="water_multiples" required lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
        </div>
      </div>


      <div class="layui-form-item">
        <label class="layui-form-label">次数限制</label>
        <div class="layui-input-block">
          <input type="number" name="num_restrict" required lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">场馆</label>
        <div class="layui-input-block">
          <input type="text" name="appoint" required lay-verify="required" autocomplete="off" placeholder="" class="layui-input">
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
          title: "新建VIP返水",
          area: ['620px', '750px'],
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
          url: "create/vip/rebate",
          method: 'post',
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
                location.href="vip-rebate";

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
        url:'query/vip/rebate',
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
              field: 'vip',
              title: 'vip等级',
              width: 180,
              align: 'center',

            },
            {
              field: 'day_num',
              title: '每日提款次数',
              align: 'center',
              width: 120
            },
            {
              field: 'balance',
              title: '每日提款额度',
              align: 'center',
              width: 180,
            }, {
              field: 'cash_gift',
              title: '升级礼金',
              width: 110,
              align: 'center',
              sort: true
            }, {
              field: 'red_packet',
              title: '每月红包',
              align: 'center',
              width: 130,
              sort: true
            }, {
              field: 'min_transfer',
              title: '最低转帐',
              align: 'center',
              width: 130,
              sort: true
            }, {
              field: 'bonus',
              title: '红利比例',
              align: 'center',
              width: 130,
              sort: true
            }, {
              field: 'max_bonus',
              title: '最高奖金',
              align: 'center',
              width: 130,
              sort: true
            }, {
              field: 'water_multiples',
              title: '流水倍数',
              align: 'center',
              width: 130,
              sort: true
            }, {
              field: 'num_restrict',
              title: '次数限制',
              align: 'center',
              width: 130,
              sort: true
            }, {
              field: 'appoint',
              title: '指定场馆',
              align: 'center',
              width: 130,
              sort: true
            }
          ]
        ],
        parseData: function(res) { //res 即为原始返回的数据
          console.log(res);
          return {
            "code": 0, //解析接口状态
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
