<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>支付管理</title>
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
                  <button type="button" class="layui-btn" id="task-management">新增支付宝二维码</button>

                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <table id="demo" lay-filter="test"></table>
  <script type="text/html" id="barDemo">

    <a class="layui-btn layui-btn-xs" lay-event="agree">开启</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">删除</a>
  </script>     

  <div class="layui-row" id="popCreateTask" style="display:none;">
    <form class="layui-form layui-from-pane" required lay-verify="required" style="margin:20px">

      <div class="layui-form-item">
        <label class="layui-form-label">二维码名称</label>
        <div class="layui-input-block">
          <input type="text" name="f_mission_content" required lay-verify="required" autocomplete="off" placeholder="请输入二维码名称" value="" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <div class="layui-upload" style="margin-left: 20%;">
            <button type="button" class="layui-btn" id="test1">上传二维码</button>
            <div class="layui-upload-list">
              <img class="layui-upload-img" id="demo1">
              <p id="demoText"></p>
            </div>
          </div>   
     </div>

      <div class="layui-form-item">
        <label class="layui-form-label">单笔最低充值</label>
        <div class="layui-input-block">
          <input type="number" name="f_mission_weight" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">单笔最高充值</label>
        <div class="layui-input-block">
          <input type="number" name="f_mission_weight" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">单日充值上限</label>
        <div class="layui-input-block">
          <input type="number" name="f_mission_weight" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
          <input type="checkbox" checked="" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="开启|关闭">
        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label">今日充值金额</label>
        <div class="layui-input-block">
          <input type="number" name="f_mission_weight" required lay-verify="required" autocomplete="off" placeholder="请输入金额" class="layui-input">
        </div>
      </div>
     
      

      <div class="layui-form-item ">
        <div class="layui-input-block">
          <div class="layui-footer" style="left: 0;">
            <button class="layui-btn" lay-submit="" lay-filter="createTask">新增支付宝二维码</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </div>
    </form>
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
          title: "新增支付宝二维码",
          area: ['620px', '680px'],
          content: $("#popCreateTask") //引用的弹出层的页面层的方式加载修改界面表单
        });
      });

      //第一个实例
      table.render({
        elem: '#demo',
        height: 600,

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
            },{
              field: 'name',
              title: '二维码名称',
              width: 180,
              align: 'center',
              sort: true
            },{
              field: 'bank',
              title: '二维码',
              width: 180,
              align: 'center',
              sort: true
            },
            {
              field: 'min',
              title: '单笔最低充值',
              align: 'center',
              width: 130,
            }, {
              field: 'max',
              title: '单笔最高充值',
              width: 130,
              align: 'center',
              sort: true
            }, {
              field: 'full',
              title: '单日充值上限',
              align: 'center',
              width: 130
            }, {
              field: 'state',
              title: '状态',
              align: 'center',
              width: 150
            }, {
              field: 'num',
              title: '今日充值金额',
              align: 'center',
              width: 180
            },{
              fixed: 'right',
              title:"操作",
              width: 150,
              align: 'center',
              toolbar: '#barDemo'
            }
          ]
        ],data: [{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },{
            "id": "206"
       ,"name": "李商隐"
      ,"bank": "斗鱼虎牙"
      ,"min": "1000"
      ,"max": "1000000"
      ,"full": "10000000"
      ,"state": "开启"
      ,"num": "10000"
    },
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


      table.on('tool(test)', function(obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

        /*         if (layEvent === 'del') { //删除
                  layer.confirm('真的删除行么', function(index) {
                    $.ajax({
                      url: "{{url('/del/horse')}}",
                      type: 'get',
                      datatype: 'json',
                      data: {
                        'id': data.f_id
                      }, //向服务端发送删除的id
                      success: function(res) {
                        console.log(res);
                        if (res == '{"status":200}') {
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
                } else  */
        if (layEvent === 'edit') { //编辑

          layer.open({
            //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
            type: 1,
            title: "编辑任务",
            area: ['620px', '550px'],
            content: $("#popUpdateTask") //引用的弹出层的页面层的方式加载修改界面表单
          });
          // console.log(data);
          form.val("updateTask", data);
          setFormValue(obj, data);

          var openTakeaway = data.f_mission_state;
          console.log(openTakeaway);
          if (openTakeaway == 1) {
            $("#taskState").prop("checked", true);
          } else {
            $("#taskState").prop("checked", false);
          }

          var openTakeawayTwo = data.f_mission_day_refresh;
          if (openTakeawayTwo == 1) {
            $("#taskRefresh").prop("checked", true);
          } else {
            $("#taskRefresh").prop("checked", false);
          }

          var stime = util.toDateString(data.f_mission_start_time * 1000, "yyyy-MM-dd HH:mm:ss");
          var ctime = util.toDateString(data.f_mission_close_time * 1000, "yyyy-MM-dd HH:mm:ss");
          laydate.render({ //日期时间选择器
            elem: '#f_mission_start_time',
            value: stime,
            type: 'datetime'
          });

          laydate.render({
            elem: '#f_mission_close_time',
            value: ctime,
            type: 'datetime'
          });

          form.render();
        } else if (layEvent === 'LAYTABLE_TIPS') {
          layer.alert('Hi，头部工具栏扩展的右侧图标。');
        }
      });
      //更新广告信息
      //监听弹出框表单提交，massage是修改界面的表单数据'submit(demo11),是修改按钮的绑定
      function setFormValue(obj, data) {
        form.on('submit(updateOneTask)', function(massage) {
          massage.field.f_mission_id = data.f_mission_id;
          if (massage.field.f_mission_day_refresh == "on") { //每日刷新
            massage.field.f_mission_day_refresh = 1;
          } else {
            massage.field.f_mission_day_refresh = 2;
          }

          if (massage.field.f_mission_state == "on") { //任务状态
            massage.field.f_mission_state = 1;
          } else {
            massage.field.f_mission_state = 2;
          }
          updateData = massage.field;
          // console.log(updateData); return false;
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{url('/update/game/task')}}",
            type: 'post',
            data: updateData,
            success: function(msg) {
              console.log(msg);
              if (msg == '{"status":200}') {
                layer.closeAll('loading');
                layer.load(2);
                layer.msg("修改成功", {
                  icon: 6
                });
                setTimeout(function() {

                  layer.closeAll(); //关闭所有的弹出层
                  window.location.href = "/game/task-management";

                }, 2000);

              } else {
                layer.msg("修改失败", {
                  icon: 5
                });
              }
            }
          })
          return false;
        })

      }

    });
  </script>
</body>

</html>