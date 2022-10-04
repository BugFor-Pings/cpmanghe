<?php
include 'head.php';

if($userInfo['dltime']>=$thtime){
   $title = '月老操作';
   $content = '<a target="_blank" style="color:#fff" href="./user/index.php">进入后台</a>';
   echo '<script>window.location.href="./user/index.php"</script>';
}else{
   $title = '加入月老';
   $content = $daili_money.' 元';
}
?>

<section class="jq22-flexView">
	<header class="jq22-navBar jq22-navBar-fixed">
		<a href="./?mod=user" class="jq22-navBar-item">
			<i class="icon icon-return"></i>
		</a>
		<div class="jq22-center">
			<span class="jq22-center-title">加入月老</span>
		</div>
		<a href="javascript:;" class="jq22-navBar-item">
			<i class="icon icon-sys"></i>
		</a>
	</header>
	<section class="jq22-scrollView">
		<div class="jq22-invitation-head">
			<img src="./public/index/img/jiameng/head.png" class="jq22-invitation-ad" alt="">
		<!--	<div class="jq22-flex jq22-flex-color">-->
		<!--		<div class="jq22-flex-box">-->
		<!--			<div class="box">-->
		<!--				<div class="t_news">-->
		<!--					<ul class="news_li">-->
		<!--						<li>-->
		<!--							<a href="javascript:return false;"><img src="http://q4.qlogo.cn/headimg_dl?dst_uin=1900432277&spec=100" alt="">恭喜王总成功加入月老，开启新的前程~~</a>-->
		<!--						</li>-->
		<!--					</ul>-->
		<!--					<ul class="swap"></ul>-->
		<!--				</div>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--	</div>-->

		</div>
		<div class="jq22-invitation-content">
			<div class="jq22-invitation-item">
				<div class="jq22-invitation-title">
					<h2><?php echo $title;?></h2>
				</div>
				<div class="jq22-coupon-body">
					<h2><?php echo $content;?></h2>
				</div>
				<div class="jq22-coupon-text">
					<p>加入月老享推广福利</p>
					<span>每笔返现<?php echo config('daili_lirun');?>%</span>
				</div>
			</div>
			<div class="jq22-invitation-item">
				<div class="jq22-invitation-title">
					<h2>月老介绍</h2>
				</div>
				<div class="jq22-coupon-text jq22-coupon-text-top">
				
				</div>
				<div class="jq22-invitation-table">
					<table id="jqueryTable">
						<tr>
							<th>月老技能</th>
						</tr>
						<tr>
							<td>可获取推广佣金</td>
						</tr>
						<tr>
							<td>专属网站域名</td>
						</tr>
						<tr>
							<td>三种在线支付接口</td>
						</tr>
						<tr>
							<td>拥有属于自己的盲盒系统</td>
						</tr>
						<tr>
							<td>拥有属于自己的月老后台</td>
						</tr>
						<tr>
							<td>可自定义盲盒站点名称</td>
						</tr>
						<tr>
							<td>赠送专属盲盒系统APP</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

	</section>
	<footer class="jq22-footer jq22-footer-fixed" data-ydui-actionsheet="{target:'#actionSheet',closeElement:'#cancel'}">
		<?php
		    if($userInfo['dltime']>=$thtime){
		        echo '	<a class="jq22-tabBar-item">
			<span class="jq22-tabBar-item-text">您已是月老</span>
		</a>';
		    }else{
		        echo '	<a onclick="daili()" class="jq22-tabBar-item">
			<span class="jq22-tabBar-item-text">加入月老</span>
		</a>';
		    }
		?>
	</footer>
</section>
<?php
include 'foot.php';
?>
<script>
		function b() {
			t = parseInt(x.css('top'));
			y.css('top', '25px');
			x.animate({
				top: t - 25 + 'px'
			}, 'slow');
			if (Math.abs(t) == h - 25) {
				y.animate({
					top: '0px'
				}, 'slow');
				z = x;
				x = y;
				y = z;
			}
			setTimeout(b, 3000);
		}
		$(document).ready(function() {
			$('.swap').html($('.news_li').html());
			x = $('.news_li');
			y = $('.swap');
			h = $('.news_li li').length * 25;
			setTimeout(b, 1000);
		})
	</script>
</script>