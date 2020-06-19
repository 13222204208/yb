

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
          <div class="layui-card-header">新增活动</div>
          <div class="layui-card-body" >
            
            <div class="layui-form" lay-filter="">
    
              <div class="layui-form-item">
                <label class="layui-form-label" >活动类型</label>
                <div class="layui-input-inline">
                    <select name="rolename">
                        <option value="0">管理员</option>
                        <option value="1">超级管理员</option>
                        <option value="2">纠错员</option>
                        <option value="3">采购员</option>
                        <option value="4">推销员</option>
                        <option value="5">运营人员</option>
                        <option value="6">编辑</option>
                      </select>
              
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label" >申请模式</label>
                <div class="layui-input-inline">
                    <select name="rolename">
                        <option value="0">管理员</option>
                        <option value="1">超级管理员</option>
                        <option value="2">纠错员</option>
                        <option value="3">采购员</option>
                        <option value="4">推销员</option>
                        <option value="5">运营人员</option>
                        <option value="6">编辑</option>
                      </select>
              
                </div>
              </div>

              

              <div class="layui-form-item">
                <label class="layui-form-label" >活动标题</label>
                <div class="layui-input-inline">
                  <input type="text" name="username" placeholder="活动标题" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label" >排序</label>
                <div class="layui-input-inline">
                  <input type="text" name="username" placeholder="排序" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-upload" style="margin-left: 7%;">
                    <button type="button" class="layui-btn" id="test1">上传活动图片</button>
                    <div class="layui-upload-list">
                      <img class="layui-upload-img" id="demo1">
                      <p id="demoText"></p>
                    </div>
                  </div>   
             </div>

              <div class="layui-form-item">
                <label class="layui-form-label" >起止时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input dateIcon" id="dateTime" style="width: 300px;" placeholder="请选择时间范围">
                </div>
              </div>

              
              <div class="layui-form-item">
                <label class="layui-form-label" >活动条件</label>
                <div class="layui-input-inline">
                  <input type="text" name="username" placeholder="活动条件" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>

              
              <div class="layui-form-item">
                <label class="layui-form-label" >条件数量</label>
                <div class="layui-input-inline">
                  <input type="text" name="username" placeholder="条件数量" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>

              
              <div class="layui-form-item">
                <label class="layui-form-label" >奖励金额</label>
                <div class="layui-input-inline">
                  <input type="number" name="username" placeholder="60000" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>

              
              <div class="layui-form-item">
                <label class="layui-form-label" >活动描述</label>
                <div class="layui-input-inline">
                  <input type="text" name="username" placeholder="活动描述" value="" style="width: 300px;" lay-verify="username" class="layui-input">
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
    }).use(['index', 'user','laydate'], function() {
        var laydate= layui.laydate;

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
        laydate.render({
    elem: '#dateTime'
    ,type:"datetime"
    ,range: true
  });

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