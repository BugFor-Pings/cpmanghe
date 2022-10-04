<?php
include 'head.php';
?>
<style>
.main {
	padding:20px;
}
.main-tabs {
	width:300px;
	background:#fafafa;
	border:1px solid #ccc;
	overflow:hidden;
}
.tabs {
	height:45px;
	line-height:45px;
	overflow:hidden;
}
.tabs-li {
	width:50%;
	float:left;
	background:#eee;
	color:#444;
	text-align:center;
	cursor:pointer;
}
.tabs-li.active {
	background:red;
	color:#fff;
}
.content {
	padding:10px;
}
.tabs-content {
	display:none;
}
.tabs-content.on {
	display:block;
}

</style>
        <section class="aui-flexView">
            <header class="aui-navBar aui-navBar-fixed">
                <a href="?mod=jifen" class="aui-navBar-item">
                    <!--<div class="aui-jf2">积分<?php echo $users['jifen']?></div>-->
                </a>
                <div class="aui-center">
                    <span class="aui-center-title">盲盒记录</span>
                </div>
                <a onclick="tuiguang()" class="aui-navBar-item">
                </a>
            </header>
            <section class="aui-scrollView">
                <center>
                <div class="main">
                    <div class="main-tabs">
                        <div class="tabs">
                            <div class="tabs-li active">我抽取的</div>
                            <div class="tabs-li">我投递的</div>
                        </div>
                
                    </div>
                </div>
                </center>
                <div class="content">
                 <div class="tabs-content on">
                    <div class="aui-mine-list">
                    	<?php
                    	    $sex = array('女','男');
                    	    $mh_info = $DB->query("SELECT * FROM `pre_manghe` WHERE `for_user`='{$userInfo['user']}' AND `ok`='1' ORDER BY `endtime` DESC");
                    	   
                    	    
                    	    if(!$mh_info->rowCount()){
                                echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><center style="max-width:380px;"><h1><font color="#c5c5c5">盲盒空空如也...</font></h1><center>';
                            }
                            
                    	    
                    	    while($row = $mh_info->fetch()){
                    	        if(!$row['name']){
                    	            $row['name'] = '不愿透露姓名的友人';   
                    	        }
                    	        if(!$row['touxiang']){
                    	            $row['touxiang'] = './public/index/img/touxiang/moren.png';
                    	        }
                    	        echo '<a href="javascript:;" class="aui-flex b-line">
                                <div class="aui-mine-img">
                                    <img onclick="getimg(\''.$row['touxiang'].'\')" src="'.$row['touxiang'].'" alt="">
                                </div>
                                <div class="aui-flex-box">
                                    <h3>'.$row['name'].'</h3>
                                    <p>年龄：'.birthday($row['birthday']).'岁，性别：'.$sex[$row['sex']].'</p>
                                    <span>抽取时间：'.$row['endtime'].'</span>
                                </div>
        						<div class="aui-button-get2" onclick="xiangxi(\'toudi\','.$row['id'].')"><button>详情</button></div>
                            </a>';
                    	    }
                    	?>
                     </div>
                    </div>
                    <div class="tabs-content">
                        <div class="aui-mine-list">
                        	<?php
                    	    $sex = array('女','男');
                    	    $mh_info = $DB->query("SELECT * FROM `pre_manghe` WHERE `from_user`='{$_COOKIE['userName']}' AND `ok`=1 ORDER BY `id` DESC");
                            
                            if(!$mh_info->rowCount()){
                                echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><center style="max-width:380px;"><h1><font color="#c5c5c5">盲盒空空如也...</font></h1><center>';
                            }
                            
                    	    while($row = $mh_info->fetch()){
                    	        if(!$row['name']){
                    	            $row['name'] = '不愿透露姓名的友人';   
                    	        }
                    	        if(!$row['touxiang']){
                    	            $row['touxiang'] = './public/index/img/touxiang/moren.png';
                    	        }
                    	        echo '<a href="javascript:;" class="aui-flex b-line">
                                <div class="aui-mine-img">
                                    <img onclick="getimg(\''.$row['touxiang'].'\')" src="'.$row['touxiang'].'" alt="">
                                </div>
                                <div class="aui-flex-box">
                                    <h3>'.$row['name'].'</h3>
                                    <p>年龄：'.birthday($row['birthday']).'岁，性别：'.$sex[$row['sex']].'</p>
                                    <span>投递时间：'.$row['addtime'].'</span>
                                </div>
        						<div class="aui-button-get2" onclick="xiangxi(\'toudi\','.$row['id'].')"><button>详情</button></div>
                            </a>';
                    	    }
                    	?>
                         </div>
                    </div>
                </div>
            </div>
        </section>
       <br><br>
<?php include 'foot.php';?>
</section>
<script>
    function xiangxi(mod,id){
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./view/ajax.php?act=manghe_info",
    		data: {id},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
    			    if(data.sex==0){
    			        data.sex = '女';
    			    }else{
    			        data.sex = '男';
    			    }
    			    if(!data.jieshao){
    			        data.jieshao = '不愿透露介绍的的友人';
    			    }
    			    if(!data.name){
    			        data.name = '不愿透露姓名的的友人';
    			    }
                    layer.alert(1,{
                        title:'盲盒信息',
                        skin: 'layui-layer-molv',
                        content:'姓名：'+data.name+'<br>性别：'+data.sex+'<br>生日：'+data.birthday+'<br>年龄：'+data.age+'<br>星座：'+data.xingzuo+'<br>地址：'+data.city+'<br>微信：'+data.weixin+'<br><br><textarea style="min-height:100px;height:auto;line-height:20px;padding:6px 10px;resize:vertical;display:block;width:100%;" disabled>'+data.jieshao+'</textarea>'
                    });
    			}else{
    			    layer.msg(data.msg);
    			}
    		},
    		error:function(data){
    		    layer.close(load);
    			layer.msg('服务器错误');
    			return false;
    		}
    	})
    }
    
   $(function() {
    var num = 0
    $(".tabs-li").click(function() {
        $(this).addClass("active").siblings('.tabs-li').removeClass('active')
        num = $(this).index()
        for (var i = 0; i < $('.tabs-content').length; i++) {
            if (i == num) {
                $('.tabs-content').eq([num]).addClass('on').siblings().removeClass('on')
            }
        }
    })
})
</script>
    </body>
</html>