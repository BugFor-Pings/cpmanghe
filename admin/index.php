<?php
    include './head.php';
    $thtime=date("Y-m-d").' 00:00:00';
    $user_all = $DB->getColumn("SELECT count(*) FROM `pre_user`");
    $user_day = $DB->getColumn("SELECT count(*) FROM `pre_user` WHERE addtime>='$thtime'");
    $manghe_nan = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `sex`=1 AND `for_user` IS NULL");
    $manghe_nv = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `sex`=0 AND `for_user` IS NULL");
    
    $manghe_all = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `for_user` IS NULL");
    $manghe_day = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE addtime>='$thtime'");
?>
<div class="container-fluid">
        
        <div class="row">
           <div class="col-sm-4 col-lg-4">
            <div class="card bg-danger">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">平台共有<?php echo $user_all;?>位用户</p>
                  <p class="h3 text-white m-b-0">今日新增<?php echo $user_day;?>个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-80 bg-translucent"><i class="mdi mdi-account-plus fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-lg-4">
            <div class="card bg-success">
              <div class="card-body clearfix">
                <div class="pull-right">
                <p class="h6 text-white m-t-0">男生盲盒<?php echo $manghe_nan;?>个</p>
                  <p class="h3 text-white m-b-0">女生盲盒<?php echo $manghe_nv;?>个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-70 bg-translucent"><i class="mdi mdi-account-multiple-plus fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
        <div class="col-sm-4 col-lg-4">
            <div class="card bg-info">
              <div class="card-body clearfix">
                <div class="pull-right">
                  <p class="h6 text-white m-t-0">现有盲盒数量<?php echo $manghe_all;?>个</p>
                  <p class="h3 text-white m-b-0">新增<?php echo $manghe_day;?>个</p>
                </div>
                <div class="pull-left"> <span class="img-avatar img-avatar-80 bg-translucent"><i class="mdi mdi-diamond fa-1-5x"></i></span> </div>
              </div>
            </div>
          </div>
          </div>
          
       <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><h4>新增用户趋势</h4></div>
              <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div ></div></div><div class="chartjs-size-monitor-shrink"><div></div></div></div>
                <canvas id="chart-vbar-1" width="702" height="438" class="chartjs-render-monitor" style="display: block; height: 351px; width: 562px;"></canvas>
              </div>
            </div>
          </div>
        
     
          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header">
                <h4>系统信息</h4>
              </div>
              <div class="card-body">
                  <li class="list-group-item"><i class="mdi mdi-apple-mobileme"></i> <b>运营天数：</b> 1 天</li>
                  <li class="list-group-item"><i class="mdi mdi-language-php"></i> <b>PHP版本：</b> <?php echo PHP_VERSION?></li>
                  <li class="list-group-item"><i class="mdi mdi-link-variant"></i> <b>当前域名：</b> <?php echo $_SERVER["HTTP_HOST"]?></li>
                  <li class="list-group-item"><i class="mdi mdi-android"></i> <b>程序版本：</b> 1.0</li>
                  <li class="list-group-item"><i class="mdi mdi-shuffle-variant"></i> <b>服务器IP：</b> <?php echo GetHostByName($_SERVER['SERVER_NAME'])?></li>
                  <li class="list-group-item"><i class="mdi mdi-alarm-multiple"></i> <b>当前时间：</b> <?php echo date("Y-m-d H:i:s",time())?></li>
                  <li class="list-group-item"  lass="mdi mdi-alarm-multiple">联系作者:<a href="http://wpa.qq.com/msgrd?v=3&uin=924984&site=qq&menu=yes" target="_blank">点击直接跳转</a></li>
              </div>
            </div>
          </div>
           
        </div>
        
      </div>
<?php
    include './foot.php';
?>
<script type="text/javascript" src="../public/admin/js/Chart.js"></script>

<script>
new Chart($("#chart-vbar-1"), {
    type: 'bar',
    data: {
        labels: [<?php foreach (get_weeks() as $day){echo '"'.$day.'"';if(date("m-d")!=$day)echo ',';}?>],
        datasets: [{
            label: "新增盲盒数量",
            backgroundColor: "rgba(51,202,185,0.5)",
            borderColor: "rgba(0,0,0,0)",
            hoverBackgroundColor: "rgba(51,202,185,0.7)",
            hoverBorderColor: "rgba(0,0,0,0)",
            data: [<?php $y=date("Y");foreach (get_weeks() as $day){echo $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `addtime`>='$y-$day 00:00:00' AND `addtime`<='$y-$day 23:59:59'");if(date("m-d")!=$day)echo ',';}?>]
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>