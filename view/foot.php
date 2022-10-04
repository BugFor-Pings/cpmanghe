<?php
	function check($name,$mod){
	    if(!$mod){
	        $mod = 'index';
	    }
		if($mod==$name){
			return 'aui-tabBar-item-active';
		}
	}
?>
<footer class="aui-footer aui-footer-fixed">
     <a href="/" style="text-decoration: none" class="aui-tabBar-item <?php echo check('index',$mod);?>">
        <span class="aui-tabBar-item-icon">
            <i class="fa fa-gift fa-tanget"></i>
        </span>
        <span class="aui-tabBar-item-text">盲盒</span>
    </a>
     <a href="?mod=user" style="text-decoration: none" class="aui-tabBar-item <?php echo check('user',$mod);?>">
        <span class="aui-tabBar-item-icon">
            <i class="fa fa-diamond"></i>
        </span>
        <span class="aui-tabBar-item-text">我的</span>
    </a>
</footer>

<script type="text/javascript" src="./public/index/js/main.js?a=11"></script>