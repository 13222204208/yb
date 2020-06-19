

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>创建帐号</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
                  <input type="number" name="username" placeholder="充值达到此金额才会赠送" value="" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">每笔赠送比例</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="赠送比例" value="" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">每日赠送上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="赠送上限" value="" lay-verify="username" class="layui-input">
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
                  <input type="number" name="username" placeholder="" value="" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔提款下限</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="" value="" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔提款上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="" value="" lay-verify="username" class="layui-input">
                </div>
              </div>

              
              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔提款手续费比例</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="" value="" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" style="width:130px">单笔手续费上限</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="" value="" lay-verify="username" class="layui-input">
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

    </div>
  </div>

  <script src="/layuiadmin/layui/layui.js"></script>
  <script src="/layuiadmin/layui/jquery3.2.js"></script>
  <script> 
    layui.config({
      base: '/layuiadmin/'
    }).extend({
      index: 'lib/index' 
    }).use(['index', 'user'], function() {

      var form = layui.form;
      form.verify({

                username: function(value){
                    if(value.length < 6){
                        return '用户名至少得6个字符啊';
                    }
                }, 
                
                password: function(value){
                    if(value.length < 8){
                        return '请输入至少8位';
                    }
                },
                //phone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！'],
                //email: [/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/, '邮箱格式不对']
      });

      var $ = layui.$,
        setter = layui.setter,
        admin = layui.admin,
        form = layui.form,
        router = layui.router(),
        search = router.search;

      form.render();

      //提交
      form.on('submit(setmyinfo)', function(obj) {
       
        $.ajax({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          url: "{{url('add/newuser')}}",
          method: 'POST',
          data: obj.field,
          dataType: 'json',
          success: function(res) {
          
            if (res.status == 404) {
              layer.msg('用户名密码不一致',{
                offset: '15px',
                icon: 2,
                time: 3000
              }, function(){ alert(404);
                location.href= '/set/user/newuser';
              })
            }

            if (res.status == 200) {
              layer.msg('添加成功',{
                offset: '15px',
                icon: 1,
                time: 3000
              }, function(){
                location.href= '/set/user/newuser';
              })
            }else if (res.status == 403) {
   
              layer.msg('添加失败',{
                offset: '15px',
                icon: 2,
                time: 3000
              }, function(){
                location.href= '/set/user/newuser';
              })
            }
          },
          error: function(error) {
            alert(error);
            layer.msg('添加失败',{
                offset: '15px',
                icon: 2,
                time: 3000
              }, function(){
                location.href= '/set/user/newuser';
              })
          }
        });
      });
    });
  </script>
</body>
</html>