

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layuiAdmin 主页示例模板二</title>
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
            <p class="layuiadmin-big-font">1024</p>
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
          <div class="layui-card-body layuiadmin-card-list" >
            <p>投注会员数： <span class=" layui-badge layui-bg-green ">100</span> (今日参与投注的会员数量)</p>
            <p>投注次数：<span class="layui-badge layui-bg-green ">102,4</span> (今日投注总次数)</p>
            <p>总投注金额：<span class="layui-badge layui-bg-green ">120,100</span> (今日总下注金额)</p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            今日存款
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list" >
            <p>申请笔数： <span class=" layui-badge layui-bg-green ">100</span> (存款申请的次数)</p>
            <p>存款笔数：<span class="layui-badge layui-bg-green ">102,4</span> (已处理的存款申请次数)</p>
            <p>存款金额：<span class="layui-badge layui-bg-green ">120,100</span> (已处理的存款申请的总金额)</p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            今日提款
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list" >
            <p>申请笔数： <span class=" layui-badge layui-bg-green ">100</span> (提款申请的次数)</p>
            <p>提款笔数：<span class="layui-badge layui-bg-green ">102,4</span> (已处理的提款申请次数)</p>
            <p>提款金额：<span class="layui-badge layui-bg-green ">120,100</span> (已处理的提款申请的总金额)</p>
          </div>
        </div>
      </div>
      <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
          <div class="layui-card-header">
            发放奖励
            <span class="layui-badge layui-bg-blue layuiadmin-badge">日</span>
          </div>
          <div class="layui-card-body layuiadmin-card-list" >
            <p>发放笔数： <span class=" layui-badge layui-bg-green ">100</span> (今日发放奖励的次数)</p>
            <p>发放总额：<span class="layui-badge layui-bg-green ">102,401</span> (今日发放奖励的总金额)</p>

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
              <tbody>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>127.0.0.1</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
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
          <div class="layui-card-header">转帐监控(统计大额转入转出的会员帐号)</div>
          <div class="layui-card-body">
            <table class="layui-table layuiadmin-page-table" lay-skin="line">
              <thead>
                <tr>
                  <th>帐号</th>
                  <th>转入金额</th>
                  <th>转出金额</th>
                  <th>时间</th>
                </tr> 
              </thead>
              <tbody>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>100万</span></td>
                  <td><span>80万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
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
              <tbody>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
                <tr>
                  <td><span class="first">yangpanda</span></td>
                  <td><span>60万</span></td>
                  <td><i class="layui-icon layui-icon-log"> 11:20</i></td>
                </tr>
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
  }).use(['echarts','jquery'],function(){
    var $ = layui.jquery, echarts = layui.echarts;

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
                    data: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
                }],
                yAxis: [{
                    type: "value",
                    name: "新增注册用户",
                    axisLabel: {
                        formatter: "{value}"
                    }
                }],
                series: [{
                    name: "注册用户",
                    color:'green',
                    type: "line",
                    data: [900, 850, 950, 1e3, 1100, 1050, 1e3, 1150, 1250, 1370, 1250, 1100]
                }]
            };
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}

//资金流动趋势
var myChart = echarts.init(document.getElementById('cityChart'));
// 指定图表的配置项和数据
var option = 
            {
    title: {
        text: '万元'
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
        data: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
    },
    yAxis: {
        type: 'value',
        name: '金额'
    },
    series: [
        {
            name: "存款",
            color:'green',
            type: "line",
            data: [320, 232, 201, 234, 390, 430, 410, 201, 234, 390, 430, 410]
        },
        {
          name: "提款",
                    type: "line",
                    color: 'red',
            data: [220, 182, 191, 234, 290, 330, 310, 191, 234, 290, 330, 310]
        },
        {
          name: "奖励",
                    color: 'yellow',
                    type: "line",
            data: [150, 232, 201, 154, 190, 330, 410, 201, 154, 190, 330, 410]
        }
    ]
};

// 使用刚指定的配置项和数据显示图表。
myChart.setOption(option,true);

//平台下注概况
var myChart = echarts.init(document.getElementById('bottom-pour'));
// 指定图表的配置项和数据
var option = 
            {
    title: {
        text: '万元'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ["平台1", "平台2", "平台3"]
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
        data: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
    },
    yAxis: {
        type: 'value',
        name: '金额'
    },
    series: [
        {
            name: "平台1",
            color:'green',
            type: "line",
            data: [320, 232, 201, 234, 390, 430, 410, 201, 234, 390, 430, 410]
        },
        {
          name: "平台2",
                    type: "line",
                    color: 'red',
            data: [220, 182, 191, 234, 290, 330, 310, 191, 234, 290, 330, 310]
        },
        {
          name: "平台3",
                    color: 'yellow',
                    type: "line",
            data: [150, 232, 201, 154, 190, 330, 410, 201, 154, 190, 330, 410]
        }
    ]
};

// 使用刚指定的配置项和数据显示图表。
myChart.setOption(option,true);
});
  
  </script>
</body>
</html>