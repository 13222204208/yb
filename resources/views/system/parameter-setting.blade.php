

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>参数设置</title>
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
          <div class="layui-card-header">会员充值</div>
          <div class="layui-card-body" >
            
            <div class="layui-form" lay-filter="">
    
              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">最低赠送金额</label>
                <div class="layui-input-inline">
                  <input type="number" name="min_money" placeholder="充值达到此金额才会赠送" value=""  onKeyUp="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');"  lay-verify="min_money" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">每笔赠送比例(%)</label>
                <div class="layui-input-inline">
                  <input type="number" name="largess_scale" placeholder="赠送比例" value=""  onKeyUp="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');"  lay-verify="largess_scale" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">每日赠送上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="largess_toplimit" placeholder="赠送上限" value=""  onKeyUp="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');"  lay-verify="largess_toplimit" class="layui-input">
                </div>
              </div>
 

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setmyinfo">保存</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>


      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">会员提款</div>
          <div class="layui-card-body" >
            
            <div class="layui-form" lay-filter="">
    
              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">每日提款次数上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="draw_money_num" placeholder="" value="" lay-verify="draw_money_num" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔提款下限</label>
                <div class="layui-input-inline">
                  <input type="number" name="min_draw_money" placeholder="" value="" lay-verify="min_draw_money" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔提款上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="max_draw_money" placeholder="" value="" lay-verify="max_draw_money" class="layui-input">
                </div>
              </div>

              
              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔提款手续费比例(%)</label>
                <div class="layui-input-inline">
                  <input type="number" name="draw_money_scale" placeholder="" value="" lay-verify="draw_money_scale" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔手续费上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="poundage_full" placeholder="" value="" lay-verify="poundage_full" class="layui-input">
                </div>
              </div>
 

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setDrawMoney">保存</button>
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

        $.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "query/member/recharge",
					method: 'get',
					success: function(res) {
						if (res.status == 200) {
              $(" input[ name='min_money' ] ").val(res.data.min_money);
              $(" input[ name='largess_scale' ] ").val(res.data.largess_scale);
              $(" input[ name='largess_toplimit' ] ").val(res.data.largess_toplimit);

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

    	/* 自定义验证规则 */
			form.verify({
				min_money: function(value) {
					if (value > 10000000) {
						return '数额巨大';
					}
				},

				largess_scale: function(value) {
					if (value > 100) {
						return '比例不能大于100';
					}
				},

				largess_toplimit: function(value) {
					if (value > 1000000) {
						return '数额巨大';
					}
				},
			});


			form.on('submit(setmyinfo)', function(data) {//更新会员充值
				var data = data.field;
				
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "update/member/recharge",
					method: 'POST',
					data: data,
					success: function(res) {
						console.log(res);
						if (res.status == 200) {
							layer.msg('添加成功', {
								offset: '15px',
								icon: 1,
								time: 3000
							});
						} else {
							console.log(res);
							layer.msg('添加失败', {
								offset: '15px',
								icon: 2,
								time: 3000
							})
						}
					}
				});
				return false;
			});


			form.on('submit(setDrawMoney)', function(data) {//更新会员提款
				var data = data.field;
				
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "update/member/draw/money",
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
					url: "query/member/draw/money",
					method: 'get',
					success: function(res) {
						if (res.status == 200) {
              $(" input[ name='draw_money_num' ] ").val(res.data.draw_money_num);
              $(" input[ name='min_draw_money' ] ").val(res.data.min_draw_money);
              $(" input[ name='max_draw_money' ] ").val(res.data.max_draw_money);
              $(" input[ name='draw_money_scale' ] ").val(res.data.draw_money_scale);
              $(" input[ name='poundage_full' ] ").val(res.data.poundage_full);

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