<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>添加平台</title>
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
          <div class="layui-card-header">添加平台</div>
          <div class="layui-card-body">

            <div class="layui-form" lay-filter="">



              <div class="layui-form-item">
                <label class="layui-form-label">平台名称</label>
                <div class="layui-input-inline">
                  <input type="text" name="platform_name" placeholder="平台名称" value="" style="width: 300px;" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">显示名称</label>
                <div class="layui-input-inline">
                  <input type="text" name="show_name" placeholder="显示名称" value="" style="width: 300px;" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">所属类型</label>
                <div class="layui-input-inline">
                  <select name="platform_type">
                    <option value="体育">体育</option>
                    <option value="电竞">电竞</option>
                    <option value="棋牌">棋牌</option>
                    <option value="真人">真人</option>
                    <option value="电子">电子</option>
                  </select>

                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-inline">
                  <input type="number" name="platform_sort" placeholder="排序" value="" style="width: 300px;" class="layui-input">
                </div>
              </div>

              <input type="hidden" name="platform_img" class="image">
              <div class="layui-form-item">
                <div class="layui-upload" style="margin-left: 7%;">
                  <button type="button" class="layui-btn" id="test-upload-normal">上传入口图片</button>
                  <div class="layui-upload-list">
                    <img class="layui-upload-img" src="" id="test-upload-normal-img" style="width:300px" alt="图片预览">
                  </div>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                  <input type="checkbox" checked="" name="state" lay-skin="switch" lay-filter="switchTest" lay-text="开启|关闭">
                </div>
              </div>


              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setActivity">确定</button>
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
    layui.use(['table', 'form', 'jquery', 'upload','laydate'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var form = layui.form;
      var util = layui.util;
      var $ = layui.jquery;
      var upload = layui.upload;



      //普通图片上传
      var uploadInst = upload.render({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        elem: '#test-upload-normal',
        accept: 'images',
        size: 3000,
        url: 'upload/platform/img',
        before: function(obj) {
          //预读本地文件示例，不支持ie8
          obj.preview(function(index, file, result) {
            $('#test-upload-normal-img').attr('src', result); //图片链接（base64）
          });
        },
        done: function(res) {
          if (res.status == 200) {
            console.log(window.location.hostname + '/' + res.path);
            var img_url = window.location.hostname + '/' + res.path;
            $(" input[ name='platform_img' ] ").val(img_url);
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
          url: "create/platform",
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
              layer.msg('保存失败,平台名称重复', {
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