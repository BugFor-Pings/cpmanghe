<?php
    include '../core/core.php';
    
    if($act=='userReg'){
        $name = daddslashes($_POST['name']);
        $pwd = daddslashes($_POST['pwd']);
        if(!$name || !$pwd){
            exit('{"code":0,"msg":"请填写完整"}');  
        }else{
            $userInfo = $DB->getRow("SELECT `name` FROM `pre_user` WHERE `name`='{$name}'");
            if($userInfo){
                exit('{"code":0,"msg":"用户名已存在"}'); 
            }
            $res = $DB->query("INSERT INTO `pre_user`(`name`, `pwd`) VALUES ('{$name}','{$pwd}')");
            if($res){
                exit('{"code":1,"msg":"注册成功"}'); 
            }else{
                exit('{"code":0,"msg":"注册失败"}'); 
            }
        }
    }elseif($act=='userLogin'){
        $name = daddslashes($_POST['name']);
        $pwd = daddslashes($_POST['pwd']);
        if(!$name || !$pwd){
            exit('{"code":0,"msg":"请填写完整"}');  
        }else{
            $userInfo = $DB->getRow("SELECT `name`,`pwd` FROM `pre_user` WHERE `name`='{$name}'");
            if($name==$userInfo['name'] && $pwd==$userInfo['pwd']){
                $userToken = md5($name.$pwd);
                setcookie("userName",$name, time() + 604800, '/');
                setcookie("userToken",$userToken, time() + 604800, '/');
                exit('{"code":1,"msg":"登陆成功"}');
            }else{
                exit('{"code":0,"msg":"账号或密码错误"}');
            }
        }
    }
//小高教学网www.12580sky.com
    //高网地址发布页：www.xgjxw6.com   关注微信公众号：小高教学网
    if($_COOKIE['user']!=$userInfo['user'] && $_COOKIE['userToken']!=md5($userInfo['user'].$userInfo['pwd'])){
        exit(json_encode(['code' => 0, 'msg' => '您未登录']));
    }
    
    
    switch ($act) {
        case 'file_opload':
        	$file = $_FILES['file'];
        	$type = strtolower(substr($file['name'], strrpos($file['name'], '.') + 1));
        	if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
        		exit(json_encode(['code' => 0, 'msg' => '上传图片格式错误']));
        	}
        
            $path = '../public/index/img/skt/'.time().mt_rand(1,99).'.png';
            $res = copy($file['tmp_name'],$path);
            if($res){
                exit(json_encode(['code' => 1, 'msg' => '上传成功','path'=>$path]));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '上传失败']));
            }
        break;
        case 'tx_config':
            $tx_skt = daddslashes($_POST['tx_skt']);
            $tx_zh = daddslashes($_POST['tx_zh']);
            $tx_xm = daddslashes($_POST['tx_xm']);
            $tx_type = daddslashes($_POST['tx_type']);
            
            $res = $DB->query("UPDATE `pre_site` SET `tx_zh`='{$tx_zh}',`tx_xm`='{$tx_xm}',`tx_skt`='{$tx_skt}',`tx_type`='{$tx_type}' WHERE `user`='{$userInfo['user']}'");
            if($res){
                exit(json_encode(['code' => 1, 'msg' => '修改成功']));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '修改失败']));
            }
        break;
        case 'tixian':
            $rmb = daddslashes($_POST['rmb']);
            $time = date("Y-m-d H:i:s",time());
            
            if($userInfo['rmb']<$rmb){
                exit(json_encode(['code' => 0, 'msg' => '您余额不足！']));
            }elseif($rmb<config('tixian')){
                exit(json_encode(['code' => 0, 'msg' => '最低提现'.config('tixian').'元']));
            }
            $res = rmb('-',$rmb,$userInfo['user'],'申请提现');
            if($res){
                $DB->query("INSERT INTO `pre_tixian` (`money`,`addtime`,`user`) VALUES('{$rmb}','{$time}','{$userInfo['user']}')");
                exit(json_encode(['code' => 1, 'msg' => '申请成功']));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '申请失败']));
            }
        break;
        case 'user_config':
            $userName = daddslashes($userInfo['user']);
            $sitename = daddslashes($_POST['sitename']);
            $description = daddslashes($_POST['description']);
            $keywords = daddslashes($_POST['keywords']);
            $toudi = daddslashes($_POST['toudi']);
            $chouqu = daddslashes($_POST['chouqu']);
            $daili = daddslashes($_POST['daili']);
            $user_url = daddslashes($_POST['user_url']);
            
            $is_url = $DB->getRow("SELECT `id` FROM `pre_site` WHERE `url`='{$user_url}'");
            if($is_url && $is_url['id']!=$siteInfo['id']){
                exit(json_encode(['code' => 0, 'msg' => '该域名已被绑定，请更换！']));
            }
            
            if(!$toudi && $toudi!=0){
               $toudi =  $siteInfo['toudi'];
            }
            if(!$chouqu && $chouqu!=0){
               $chouqu =  $siteInfo['chouqu'];
            }
            if(!$daili && $daili!=0){
               $daili =  $siteInfo['daili'];
            }
            if(!$user_url){
               $user_url = $siteInfo['url'];
            }

            if($toudi<0.01 || $chouqu<0.01 || $daili<0.01){
                exit(json_encode(['code' => 0, 'msg' => '价格必须大于0，请重填！']));
            }
            
            $res = $DB->query("UPDATE `pre_site` SET `sitename`='{$sitename}',`description`='{$description}',`keywords`='{$keywords}',`toudi`='{$toudi}',`chouqu`='{$chouqu}',`daili`='{$daili}',`url`='{$user_url}' WHERE `user`='{$userName}'");
            if($res){
                exit(json_encode(['code' => 1, 'msg' => '修改成功']));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '修改失败']));
            }
        break;
        default:
             exit(json_encode(['code' => 0, 'msg' => '未知错误']));
        break;
    }

?>