<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8">
		<title>邮件发送</title>
		<meta name="renderer" content="webkit">
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
						<input type="radio" lay-filter="MailType" name="MailType" value="0" title="个人邮件" checked="checked">
						<input type="radio" lay-filter="MailType" name="MailType" value="1" title="全服邮件" >
					</div>
				</div>
				<div class="layui-form-item" id="geren">
					<label class="layui-form-label">收件人</label>
					<div class="layui-input-block">
						<input type="text" name="RoleID" value="0" class="layui-input" style="width: 350px;display: inline-block;">

					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">邮件标题</label>
					<div class="layui-input-block">
						<input type="text" name="Title" value="1" class="layui-input" style="width: 350px;display: inline-block;">

					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">邮件内容</label>
					<div class="layui-input-block">
						<textarea class="layui-input" name="Content" style="width: 350px;height:100px;display: inline-block;"></textarea>
					</div>
				</div>
<!-- 				<div class="layui-form-item">
					<label class="layui-form-label">发送时间</label>
					<div class="layui-input-block">
						<input type="text" name="StartTime" id="test1" value="" class="layui-input" style="width: 350px;display: inline-block;">

					</div>
                </div> -->
                <div class="layui-form-item">
					<label class="layui-form-label">发送时间</label>
					<div class="layui-input-block">
						<input type="text" name="EndTime" id="send-time" value="" class="layui-input" style="width: 350px;display: inline-block;">

					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">销毁时间</label>
					<div class="layui-input-block">
						<input type="text" name="EndTime" id="del-time" value="" class="layui-input" style="width: 350px;display: inline-block;">

					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">重大邮件</label>
					<div class="layui-input-block">
						<input type="radio" name="IsImportant" lay-skin="primary" title="是" value="1" checked="">
						<input type="radio" name="IsImportant" lay-skin="primary" title="否" value="0" checked="checked">
					</div>
				</div>

<!-- 				<div class="layui-form-item">
					<label class="layui-form-label">附件奖励</label>
					<div class="layui-input-block">
						   <input type="radio" name="RewardType" lay-skin="primary" title="金币" value="0" checked="">
						   <input type="radio" name="RewardType" lay-skin="primary" title="金豆" value="1" checked="">
					</div>
				</div> -->

<!-- 				<div class="layui-form-item">
					<label class="layui-form-label">选择奖励</label>
					<div class="layui-input-block">
					<input type="checkbox" name="Money" title="金币" lay-filter="ReWardMoney" ><br>
					<input type="text" name="ReWardMoney" value="" id="ReWardMoney" placeholder="请输入金币数量" lay-verify="Money" class="layui-input" style="width: 180px;display: none;"> <br>
					<input type="checkbox" name="XiMaLiang" title="金豆" lay-filter="ReWardXiMaLiang" ><br>
					<input type="text" name="ReWardXiMaLiang" value="" id='ReWardXiMaLiang' placeholder="请输入金豆数量" lay-verify='XiMaLiang' class="layui-input" style="width: 180px;display: none;"><br>
					<input type="checkbox" name="ReWardExp" title="经验" lay-filter="ReWardExp"><br>
					<input type="text" name="ReWardExp" value="" id="ReWardExp" placeholder="请输入经验数量" lay-verify="Exp" class="layui-input" style="width: 180px;display: none;"> <br>
					</div>
				</div> -->

				<div class="layui-form-item">
					<label class="layui-form-label">奖励金币</label>
					<div class="layui-input-block">
						<input type="number" name="Title" value="" placeholder="请输入金币数量" class="layui-input" style="width: 350px;display: inline-block;">

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

			layui.use(['form','laydate'], function() {
				var form = layui.form;
                var laydate = layui.laydate;

                laydate.render({
			    elem: '#del-time',
				type: 'datetime'
			  });
			  laydate.render({
			    elem: '#send-time',
				type: 'datetime'
			  });

				form.verify({
                Money: function(value){
                    if(value.length > 7){
                        return '数量最多七位数';
                    }
				}, 
				
				XiMaLiang: function(value){
                    if(value.length > 7){
                        return '数量最多七位数';
                    }
				}, 
				
				Exp: function(value){
                    if(value.length > 7){
                        return '数量最多七位数';
                    }
                }, 

                //phone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！'],
                //email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对']
      });

				form.on('radio(MailType)', function(data){
				  console.log(data.elem); //得到radio原始DOM对象
				  console.log(data.value); //被点击的radio的value值
				  if(data.value == '1'){
					  $('#geren').hide();
				  }else{
					  $('#geren').show();
				  }
				});

				form.on('checkbox(ReWardMoney)', function(data){
				  console.log(data.elem); 
				  console.log(data.elem.checked);
				  if(data.elem.checked == true){
					  $('#ReWardMoney').show();
				  }else{
					  $('#ReWardMoney').hide();
				  }
				});

				form.on('checkbox(ReWardXiMaLiang)', function(data){
				  console.log(data.elem); 
				  console.log(data.elem.checked);
				  if(data.elem.checked == true){
					  $('#ReWardXiMaLiang').show();
				  }else{
					  $('#ReWardXiMaLiang').hide();
				  }
				});

				form.on('checkbox(ReWardExp)', function(data){
				  console.log(data.elem); 
				  console.log(data.elem.checked);
				  if(data.elem.checked == true){
					  $('#ReWardExp').show();
				  }else{
					  $('#ReWardExp').hide();
				  }
				});
				//监听提交
				form.on('submit(formDemo)', function(data) {
					//layer.msg(JSON.stringify(data.field));
					var data = data.field;

					$.ajax({
						headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									},
							url: "{{url('send/mail')}}",
							method: 'POST',
							data: data,
							dataType: 'json',
							success: function(res) {
								console.log(res);
								if (res.status == 200) {
								layer.msg('发送成功',{
									offset: '15px',
									icon: 1,
									time: 3000
								}, function(){
									location.href= "{{url('/create/mail')}}";
								})
								}else if (res.status == 403) {
									console.log(res);
								layer.msg('发送失败',{
									offset: '15px',
									icon: 2,
									time: 3000
								}, function(){
									//location.href= '/login';
								})
								}else if (res.endTime == "notime") {
									console.log(res);
								layer.msg('请填写销毁时间',{
									offset: '15px',
									icon: 2,
									time: 3000
								}, function(){
									//location.href= '/login';
								})
								}
							},
							error: function(error) {
								console.log(error);
								layer.msg('发送失败请重新确认',{
									offset: '15px',
									icon: 2,
									time: 3000
								}, function(){
									//location.href= '/login';
								})
							}
							});

					return false;
				});
			});


		
		</script>
	</body>

</html>
