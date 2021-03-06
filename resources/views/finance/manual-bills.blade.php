<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>
<body> 
 
    <div class="layui-fluid">
        <div class="layui-card">
          <div class="layui-card-header">添加帐单</div>
          <div class="layui-card-body" style="padding: 15px; width: 50%;">
            <form class="layui-form" action="" lay-filter="component-form-group">
     
                <div class="layui-form-item">
                    <div class="layui-inline">
                      <label class="layui-form-label">时间</label>
                      <div class="layui-input-inline">
                        <input type="text" name="time" class="layui-input" id="datetime" placeholder="yyyy-MM-dd HH:mm:ss">
                      </div>
                    </div>
                  </div>
    
              <div class="layui-form-item">
                <label class="layui-form-label">交易类型</label>
                <div class="layui-input-block">
                  <select name="business_type" required lay-verify="required">
                    <option value="存款">存款</option>
                    <option value="提款">提款</option>
                    <option value="奖励">奖励</option>
                    <option value="返水">返水</option>
                    <option value="其它">其它</option>
                  </select>
                </div>
              </div>
              
              <div class="layui-form-item">
                <label class="layui-form-label">银行卡号</label>
                <div class="layui-input-block">
                  <input type="number" name="bank_card" required  lay-verify="required" placeholder="平台对应的发生交易所用的银行卡号" autocomplete="off" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">操作人</label>
                <div class="layui-input-block">
                  <input type="text" name="operation" required  lay-verify="required" placeholder="平台系统用户" autocomplete="off" class="layui-input">
                </div>
              </div>
    
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-block">
                  <textarea name="remarks" required placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
              </div>  
              
              <div class="layui-form-item ">
                <div class="layui-input-block">
                  <div class="layui-footer" style="left: 0;">
                    <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                  </div>
                </div>
              </div>
              </form>
             </div>
         
          </div>
        </div>
      </div>
    
        
      <script src="/layuiadmin/layui/layui.js"></script>  
      <script>
      layui.use([ 'form', 'laydate'], function(){
        var $ = layui.$
        ,admin = layui.admin
        ,element = layui.element
        ,layer = layui.layer
        ,laydate = layui.laydate
        ,form = layui.form;

        laydate.render({
            elem: '#datetime'
            ,type: 'datetime'
        });
        
        form.render(null, 'component-form-group');
    
        
        /* 监听提交 */
        form.on('submit(component-form-demo1)', function(data){
          var data = data.field;
    
          $.ajax({
                            headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                url: "add/manual/bills",
                                method: 'POST',
                                data: data,
                                success: function(res) {
                                    console.log(res);
                                    if (res.status == 200) {
                                    layer.msg('添加成功',{
                                        offset: '15px',
                                        icon: 1,
                                        time: 3000
                                    })
                                    }else{
                                     
                                    layer.msg('添加失败',{
                                        offset: '15px',
                                        icon: 2,
                                        time: 3000
                                    })
                                    }
                                },
                                error: function(error) {
                                    console.log(error);
                                    layer.msg('添加失败请重新确认',{
                                        offset: '15px',
                                        icon: 2,
                                        time: 3000
                                    })
                                }
                                });
          return false;
        });
      });
      </script>

</body>
</html>