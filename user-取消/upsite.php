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
            <span class="input-group-addon">升级价格</span>
            <input type="text" disabled="" value="<?php echo $daili_money?>" id="daili_money" class="form-control" placeholder="请输入站点名称">
        </div><br>
        <button onclick="user_upsite()" class="btn btn-success btn-block">立即升级</button>
        <br>
</div>
</div>
</div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
    function user_upsite(){
        var ii = layer.load(2, {shade:[0.1,'#fff']});
    	$.ajax({
        	type:'POST',
        	url:'../view/ajax.php?act=user_upsite',
        	dataType : 'json',
        	data:{},
        	success : function(data) {
        		layer.close(ii);
        		if(data.code==1){
        			layer.msg(data.msg,{icon:6});
        		}else{
        			layer.msg(data.msg,{icon:5});
        		}
        	},
        	error:function(data){
        		layer.msg('系统繁忙，请稍后再试');
        		return false;
        	}
        });
    }
</script>