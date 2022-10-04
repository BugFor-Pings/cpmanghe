<?php
    include '../core/core.php';
    
    if($act=='user_login'){
        $user = daddslashes($_POST['user']);
        $pwd = daddslashes($_POST['pwd']);
        if(!$user || !$pwd){
            exit('{"code":0,"msg":"请填写完整"}');  
        }else{
            $userInfo = $DB->getRow("SELECT `user`,`pwd` FROM `pre_user` WHERE `user`='{$user}'");
            if($userInfo && $user==$userInfo['user'] && $pwd==$userInfo['pwd']){
                $userToken = md5($user.$pwd);
                setcookie("userName",$user, time() + 604800, '/');
                setcookie("userToken",$userToken, time() + 604800, '/');
                exit(json_encode(['code' => 1, 'msg' => '登录成功']));
            }elseif(!$userInfo){ //首次登录并注册
                $res = $DB->query("INSERT INTO `pre_user` (`user`,`pwd`,`upsite`) VALUES('{$user}','{$pwd}','{$site_id}')");
                if($res){
                    $userToken = md5($user.$pwd);
                    setcookie("userName",$user, time() + 604800, '/');
                    setcookie("userToken",$userToken, time() + 604800, '/');
                    exit(json_encode(['code' => 1, 'msg' => '注册登录成功，请截图保存密码！','user'=>$user,'pwd'=>$pwd]));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '注册失败,请重试']));
                }
            }else{
                exit(json_encode(['code' => 0, 'msg' => '账号或密码错误']));
            }
        }
    }
    
    switch($act){
        case 'file_opload':
        	$file = $_FILES['file'];
        	$type = strtolower(substr($file['name'], strrpos($file['name'], '.') + 1));
        	if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
        		exit(json_encode(['code' => 0, 'msg' => '上传图片格式错误']));
        	}
        
            $path = '../public/index/img/touxiang/'.time().mt_rand(1,99).'.png';
            $res = copy($file['tmp_name'],$path);
            if(!$res){
                exit(json_encode(['code' => 0, 'msg' => '上传失败']));
            }else{
                exit(json_encode(['code' => 1, 'msg' => '上传成功','path'=>$path]));
            }
        break;
        case 'pay_cz':
        	$orderid = daddslashes($_POST['orderid']);
        	$user = daddslashes($_POST['user']);
        	$mod = daddslashes($_POST['mod']);
        	$money = daddslashes($_POST['money']);
        	$chouqu = daddslashes($_POST['chouqu']);
        	$time = date("Y-m-d H:i:s",time());

        	if($mod=='toudi'){
        	    $money = $toudi_money;
        	    $bz = '投递盲盒';
        	}elseif($mod=='chouqu'){
        	    $money = $chouqu_money;
        	    $bz = '抽取盲盒';
        	}elseif($mod=='daili'){
        	    $money = $daili_money;
        	    $bz = '加盟代理';
        	}elseif($mod=='chongzhi'){
        	    $money = $money;
        	    $bz = '用户充值';
        	}
        // 	$time_sql = getRow("SELECT * FROM `pre_pay` WHERE `user`='{$user}' ORDER BY `addtime` DESC");
        // 	if(strtotime($time)-strtotime($time_sql['addtime'])<5){
        // 		exit(json_encode(array('code'=>0,'msg'=>'您的操作频繁,请 5 秒后再试~')));
        // 	}
        	$res = $DB->query("INSERT INTO `pre_pay` (`orderno`, `addtime`, `money`, `status`, `bz`,`chouqu`,`user`) VALUES ('".$orderid."', '".$time."', '{$money}', '0', '{$bz}','{$chouqu}','{$user}')");
        	if($res){
        		exit(json_encode(array('code'=>1,'orderno'=>$orderid,'money'=>$money)));
        	}else{
        	    exit(json_encode(array('code'=>1,'orderno'=>$orderid,'money'=>$money)));
        	}
        break;
        case 'toudi':
            $touxiang = str_replace('..','',daddslashes($_POST['touxiang']));
            $name = daddslashes($_POST['name']);
            $shengri = daddslashes($_POST['shengri']);
            $sex = daddslashes($_POST['sex']);
            $weixin = daddslashes($_POST['weixin']);
            $jieshao = daddslashes($_POST['jieshao']);
            $birthday = daddslashes($_POST['birthday']);
            $city = daddslashes($_POST['city']);
            $userName = daddslashes($_POST['userName']);
            $ip = x_real_ip();

            
            if(!$birthday || !in_array($sex,[0,1]) || !$weixin){
                exit(json_encode(['code' => 0, 'msg' => '生日,性别,微信为必填项哦！']));
            }else{
                $riqi = explode('-',$birthday);
                $time = date("Y-m-d H:i:s",time());
                
                if(config('manghe_shenhe')=='1'){ //审核模式
                    $res = $DB->query("INSERT INTO `pre_manghe` ( `name`, `birthday`, `sex`, `weixin`, `jieshao`, `city`,`touxiang`,`addtime`,`from_user`,`orderid`,`ip`,`status`) VALUES('{$name}','{$birthday}','{$sex}','{$weixin}','{$jieshao}','{$city}','{$touxiang}','{$time}','{$userName}','{$order_id}','{$ip}','0')");
                }else{
                    $res = $DB->query("INSERT INTO `pre_manghe` (`name`, `birthday`, `sex`, `weixin`, `jieshao`, `city`,`touxiang`,`addtime`,`from_user`,`orderid`,`ip`) VALUES('{$name}','{$birthday}','{$sex}','{$weixin}','{$jieshao}','{$city}','{$touxiang}','{$time}','{$userName}','{$order_id}','{$ip}')");
                }
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '添加成功','orderid'=>$order_id]));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '添加失败']));
                }
            }
        break;
        case 'manghe_info':
            $id = daddslashes($_POST['id']);
            if(!$id){
                exit(json_encode(['code' => 0, 'msg' =>'参数不完整']));
            }
            $mh_info = $DB->getRow("SELECT * FROM `pre_manghe` WHERE `id`='{$id}'");
            if($mh_info){
                $riqi = explode('-',$mh_info['birthday']);
                exit(json_encode(['code' => 1,'name'=>daddslashes($mh_info['name']),'age'=>daddslashes(birthday($mh_info['birthday'])),'xingzuo'=>daddslashes(xingzuo($riqi[1],$riqi[2])),'sex'=>daddslashes($mh_info['sex']),'weixin'=>daddslashes($mh_info['weixin']),'jieshao'=>daddslashes($mh_info['jieshao']),'birthday'=>daddslashes($mh_info['birthday']),'city'=>htmlspecialchars_decode($mh_info['city'])]));
            }else{
                exit(json_encode(['code' => 0, 'msg' =>'查询失败,请重试！']));
            }
        break;
        case 'manghe':
            $mod = daddslashes($_POST['mod']);
            $ip = x_real_ip();
            
            
            if($mod=='nan'){
                $sex = '1';
            }else{
                $sex = '0';
            }
            
            chouqu($sex);
        break;
        case 'manghe_null':
            $mod = daddslashes($_POST['mod']);
            if($mod=='nan'){
                $mod = 1;
            }elseif($mod=='nv'){
                $mod = 0;
            }
            $mangh_null = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `sex`='{$mod}' AND `for_user` IS NULL AND `ok`='1' AND `from_user`!='{$userInfo['user']}'");
            if($mangh_null){
                exit(json_encode(['code' => 1, 'msg' => '获取成功']));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '暂无数据，请稍后尝试哦~']));
            }
        break;
    }
    
    if($_COOKIE['user']!=$userInfo['user'] && $_COOKIE['userToken']!=md5($userInfo['user'].$userInfo['pwd'])){
        exit(json_encode(['code' => 0, 'msg' => '您未登录']));
    }
    
    switch($act){
        case 'rmb_zf':
        	$user = daddslashes($userInfo['user']);
        	$mod = daddslashes($_POST['mod']);
        	$orderid = daddslashes($_POST['orderid']);
        	$time = date("Y-m-d H:i:s",time());
        	
            if($mod=='toudi'){
                $rmb = $toudi_money;
                $content = '投递盲盒';
            }elseif($mod=='chouqu'){
                $rmb = $chouqu_money;
                $content = '抽取盲盒';
                $cq_orderid = $orderid.'-no';
            }elseif($mod=='chongzhi'){
                $rmb = $chouqu_money;
                $content = '充值余额';
            }
        	
            $pay_info = $DB->getRow("SELECT * FROM `pre_pay` WHERE `orderno`='{$orderid}'");
            if(!$pay_info){
                exit(json_encode(['code' => 0, 'msg' => '请重新发起支付！']));
            }else{
                if($pay_info['status']=='0'){ //订单状态等于0
                    $res = rmb('-',$rmb,$userInfo['user'],$content,$cq_orderid);
        			if($res){
        			    $res = $DB->query("UPDATE `pre_pay` SET `status` = '1' WHERE `orderno` = ".$pay_info['orderno']."");
        			    if($res){
        			        exit(json_encode(['code' => 1, 'msg' => $content.'成功']));
        			    }else{
        			        exit(json_encode(['code' => 0, 'msg' => $content.'失败']));
        			    }
        			}else{
        			    exit(json_encode(['code' => 0, 'msg' => '支付失败，可能是您的余额不足！']));
                    }
        		}else{
        			exit(json_encode(['code' => 0, 'msg' => '订单已完结，如有问题请联系客服！']));
        		}
            }
        break;
        case 'qiandao':
            $user = daddslashes($_POST['user']);
            $thtime = date("Y-m-d").' 00:00:00';
            $time = date("Y-m-d H:i:s");
            $jifen = config('jifen');
            
            if($user){
                $qiandao_info = $DB->getRow("SELECT `qdtime` FROM `pre_user` WHERE `user`='{$user}'");
                if($qiandao_info['qdtime']>=$thtime){
                    exit(json_encode(['code' => 0, 'msg' => '您今天签到过了哦~']));
                }
                
                $res = $DB->query("UPDATE `pre_user` SET `qdtime`='{$time}',`jifen`=`jifen`+'{$jifen}' WHERE `user`='{$user}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '签到成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '签到失败']));
                }
            }else{
                exit(json_encode(['code' => 0, 'msg' => '参数不完整']));
            }
        break;
        case 'manghe_zidong':
            $userName = daddslashes($userInfo['user']);
            
            if($userName){
                $res = $DB->getRow("SELECT `touxiang`,`name`,`city`,`birthday`,`sex`,`weixin`,`jieshao` FROM `pre_user` WHERE `user`='{$userName}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '获取并自动填入成功','data'=>$res]));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '获取失败，请重试...']));
                }
            }else{
                exit(json_encode(['code' => 0, 'msg' => '您未登录']));
            }
        break;
        case 'daili':
            $userName = daddslashes($userInfo['user']);
            $money = $daili_money;
            $time = date("Y-m-d H:i:s",time());
            
            if($userInfo['rmb']>=$money){
                $res = $DB->query("UPDATE `pre_user` SET `rmb`=`rmb`-'{$money}' WHERE `user`='{$userName}'");
                if($res){
                    $DB->query("INSERT INTO `pre_site` (`addtime`,`user`) VALUES('{$time}','{$userName}')");
                    $DB->query("UPDATE `pre_user` SET `dltime`='2099-09-22' WHERE `user`='{$userName}'");
                    exit(json_encode(['code' => 1, 'msg' => '开通成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '开通失败，请重试']));
                }
            }else{
                exit(json_encode(['code' => 0, 'msg' => '账户余额不足']));
            }
        break;
        case 'user_setChange':
            $touxiang = str_replace('..','',daddslashes($_POST['touxiang']));
            $name = daddslashes($_POST['name']);
            $shengri = daddslashes($_POST['shengri']);
            $sex = daddslashes($_POST['sex']);
            $weixin = daddslashes($_POST['weixin']);
            $jieshao = daddslashes($_POST['jieshao']);
            $birthday = daddslashes($_POST['birthday']);
            $city = daddslashes($_POST['city']);
            $userName = daddslashes($userInfo['user']);
            $pwd = daddslashes($_POST['pwd']);
            
            if(!$pwd){
                $pwd = $userInfo['pwd'];
            }
            
            if(!$birthday || !in_array($sex,[0,1]) || !$weixin){
                exit(json_encode(['code' => 0, 'msg' => '生日,性别,微信为必填项哦！']));
            }else{
                $riqi = explode('-',$birthday);
                $time = date("Y-m-d H:i:s",time());
                $res = $DB->query("UPDATE `pre_user` SET `touxiang`='{$touxiang}',`name`='{$name}',`birthday`='{$birthday}',`sex`='{$sex}',`weixin`='{$weixin}',`jieshao`='{$jieshao}',`city`='{$city}',`pwd`='{$pwd}' WHERE `user`='{$userName}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'user_upsite':
            $userName = daddslashes($userInfo['user']);
            $money = $daili_money;
            
            if($siteInfo['type']=='2'){
                exit(json_encode(['code' => 1, 'msg' => '您已经是最高级别']));
            }else{
                if($userInfo['rmb']>=$money){
                    $res = $DB->query("UPDATE `pre_user` SET `rmb`=`rmb`-'{$money}' WHERE `user`='{$userName}'");
                    if($res){
                        $DB->query("UPDATE `pre_site` SET `type`='2' WHERE `user`='{$userName}'");
                        exit(json_encode(['code' => 1, 'msg' => '开通成功']));
                    }else{
                        exit(json_encode(['code' => 0, 'msg' => '开通失败，请重试']));
                    }
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '账户余额不足']));
                }
            }
        break;
        default:
            exit(json_encode(['code' => 0, 'msg' => '您未登录']));
        break;
    }
?>