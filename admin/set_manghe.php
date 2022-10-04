<?php
    include './head.php';
?>
	
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>网站设置</h4>
              </div>
              <div class="card-body">
			    <div class="row">
			        <div class="col-lg-6"> 
						<div class="form-group">
                    		<label for="example-text-input">盲盒投递费用（元）</label>
                    		<input type="text" id="toudi_money" value="<?php echo config('toudi_money')?>" class="form-control" required/>
						</div>
						<div class="form-group">
                    		<label for="example-text-input">盲盒抽取费用（元）</label>
                    		<input type="text" id="chouqu_money" value="<?php echo config('chouqu_money')?>" class="form-control" required/>
						</div>
						<!--<div class="form-group">-->
      <!--              		<label for="example-text-input">盲盒用户VIP费用（元/月）</label>-->
      <!--              		<input type="text" id="manghe_vip" value="<?php echo config('manghe_vip')?>" class="form-control" required/>-->
						<!--</div>-->
						<div class="form-group">
                    		<label for="example-text-input">每日签到积分</label>
                    		<input type="text" id="jifen" value="<?php echo config('jifen')?>" class="form-control" required/>
						</div>
						<div class="form-group">
                            <label for="example-text-input">盲盒人工审核</label>
                              <select class="form-control" id="manghe_shenhe" size="1">
                                <option value="1" <?php if(config('manghe_shenhe')=='1'){echo 'selected';} ?>>开启</option>
                                <option value="0" <?php if(config('manghe_shenhe')=='0'){echo 'selected';} ?>>关闭</option>
                              </select>
                        </div>
			             <!--<div class="form-group">-->
                <!--            <label for="example-text-input">首次投递免费</label>-->
                <!--              <select class="form-control" id="first_toudi">-->
                <!--                <option value="1" <?php if(config('first_toudi')=='1'){echo 'selected';} ?>>开启</option>-->
                <!--                <option value="0" <?php if(config('first_toudi')=='0'){echo 'selected';} ?>>关闭</option>-->
                <!--              </select>-->
                <!--        </div>-->
		            </div>
			        <!--<hr>-->
			       <!--   <div class="col-lg-6">-->
					 <!--	<div class="form-group">-->
                     <!--		<label for="example-text-input">加盟费用（元）</label>
                     <!--		<input type="text" id="daili_money" value="<?php echo config('daili_money')?>" class="form-control"/>-->
					 <!--	</div>-->
					 <!--	<div class="form-group">-->
                     <!--		<label for="example-text-input">一级利润（百分比）</label>-->
                     <!--		<input type="text" id="daili_lirun" value="<?php echo config('daili_lirun')?>" class="form-control"/>-->
					 <!--	</div>-->
					 <!--	<div class="form-group">-->
                     <!--		<label for="example-text-input">二级利润（百分比）</label>-->
                     <!--		<input type="text" id="daili_lirun2" value="<?php echo config('daili_lirun2')?>" class="form-control"/>-->
					 <!--	</div>-->
					 <!--	<div class="form-group">-->
                     <!--		<label for="example-text-input">最低提现（元）</label>-->
                    	 <!--	<input type="text" id="tixian" value="<?php echo config('tixian')?>" class="form-control"/>-->
					 <!--	</div>-->
						 <!--<div class="form-group">-->
                         <!--    <label for="example-text-input">允许代理自定义价格</label>-->
                          <!--     <select class="form-control" id="daili_zdy">-->
                           <!--      <option value="1" <?php if(config('daili_zdy')=='1'){echo 'selected';} ?>>开启</option>-->
                            <!--     <option value="0" <?php if(config('daili_zdy')=='0'){echo 'selected';} ?>>关闭</option>-->
                           <!--    </select>-->
                         <!--</div>-->
                        <!-- <div class="form-group">-->
                    	 <!--	<label for="example-text-input">可选二级域名 (多个,隔开)</label>-->
                    	 <!--	<input type="text" id="user_url" value="<?php echo config('user_url')?>" class="form-control"/>-->
					</div> 
						<div class="form-group">
						   
                    		<label for="example-text-input">用户中心公告</label>
                    		<textarea class="form-control" id="user_gonggao" name="example-textarea-input" rows="4" placeholder="请输入用户中心公告"><?php echo config('user_gonggao');?></textarea>
                    		</div> 
					</div>
			        </div>
			        <button id="config" class="btn btn-block btn-primary">立即保存</button>
			    </div>
				
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
<?php
    include './foot.php';
?>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
    $('#config').click(function(){
        toudi_money = $('#toudi_money').val();
        chouqu_money = $('#chouqu_money').val();
        manghe_vip = $('#manghe_vip').val();
        daili_money = $('#daili_money').val();
        daili_lirun = $('#daili_lirun').val();
        daili_lirun2 = $('#daili_lirun2').val();
        tixian = $('#tixian').val();
        jifen = $('#jifen').val();
        manghe_shenhe = $('#manghe_shenhe').val();
        first_toudi = $('#first_toudi').val();
        daili_zdy = $('#daili_zdy').val();
        user_gonggao = $('#user_gonggao').val();
        user_url = $('#user_url').val();
        
        if(Number(daili_lirun)+Number(daili_lirun2)>100){
            layer.alert('俩个等级利润百分比总大于100，请检查！');
            return false;
        }
        
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=config",
    		data: {toudi_money,chouqu_money,manghe_vip,daili_money,daili_lirun,daili_lirun2,tixian,jifen,manghe_shenhe,first_toudi,daili_zdy,user_gonggao,user_url},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
                    layer.msg(data.msg,{icon:6});
    			}else{
    			    layer.msg(data.msg,{icon:5});
    			}
    		},
    		error:function(data){
    		    layer.close(load);
    			layer.msg('服务器错误');
    			return false;
    		}
    	});
    });
</script>