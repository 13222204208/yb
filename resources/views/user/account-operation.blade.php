<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>帐号操作</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>

<body>

    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">帐号操作</div>
            <div class="layui-card-body" style="padding: 15px;">
                <form class="layui-form" action="">
                    <div class="layui-inline">
                        <label class="layui-form-label">用户账号</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" placeholder="请输入用户账号" autocomplete="off" class="layui-input">

                        </div>
                    </div>

                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <button class="layui-btn" lay-submit lay-filter="formQuery">查询</button>
                        </div>
                    </div>
                </form>
                <br>
                <div class="layui-inline">
                    <label class="layui-form-label">用户昵称</label>
                    <div class="layui-input-inline">
                        <input type="text" id="nickname" style="border:0; color:blue;font-size:22px;" autocomplete="off" class="layui-input">

                    </div>
                </div><br><br>
                <form class="layui-form" action="">

                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:90px">重置手机号</label>
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="resetPhone">重置</button>
                        </div>
                    </div>
                </form>

                <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:90px">重置密码</label>
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="resetPassword">重置</button>
                        </div>
                    </div>
                </form>
                <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width:90px">重置取款密码</label>
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="resetDepot">重置</button>
                        </div>
                    </div>
                </form>
    
                <form class="layui-form" action="">
                    <div class="layui-form-item">
                        <label class="layui-form-label">帐号封禁</label>
                        <div class="layui-input-block">
                            <select name="city" lay-verify="required" lay-filter="stateSelect">
                                <option value=""></option>
                                <option value="1">1天</option>
                                <option value="3">3天</option>
                                <option value="7">7天</option>
                                <option value="30">30天</option>
                                <option value="365">365天</option>
                                <option value="forever">永久封禁</option>
                                <option value="relieve">解除封禁</option>
                            </select>
                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>
    </div>


    <script src="/layuiadmin/layui/layui.js"></script>
    <script>
        layui.use([ 'form', 'laydate','layer'], function() {
            var $ = layui.$,
                admin = layui.admin,
                element = layui.element,
                layer = layui.layer,
                laydate = layui.laydate,
                form = layui.form;
            form.on('submit(formQuery)', function(msg) {

                var username= msg.field.username;
                console.log(username);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "search/user/nickname",
                    type: 'post',
                    data: {
                        'username':username
                    },
                    success: function(res) {
                       
                        if (res.status == 200) {
                            layer.msg("查询成功", {
                                icon: 1
                            });

                            $('#nickname').val(res.nickname);

                            form.on('submit(resetPhone)', function(msg) { //重置手机号

                                layer.confirm('确定重置手机号么', function(index) {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url: "reset/user/phone",
                                        type: 'post',
                                        data: {
                                            'username':username
                                        },
                                        success: function(res) {
                                            console.log(res);
                                            if (res.status == 200) {

                                                layer.msg("重置成功", {
                                                    icon: 1
                                                });

                                            } else if (res.status == 403) {
                                                layer.msg("查询不到用户", {
                                                    icon: 5
                                                });
                                            } else {
                                                layer.msg("重置失败", {
                                                    icon: 5
                                                });
                                            }
                                        }
                                    });
                                    layer.close(index);
                                });
                                return false;
                            });

                            form.on('submit(resetPassword)', function(msg) { //重置密码

                                layer.confirm('确定重置密码么', function(index) {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url: "reset/user/password",
                                        type: 'post',
                                        data: {
                                            'username':username
                                        },
                                        success: function(res) {
                                            console.log(res);
                                            if (res.status == 200) {

                                                layer.msg("重置成功", {
                                                    icon: 1
                                                });

                                            } else if (res.status == 403) {
                                                layer.msg("查询不到用户", {
                                                    icon: 5
                                                });
                                            } else {
                                                layer.msg("重置失败", {
                                                    icon: 5
                                                });
                                            }
                                        }
                                    });
                                    layer.close(index);
                                });
                                return false;
                            });


                            form.on('submit(resetDepot)', function(msg) { 

                                layer.confirm('确定取款密码么', function(index) {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url: "reset/user/take/password",
                                        type: 'post',
                                        data: {
                                            'username':username
                                        },
                                        success: function(res) {
                                            console.log(res);
                                            if (res.status == 200) {

                                                layer.msg("重置成功", {
                                                    icon: 1
                                                });

                                            } else if (res.status == 403) {
                                                layer.msg("查询不到用户", {
                                                    icon: 5
                                                });
                                            } else {
                                                layer.msg("重置失败", {
                                                    icon: 5
                                                });
                                            }
                                        }
                                    });
                                    layer.close(index);
                                });
                                return false;
                            });

                            form.on('select(stateSelect)', function(data) { //更改帐号状态
                                let status = data.elem.value; //当前字段变化的值
                                console.log(status);
                                layer.confirm('确定操作么', function(index) {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url: "update/account/status",
                                        type: 'post',
                                        data: {
                                            'username':username,
                                            'account_freeze': status
                                        },
                                        success: function(res) {
                                            console.log(res);
                                            if (res.status == 200) {

                                                layer.msg("修改成功", {
                                                    icon: 1
                                                });

                                            } else if (res.status == 403) {
                                                layer.msg("查询不到用户", {
                                                    icon: 5
                                                });
                                            } else {
                                                layer.msg("重置失败", {
                                                    icon: 5
                                                });
                                            }
                                        }
                                    });
                                    layer.close(index);
                                });
                                return false;
                            });


                        } else if (res.status == 403) {
                            layer.msg("查询不到用户", {
                                icon: 5
                            });
                        } else {
                            layer.msg("查询失败", {
                                icon: 5
                            });
                        }
                    }
                });
                return false;
            });


        });
    </script>
</body>

</html>