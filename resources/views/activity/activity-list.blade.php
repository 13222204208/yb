<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>活动列表</title>
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

    <a class="layui-btn layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
  </script>     

  <div class="layui-col-md12" id="popUpdateTask" style="display:none">
        <div class="layui-card">
          <div class="layui-card-body">

          <form class="layui-form layui-from-pane" required lay-verify="required" lay-filter="formUpdate"  style="margin:20px">

              <div class="layui-form-item">
                <label class="layui-form-label">活动类型</label>
                <div class="layui-input-inline">
                  <select name="activity_type">
                    <option value="体育">体育</option>
                    <option value="电竞">电竞</option>
                    <option value="棋牌">棋牌</option>
                  </select>

                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">申请模式</label>
                <div class="layui-input-inline">
                  <select name="application_mode">
                    <option value="在线申请">在线申请</option>
                    <option value="线下申请">线下申请</option>
                  </select>

                </div>
              </div>



              <div class="layui-form-item">
                <label class="layui-form-label">活动标题</label>
                <div class="layui-input-inline">
                  <input type="text" name="activity_title" placeholder="活动标题" value="" style="width: 300px;" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">活动链接</label>
                <div class="layui-input-inline">
                  <input type="text" name="activity_url" placeholder="活动链接" value="" style="width: 300px;" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-inline">
                  <input type="number" name="activity_sort" placeholder="排序" value="" style="width: 300px;" class="layui-input">
                </div>
              </div>

              <input type="hidden" name="activity_img" class="image">
              <div class="layui-form-item">
                <div class="layui-upload" style="margin-left: 7%;">
                  <button type="button" class="layui-btn" id="test-upload-normal">上传活动图片</button>
                  <div class="layui-upload-list">
                    <img class="layui-upload-img" src="" id="test-upload-normal-img" style="width:300px" alt="图片预览">
                  </div>
                </div>
              </div>


              <div class="layui-form-item">
                <div class="layui-inline">
                  <label class="layui-form-label">开始时间</label>
                  <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="start_time" id="start-time" style="width: 300px;" placeholder="yyyy-MM-dd HH:mm:ss">
                  </div>
                </div>
              </div>

              <div class="layui-form-item">
                <div class="layui-inline">
                  <label class="layui-form-label">结束时间</label>
                  <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="stop_time" id="stop-time" style="width: 300px;" placeholder="yyyy-MM-dd HH:mm:ss">
                  </div>
                </div>
              </div>


              <div class="layui-form-item">
                <label class="layui-form-label">活动条件</label>
                <div class="layui-input-inline">
                  <input type="text" name="activity_term" placeholder="活动条件" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>


              <div class="layui-form-item">
                <label class="layui-form-label">条件数量</label>
                <div class="layui-input-inline">
                  <input type="text" name="term_num" placeholder="条件数量" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>


              <div class="layui-form-item">
                <label class="layui-form-label">奖励金额</label>
                <div class="layui-input-inline">
                  <input type="number" name="award_num" placeholder="" value="" style="width: 300px;" lay-verify="username" class="layui-input">
                </div>
              </div>


              <div class="layui-form-item">
                <label class="layui-form-label">活动描述</label>
                <div class="layui-input-inline">
                  <textarea name="activity_describe" placeholder="活动描述" style="width: 300px;" class="layui-textarea"></textarea>
                </div>
              </div>

              <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
          <input type="checkbox" checked="" name="activity_state" lay-skin="switch" lay-filter="switchTest" lay-text="开启|关闭">
        </div>
      </div>

              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setActivity">保存活动</button>
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
            //日期时间选择器
            laydate.render({
        elem: '#start-time',
        type: 'datetime'
      });

      //日期时间选择器
      laydate.render({
        elem: '#stop-time',
        type: 'datetime'
      });
      //第一个实例
      table.render({
        elem: '#LAY_table_user',
        height: 600,
        url:'query/activity/list',
        page: true //开启分页
          ,
        cols: [
          [ //表头
            {
              field: 'id',
              title: 'ID',
              width: 80,
              align: 'center',
              sort: true
            },{
              field: 'activity_title',
              title: '活动标题',
              width: 180,
              align: 'center',
           
            },{
              field: 'activity_url',
              title: '活动链接地址',
              width: 180,
              align: 'center',
            
            },{
              field: 'activity_describe',
              title: '活动的具体描述',
              width: 280,
              align: 'center',
            
            },{
              field: 'activity_sort',
              title: '排序',
              width: 80,
              align: 'center',
              sort: true
            },{
              field: 'activity_state',
              title: '状态',
              width: 80,
              align: 'center',
              templet: function(d) {
                if (d.activity_state == 1) {
                  return "开启";
                }else if(d.activity_state == "on"){
                  return "开启";
                }else{
                  return "关闭";
                }
              },

            },
            {
              field: 'start_time',
              title: '开始时间',
              align: 'center',
              width: 200,
            }, {
              field: 'stop_time',
              title: '结束时间',
              align: 'center',
              width: 200
            },{
              fixed: 'right',
              title:"操作",
              width: 180,
              align: 'center',
              toolbar: '#barDemo'
            }
          ]
        ],
        parseData: function(res) { //res 即为原始返回的数据
          console.log(res);
          return {
            "code": '0', //解析接口状态
            "msg": res.message, //解析提示文本
            "count": res.total, //解析数据长度
            "data": res.data //解析数据列表
          }
        },
        toolbar: '#toolbarDemo',
        title: '后台广告管理',
        totalRow: true

      });

        //普通图片上传
        var uploadInst = upload.render({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        elem: '#test-upload-normal',
        accept: 'images',
        size: 3000,
        url: 'upload/activity/img',
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
            $(" input[ name='activity_img' ] ").val(img_url);
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

      table.on('tool(user)', function(obj) { //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

                 if (layEvent === 'del') { //删除
                  layer.confirm('真的删除行么', function(index) {
                    $.ajax({
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                      url: "del/activity",
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
                } else  
        if (layEvent === 'edit') { //编辑

          layer.open({
            //layer提供了5种层类型。可传入的值有：0（信息框，默认）1（页面层）2（iframe层）3（加载层）4（tips层）
            type: 1,
            title: "编辑活动",
            area: ['620px', '650px'],
            content: $("#popUpdateTask") //引用的弹出层的页面层的方式加载修改界面表单
          });
           //console.log(data);return false;
          form.val("formUpdate", data);
          setFormValue(obj, data);

/*           var openTakeaway = data.f_mission_state;
          console.log(openTakeaway);
          if (openTakeaway == 1) {
            $("#taskState").prop("checked", true);
          } else {
            $("#taskState").prop("checked", false);
          } */


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
            url: "update/activity",
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
                    activity_url:massage.activity_url,
                    activity_type:massage.activity_type,
                    activity_title:massage.activity_title,
                    activity_describe:massage.activity_describe,
                    activity_sort:massage.activity_sort,
                    activity_state:massage.activity_state,
                    start_time:massage.start_time,
                    stop_time:massage.stop_time,        
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