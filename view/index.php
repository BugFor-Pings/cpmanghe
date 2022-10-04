<?php
    include 'head.php';
    if(daddslashes($_GET['orderid'])){
        $orderid = daddslashes($_GET['orderid']);
        $chouqu = daddslashes($_GET['chouqu']);
        echo '<script type="text/javascript" src="./public/index/js/main.js?var='.config('var').'"></script>';
        ticheng($orderid,$chouqu);
    }
    
    $manghe_nan = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `sex`=1 AND `for_user` IS NULL AND `ok`='1' AND `from_user`!='{$userInfo['user']}'");
    $manghe_nv = $DB->getColumn("SELECT count(*) FROM `pre_manghe` WHERE `sex`=0 AND `for_user` IS NULL AND `ok`='1' AND `from_user`!='{$userInfo['user']}'");

?>
<style>
.auto-layer{
	width:300px;
}
</style>
<section class="aui-flexView">
            <section class="aui-scrollView">
                <div class="m-slider" data-ydui-slider="">
                    <div class="slider-wrapper" style="transform: translate3d(-4374px, 0px, 0px); transition-duration: 300ms;">
                        <div class="slider-item" style="width: 1458px;">
                            <a href="<?php echo config('img1_url');?>">
                                <img src="<?php echo config('img1');?>">
                            </a>
                        </div>
                        <div class="slider-item" style="width: 1458px;">
                            <a href="<?php echo config('img2_url');?>">
                                <img src="<?php echo config('img2');?>">
                            </a>
                        </div>
                        <div class="slider-item" style="width: 1458px;">
                            <a href="<?php echo config('img3_url');?>">
                                <img src="<?php echo config('img3');?>">
                            </a>
                        </div></div>
                    <div class="slider-pagination"></div>
                </div>
                <div class="aui-flex aui-flex-white">
                    <div class="aui-sml-logo">
                        <img src="<?php echo $HTTP_HOST;?>/public/index/img/tj.jpg" alt="">
                    </div>
                    <div class="aui-flex-box">
                        <h2>数据统计</h2>
                        <p>现有女生盲盒<?php echo $manghe_nv;?>个，男生盲盒<?php echo $manghe_nan;?>个~</p>
                    </div>
                </div>
                <div class="aui-list-theme">
                    <a onclick="manghe('nan','<?php echo $order_id?>')" class="aui-list-theme-item">
                        <div class="aui-list-title">
                            <h3>男生盲盒</h3>
                            <div class="aui-flex">
                                <div class="aui-flex-box">
                                    <span>抽取一个男生盲盒~</span>
                                </div>
                                <div class="aui-flex-icon-sm">
                                    <img src="<?php echo $HTTP_HOST;?>/public/index/img/icon-001.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a onclick="manghe('nv','<?php echo $order_id?>')" style="text-decoration: none" class="aui-list-theme-item aui-list-color">
                        <div class="aui-list-title">
                            <h3>女生盲盒</h3>
                            <div class="aui-flex">
                                <div class="aui-flex-box">
                                    <span>抽取一个女生盲盒~</span>
                                </div>
                                <div class="aui-flex-icon-sm">
                                    <img src="<?php echo $HTTP_HOST;?>/public/index/img/icon-003.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="?mod=toudi" class="aui-list-theme-item aui-list-color1">
                        <div class="aui-list-title">
                            <h3>投递盲盒</h3>
                            <div class="aui-flex">
                                <div class="aui-flex-box">
                                    <span>期待您加入其中~</span>
                                </div>
                                <div class="aui-flex-icon-sm">
                                    <img src="/public/index/img/icon-004.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                     <a href="?mod=manghe" class="aui-list-theme-item">
                        <div class="aui-list-title">
                            <h3>盲盒记录</h3>
                            <div class="aui-flex">
                                <div class="aui-flex-box">
                                    <span>查看属于你的盲盒~</span>
                                </div>
                                <div class="aui-flex-icon-sm">
                                    <img src="/public/index/img/icon-003.png" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="aui-flex">
                    <div class="aui-flex-box">
                        <img src="/public/index/img/icon-title.png" alt="">
                    </div>
                    <div class="aui-arrow">
                        <a href="?mod=tool" style="color:red;"><p>更多推荐</p></a>
                    </div>
                </div>
               
                <?php
                    if(config('first_toudi')){
                        echo '<div class="aui-local-box">
                    <div class="aui-flex">
                        <div class="aui-flex-box">
                            <div class="aui-jiu-logo">
                                <img src="/public/index/img/zan.png" alt="">
                            </div>
                            <div class="aui-head-info">免费投放一次盲盒</div>
                        </div>
                        <div class="aui-head-button">
                            <a href="?mod=toudi">
	                        <div class="aui-head-button">
	                            <button>立即体验</button>
	                        </div>
                        </a>
                        </div>
                    </div>
                </div>';
                    }
                ?>
             <div class="aui-local-box">
                    <div class="aui-flex">
                        <div class="aui-flex-box">
                            <div class="aui-jiu-logo">
                                <img src="/public/index/img/kf.png" alt="">
                            </div>
                            <div class="aui-head-info">联系QQ客服</div>
                        </div>
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $kfqq;?>&site=qq&menu=yes">
	                        <div class="aui-head-button">
	                            <button>QQ客服</button>
	                        </div>
                        </a>
                    </div>
                </div>
                <div class="aui-local-box">
                    <div class="aui-flex">
                        <div class="aui-flex-box">
                            <div class="aui-jiu-logo">
                                <img src="/public/index/img/kf.png" alt="">
                            </div>
                            <div class="aui-head-info">联系微信客服</div>
                        </div>
                        <a onclick="layer.alert('客服微信号: <?php echo $kfwx;?>')">
	                        <div class="aui-head-button">
	                            <button>微信客服</button>
	                        </div>
                        </a>
                    </div>
                </div>
                <br><br><br><br><br><br><br>
            </section>
            <?php include 'foot.php'?>
        </section>
</body>
</html>