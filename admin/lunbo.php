<?php
    include './head.php';
?>
<?php 
function alert($content){
 echo '<script>alert(\''.$content.'\');history.go(-1);</script>';
}

if($_GET['mod']=='set'){
 if($_POST['img1']=='')exit(alert('图片1不能为空！'));set_config('img1',$_POST['img1']);
 if($_POST['img1_url']=='')exit(alert('图片1的链接不能为空！'));set_config('img1_url',$_POST['img1_url']);

 if($_POST['img2']=='')exit(alert('图片2不能为空！'));set_config('img2',$_POST['img2']);
 if($_POST['img2_url']=='')exit(alert('图片1的链接不能为空！'));set_config('img2_url',$_POST['img2_url']);

 if($_POST['img3']=='')exit(alert('图片3不能为空！'));set_config('img3',$_POST['img3']);
 if($_POST['img3_url']=='')exit(alert('图片3的链接不能为空！'));set_config('img3_url',$_POST['img3_url']);
 exit(alert('修改成功！'));
?>
<?php }else{?>
      <div class="container-fluid">    
        <div class="row">
          <div class="col-lg-6"> 
            <div class="card">
              <div class="card-header"><h4>当前轮播图</h4></div>
                
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                  </ol>
				  
                  <div class="carousel-inner">
                    <div class="item active"><img src="<?php echo config('img1')?>" alt="轮播图1" width="100%"></div>
                    <div class="item"><img src="<?php echo config('img2')?>" alt="轮播图2" width="100%"></div>
                    <div class="item"><img src="<?php echo config('img3')?>" alt="轮播图3" width="100%"></div>
                  </div>
                  <a class="left carousel-control" href="#carouselExampleIndicators" role="button" data-slide="prev"><span class="icon-left-open-big icon-prev" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
                  <a class="right carousel-control" href="#carouselExampleIndicators" role="button" data-slide="next"><span class="icon-right-open-big icon-next" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                </div>
                
            </div>
          </div>
		  
		  
		  <form action="./lunbo.php?mod=set" method="post" class="col-lg-6" role="form"> 
            <div class="card">
              <div class="card-header"><h4>轮播图上传</h4></div>
                <div class="card-body">
				  <label for="example-text-input">轮播图1</label>
                  <div class="input-group m-b-10">
                    <span class="input-group-addon">跳转链接</span>
                    <input type="text" name="img1_url" value="<?php echo config('img1_url')?>" class="form-control" required/>
                  </div>
                  <input type="file" id="file1" onchange="fileUpload(1)" style="display:none;"/>
				  <div class="input-group">
                    <span class="input-group-addon">图片链接</span>
                    <input type="text" class="form-control" id="img1" name="img1" value="<?php echo config('img1')?>" placeholder="轮播图1图片链接">
                    <span class="input-group-btn">
                        <a href="javascript:fileSelect(1)" class="btn btn-info" title="上传图片"><i class="mdi mdi-apple-keyboard-caps"></i></a>
                    </span>
                    <span class="input-group-btn">
                        <a href="javascript:fileView(1)" class="btn btn-pink" title="查看图片"><i class="mdi mdi-image-multiple"></i></a>
                    </span>
                  </div>
				  <hr>
				  <label for="example-text-input">轮播图2</label>
                  <div class="input-group m-b-10">
                    <span class="input-group-addon">跳转链接</span>
                    <input type="text" name="img2_url" value="<?php echo config('img2_url')?>" class="form-control" required/>
                  </div>
                  <input type="file" id="file2" onchange="fileUpload(2)" style="display:none;"/>
				  <div class="input-group">
                    <span class="input-group-addon">图片链接</span>
                    <input type="text" class="form-control" id="img2" name="img2" value="<?php echo config('img2')?>" placeholder="轮播图1图片链接">
                    <span class="input-group-btn">
                        <a href="javascript:fileSelect(2)" class="btn btn-info" title="上传图片"><i class="mdi mdi-apple-keyboard-caps"></i></a>
                    </span>
                    <span class="input-group-btn">
                        <a href="javascript:fileView(2)" class="btn btn-pink" title="查看图片"><i class="mdi mdi-image-multiple"></i></a>
                    </span>
                  </div>
				  <hr>
				  <label for="example-text-input">轮播图3</label>
                  <div class="input-group m-b-10">
                    <span class="input-group-addon">跳转链接</span>
                    <input type="text" name="img3_url" value="<?php echo config('img3_url')?>" class="form-control" required/>
                  </div>
                  <input type="file" id="file3" onchange="fileUpload(3)" style="display:none;"/>
				  <div class="input-group">
                    <span class="input-group-addon">图片链接</span>
                    <input type="text" class="form-control" id="img3" name="img3" value="<?php echo config('img3')?>" placeholder="轮播图1图片链接">
                    <span class="input-group-btn">
                        <a href="javascript:fileSelect(3)" class="btn btn-info" title="上传图片"><i class="mdi mdi-apple-keyboard-caps"></i></a>
                    </span>
                    <span class="input-group-btn">
                        <a href="javascript:fileView(3)" class="btn btn-pink" title="查看图片"><i class="mdi mdi-image-multiple"></i></a>
                    </span>
                  </div>
				  
				  </div>
				  
				  <footer class="card-footer">
				  	<input type="submit" name="submit" value="确认修改" class="btn btn-block btn-primary"/>
				  </footer>
              </div>
            </form>
          </div>

        </div>
        
      </div>
      
    </main>
    <!--End 页面主要内容-->
    
<?php include 'foot.php';?>

<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
function fileSelect(no){
	$("#file"+no).trigger("click");
}
function fileView(no){
	var img = $("#img"+no).val();
	if(img=='') {
		layer.alert("请先上传图片，才能预览");
		return;
	}
	if(img.indexOf('http') == -1)img = '../'+img;
	layer.open({
		type: 1,
		area: ['360px', '400px'],
		title: '商品图片查看',
		shade: 0.3,
		anim: 1,
		shadeClose: true,
		content: '<center><img width="300px" src="'+img+'"></center>'
	});
}
function fileUpload(no){
	var fileObj = $("#file"+no)[0].files[0];
	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("do","upload");
	formData.append("type","img");
	formData.append("file",fileObj);
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./ajax.php?act=uploadimg",
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('上传图片'+no+'成功');
				$("#img"+no).val(data.url);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	})
}
</script>
<?php }?>