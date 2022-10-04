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
                    		<label for="example-text-input">站点名称</label>
                    		<input type="text" id="sitename" value="<?php echo config('sitename')?>" class="form-control" required/>
						</div>
						<div class="form-group">
                    		<label for="example-text-input">标题后缀</label>
                    		<input type="text" id="title" value="<?php echo config('title')?>" class="form-control" required/>
						</div>
						<div class="form-group">
                    		<label for="example-text-input">关键字</label>
                    		<input type="text" id="keywords" value="<?php echo config('keywords')?>" class="form-control"/>
						</div>
						<div class="form-group">
                    		<label for="example-text-input">网站描述</label>
                    		<input type="text" id="description" value="<?php echo config('description')?>" class="form-control"/>
						</div>
    						<div class="form-group">
                        		<label for="example-text-input">客服ＱＱ</label>
                        		<input type="text" id="kfqq" value="<?php echo config('kfqq')?>" class="form-control"/>
    						</div>
						<div class="form-group">
                        		<label for="example-text-input">客服微信</label>
                        		<input type="text" id="kfwx" value="<?php echo config('kfwx')?>" class="form-control"/>
						</div>
			        </div>
			        <div class="col-lg-6">
						<div class="form-group">
                    		<label for="example-text-input">网站创建时间</label>
                    		<input type="date" id="sitetime" value="<?php echo config('sitetime')?>" class="form-control"/>
						</div>
						<div class="form-group">
                    		<label for="example-text-input">登录密码</label>
                    		<input type="text" id="pwd" class="form-control" placeholder="不修改请留空"/>
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
        sitename = $('#sitename').val();
        title = $('#title').val();
        keywords = $('#keywords').val();
        description = $('#description').val();
        kfqq = $('#kfqq').val();
        kfwx = $('#kfwx').val();
        sitetime = $('#sitetime').val();
        pwd = $('#pwd').val();
        
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=config",
    		data: {sitename,title,keywords,description,kfqq,kfwx,sitetime,pwd},
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