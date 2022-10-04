<?php
    include '../core/core.php';
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="icon" href="0.ico" type="images/x-ico" />
    <title>盲盒</title>
    <link href="../public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/admin/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../public/admin/css/style.min.css" rel="stylesheet">
    <link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
</head>
<!--系统登录开始-->
<body data-theme="default" data-headerbg="color_6">
<?php 
    if($_COOKIE['adminToken']==md5(config('name').config('pwd'))){
?>

<div class="lyear-layout-web">
    <div class="lyear-layout-container">
    <aside class="lyear-layout-sidebar">
        <div id="logo" class="sidebar-header">
            <center>
                <ul class="nav">
                    <li class="dropdown dropdown-profile" style="background: linear-gradient(to bottom,#959ae5,#346faf);"><br><img class="img-avatar"
                             src="http://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo config('kfqq')?>&spec=100"/>
                    <br>
                    <font color="#fffff"><?php echo config('name');?></font><br>
                    <span class="label label-danger">超级管理员</span><br><br>
                    </li>
                </ul>
            </center>
        </div>
        <div class="lyear-layout-sidebar-scroll">
            <nav class="sidebar-main">
                <ul class="nav nav-drawer">
                    <li class="<?php echo active('index'); ?>">
                        <a href="./index.php"><i class="mdi mdi-home"></i> 后台首页</a>
                    </li>
                    <li class="<?php echo active('manghe'); ?>">
                        <a href="./manghe.php"><i class="mdi mdi-heart"></i> 盲盒列表</a>
                    </li>
                    <li class="<?php echo active('user'); ?>">
                        <a href="./user.php"><i class="mdi mdi-account"></i> 用户列表</a>
                    </li>
                   <!-- <li class="<?php echo active('fenzhan'); ?>">
                        <a href="./fenzhan.php"><i class="mdi mdi-account"></i> 分站列表</a>
                    </li>-->
                    <li class="<?php echo active('point'); ?>">
                        <a href="./point.php"><i class="mdi mdi-contacts"></i> 收支明细</a>
                    </li>
                    <li class="nav-item nav-item-has-subnav <?php echo active('set,set_manghe,pay,lunbo',true); ?>">
                      <a href="javascript:void(0)"><i class="mdi mdi-creation"></i> 系统管理</a>
                      <ul class="nav nav-subnav">
                        <li class="<?php echo active('set'); ?>">
                            <a href="./set.php"><i class="mdi mdi-compass"></i> 网站信息配置</a>
                        </li>
                      </ul>
                      <ul class="nav nav-subnav">
                        <li class="<?php echo active('set_manghe'); ?>">
                            <a href="./set_manghe.php"><i class="mdi mdi-compass"></i> 盲盒信息配置</a>
                        </li>
                      </ul>
                      <ul class="nav nav-subnav">
                        <li class="<?php echo active('pay'); ?>">
                            <a href="./pay.php"><i class="mdi mdi-compass"></i> 在线支付配置</a>
                        </li>
                      </ul>
                      <ul class="nav nav-subnav">
                        <li class="<?php echo active('lunbo'); ?>">
                            <a href="./lunbo.php"><i class="mdi mdi-compass"></i> 首页轮播配置</a>
                        </li>
                      </ul>
                    </li>
                    <li class="<?php echo active('var'); ?>">
                        <a href="./var.php"><i class="mdi mdi-console"></i> 程序信息</a>
                    </li>
                </ul>
                <div style="min-height:120px"></div>
            </nav>
        </div>
    </aside>

<header class="lyear-layout-header">
        <nav class="navbar navbar-default">
            <div class="topbar">
                <div class="topbar-left">
                    <div class="lyear-aside-toggler">
                        <span class="lyear-toggler-bar"></span>
                        <span class="lyear-toggler-bar"></span>
                        <span class="lyear-toggler-bar"></span>
                    </div>
                    <span class="navbar-page-title">盲盒后台管理系统</span>
                </div>
                <ul class="topbar-right">
                </ul>
            </div>
        </nav>
    </header>
    
    <main class="lyear-layout-content">
<?php  }else{
    if(!active('login')){
        exit('<script>window.location.href="./login.php"</script>');   
    }
} ?>