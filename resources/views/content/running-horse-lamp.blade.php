<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>跑马灯</title>
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
                  <button type="button" class="layui-btn" id="task-management">新建跑马灯</button>

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
        <label class="layui-form-label">内容</label>
        <div class="layui-input-block">
            <textarea type="text" name="content" lay-verify="required" autocomplete="off" class="layui-textarea"></textarea>

        </div>
      </div>

      <div class="layui-form-item">
        <label class="layui-form-label" >类型</label>
        <div class="layui-input-inline">
            <select name="type">
                <option value="公告">公告</option>
                <option value="活动">活动</option>
              </select>
      
        </div>
      </div>
      <div class="layui-form-item">
      <div class="layui-inline">
        <label class="layui-form-label">开始时间</label>
        <div class="layui-input-inline">
          <input type="text" class="layui-input" name="start_time" id="start-time" placeholder="yyyy-MM-dd HH:mm:ss">
        </div>
      </div>
      </div>

      <div class="layui-form-item">
      <div class="layui-inline">
        <label class="layui-form-label">结束时间</label>
        <div class="layui-input-inline">
          <input type="text" class="layui-input" name="stop_time" id="stop-time" placeholder="yyyy-MM-dd HH:mm:ss">
        </div>
      </div>
      </div>

      <div class="layui-form-item ">
        <div class="layui-input-block">
          <div class="layui-footer" style="left: 0;">
            <button class="layui-btn" lay-submit="" lay-filter="createTask">新建跑马灯</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </div>
    </form>
  </div>


 



  <script src="/layuiadmin/layui/layui.js"></script>
  <script src="/layuiadmin/layui/jquery3.2.js"></script>
  <script>
    layui.use(['table', 'form', 'laydate', 'layer', 'jquery'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var form = layui.form;
      var layer = layui.layer;
      var $ = layui.jquery;

  //日期时间选择器
  laydate.render({
    elem: '#start-time'
    ,type: 'datetime'
  });

    //日期时间选择器
    laydate.render({
    elem: '#stop-time'
    ,type: 'datetime'
  });



      $(document).on('click', '#task-management', function() {
        layer.open({
          //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
          type: 1,
          title: "新建跑马灯",
          area: ['620px', '480px'],
          content: $("#popCreateTask") //引用的弹出层的页面层的方式加载修改界面表单
        });
      });

      //第一个实例
      table.render({
        elem: '#demo',
        height: 600,
        url:'query/running/horse',
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
              field: 'content',
              title: '内容',
              width: 280,
              align: 'center',
              sort: true
            },{
              field: 'type',
              title: '类型',
              width: 140,
              align: 'center',
              sort: true
            },
            {
              field: 'start_time',
              title: '开始时间',
              align: 'center',
              width: 200,
            }, {
              field: 'stop_time',
              title: '结束时间',
              align: 'center',
              width: 200
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

      form.on('submit(createTask)', function(data) {//新建跑马灯
				var data = data.field;
			//	console.log(data);return false;
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "create/running/horse",
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
              layer.closeAll(); 
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
  

    });
  </script>
</body>

</html>