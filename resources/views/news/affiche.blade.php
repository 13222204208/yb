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

	<script src="/layuiadmin/layui/layui.js"></script>
	<script src="/layuiadmin/layui/jquery3.2.js"></script>
	<script>
		layui.use(['form', 'laydate'], function() {
			var form = layui.form;
			var laydate = layui.laydate;





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