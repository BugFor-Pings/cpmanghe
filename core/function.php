<?php
//小高教学网www.12580sky.com
    //高网地址发布页：www.xgjxw6.com   关注微信公众号：小高教学网
	function config($k){
		global $DB;
		$res = $DB->getRow("SELECT * FROM `pre_config` WHERE `k`='".$k."'");
		return $res['v'];
	}
    
    function set_config($k,$v){
    	global $DB;
    	$DB->query("UPDATE `pre_config` SET `v` = '$v' WHERE `k` = '$k'");
    }
    
    function active($pageArr,$mod=false){
      $page = explode(",", $pageArr);
      $name = substr($_SERVER["REQUEST_URI"], strrpos($_SERVER["REQUEST_URI"], "/") + 1, strrpos($_SERVER["REQUEST_URI"], ".") - strrpos($_SERVER["REQUEST_URI"], "/") - 1);
      if($mod && in_array($name,$page)){
        return "active open";
      }
      if(in_array($name,$page)) {
        return "active";
      }
    }

    function rmb($mod,$money,$user,$content,$orderid=false){
        global $DB;
        global $userInfo;
        
        $time = date("Y-m-d H:i:s",time());
        if($mod=='-'){
            $type = '减少';
        }elseif($mod=='+'){
            $type = '增加';
        }
        if($userInfo['rmb']<=0){
            return false;
        }
        $res = $DB->query("UPDATE `pre_user` SET `rmb`=`rmb`{$mod}{$money} WHERE `user`='{$user}'");
        if($res){
            $DB->query("INSERT INTO `pre_point` (`money`,`type`,`content`,`addtime`,`user`,`orderid`) VALUES('{$money}','{$type}','{$content}','{$time}','{$user}','{$orderid}')");
            return true;
            // $DB->lastInsertId();
        }else{
            return false;
        }
    }

    function ticheng($orderid,$chouqu=false){
        global $DB;
        global $userInfo;
        global $siteInfo;
        global $the_url;
        
        $pay_info = $DB->getRow("SELECT * FROM `pre_pay` WHERE `orderno`='{$orderid}'");
        if($pay_info['bz']=='投递盲盒'){
            $bz = '投递盲盒';
            $manghe_info = $DB->getRow("SELECT * FROM `pre_manghe` WHERE `orderid`='{$orderid}'");
            if($manghe_info['ok']=='0'){
                $tiaojian =  true;
            }
        }elseif($pay_info['bz']=='抽取盲盒'){
            $bz = '抽取盲盒';
            $manghe_info = $DB->getRow("SELECT * FROM `pre_point` WHERE `orderid`='{$orderid}-no'");
            if($manghe_info){
                $tiaojian = true;
            }
        }
        if($pay_info['status']=='1'){
            $one_lirun = '0.'.config('daili_lirun');
            $tow_lirun = '0.'.config('daili_lirun2');
            $one = (($pay_info['money']*$one_lirun) * 100) / 100;
            $two = (($pay_info['money']*$tow_lirun) * 100) / 100;
            $one_money = round($one,2);
            $two_money = round($two,2);
            
            if($one<0.01){
                $one_money = '0.00';
            }
            if($two<0.01){
                $tow_money = '0.00';
            }

            if($userInfo['upsite']!='0' && $tiaojian){
                $is_siteInfo = $DB->getRow("SELECT * FROM `pre_site` WHERE `id`='{$userInfo['upsite']}'");
                if(!$is_siteInfo){
                    $is_siteInfo = $DB->getRow("SELECT * FROM `pre_site` WHERE `url`='{$the_url}'");
                }
                if($is_siteInfo['type']=='1'){
                    $is_userInfo_upid = $DB->getRow("SELECT * FROM `pre_user` WHERE `user`='{$is_siteInfo['user']}'"); //该站点上级id
                    if($is_userInfo_upid['upsite']){ //有上级
                        $is_userInfo_up = $DB->getRow("SELECT * FROM `pre_site` WHERE `id`='{$is_userInfo_upid['upsite']}'");//获取顶级站点用户
                        if($is_userInfo_up['type']=='2'){ //上级是顶级
                            rmb('+',$two_money,$is_siteInfo['user'],'用户'.$bz.'获取提成',$orderid);
                            rmb('+',$one_money,$is_userInfo_up['user'],'下级分站用户'.$bz.'获取提成',$orderid);
                        }else{
                            rmb('+',$two_money,$is_siteInfo['user'],'用户'.$bz.'获取提成',$orderid);
                        }
                    }
                }elseif($is_siteInfo['type']=='2'){
                    rmb('+',$one_money,$is_siteInfo['user'],''.$bz.'获取提成',$orderid);
                }
                if($pay_info['bz']=='投递盲盒'){
                    $res = $DB->query("UPDATE `pre_manghe` SET `ok`='1' WHERE `orderid`='{$orderid}'");
                    exit('<script>layer.alert(1,{title:"盲盒信息",btn:false,title:"",closeBtn:"",content:\'<center><img src="./public/index/img/user-003.png"><br><br>恭喜您，'.$bz.'成功<br><a href="./?mod=manghe" style="display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display:block;width:100%;">立即查看</a>\'});</script>');
                }elseif($pay_info['bz']=='抽取盲盒'){
                    $res = $DB->query("UPDATE `pre_point` SET `orderid`='{$orderid}' WHERE `orderid`='{$orderid}-no'");
                    exit('<script>manghe_btn(\''.$chouqu.'\',\''.$orderid.'\')</script>');
                    exit();
                }
            }elseif($userInfo['upsite']=='0' && $tiaojian){
                if($pay_info['bz']=='投递盲盒'){
                    $res = $DB->query("UPDATE `pre_manghe` SET `ok`='1' WHERE `orderid`='{$orderid}'");
                    exit('<script>layer.alert(1,{title:"盲盒信息",btn:false,title:"",closeBtn:"",content:\'<center><img src="./public/index/img/user-003.png"><br><br>恭喜您，'.$bz.'成功<br><a href="./?mod=manghe" style="display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display:block;width:100%;">立即查看</a>\'});</script>');
                }elseif($pay_info['bz']=='抽取盲盒'){
                    $res = $DB->query("UPDATE `pre_point` SET `orderid`='{$orderid}' WHERE `orderid`='{$orderid}-no'");
                    exit('<script>manghe_btn(\''.$chouqu.'\',\''.$orderid.'\')</script>');
                    exit();
                }
            }
        }
    }

    function chouqu($mod){
        global $DB;
        $from_user = daddslashes($_COOKIE['userName']);
        $time = date("Y-m-d H:i:s",time());
        $ip = x_real_ip();
        
        $mh_info = $DB->getRow("SELECT * FROM `pre_manghe` WHERE `for_user` IS NULL AND `from_user`!='{$from_user}' AND `sex`='{$mod}' AND `ok`='1' ORDER BY RAND() LIMIT 0,1"); 
        if($mh_info){
            $res = $DB->query("UPDATE `pre_manghe` SET `for_user`='{$from_user}',`endtime`='{$time}',`ip`='{$ip}' WHERE `id`='{$mh_info['id']}'");    
        }else{
            exit(json_encode(['code' => 0, 'msg' => '该盲盒内暂无数据，请稍后再试，呜呜呜']));
        }
         
        if($res){
            exit(json_encode(['code' => 1, 'msg' => '抽取成功']));
        }else{
            exit(json_encode(['code' => 0, 'msg' => '抽取出错请重试，呜呜呜...']));
        }
    }

	function siteHttp(){
      $res = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
      return $res.$_SERVER['HTTP_HOST'];
    }
    
	function daddslashes($string, $force = 0, $strip = FALSE) {
        !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
        if(!MAGIC_QUOTES_GPC || $force) {
            if(is_array($string)) {
                foreach($string as $key => $val) {
                    $string[$key] = daddslashes($val, $force, $strip);
                }
            } else {
                $string = addslashes($strip ? stripslashes($string) : $string);
            }
        }
        return $string;
    }
    
    function point($money,$type,$content,$user){
        global $DB;
        
        $time = date("Y-m-d H:i:s",time());
		$res = $DB->query("INSERT INTO `pre_point` (`money`,`type`,`content`,`addtime`,`site`) VALUES('{$money}','{$type}','{$content}','{$time}','{$user}')");
		if($res){
		    return true;
		}else{
		    return false;
		}
    }
    
    function x_real_ip(){
		$ip = $_SERVER['REMOTE_ADDR'];
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
			foreach ($matches[0] as $xip) {
				if (!preg_match('#^(10|172\\.16|192\\.168)\\.#', $xip)) {
					$ip = $xip;
					break;
				}
			}
		} else {
			if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
					$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
				} else {
					if (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
						$ip = $_SERVER['HTTP_X_REAL_IP'];
					}
				}
			}
		}
		return $ip;
	}
    
    function get_weeks($time = '', $format='m-d'){
    	$time = $time != '' ? $time : time();
    	//组合数据
    	$date = [];
    	for ($i=1; $i<=7; $i++){
    	$date[$i] = date($format ,strtotime( '+' . $i-7 .' days', $time));
    	}
    	return $date;
    }
    
    function pageSelf(){
        $php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
        return $php_self;
    }

    function birthday($birthday){ 
         $age = strtotime($birthday); 
         if($age === false){ 
          return false; 
         } 
         list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
         $now = strtotime("now"); 
         list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
         $age = $y2 - $y1; 
         if((int)($m2.$d2) < (int)($m1.$d1)) 
          $age -= 1; 
         return $age; 
    } 
    
    function xingzuo($month, $day) {
         // 检查参数有效性
         if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;
        
         // 星座名称以及开始日期
         $constellations = array(
          array( "20" => "水瓶座"),
          array( "19" => "双鱼座"),
          array( "21" => "白羊座"),
          array( "20" => "金牛座"),
          array( "21" => "双子座"),
          array( "22" => "巨蟹座"),
          array( "23" => "狮子座"),
          array( "23" => "处女座"),
          array( "23" => "天秤座"),
          array( "24" => "天蝎座"),
          array( "22" => "射手座"),
          array( "22" => "摩羯座")
         );
        
         list($constellation_start, $constellation_name) = each($constellations[(int)$month-1]);
        
         if ($day < $constellation_start) list($constellation_start, $constellation_name) = each($constellations[($month -2 < 0) ? $month = 11: $month -= 2]);
        
         return $constellation_name;
    }

?>