<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>主页</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>

<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">

      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            今日注册
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p class="layuiadmin-big-font" id="register_num">1024</p>
            <p>
              统计今日新用户注册数量
              <!--        <span class="layuiadmin-span-color">88万 <i class="layui-inline layui-icon layui-icon-flag"></i></span> -->
            </p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            今日投注
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p>投注会员数： <span class=" layui-badge layui-bg-green " id="betting_user">0</span> (今日参与投注的会员数量)</p>
            <p>投注次数：<span class="layui-badge layui-bg-green " id="betting_count">102,4</span> (今日投注总次数)</p>
            <p>总投注金额：<span class="layui-badge layui-bg-green " id="betting_money">120,100</span> (今日总下注金额)</p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            今日存款
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p>申请笔数： <span class=" layui-badge layui-bg-green " id="apply_num">100</span> (存款申请的次数)</p>
            <p>存款笔数：<span class="layui-badge layui-bg-green " id="deposit_num">102,4</span> (已处理的存款申请次数)</p>
            <p>存款金额：<span class="layui-badge layui-bg-green " id="recharge_money">120,100</span> (已处理的存款申请的总金额)</p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            今日提款
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p>申请笔数： <span class=" layui-badge layui-bg-green " id="with_apply_num">100</span> (提款申请的次数)</p>
            <p>提款笔数：<span class="layui-badge layui-bg-green " id="with_deposit_num">102,4</span> (已处理的提款申请次数)</p>
            <p>提款金额：<span class="layui-badge layui-bg-green " id="withdrawal_money">120,100</span> (已处理的提款申请的总金额)</p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            发放奖励
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list">
            <p>发放笔数： <span class=" layui-badge layui-bg-green " id="award_num">100</span> (今日发放奖励的次数)</p>
            <p>发放总额：<span class="layui-badge layui-bg-green " id="award_money">102,401</span> (今日发放奖励的总金额)</p>

          </div>
        </div>
      </div>
      <div class="layui-col-sm12">

        <div class="layui-card">
          <div class="layui-card-header">
            会员注册趋势
            <div class="layui-btn-group layuiadmin-btn-group">
              <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs">去年</a>
              <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs">今年</a>
            </div>
          </div>
          <div class="layui-card-body">
            <div class="layui-row">
              <div class="layui-col-sm8">
                <div class="layui-col-sm12">
                  <div id="user-reg" style="height: 350px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="layui-card">
          <div class="layui-card-header">
            资金流动趋势
            <div class="layui-btn-group layuiadmin-btn-group">
              <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs">去年</a>
              <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs">今年</a>
            </div>
          </div>
          <div class="layui-card-body">
            <div class="layui-row">
              <div class="layui-col-sm8">
                <div class="layui-col-sm12">
                  <div id="cityChart" style="height: 350px;"></div>
                </div>





                <!--               <div class="layui-col-sm4">
              <div class="layuiadmin-card-list">
                <p class="layuiadmin-normal-font">月访问数</p>
                <span>同上期增长</span>
                <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                  <div class="layui-progress-bar" lay-percent="30%"></div>
                </div>
              </div>
              <div class="layuiadmin-card-list">
                <p class="layuiadmin-normal-font">月下载数</p>
                <span>同上期增长</span>
                <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                  <div class="layui-progress-bar" lay-percent="20%"></div>
                </div>
              </div>
              <div class="layuiadmin-card-list">
                <p class="layuiadmin-normal-font">月收入</p>
                <span>同上期增长</span>
                <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                  <div class="layui-progress-bar" lay-percent="25%"></div>
                </div>
              </div>
            </div> -->
              </div>
            </div>
          </div>
        </div>

        <div class="layui-card">
          <div class="layui-card-header">
            平台下注概况
            <div class="layui-btn-group layuiadmin-btn-group">
              <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs">去年</a>
              <a href="javascript:;" class="layui-btn layui-btn-primary layui-btn-xs">今年</a>
            </div>
          </div>
          <div class="layui-card-body">
            <div class="layui-row">
              <div class="layui-col-sm8">
                <div class="layui-col-sm12">
                  <div id="bottom-pour" style="height: 350px;"></div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="layui-col-sm4">
          <div class="layui-card">
            <div class="layui-card-header">帐号监控(统计相同IP下登入的会员帐号)</div>
            <div class="layui-card-body">
              <table class="layui-table layuiadmin-page-table" lay-skin="line">
                <thead>
                  <tr>
                    <th>帐号</th>
                    <th>IP</th>
                    <th>最后登录时间</th>

                  </tr>
                </thead>
                <tbody id="repeatIP">
                  <tr>
                    <td><span class="first">yangpanda</span></td>
                    <td><span>127.0.0.1</span></td>
                    <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="layui-col-sm4">
          <div class="layui-card">
            <div class="layui-card-header">转帐监控(统计大额转入的会员帐号)</div>
            <div class="layui-card-body">
              <table class="layui-table layuiadmin-page-table" lay-skin="line">
                <thead>
                  <tr>
                    <th>帐号</th>
                    <th>转入金额</th>
                    <th>时间</th>
                  </tr>
                </thead>
                <tbody id="moneySwitch">
                  <tr>
                    <td><span class="first">yangpanda</span></td>
                    <td><span>100万</span></td>
                    <td><span>80万</span></td>
                    <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                  </tr>
         
            
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <div class="layui-col-sm4">
          <div class="layui-card">
            <div class="layui-card-header">套利监控(统计频繁转出的会员帐号)</div>
            <div class="layui-card-body">
              <table class="layui-table layuiadmin-page-table" lay-skin="line">
                <thead>
                  <tr>
                    <th>帐号</th>
                    <th>转出金额</th>
                    <th>转出时间</th>
                  </tr>
                </thead>
                <tbody id="moneyRollout">
                  <tr>
                    <td><span class="first">yangpanda</span></td>
                    <td><span>60万</span></td>
                    <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                  </tr>
                
                </tbody>
              </table>
            </div>
          </div>
        </div>



      </div>
    </div>

  </div>
  </div>
  </div>

  <script src="/layuiadmin/layui/layui.js"></script>
  <script>
    layui.config({
      base: '/layuiadmin/lib/extend/' //静态资源所在路径
    }).use(['echarts', 'jquery', 'layer'], function() {
      var $ = layui.jquery,
        echarts = layui.echarts;
      var layer = layui.layer;
      $.ajax({ //今日投注
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/today/betting/records",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          //console.log(res);
          if (res.status == 200) {
            $("#betting_user").html(res.betting_user);
            $("#betting_count").html(res.betting_count);
            $("#betting_money").html(res.betting_money);

          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //今日存款
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/today/recharge/records",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          // console.log(res);
          if (res.status == 200) {
            $("#apply_num").html(res.apply_num);
            $("#deposit_num ").html(res.deposit_num);
            $("#recharge_money").html(res.recharge_money);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //今日提款
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/today/withdrawal/records",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          //console.log(res);
          if (res.status == 200) {
            $("#with_apply_num").html(res.with_apply_num);
            $("#with_deposit_num ").html(res.with_deposit_num);
            $("#withdrawal_money").html(res.withdrawal_money);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //发放奖励
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/today/award/records",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          //console.log(res);
          if (res.status == 200) {
            $("#award_num").html(res.award_num);
            $("#award_money").html(res.award_money);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //发放奖励
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/today/register/user",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          //  console.log(res);
          if (res.status == 200) {
            $("#register_num").html(res.register_num);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });


      $.ajax({ //转帐监控大于八万
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/money/switch/control",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          data= res.data;
          if (res.status == 200) {
            options ="";
            for (let i = 0; i < data.length; i++) {
              options += '<tr>'+
                  '<td><span class="first">'+data[i].username+'</span></td>'+
                  '<td><span>'+data[i].recharge_money+'</span></td>'+
                  '<td><i class="layui-icon layui-icon-log">'+data[i].remit_time+'</i></td>'+
                  '</tr>'
            }
            $("#moneySwitch").html(options);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //频繁转出的会员帐号
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/money/rollout/control",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          data= res.data;
          if (res.status == 200) {
            options ="";
            for (let i = 0; i < data.length; i++) {
              options += '<tr>'+
                  '<td><span class="first">'+data[i].username+'</span></td>'+
                  '<td><span>'+data[i].draw_money+'</span></td>'+
                  '<td><i class="layui-icon layui-icon-log">'+data[i].ask_time+'</i></td>'+
                  '</tr>'
            }
            $("#moneyRollout").html(options);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //相同IP下登入的会员帐号
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/same/ip",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          
          data= res.data;/* console.log(data);return false; */
          if (res.status == 200) {
            options ="";
            for (let i = 0; i < data.length; i++) {
              options += '<tr>'+
                  '<td><span class="first">'+data[i].username+'</span></td>'+
                  '<td><span>'+data[i].login_ip+'</span></td>'+
                  '<td><i class="layui-icon layui-icon-log">'+data[i].created_at+'</i></td>'+
                  '</tr>'
            }
            $("#repeatIP").html(options);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //统计今年注册人数
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/year/register/user",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          // console.log(res.data);
          var data = res.data;

          if (res.status == 200) {
            arr = [];
            peo = [];
            
            for (let i = 0; i < data.length; i++) {
              arr.push(data[i].date);
              peo.push(data[i].value);
            }

            var dom = document.getElementById("user-reg");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
              tooltip: {
                trigger: "axis"
              },
              calculable: !0,
              title: {
                text: '人数'
              },
              xAxis: [{
                type: "category",
                data: arr
              }],
              yAxis: [{
                type: "value",
                name: "新增注册用户",
                //data: [10, 20, 950, 1e3, 1100, 1050, 1e3, 1150, 1250, 1370, 1250, 1100],
                axisLabel: {
                  formatter: "{value}"
                }
              }],
              series: [{
                name: "注册用户",
                color: 'green',
                type: "line",
                data: peo
              }]
            };;
            if (option && typeof option === "object") {
              myChart.setOption(option, true);
            }



          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });


      $.ajax({ //资金流动趋势
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/year/cash/flow",
        method: 'get',
        dataType: 'json',
        success: function(res) {
            data= res.data;
          if (res.status == 200) {
            date = [];
            deposit = [];
            draw_money =[];
            reward = [];
            
            for (let i = 0; i < data.length; i++) {
              date.push(data[i].date);
              deposit.push(data[i].deposit);
              draw_money.push(data[i].draw_money);
              reward.push(data[i].reward);
            }

               //资金流动趋势
      var myChart = echarts.init(document.getElementById('cityChart'));
      // 指定图表的配置项和数据
      var option = {
        title: {
          text: '元'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          data: ["存款", "提款", "奖励"]
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        xAxis: {
          type: 'category',
          boundaryGap: false,
          data: date
        },
        yAxis: {
          type: 'value',
          name: '金额'
        },
        series: [{
            name: "存款",
            color: 'green',
            type: "line",
            data: deposit
          },
          {
            name: "提款",
            type: "line",
            color: 'red',
            data: draw_money
          },
          {
            name: "奖励",
            color: 'yellow',
            type: "line",
            data: reward
          }
        ]
      };

      // 使用刚指定的配置项和数据显示图表。
      myChart.setOption(option, true);


          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          }
        }
      });

      $.ajax({ //平台下注情况
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "query/year/betting/records",
        method: 'get',
        dataType: 'json',
        success: function(res) {
          option_data_selected= res;
          console.log(option_data_selected);
          var new_series=new Array();
            var legend_data = new Array();
            var date = new Array;
            for(var x1 in option_data_selected){
                var new_series_per_obj=new Object();
                new_series_per_obj.name=x1;
                new_series_per_obj.type='line';
                new_series_per_obj.data=option_data_selected[x1]['bottom'];
                new_series.push(new_series_per_obj);
                legend_data.push(new_series_per_obj.name);
                date=option_data_selected[x1]['date'];
            }
  
      var myChart = echarts.init(document.getElementById('bottom-pour'));
      // 指定图表的配置项和数据
      var option = {
        title: {
          text: '元'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          data: legend_data
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        xAxis: {
          type: 'category',
          boundaryGap: false,
          data: date
        },
        yAxis: {
          type: 'value',
          name: '金额'
        },
        series: new_series
      };

      // 使用刚指定的配置项和数据显示图表。
      myChart.setOption(option, true);
/*           if (res.status == 200) {
            date = [];
            platform = [];
            bottom =[];
            
            for (let i = 0; i < data.length; i++) {
              platform.push(data[i]);
            }
            console.log(platform);
          } else if (res.status == 403) {
            layer.msg('错误', {
              offset: '15px',
              icon: 2,
              time: 3000
            })
          } */
        }
      });

    });
  </script>
</body>

</html>