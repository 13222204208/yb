<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>平台列表</title>
  <meta name="renderer" content="webkit">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>
      
  </style>
</head>
<body> 
 


 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
     
  <script type="text/html" id="barDemo">

  
  <!--   <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">查看</a> -->
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="edit">编辑</a>
  </script>     

  <div class="layui-col-md12" style="display:none" id="popUpdateTask" >
        <div class="layui-card">
          <div class="layui-card-body">
          <form class="layui-form layui-from-pane" required lay-verify="required" lay-filter="formUpdate"  style="margin:20px">
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

<!--               <div class="layui-form-item">
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
              </div> -->

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
          </form>

          </div>
        </div>
      </div>
<script src="/layuiadmin/layui/layui.js"></script>

<script>
 layui.use(['table', 'form', 'laydate', 'layer', 'jquery','upload'], function() {
      var table = layui.table;
      var laydate = layui.laydate;
      var form = layui.form;
      var util = layui.util;
      var layer = layui.layer;
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
  
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
    ,url: 'query/platform'
    ,cols: [[
      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'platform_name', title: '平台名称', width:180, sort: true}
      ,{field:'show_name', title: '显示名称', width:180}
      ,{field:'platform_type', title: '所属类型', width:120}
      ,{field:'platform_sort', title: '排序', width:120}
      ,{field:'platform_img', title: '入口图',  width:260}
      ,{field:'remainder', title: '余额', width:120}
      ,{field:'state', title: '状态', sort: true, width:100,
        templet: function(d) {
                if (d.state == 1) {
                  return "开启";
                }else if(d.state == "on"){
                  return "开启";
                }else{
                  return "关闭";
                }
              },}
      ,{
              fixed: 'right',
              title:"操作",
              width: 100,
              align: 'center',
              toolbar: '#barDemo'
            }
    ]]
    ,parseData: function(res) { //res 即为原始返回的数据
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
        if (layEvent === 'edit') { //编辑
          layer.open({
            //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
            type: 1,
            title: "编辑",
            area: ['620px', '550px'],
            content: $("#popUpdateTask") //引用的弹出层的页面层的方式加载修改界面表单
          });
           //console.log(data);return false;
          form.val("formUpdate", data);
          setFormValue(obj, data);
          form.render();
        } else if (layEvent === 'LAYTABLE_TIPS') {
          layer.alert('Hi，头部工具栏扩展的右侧图标。');
        }
      });
   
      function setFormValue(obj, data) {
        form.on('submit(setActivity)', function(massage) {
          massage= massage.field; 
          massage.id = data.id;
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "update/platform",
            type: 'post',
            data: massage,
            success: function(msg) {
              console.log(msg);
              if (msg.status == 200) {
                layer.closeAll('loading');
                layer.load(2);
                layer.msg("修改成功", {
                  icon: 6
                });
                setTimeout(function() {

                  obj.update({
                    platform_name:massage.platform_name,
                    show_name:massage.show_name,
                    platform_type:massage.platform_type,
                    platform_sort:massage.platform_sort,
                    platform_img:massage.platform_img,
                    state:massage.state,        
                  }); //修改成功修改表格数据不进行跳转              
                  layer.closeAll(); //关闭所有的弹出层

                }, 1000);

              } else {
                layer.msg("修改失败", {
                  icon: 5
                });
              }
            }
          })
          return false;
        })
      }
  
});
</script>

</body>
</html>