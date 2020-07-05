<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>创建默认头像</title>
  <meta name="renderer" content="webkit">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
          <div class="layui-card-header">新增默认头像</div>
          <div class="layui-card-body">

            <div class="layui-form" lay-filter="">

              <input type="hidden" name="default_head" class="image">
              <div class="layui-form-item">
                <div class="layui-upload" style="margin-left: 7%;">
                  <button type="button" class="layui-btn" id="test-upload-normal">上传默认头像图片</button>
                  <div class="layui-upload-list">
                    <img class="layui-upload-img" src="" id="test-upload-normal-img" style="width:300px" alt="图片预览">
                  </div>
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setActivity">保存头像</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


    </div>


    <table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
    <script type="text/html" id="barDemo">
<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>     
  </div>

  <script src="/layuiadmin/layui/layui.js"></script>
  <script src="/layuiadmin/layui/jquery3.2.js"></script>
  <script>
    layui.use(['table', 'form', 'jquery', 'upload','laydate'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var form = layui.form;
      var util = layui.util;
      var $ = layui.jquery;
      var upload = layui.upload;

      table.render({
    elem: '#LAY_table_user'
    ,url: 'query/default/head' 
    ,cols: [[

      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'default_head', title: '默认头像地址', width:420}
      ,{
              fixed: 'right',
              title:"操作",
              width: 180,
              align: 'center',
              toolbar: '#barDemo'
            }
    ]]
    , parseData: function(res) { //res 即为原始返回的数据
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        }
    ,id: 'testReload'
    ,page: true

  });

  table.on('tool(user)', function(obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

                 if (layEvent === 'del') { //删除
                  layer.confirm('真的删除行么', function(index) {
                    $.ajax({
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                      url: "del/default/head",
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
                }
      });

      //普通图片上传
      var uploadInst = upload.render({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        elem: '#test-upload-normal',
        accept: 'images',
        size: 3000,
        url: 'upload/default/head',
        before: function(obj) {
          //预读本地文件示例，不支持ie8
          obj.preview(function(index, file, result) {
            $('#test-upload-normal-img').attr('src', result); //图片链接（base64）
          });
        },
        done: function(res) {
          if (res.status == 200) {
            var img_url =res.path;
            $(" input[ name='default_head' ] ").val(img_url);
            return layer.msg('图片上传成功', {
              offset: '15px',
              icon: 1,
              time: 2000
            });
          }
          //如果上传失败
          if (res.status == 403) {
            return layer.msg('上传失败', {
              offset: '15px',
              icon: 2,
              time: 2000
            });
          }
          //上传成功
        },
        error: function(error) {
          console.log(error);
          //演示失败状态，并实现重传
          var demoText = $('#test-upload-demoText');
          demoText.html('<span style="color: #FF5722;">图片上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
          demoText.find('.demo-reload').on('click', function() {
            uploadInst.upload();
          });
        }
      });

      form.on('submit(setActivity)', function(data) { 
        var data = data.field;
        console.log(data);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "create/default/head",
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
              setTimeout(function() {

            layer.closeAll(); //关闭所有的弹出层
            location.href="default-head";

            }, 2000);
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
    });
  </script>
</body>

</html>