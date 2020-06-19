<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
  <style>
      
  </style>
</head>
<body> 
 
<div class="demoTable" style="margin:20px;">
  查询用户或者订单号：
  <div class="layui-inline">
    <input class="layui-input" name="id" id="demoReload" autocomplete="off">
  </div>
  <button class="layui-btn" data-type="reload">查询</button>
</div>

<div class="mainTop layui-clear">

    <div class="fr">
        <form class="layui-form" action="">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">状态：</label>
                    <div class="layui-input-inline">
                        <select name="city" lay-verify="required" class="select_wd120">
                           <option value="">全部</option>
                            <option value="0">已处理</option>
                            <option value="1">未处理</option>
                            <option value="2">已拒绝</option>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">起止时间：</label>
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input dateIcon" id="dateTime" placeholder="请选择时间范围"
                               style="width: 240px;">
                    </div>
                    
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn layui-btn-blue">搜索</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
 
<table class="layui-hide" id="LAY_table_user" lay-filter="user"></table> 
               
     
  <script type="text/html" id="barDemo">

    <a class="layui-btn layui-btn-xs" lay-event="agree">同意</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="resuse">拒绝</a>
  </script>     
<script src="/layuiadmin/layui/layui.js"></script>

<script>
layui.use(['table','laydate'], function(){
  var table = layui.table;
  var laydate = layui.laydate;
  laydate.render({
    elem: '#dateTime'
    ,range: true
  });
  
  //方法级渲染
  table.render({
    elem: '#LAY_table_user'
/*     ,url: '/demo/table/user/' */
    ,cols: [[

      {field:'id', title: 'ID', width:80, sort: true}
      ,{field:'order', title: '订单号', width:120}
      ,{field:'username', title: '用户名', width:120}
      ,{field:'cz', title: '提款金额', width:120}
      ,{field:'name', title: '收款卡号',  width:260}
      ,{field:'jl', title: '开户人/开户行', width:120}
      ,{field:'zctime', title: '申请时间',sort: true, width:160}
      ,{field:'state', title: '状态', sort: true, width:100}
      ,{
              fixed: 'right',
              title:"操作",
              width: 150,
              align: 'center',
              toolbar: '#barDemo'
            }
    ]]
    ,data: [{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },{
      "id": "10001"
      ,"order": "12345678945"
      ,"username": "杜甫"
      ,"cz": "80万"
      ,"jl": "中国人民银行"
      ,"name": "6789456123456"
      ,"zctime": "2016-10-14"
      ,"state": "已处理"
    },]
    ,id: 'testReload'
    ,page: true
    ,height: 610
  });
  
  var $ = layui.$, active = {
    reload: function(){
      var demoReload = $('#demoReload');
      
      //执行重载
      table.reload('testReload', {
        page: {
          curr: 1 //重新从第 1 页开始
        }
        ,where: {
          key: {
            id: demoReload.val()
          }
        }
      }, 'data');
    }
  };
  
  $('.demoTable .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
});
</script>

</body>
</html>