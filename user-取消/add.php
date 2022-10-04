<?php
//小高教学网www.12580sky.com
    //高网地址发布页：www.xgjxw6.com   关注微信公众号：小高教学网
    include './head.php';
    $mysqlversion=$DB->getColumn("select VERSION()");
?>
<div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-md-10 col-lg-6 center-block" style="float: none;">
            <div class="text-center">
                <h3>在线生成</h3>
                <hr>
                <div class="input-group">
        			<span class="input-group-addon">APP名称</span>
        			<input type="text" id="name" value="" class="form-control" placeholder="请输入APP名称">
        		</div><br>
        		<div class="input-group">
        			<span class="input-group-addon">APP图标</span>
        			<input type="text" id="pwd" class="form-control" placeholder="请输入APP图标">
        		</div><br>
        		<div class="input-group">
        			<span class="input-group-addon">APP启动图</span>
        			<input type="text" id="pwd" class="form-control" placeholder="请输入APP启动图">
        		</div><br>
        		<div class="input-group">
        			<span class="input-group-addon">网站地址</span>
        			<input type="text" id="pwd" class="form-control" placeholder="请输入网站地址">
        		</div><br>
        		<button id="createApp" class="btn btn-success">在线生成</button>
        		<hr>
    </div>