<?php
    include 'head.php';
    
    if(daddslashes($_GET['orderid'])){
        $orderid = daddslashes($_GET['orderid']);
        $pay_info = $DB->getRow("SELECT * FROM `pre_pay` WHERE `orderno`='{$orderid}'");
        $point_info = $DB->getRow("SELECT * FROM `pre_point` WHERE `orderid`='{$orderid}'");
        if($pay_info['status']=='1' && !$point_info){
            $res = rmb('+',$pay_info['money'],$userInfo['user'],'充值余额',$orderid);
            if($res){
                exit('<script>layer.alert(1,{title:"盲盒信息",btn:false,title:"",closeBtn:"",content:\'<center><img src="./public/index/img/user-003.png"><br><br>恭喜您充值余额成功，请核实！<br><a href="./?mod=user" style="display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display:block;width:100%;">立即查看</a>\'});</script>');
            }
        }
    }
    
    if($userInfo['sex']==1){
        $userInfo['sex'] = '♂';
        $color = '#2196f3';
    }else{
        $userInfo['sex'] = '♀';
        $color = '#e91e63';
    }
    
    if(!$userInfo['touxiang']){
        $userInfo['touxiang'] = '/public/index/img/touxiang/moren.png';
    }
    
    $time = date("Y-m-d H:i:s");
    if($userInfo['viptime']>$time){
        $type = '<button> 本 站 尊 贵 V I P </button>';
    }elseif($userInfo['dltime']>$time){
        $type = '<button color=""> 本 站 尊 贵 月 老 </button>';
    }else{
        $type = '<big> 普 通 用 户 </big>';
    }
    
    $thtime=date("Y-m-d").' 00:00:00';
    // $chouqu_all = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `for_user`='{$userInfo['user']}'");
    // $chouqu_day = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `for_user`='{$userInfo['user']}' AND `endtime`>='$thtime'");
    
    // $beichou_all = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `from_user`='{$userInfo['user']}'");
    // $beichou_day = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `from_user`='{$userInfo['user']}' AND `endtime`>='$thtime'");
?>
<style>
.test div.layui-layer-btn{
	padding: 0 20px 12px;
}
</style>
<body>
<section class="aui-flexView">
    <section class="aui-scrollView">
	<header class="aui-navBar aui-navBar-fixed">
		<a href="/" class="aui-navBar-item">
			<i class="icon icon-return"></i>
		</a>
		<div class="aui-center">
			<span class="aui-center-title"></span>
		</div>
		<a onclick="logout('成功退出登录！')" class="aui-navBar-item" >
			<i class="icon icon-user"></i>
		</a>
	</header>
	<section class="aui-scrollView">
		<div class="aui-chang-box"></div>
		<div class="aui-chang-list">
			<div class="aui-user-img">
				<img style=" width:100%;height:auto;display:block;border: 0;" src="<?php echo $userInfo['touxiang'];?>" alt="">
			</div>
			<div class="aui-user-text" onclick="user_set()">
				<h1><?php echo $users['name']?></h1>
				<span><?php echo $type; ?></span>
				<br>
				<button style="border:1px solid <?php echo $color;?>;color:<?php echo $color;?>"><?php echo $userInfo['sex'].' '.$userInfo['user']?></button>&nbsp;&nbsp;
				<button style="border:1px solid #673ab7;color:#673ab7"><?php echo '￥ '.$userInfo['rmb']?></button>
			</div>
			<div class="aui-jf"><span class="fa fa-cog fa-0x"></span></div>
		</div>
		<div class="aui-palace aui-palace-one">
			<a onclick="qiandao('<?php echo $userInfo['user']?>')" class="aui-palace-grid">
				<div class="aui-palace-grid-icon">
					<img src="/public/index/img/nav-001.png" alt="">
				</div>
				<div class="aui-palace-grid-text">
					<h2>每日签到</h2>
				</div>
			</a>
			<a href="?mod=manghe" class="aui-palace-grid">
				<div class="aui-palace-grid-icon">
					<img src="/public/index/img/nav-004.png" alt="">
				</div>
				<div class="aui-palace-grid-text">
					<h2>盲盒记录</h2>
				</div>
			</a>
			<a id="chongzhi" class="aui-palace-grid">
				<div class="aui-palace-grid-icon">
					<img src="/public/index/img/nav-002.png" alt="">
				</div>
				<div class="aui-palace-grid-text">
					<h2>充值余额</h2>
				</div>
			</a>
		<!--//	//<?php
		    //if($userInfo['dltime']>=$thtime){
		    //    echo '<a href="?mod=jiameng" class="aui-palace-grid">
			//	<div class="aui-palace-grid-icon">
			//		<img src="/public/index/img/nav-003.png" alt="">
			//	</div>
			//	<div class="aui-palace-grid-text">
			//		<h2>月老业绩</h2>
			//	</div>
		//	</a>';
		    //}else{
		     //   echo '<a href="?mod=jiameng" class="aui-palace-grid">
			//	<div class="aui-palace-grid-icon">
			//		<img src="/public/index/img/nav-003.png" alt="">
			//	</div>
			//	<div class="aui-palace-grid-text">
			//		<h2>加入月老</h2>
			//	</div>
			//</a>';
		   // }
	//	?>-->
		</div>             
		<div class="divHeight"></div>
		<div class="aui-list-item">
			<a class="aui-flex b-line">
				<div class="aui-cou-img">
					<img src="/public/index/img/gonggao.png" alt="">
				</div>小贴士：
				<div class="aui-flex-box" style="max-width:380px;">
					<p><font><?php echo config('user_gonggao')?></font></p>
				</div>
			</a>
			<!--<a href="javascript:;" class="aui-flex b-line">-->
			<!--	<div class="aui-cou-img">-->
			<!--		<img src="/public/index/img/icon-005.png" alt="">-->
			<!--	</div>-->
			<!--	<div class="aui-flex-box">-->
			<!--		<p>今日抽取：<?php echo $chouqu_day;?> 人 | 累计抽取：<?php echo $chouqu_all;?> 人-->
			<!--		</p>-->
			<!--	</div>-->
			<!--</a>-->
			<!--<a href="javascript:;" class="aui-flex b-line">-->
			<!--	<div class="aui-cou-img">-->
			<!--		<img src="/public/index/img/user-003.png" alt="">-->
			<!--	</div>-->
			<!--	<div class="aui-flex-box">-->
			<!--		<p>今日被抽：<?php echo $beichou_day;?> 次 | 累计被抽：<?php echo $beichou_all;?> 次</p>-->
			<!--	</div>-->
			<!--</a>-->
			<br><br>
	</section>
	</section>
	</section>
	<script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
	<script>
		$('#chongzhi').click(function(){
		   layer.prompt({title: '输入充值金额'}, function(value, index){
              layer.close(index);
              if(isNaN(value)) {
                layer.alert('请输入正确的金额');
                return false;
              }else{
                pay_cz('chongzhi','<?php echo $order_id?>',value);
              }
            }); 
		});
	</script>
</body>
</html>
<?php include 'foot.php'?>
</body>
</html>