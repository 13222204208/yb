

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>版本设置</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">

      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">版本设置</div>
          <div class="layui-card-body" >

            <div class="layui-form" lay-filter="">

              <div class="layui-form-item">
                <label class="layui-form-label" >最新版本号</label>
                <div class="layui-input-inline">
                  <input type="text" name="new_version" placeholder="" value=""  class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                    <label class="layui-form-label">是否强制更新</label>
                    <div class="layui-input-block">
                    <input type="radio" name="compel_update" value="0" title="否" >
                    <input type="radio" name="compel_update" value="1" title="是" checked>
                    </div>
                </div>

                <div class="layui-form-item">
				<label class="layui-form-label">更新的内容</label>
				<div class="layui-input-block">
					<textarea class="layui-input" name="update_content" value='' style="width: 350px;height:100px;display: inline-block;"></textarea>
				</div>
			</div>

              <div class="layui-form-item">
                    <label class="layui-form-label">是否更新</label>
                    <div class="layui-input-block">
                    <input type="radio" name="is_update" value="0" title="否" >
                    <input type="radio" name="is_update" value="1" title="是" checked>
                    </div>
                </div>

                <div class="layui-form-item">
                <label class="layui-form-label" >ios下载链接</label>
                <div class="layui-input-inline">
                  <input type="text" name="ios_href" placeholder="" value="" lay-verify="" style="width: 350px;display: inline-block;" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" >android下载链接</label>
                <div class="layui-input-inline">
                  <input type="text" name="android_href" placeholder="" value="" lay-verify="" style="width: 350px;display: inline-block;" class="layui-input">
                </div>
              </div>



              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setDrawMoney">更新</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="/layuiadmin/layui/layui.js"></script>
  <script src="/layuiadmin/layui/jquery3.2.js"></script>
  <script>
    layui.use([ 'form'], function() {
			var $ = layui.$,
				admin = layui.admin,
				element = layui.element,
				layer = layui.layer,
				form = layui.form;



			form.on('submit(setDrawMoney)', function(data) {//更新会员提款
				var data = data.field;

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "app/version",
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

					url: "query/app/version",
					method: 'get',
					success: function(res) {
                        data= res.data;
                       // console.log(data);return false;
						if (res.status == 200) {
              $(" input[ name='new_version' ] ").val(data.new_version);

              if(data.compel_update == 0){
                $("input[name=compel_update][value=1]").prop("checked","false");
                $("input[name=compel_update][value=0]").prop("checked","true");
                }

                if(data.is_update == 0){
                $("input[name=is_update][value=1]").prop("checked","false");
                $("input[name=is_update][value=0]").prop("checked","true");
                }
              //$(" input[ name='compel_update' ] ").val(res.data.compel_update);
              //$(" input[ name='is_update' ] ").val(data.is_update);
              $(" textarea[ name='update_content' ] ").val(data.update_content);
              $(" input[ name='ios_href' ] ").val(data.ios_href);
              $(" input[ name='android_href' ] ").val(data.android_href);
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
