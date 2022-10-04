<?php
    include '../core/core.php';
    //小高教学网：www.12580sky.com
    //爱上收集网：www.issjw.com
    if($act=='login'){
        $name = daddslashes($_POST['name'])??null;
        $pwd = daddslashes($_POST['pwd'])??null;

        if($name==config('name') && $pwd==config('pwd')){
          $adminToken = md5($name.$pwd);
          setcookie("adminToken", $adminToken, time() + 604800, '/');
          exit(json_encode(['code' => 1, 'msg' => '登录成功']));
        }else{
          exit(json_encode(['code' => 0, 'msg' => '账号或密码错误']));
        }
    }
    
    if($_COOKIE['adminToken']!=md5(config('name').config('pwd'))){
        exit(json_encode(['code' => 0, 'msg' => '您未登录']));
    }
    
    switch($act){
        case 'uploadimg':
        	if($_POST['do']=='upload'){
        		$type = $_POST['type'];
        		$filename = $type.'_'.md5_file($_FILES['file']['tmp_name']).'.png';
        		$fileurl = '../public/index/img/lunbo/'.$filename;
        		if(copy($_FILES['file']['tmp_name'],'../public/index/img/lunbo/'.$filename)){
        			exit('{"code":0,"msg":"succ","url":"'.$fileurl.'"}');
        		}else{
        			exit('{"code":-1,"msg":"上传失败，请确保有本地写入限"}');
        		}
        	}
        break;
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
        case 'manghe_info':
            $id = daddslashes($_POST['id']);
        	$mh_info = $DB->getRow("SELECT * FROM `pre_manghe` WHERE `id`='{$id}'");
        	if($mh_info){
        	    exit(json_encode(['code' => 1, 'data' => $mh_info]));
        	}else{
        	    exit(json_encode(['code' => 0, 'msg' => '获取错误，请重试！']));
        	}
        break;
        case 'manghe_change':
            $id = daddslashes($_POST['id']);
            $touxiang = str_replace('..','',daddslashes($_POST['touxiang']));
            $name = daddslashes($_POST['name']);
            $shengri = daddslashes($_POST['shengri']);
            $sex = daddslashes($_POST['sex']);
            $weixin = daddslashes($_POST['weixin']);
            $jieshao = daddslashes($_POST['jieshao']);
            $birthday = daddslashes($_POST['birthday']);
            $city = daddslashes($_POST['city']);
            
            if(!$name || !$birthday || !in_array($sex,[0,1]) || !$weixin || !$id){
                exit(json_encode(['code' => 0, 'msg' => '姓名,生日,性别,微信为必填项哦！']));
            }else{
                $riqi = explode('-',$birthday);
                $time = date("Y-m-d H:i:s",time());
                $res = $DB->query("UPDATE `pre_manghe` SET `name`='{$name}',`birthday`='{$birthday}',`sex`='{$sex}',`weixin`='{$weixin}',`jieshao`='{$jieshao}',`city`='{$city}',`touxiang`='{$touxiang}' WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'manghe_status':
            $id = daddslashes($_POST['id']);
            $status = daddslashes($_POST['stauts']);

            if(!$id){
                exit(json_encode(['code' => 0, 'msg' => '参数不完整！']));
            }else{
                $res = $DB->query("UPDATE `pre_manghe` SET `status`='{$status}' WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'manghe_del':
            $id = daddslashes($_POST['id']);

            if(!$id){
                exit(json_encode(['code' => 0, 'msg' => '参数不完整！']));
            }else{
                $res = $DB->query("DELETE FROM `mh_manghe` WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '删除成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '删除失败']));
                }
            }
        break;
        case 'config':
            if($_POST){
              if(!$_POST['pwd']){
                  $_POST['pwd'] = config('pwd');
              }
              foreach($_POST as $k=>$v){
                $DB->query("UPDATE `pre_config` SET `v`='".daddslashes($v)."' WHERE `k`='".$k."'");
              }
                exit(json_encode(['code' => 1, 'msg' => '修改成功']));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '参数不完整']));
            }
        break;
        case 'user_status':
            $id = daddslashes($_POST['id']);
            $status = daddslashes($_POST['stauts']);

            if(!$id){
                exit(json_encode(['code' => 0, 'msg' => '参数不完整！']));
            }else{
                $res = $DB->query("UPDATE `pre_user` SET `status`='{$status}' WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'user_info':
            $id = daddslashes($_POST['id']);
        	$mh_info = $DB->getRow("SELECT * FROM `pre_user` WHERE `id`='{$id}'");
        	if($mh_info){
        	    exit(json_encode(['code' => 1, 'data' => $mh_info]));
        	}else{
        	    exit(json_encode(['code' => 0, 'msg' => '获取错误，请重试！']));
        	}
        break;
        case 'user_change':
            $id = daddslashes($_POST['id']);
            $touxiang = str_replace('..','',daddslashes($_POST['touxiang']));
            $rmb = daddslashes($_POST['rmb']);
            $shengri = daddslashes($_POST['shengri']);
            $sex = daddslashes($_POST['sex']);
            $weixin = daddslashes($_POST['weixin']);
            $jieshao = daddslashes($_POST['jieshao']);
            $birthday = daddslashes($_POST['birthday']);
            $city = daddslashes($_POST['city']);
            $pwd = daddslashes($_POST['pwd']);
            
            if(!$birthday || !in_array($sex,[0,1]) || !$weixin || !$id){
                exit(json_encode(['code' => 0, 'msg' => '姓名,生日,性别,微信为必填项哦！']));
            }else{
                $riqi = explode('-',$birthday);
                $time = date("Y-m-d H:i:s",time());
                $res = $DB->query("UPDATE `pre_user` SET `rmb`='{$rmb}',`birthday`='{$birthday}',`sex`='{$sex}',`weixin`='{$weixin}',`jieshao`='{$jieshao}',`city`='{$city}',`touxiang`='{$touxiang}',`pwd`='{$pwd}' WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'user_del':
            $user = daddslashes($_POST['user']);

            if(!$user){
                exit(json_encode(['code' => 0, 'msg' => '参数不完整！']));
            }else{
                $res = $DB->query("DELETE FROM `pre_user` WHERE `user`='{$user}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '删除成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '删除失败']));
                }
            }
        break;
        case 'site_status':
            $id = daddslashes($_POST['id']);
            $status = daddslashes($_POST['stauts']);

            if(!$id){
                exit(json_encode(['code' => 0, 'msg' => '参数不完整！']));
            }else{
                $res = $DB->query("UPDATE `pre_site` SET `status`='{$status}' WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'site_type':
            $id = daddslashes($_POST['id']);
            $status = daddslashes($_POST['stauts']);

            if(!$id){
                exit(json_encode(['code' => 0, 'msg' => '参数不完整！']));
            }else{
                $res = $DB->query("UPDATE `pre_site` SET `type`='{$status}' WHERE id='{$id}'");
                if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
                }else{
                    exit(json_encode(['code' => 0, 'msg' => '修改失败']));
                }
            }
        break;
        case 'site_info':
            $id = daddslashes($_POST['id']);
        	$mh_info = $DB->getRow("SELECT * FROM `pre_site` WHERE `id`='{$id}'");
        	if($mh_info){
        	    exit(json_encode(['code' => 1, 'data' => $mh_info]));
        	}else{
        	    exit(json_encode(['code' => 0, 'msg' => '获取错误，请重试！']));
        	}
        break;
        case 'site_change':
            $id = daddslashes($_POST['id']);
            $sitename = daddslashes($_POST['sitename']);
            $title = daddslashes($_POST['title']);
            $description = daddslashes($_POST['description']);
            $keywords  = daddslashes($_POST['keywords']);
            $url = daddslashes($_POST['url']);
            $kfwx = daddslashes($_POST['kfwx']);
            $kfqq = daddslashes($_POST['kfqq']);
            $toudi  = daddslashes($_POST['toudi']);
            $chouqu = daddslashes($_POST['chouqu']);
            $daili = daddslashes($_POST['daili']);
            
            $res = $DB->query("UPDATE `pre_site` SET `sitename`='{$sitename}',`title`='{$title}',`description`='{$description}',`keywords`='{$keywords}',`url`='{$url}',`kfwx`='{$kfwx}',`kfqq`='{$kfqq}',`toudi`='{$toudi}',`chouqu`='{$chouqu}',`daili`='{$daili}' WHERE id='{$id}'");
            if($res){
                    exit(json_encode(['code' => 1, 'msg' => '修改成功']));
            }else{
                exit(json_encode(['code' => 0, 'msg' => '修改失败']));
            }
        break;
    }
?>