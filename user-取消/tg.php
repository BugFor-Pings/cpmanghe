<?php
    include './head.php';
    

    $scriptpath = str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
    $scriptpath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
    $scriptpath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
    $url = 'http://'.$siteInfo['url'].$scriptpath.'/';
    $turl = $url;
?>
<div class="container" style="padding-top:70px;">
<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><b>推广赚钱</b></h3></div>
				<div class="panel-body">
                    <p>① 将以下图片保存至本地或者复制文字广告，在QQ好友、QQ群、QQ空间、微信好友、微信朋友圈、贴吧、论坛等地方发表！</p>
                    <p>② 用户扫描下面任一一张二维码或访问任一文字广告内连接均可进入您的网站，下单均可获得提成哦~</p>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="panel panel-default">
			<div class="panel-heading">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#pic" data-toggle="tab"><i class="fa fa-image"></i> 图片广告</a></li>
				<li><a href="#text" data-toggle="tab"><i class="fa fa-file-text"></i> 文字广告</a></li>
			</ul>
			<a href="javascript:void(0);" onclick="TgTips()" class="btn btn-primary btn-sm pull-right" style="top:7px;right:28px;position: absolute!important;">投稿</a>
			</div>
			<div class="panel-body">
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade in active" id="pic">
						<div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <span style="font-weight:bold">专属推广图片①</span>
                                        <a href="javascript:void(0);" class="btn btn-success btn-xs pull-right" onclick="CunTips()">保存图片</a>
                                    </div>
                                    <div class="panel-body">
                                        <img class="img-rounded img-thumbnail" src="./timg/timg.php?id=1&url=<?php echo $turl?>" alt="推广图1">
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
					<div class="tab-pane fade in" id="text">
						<div class="col-12 col-md-6 col-lg-8">
							<div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-weight:bold">专属文字广告①</span>
                                    <a href="javascript:void(0);" id="copy-btn" class="btn btn-success btn-xs pull-right" data-clipboard-target="#wen-a">复制广告</a>
                                </div>
                                <div class="panel-body">
                                    <p id="wen-a">
                                        爱你不“盲”目,“盒”你一辈子，广大网友脱单基地，随机男女盲盒等你来抽：<?php echo $turl?></p>
                                </div>
                            </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
function CunTips() {
	layer.alert('保存方法：<br><b>手机</b>：长按图片即可将图片保存至本地！(需要在浏览器才能保存哦)<br><b>电脑</b>：鼠标指针放在图片上并点击右键»图片另存为，即可保存！', {
		icon: 6,
		title: '小提示',
		skin: 'layui-layer-molv layui-layer-wxd'
	})
}
function TgTips() {
	layer.alert('若您有更好的图文广告模板，文字广告语，均可联系客服进行投稿哦~<br>期待下一个投稿的您~！', {
		icon: 6,
		title: '小提示',
		skin: 'layui-layer-molv layui-layer-wxd'
	})
}
$(document).ready(function(){
	var clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function(e) {
            layer.msg('复制成功！',{time: 1000, icon: 1});
        });
        clipboard.on('error', function(e) {
            layer.msg('复制失败！建议更换其他最新版浏览器！',{time: 2000, icon: 2});
        });
})
</script>
</body>
</html>