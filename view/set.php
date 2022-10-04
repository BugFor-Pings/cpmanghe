<?php
    include 'head.php';
?>
<link rel="stylesheet" href="https://www.layuicdn.com/layui-v2.5.6/css/layui.css" >
<style>
@media (min-width: 300px) {
	body{
		min-width: 100%;
	}
	.contain {
	    margin-top: 13.8%;
	}
	.aui-footer{
		width:100%;
	}
	.auto{
		width:100%;
	}
	.auto-width{
		width:100%;
	}
	.auto-layer{
		width:calc(100% - 23px);
	}
}
@media (min-width: 375px) {
	.auto-layer{
		width:calc(100% - 23px);
	}
}
@media (min-width: 500px) {
	body{
		min-width: unset;
		margin-left:40.1%;
	}
	.aui-footer{
		width:380px;
	}
	.auto{
		width:380px;
		margin-left:40.1%;
	}
	.auto-width{
		width:380px;
	}
	.auto-layer{
		width:350px;
	}
}
body {
    width:100%;
    max-width:380px;
    margin-left: auto;
    margin-right: auto;
}

.am-form-file
{
  position:relative;
  overflow:hidden;
}
.am-form-file input[type=file]
{
  position:absolute;
  z-index:1;
  width:100%;
  font-size:50rem;
  opacity:0;
  cursor:pointer;
}


.shortselect{  
        display: inline-block;
		width: 100px;
		min-height: 30px;
		position: relative;
		vertical-align: middle;
		padding: 0;
		overflow: hidden;
		background-color: #fff;
		color: #555;
		border: 1px solid #aaa;
		text-shadow: none;
		border-radius: 4px;	
		transition: box-shadow 0.25s ease;
		z-index: 2;
}
</style>
        <section class="aui-flexView">
            <section class="aui-scrollView">
                <center>
                    <?php
                        if(!$userInfo['touxiang']){
                            $userInfo['touxiang'] = '/public/index/img/touxiang/moren.png';
                        }
                        if(!$userInfo['birthday']){
                            $userInfo['birthday'] = '请选择您的生日';
                        }
                        if(!$userInfo['city']){
                            $userInfo['city'] = '请选择您的城市';
                        }
                    ?>
                        <div class="am-form-file">
                            <input type="file" onchange="fileUpload(this, 'tx')"><img id="touxiang" style="border-radius: 20%;" width="150" src="<?php echo $userInfo['touxiang']?>" alt="">
                        </div>
                        <hr>
                </center>
                <div class="aui-list-theme">
                   <div class="layui-form layui-form-pane">
                        <label class="layui-form-label">您的姓名</label>
                        <div class="layui-input-block">
                          <input type="text" id="name" value="<?php echo $userInfo['name']?>" lay-verify="required" placeholder="请输入您的姓名" autocomplete="off" class="layui-input">
                        </div>
                      </div><br>
                    <div class="layui-form layui-form-pane">
                        <label class="layui-form-label"><font color="red">* </font>您的生日</label>
                        <div class="layui-input-block">
                          <button id="birthday" class="layui-btn layui-btn-primary layui-btn-fluid layui-border-blue"><?php echo $userInfo['birthday']?></button>
                        </div>
                        
                     </div><br>
                    <div class="layui-form layui-form-pane">
                        <label class="layui-form-label">所在城市</label>
                        <div class="layui-input-block">
                          <div id="city">
                              <button id="city_input" class="layui-btn layui-btn-primary layui-btn-fluid layui-border-green"><?php echo $userInfo['city']?></button>
                          </div>
                        </div>
                     </div><br>
                     <div class="layui-form layui-form-pane" style="background: #fff;">
                            <label class="layui-form-label"><font color="red">* </font>您的性别</label>
                            <div class="layui-input-block">
                                <input type="radio" name="sex" value="1" title="男" <?php if($userInfo['sex']=='1'){echo 'checked';}?>>
                                <input type="radio" name="sex" value="0" title="女" <?php if($userInfo['sex']=='0'){echo 'checked';}?>>
                            </div>
                        </div>
                     </div><br>
                    <div class="layui-form layui-form-pane">
                        <label class="layui-form-label"><font color="red">* </font>您的微信</label>
                        <div class="layui-input-block">
                          <input type="text" id="weixin" value="<?php echo $userInfo['weixin']?>"  lay-verify="required" placeholder="请输入您的微信" autocomplete="off" class="layui-input">
                        </div>
                     </div><br>
                          <textarea placeholder="请输入您的个人介绍" class="layui-textarea" id="jieshao"><?php echo $userInfo['jieshao']?></textarea>
                        <br>
                     <div class="layui-form layui-form-pane">
                        <label class="layui-form-label">修改密码</label>
                        <div class="layui-input-block">
                          <input type="text" id="pwd" lay-verify="required" placeholder="不修改请留空" autocomplete="off" class="layui-input">
                        </div>
                     </div><br>
                      </div>
                    <center><button onclick="user_setChange()" class="layui-btn">确定保存</button></center>
                    <br> <br> <br> <br> <br> <br> <br>
            </section>
	<script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
	<script src="//www.layuicdn.com/layui/layui.js"></script>
	<script type="text/javascript" src="./public/index/js/main.js?var=<?php echo config('var')?>"></script>
	<script>
layui.use(['laydate','form'], function(){
  var laydate = layui.laydate;
  var form = layui.form;
  laydate.render({
    elem: '#birthday'
  });
  
   form.render();
});

$('#city').click(function(){
   getCity('city_input'); 
});


function fileUpload(obj, des){
	var fileObj = $(obj)[0].files[0];
	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("file",fileObj);
	var ii = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./view/ajax.php?act=file_opload",
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code==1){
                $('#touxiang').attr('src',data.path);
			}else{
			    layer.msg(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	})
}

function getCity(input,fid,i){
	i = i || 0;
	fid = fid || 0;
	if(i==2){
	    return false;
	}
	if(i == 0){
		var options='<select class="shortselect" id="biaozhi_'+(i+1)+'" onchange="getCity('+input+',this.value,'+(i+1)+')">';
		options+='<option></option>';
		$.each("\u5317\u4eac|1|72|1,\u4e0a\u6d77|2|78|1,\u5929\u6d25|3|51035|1,\u91cd\u5e86|4|113|1,\u6cb3\u5317|5|142,\u5c71\u897f|6|303,\u6cb3\u5357|7|412,\u8fbd\u5b81|8|560,\u5409\u6797|9|639,\u9ed1\u9f99\u6c5f|10|698,\u5185\u8499\u53e4|11|799,\u6c5f\u82cf|12|904,\u5c71\u4e1c|13|1000,\u5b89\u5fbd|14|1116,\u6d59\u6c5f|15|1158,\u798f\u5efa|16|1303,\u6e56\u5317|17|1381,\u6e56\u5357|18|1482,\u5e7f\u4e1c|19|1601,\u5e7f\u897f|20|1715,\u6c5f\u897f|21|1827,\u56db\u5ddd|22|1930,\u6d77\u5357|23|2121,\u8d35\u5dde|24|2144,\u4e91\u5357|25|2235,\u897f\u85cf|26|2951,\u9655\u897f|27|2376,\u7518\u8083|28|2487,\u9752\u6d77|29|2580,\u5b81\u590f|30|2628,\u65b0\u7586|31|2652,\u6e2f\u6fb3|52993|52994,\u53f0\u6e7e|32|2768,\u9493\u9c7c\u5c9b|84|84".split(","), function(a, c) {
			c = c.split("|"),
			options+='<option value="'+c[1]+'">'+c[0]+'</option>'
		});
		options+='</select>';
		layer.alert('<div id="layer_button">'+options+'</div>',{title:'请选择城市',closeBtn:0},function(index){
			var con='';
			$("#layer_button select").each(function(){
				con+=$(this.options[this.selectedIndex]).text();
			});
// 			if(!con)return layer.alert('请选择地址！');
			if(con){
			    $("#city_input").html(con).show();
			}
			layer.close(index);
		});
	}else{
	$.ajax({
		type:"get",
		url:"https://fts.jd.com/area/get?fid="+fid,
		dataType:"jsonp",
		success:function(data){
			if(data.length<1){
				if($("#layer_button").html().indexOf("getCity('"+input+"',this.value,"+(i+1)+")")!=-1){
					$("#biaozhi_"+(i+1)).remove();
				}
				return false;
			}
			var options='<select class="shortselect" id="biaozhi_'+(i+1)+'" onchange="getCity(\''+input+'\',this.value,'+(i+1)+')">';
			options+='<option></option>';
			$.each(data,function(index,res){
				options+='<option value="'+res.id+'">'+res.name+'</option>';
			});
			options+='</select>';
			if($("#layer_button").html().indexOf("getCity('"+input+"',this.value,"+(i+1)+")")!=-1){
				$("#biaozhi_"+(i+1)).html(options);
			}else{
				$("#layer_button").append(options);
			}
		}
	});
	}
}
</script>
    </body>
</html>