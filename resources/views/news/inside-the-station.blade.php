<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title>邮件发送</title>
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
				<label class="layui-form-label">类型</label>
				<div class="layui-input-block">
					<input type="radio" lay-filter="MailType" name="news_type" value="1" title="个人邮件" checked="checked">
					<input type="radio" lay-filter="MailType" name="news_type" value="0" title="全服邮件">
				</div>
			</div>
			<div class="layui-form-item" id="geren">
				<label class="layui-form-label">收件人</label>
				<div class="layui-input-block">
					<input type="text" name="username" value="" class="layui-input" style="width: 350px;display: inline-block;">

				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">邮件标题</label>
				<div class="layui-input-block">
					<input type="text" name="news_title" value="" class="layui-input" style="width: 350px;display: inline-block;">

				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">邮件内容</label>
				<div class="layui-input-block">
					<textarea class="layui-input" name="news_content" style="width: 350px;height:100px;display: inline-block;"></textarea>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">发送时间</label>
				<div class="layui-input-block">
					<input type="text" name="start_time" id="send-time" value="" class="layui-input" style="width: 350px;display: inline-block;">

				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">销毁时间</label>
				<div class="layui-input-block">
					<input type="text" name="destroy_time" id="del-time" value="" class="layui-input" style="width: 350px;display: inline-block;">

				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">重大邮件</label>
				<div class="layui-input-block">
					<input type="radio" name="great_news" lay-skin="primary" title="是" value="1" checked="">
					<input type="radio" name="great_news" lay-skin="primary" title="否" value="0" checked="checked">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">奖励金币</label>
				<div class="layui-input-block">
					<input type="number" name="award_gold" value="" placeholder="请输入金币数量" class="layui-input" style="width: 350px;display: inline-block;">

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

			laydate.render({
				elem: '#del-time',
				type: 'datetime',
				min: getNowFormatDate()
			});
			laydate.render({
				elem: '#send-time',
				type: 'datetime',
				min: getNowFormatDate()
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
				var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate +
					" " + date.getHours() + seperator2 + date.getMinutes() +
					seperator2 + date.getSeconds();
				return currentdate;
			}

			form.on('radio(MailType)', function(data) {
				console.log(data.elem); //得到radio原始DOM对象
				console.log(data.value); //被点击的radio的value值
				if (data.value == '0') {
					$('#geren').hide();
				} else {
					$('#geren').show();
				}
			});

			//监听提交
			form.on('submit(formDemo)', function(data) {
				//layer.msg(JSON.stringify(data.field));
				var data = data.field;
				console.log(data);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "send/news",
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