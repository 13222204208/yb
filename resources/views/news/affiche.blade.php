<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title>公告发送</title>
	<meta name="renderer" content="webkit">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
	<link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
	<style>
		.layui-card {
			margin-left: 20px;
		}
	</style>
</head>

<body>
	<div class="layui-col-md12" style="padding: 30px;">
		<form class="layui-form" action="" style="width: 60%;">

			<div class="layui-form-item">
				<label class="layui-form-label">公告标题</label>
				<div class="layui-input-block">
					<input type="text" name="affiche_title" value="" class="layui-input" style="width: 350px;display: inline-block;">

				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">公告内容</label>
				<div class="layui-input-block">
					<textarea class="layui-input" name="affiche_content" style="width: 350px;height:100px;display: inline-block;"></textarea>
				</div>
			</div>
	
			<div class="layui-form-item">
				<label class="layui-form-label">重要公告</label>
				<div class="layui-input-block">
					<input type="radio" name="great_affiche" lay-skin="primary" title="是" value="1" checked="">
					<input type="radio" name="great_affiche" lay-skin="primary" title="否" value="0" checked="checked">
				</div>
			</div>




			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>
		</form>

	</div>
	<div class="layui-col-md12" >
	<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
  <script type="text/html" id="barDemo">

    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
  </script>  
	</div>
	<script src="/layuiadmin/layui/layui.js"></script>
	<script src="/layuiadmin/layui/jquery3.2.js"></script>
	<script>
		layui.use(['form', 'laydate','table'], function() {
			var form = layui.form;
			var laydate = layui.laydate;
			var table = layui.table;

			table.render({
        elem: '#LAY_table_user',
        url:'query/affiche',
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
              field: 'affiche_title',
              title: '标题',
              width: 180,
              align: 'center',
           
            },{
              field: 'affiche_content',
              title: '内容',
              width: 280,
              align: 'center',
            
            },
            {
              field: 'great_affiche',
              title: '重要公告',
			  align: 'center',
			  templet: function(d){
				  if (d.great_affiche == 1) {
					  return "是";
				  }else{
					  return "否";
				  }
			  },
              width: 100,
            }, {
              field: 'created_at',
              title: '发送时间',
              align: 'center',
              width: 200
            },{
              fixed: 'right',
              title:"操作",
              width: 180,
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
        toolbar: '#toolbarDemo',
        title: '后台广告管理',
        totalRow: true

	  });
	  
	  
      table.on('tool(user)', function(obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

                 if (layEvent === 'del') { //删除
                  layer.confirm('真的删除行么', function(index) {
                    $.ajax({
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                      url: "del/affiche",
                      type: 'post',                     
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
                }});


			//监听提交
			form.on('submit(formDemo)', function(data) {
				//layer.msg(JSON.stringify(data.field));
				var data = data.field;
				console.log(data);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "send/affiche",
					method: 'POST',
					data: data,
					dataType: 'json',
					success: function(res) {
					
						if (res.status == 200) {
							console.log(res);
							layer.msg('发送成功', {
								offset: '15px',
								icon: 1,
								time: 3000
							})
						} else if (res.status == 404) {
						
							layer.msg('用户不存在', {
								offset: '15px',
								icon: 2,
								time: 3000
							})
						}else{
							layer.msg('发送失败', {
								offset: '15px',
								icon: 2,
								time: 3000
							})
						} 
					},
					error: function(error) {
						console.log(error);
						layer.msg('发送失败请重新确认', {
							offset: '15px',
							icon: 2,
							time: 3000
						})
					}
				});

				return false;
			});


			//phone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！'],
			//email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对']
		});
	</script>
</body>

</html>