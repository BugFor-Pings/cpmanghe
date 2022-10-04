<?php
    include './head.php';
    
    $user_all = $DB->getColumn("SELECT count(*) FROM `pre_user` WHERE `site`='{$siteInfo['id']}'");
    $manghe_all = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `site`='{$siteInfo['id']}'");
?>
<link rel="stylesheet" href="../public/index/css/admin.css">
<div class="container" style="padding-top:70px;">
<div class="col-md-12 col-lg-10 center-block" style="float: none;">
<div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cloud fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $user_all;?></div>
                                    <div>注册用户</div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="panel-footer">
                                <span class="pull-left" herf="user.php">查看详情</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inbox fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="count1"><?php echo $manghe_all;?></div>
                                    <div>贡献盲盒</div>
                                </div>
                            </div>
                        </div>
                        <a href="file.php">
                            <div class="panel-footer">
                                <span class="pull-left">查看详情</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
<div class="col-lg-6 col-md-6">
    <div class="panel panel-info">
    	<div class="panel-heading">
    		<h3 class="panel-title">我的信息</h3>
    	</div>
    	<ul class="list-group">
    		<li class="list-group-item">
    			<b>账号：</b><?php echo $userInfo['user']; ?>
    		</li>
    		<li class="list-group-item">
    			<b>余额：</b><?php echo $userInfo['rmb']; ?></a>元 <a href="./tixian.php" class="btn btn-danger btn-xs">提现</a>
    		</li>
    		
    	</ul>
    </div>
	</div>
	<div class="col-lg-6 col-md-6">
    <div class="panel panel-info">
    	<div class="panel-heading">
    		<h3 class="panel-title">我的站点信息</h3>
    	</div>
    	<ul class="list-group">
    		<li class="list-group-item">
    			<b>站点名称：</b><?php echo $siteInfo['sitename']??'<font color="red">您未设置</font>'; ?>
    		</li>
    		<li class="list-group-item">
    			<b>站点地址：</b><a target="_blank" href="http://<?php echo $siteInfo['url']; ?>"><?php echo $siteInfo['url']??'<font color="red">您未设置站点域名无法获得提成</font>'; ?></a>
    		</li>
    		<li class="list-group-item">
    			<b>我的职位：</b><?php echo $site_type; if($siteInfo['type']=='1'){echo ' <a href="./upsite.php" class="btn btn-xs btn-danger"><span class="fa fa-arrow-circle-o-up"></span></a>';}?>
    		</li>
    	</ul>
    </div>
	</div>
</div>
</div>
</div>