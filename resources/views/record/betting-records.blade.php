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
  查询用户：
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
                    <label class="layui-form-label">游戏平台：</label>
                    <div class="layui-input-inline">
                        <select name="city" lay-verify="required" class="select_wd120">
                          <option value="">全部</option>
                            <option value="0">游戏平台1</option>
                            <option value="1">游戏平台2</option>
                            <option value="2">游戏平台3</option>
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
      ,{field:'username', title: '用户名', width:120}
      ,{field:'cz', title: '游戏平台', width:120}
      ,{field:'jl', title: '游戏名', width:120}
      ,{field:'name', title: '下注金额', width:260}
      ,{field:'phone', title: '派彩金额',  width:260}
      ,{field:'zctime', title: '下注时间',sort: true, width:160}
    ]]
    ,data: [{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
    },{
      "id": "10001"
      ,"username": "杜甫"
      ,"cz": "taptap"
      ,"jl": "梦幻新诛仙"
      ,"name": "6789"
      ,"phone": "1322"
      ,"zctime": "2016-10-14"
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