<?php
    include './head.php';
?>
	
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4>易支付配置</h4>
              </div>
              <div class="card-body">
			    <div class="row">
			        <div class="col-lg-12"> 
						<div class="form-group">
                    		<label for="example-text-input">易支付地址   </label>
                    		<input type="text" id="epay_url" value="<?php echo config('epay_url')?>" class="form-control" />
						</div>
						<div class="form-group">
                    		<label for="example-text-input">易支付ID</label>
                    		<input type="text" id="epay_id" value="<?php echo config('epay_id')?>" class="form-control" required/>
						</div>
						<div class="form-group">
                    		<label for="example-text-input">易支付密钥</label>
                    		<input type="text" id="epay_key" value="<?php echo config('epay_key')?>" class="form-control"/>
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
        epay_url = $('#epay_url').val();
        epay_id = $('#epay_id').val();
        epay_key = $('#epay_key').val();
        
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=config",
    		data: {epay_url,epay_id,epay_key},
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