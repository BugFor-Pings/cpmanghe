<?php
    error_reporting(0);
	$default = true;
    define('SYSTEM_ROOT', dirname(__FILE__) . '/');
    define('ROOT', dirname(SYSTEM_ROOT) . '/');
    include ROOT.'/core/function.php';
    include ROOT.'config.php';
    include ROOT.'/core/db.class.php';
    $DB = new PdoHelper($dbconfig);
    $act = daddslashes($_GET['act'])??null;
    $mod = daddslashes($_GET['mod'])??'index';
    $thtime=date("Y-m-d").' 00:00:00';
    $the_url = $_SERVER['HTTP_HOST'];
    $order_id = date("YmdHis").mt_rand(100,999);;
    $tx_type = ['微信','支付宝','QQ'];

    $site_id = '0';
    $sitename = config('sitename');
    $title = config('title');
    $description = config('description');
    $keywords = config('keywords');
    $kfwx = config('kfwx');
    $kfqq = config('kfqq');
    $toudi_money = config('toudi_money');
    $chouqu_money = config('chouqu_money');
    $daili_money = config('daili_money');
//小高教学网www.12580sky.com
    //高网地址发布页：www.xgjxw6.com   关注微信公众号：小高教学网
    $siteInfo = $DB->getRow("SELECT * FROM `pre_site` WHERE `url`='{$the_url}'");
    if($siteInfo['url']==$the_url){
        $site_id = $siteInfo['id'];
        $sitename = $siteInfo['sitename'];
        $title = $siteInfo['title'];
        $description = $siteInfo['description'];
        $keywords = $siteInfo['keywords'];
        $kfwx = $siteInfo['kfwx'];
        $kfqq = $siteInfo['kfqq'];
        if(config('daili_zdy')){
            $toudi_money = $siteInfo['toudi'];
            $chouqu_money = $siteInfo['chouqu'];
            $daili_money = $siteInfo['daili'];
        }
    }
    
    if($_COOKIE['userToken']){
        $userName = daddslashes($_COOKIE['userName']);
        $userInfo = $DB->getRow("SELECT * FROM `pre_user` WHERE `user`='{$userName}'");
        $siteInfo = $DB->getRow("SELECT * FROM `pre_site` WHERE `user`='{$userInfo['user']}'");
        if($siteInfo){
            if($siteInfo['type']=='1'){
                $site_type = '实习月老';
            }elseif($siteInfo['type']=='2'){
                $site_type = '职业月老';
            }
        }
    }
    
    if(!$_COOKIE['userName'] && !$userInfo){
        $userName = md5(time().mt_rand(1,999999));
        setcookie("userName", $userName, time() + 604800, '/');
    }elseif($userInfo){
        setcookie("userName", $userInfo['user'], time() + 604800, '/');
    }
?>