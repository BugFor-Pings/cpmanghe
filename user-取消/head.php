<?php
    include '../core/core.php';
    if(!in_array(pageSelf(),array('login.php','reg.php')) && $_COOKIE['user']!=$userInfo['user'] && $_COOKIE['userToken']!=md5($userInfo['user'].$userInfo['pwd'])){
      exit('<script>alert("请重新登录");window.location.href="../index.php?mod=user"</script>');
    }
    if($userInfo['dltime']<=$thtime || !$siteInfo){
       exit('<script>alert("您不是月老或已过期");window.location.href="../index.php?mod=user"</script>');
    }
    $siteInfo = $DB->getRow("SELECT * FROM `pre_site` WHERE `user`='{$userInfo['user']}'");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>用户中心</title>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//s1.pstatp.com/cdn/expire-1-M/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//lib.baomitu.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">导航按钮</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php">月老后台管理中心</a>
      </div><!-- /.navbar-header -->
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <?php if($_COOKIE['userToken']){ ?>
                <li class="">
                    <a href="./index.php"><span class="fa fa-home"></span> 后台首页</a>
                  </li>
                  <li class="">
                    <a href="./user.php"><span class="fa fa-users"></span> 用户列表</a>
                  </li>
                  <?php 
                    if($siteInfo['type']=='2'){
                       echo '<li class="">
                    <a href="./daili.php"><span class="fa fa-users"></span> 代理列表</a>
                  </li>'; 
                    }
                  ?>
                  <li class="">
                    <a href="./point.php"><span class="fa fa-list"></span> 收支明细</a>
                  </li>
                  <li class="">
                    <a href="./tg.php"><span class="fa fa-heart"></span> 推广图片</a>
                  </li>
                  <li class="">
                    <a href="./set.php"><span class="fa fa-cog"></span> 站点设置</a>
                  </li>
         <?php }else{?>
                <li class="">
                    <a href="./login.php"><span class="fa fa-home"></span> 登录</a>
                  </li>
                  <li class="">
                    <a href="./reg.php"><span class="fa fa-home"></span> 注册</a>
                  </li>';
            
        <?php } ?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  
