<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>支付开放状态</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div class="layui-card" style="margin:20px">

      <form class="layui-form" action="" >


  <div class="layui-form-item">
    <label class="layui-form-label">银行卡</label>
    <div class="layui-input-block">
      <input type="radio" name="bank_card" value=0 title="关闭">
      <input type="radio" name="bank_card" value=1 title="开放" checked="">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">微信支付</label>
    <div class="layui-input-block">
      <input type="radio" name="wechat_pay" value="0" title="关闭">
      <input type="radio" name="wechat_pay" value="1" title="开放" checked>
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">支付宝</label>
    <div class="layui-input-block">
      <input type="radio" name="alipay_pay" value="0" title="关闭">
      <input type="radio" name="alipay_pay" value="1" title="开放" checked>
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">第三方支付</label>
    <div class="layui-input-block">
      <input type="radio" name="third_party" value="0" title="关闭">
      <input type="radio" name="third_party" value="1" title="开放" checked>
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">确定</button>
    </div>
  </div>
</form>
              
</div>     
<script src="/layuiadmin/layui/layui.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
 

<script> 
    layui.use([ 'form'], function() {
			var $ = layui.$,
				admin = layui.admin,
				element = layui.element,
				layer = layui.layer,
				form = layui.form;

			form.on('submit(formDemo)', function(data) {
				var data = data.field;	
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "update/open/state",
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

      $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "query/open/state",
					method: 'get',
					success: function(res) {
            //console.log(res.data);return false;
            data= res.data;
						if (res.status == 200) {
              if(data.bank_card == 0){
                $("input[name=bank_card][value=1]").prop("checked","false");
                $("input[name=bank_card][value=0]").prop("checked","true");
                }

                if(data.wechat_pay == 0){
                $("input[name=wechat_pay][value=1]").prop("checked","false");
                $("input[name=wechat_pay][value=0]").prop("checked","true");
                }

                if(data.alipay_pay == 0){
                $("input[name=alipay_pay][value=1]").prop("checked","false");
                $("input[name=alipay_pay][value=0]").prop("checked","true");
                }

                if(data.third_party == 0){
                $("input[name=third_party][value=1]").prop("checked","false");
                $("input[name=third_party][value=0]").prop("checked","true");
                }
              form.render();
						} else {
							console.log(res);
							layer.msg('获取失败', {
								offset: '15px',
								icon: 2,
								time: 3000
							})
						}
					}
				});
    });
 
</script>

</body>
</html>