<?php
    include './head.php';
?>
<div class="container" style="padding-top:70px;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">站点配置</h3>
	</div>
	<br>
	<div class="col-xs-12 col-sm-10 col-md-8 col-lg-12 center-block" style="float: none;">
        <div class="input-group">
            <span class="input-group-addon">站点名称</span>
            <input type="text" value="<?php echo $siteInfo['sitename']?>" id="sitename" class="form-control" placeholder="请输入站点名称">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">站点介绍</span>
            <input type="text" value="<?php echo $siteInfo['description']?>"  id="description" class="form-control" placeholder="请输入站点介绍">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">关键词</span>
            <input type="text" value="<?php echo $siteInfo['keywords']?>"  id="keywords" class="form-control" placeholder="请输入站点关键词">
        </div><br>
        <div class="input-group">
            <div class="input-group-addon">
                二级域名
            </div>
			<div class="input-group" style="width: 100%;">
            <input type="text" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" id="qz" name="qz" class="form-control" required="" data-parsley-length="[2,8]" placeholder="不修改请留空">
			<span class="input-group-btn">
                <button class="btn btn-default" onclick="$('[name=\'qz\']').val(Math.random().toString(36).substr(6))" type="button">随机</button>
            </span>							</div>
            <select id="user_url" class="form-control">
                <?php
                    $user_url = explode(',',config('user_url'));
                    foreach($user_url as $v){
                        echo '<option value="'.$v.'">'.$v.'</option>';
                    }
                ?>
            </select>
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">当前域名</span>
            <input type="text" value="<?php echo $siteInfo['url']?>"  id="keywords" class="form-control" disabled="">
        </div><br>
        <hr>
        <?php if(config('daili_zdy')){?>
        <div class="input-group">
            <span class="input-group-addon">盲盒投递价格</span>
            <input type="text" value="<?php echo $siteInfo['toudi']?>"  id="toudi" class="form-control" placeholder="请输入站点关键词">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">盲盒抽取价格</span>
            <input type="text" value="<?php echo $siteInfo['chouqu']?>"  id="chouqu" class="form-control" placeholder="请输入站点关键词">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">加入月老价格</span>
            <input type="text" value="<?php echo $siteInfo['daili']?>"  id="daili" class="form-control" placeholder="请输入站点关键词">
        </div><br>
        <br>
        <?php }?>
        <button onclick="user_config()" class="btn btn-success btn-block">立即保存</button>
        <br>
</div>
</div>
</div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
    function user_config(){
        sitename = $('#sitename').val();
        description = $('#description').val();
        keywords = $('#keywords').val();
        toudi = $('#toudi').val();
        chouqu = $('#chouqu').val();
        daili = $('#daili').val();
        qz = $('#qz').val();
        ym = $('#user_url').val();
        user_url = qz+'.'+ym;
        if(!qz){
            user_url = '';
        }
        
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=user_config",
    		data: {sitename,description,keywords,toudi,chouqu,daili,user_url},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
                    layer.msg(data.msg,{icon:6});
                    window.location.reload();
    			}else{
    			    layer.msg(data.msg,{icon:5});
    			}
    		},
    		error:function(data){
    		    layer.close(load);
    			layer.msg('服务器错误');
    			return false;
    		}
    	})
    }
</script>