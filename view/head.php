<?php
    if(!$view && !$mod){
        exit('<script>window.location.href="../index.php?mod=index"</script>');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <title><?php echo $sitename;?> - <?php echo $title;?></title>
	    <meta name="Description" content="<?php echo $description;?>"/>
	    <meta name="keywords" content="<?php echo $keywords;?>"/>
        <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
        <meta content="yes" name="apple-mobile-web-app-capable">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        <meta content="telephone=no" name="format-detection">
        <link rel="shortcut icon" href="/favicon.ico"/>
		<link rel="bookmark"href="/favicon.ico"/>
		<link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <?php
        	if(empty($mod)){
        		echo '<link href="'.$HTTP_HOST.'/public/index/css/index_style.css" rel="stylesheet" type="text/css">';
        	}else{
        		echo '<link href="'.$HTTP_HOST.'/public/index/css/'.$mod.'_style.css?a=122" rel="stylesheet" type="text/css">';
        	}
        ?>
        <script src="//lib.baomitu.com/jquery/1.12.4/jquery.min.js"></script>
        <script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
        <script type="text/javascript" src="<?php echo $HTTP_HOST;?>/public/index/js/slider.js"></script>
        <script src="//lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<style>
@media (min-width: 300px) {
	body{
		min-width: 100%;
	}
	.contain {
	    margin-top: 13.8%;
	}
	.aui-footer{
		width:100%;
	}
	.auto{
		width:100%;
	}
	.auto-width{
		width:100%;
	}
	.auto-layer{
		width:calc(100% - 23px);
	}
}
@media (min-width: 375px) {
	.auto-layer{
		width:calc(100% - 23px);
	}
}
@media (min-width: 500px) {
	body{
		min-width: unset;
		margin-left:40.1%;
	}
	.aui-footer{
		width:380px;
	}
	.auto{
		width:380px;
		margin-left:40.1%;
	}
	.auto-width{
		width:380px;
	}
	.auto-layer{
		width:350px;
	}
}
body {
    width:100%;
    max-width:380px;
    margin-left: auto;
    margin-right: auto;
}
.xc1{
	background:none;border:1px solid #51e091;font-size:0.9rem;font-weight:400;color:#51e091;border-radius:22px;padding:0.1rem 0.5rem;
}
.xc2{background:none;border:1px solid #fdca17;font-size:0.9rem;font-weight:400;color:#fdca17;border-radius:22px;padding:0.1rem 0.5rem;
}
.xc3{background:none;border:1px solid #c1c0bc;font-size:0.9rem;font-weight:400;color:#c1c0bc;border-radius:22px;padding:0.1rem 0.5rem;
}
</style>
    </head>
    <body>
    <style>.beijing_kong{box-shadow:none;background-color:transparent;}</style>
<?php 
$page = array('','index','toudi','manghe');
if($_COOKIE['userToken']!=md5($userInfo['user'].$userInfo['pwd']) && !in_array($mod,$page)){?>
<style>
    body{background:#f5f5f5}
</style>
<script>
    layer.open({
	   type: 2,
	   title: '登录后体验更多功能',
	   shadeClose: false,
	   closeBtn:2,
	   scrollbar: false,
	   area: ['310px', '420px'],
	   content: '?mod=login'
	});
</script>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<center style="max-width:380px;"><h1><font color="#c5c5c5">刷新重新登录</font></h1><center>
<?php
    include 'foot.php';
    exit();
}?>