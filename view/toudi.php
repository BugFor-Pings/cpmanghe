<?php
    include 'head.php';

    if(daddslashes($_GET['orderid'])){
        $orderid = daddslashes($_GET['orderid']);
        ticheng($orderid);
    }
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
            <header class="aui-navBar aui-navBar-fixed b-line">
                <a href="./index.php" class="aui-navBar-item">
                    <i class="icon icon-return"></i>
                </a>
                <div class="aui-center">
                    <span class="aui-center-title">盲盒投递</span>
                </div>
                <?php
                    if($userInfo['user']){
                        echo '<a onclick="manghe_zidong()" class="aui-navBar-item">
                    自动填入
                </a>';
                    }
                ?>
            </header>
            <section class="aui-scrollView">
                <br>
                <!--<div class="aui-flex aui-flex-color">-->
                <!--    <div class="aui-flex-box">-->
                <!--        <h2>您的盲盒记录</em></h2>-->
                <!--    </div>-->
                <!--    <div class="aui-arrow"><small><a>盲盒明细</a></small></div></div>-->
                <!--</div><br>-->
                <center>
                    <!--<a><img src="http://yuelao.zc52.cn/uploads/banner/20211005/18ee2709d50f1d64d5ff925e2fb5ffbc.jpg" width="95%"/></a>-->
                        <div class="am-form-file">
                            <input type="file" onchange="fileUpload(this, 'tx')"><img style="border-radius: 20%;height:150px" id="touxiang" width="150" src="../public/index/img/touxiang/moren.png" alt="">
                        </div>
                </center>
                <div class="aui-list-theme">
                   <div class="layui-form layui-form-pane">
                        <label class="layui-form-label">您的姓名</label>
                        <div class="layui-input-block">
                          <input type="text" id="name" lay-verify="required" placeholder="请输入您的姓名" autocomplete="off" class="layui-input">
                        </div>
                      </div><br>
                    <div class="layui-form layui-form-pane">
                        <label class="layui-form-label"><font color="red">* </font>您的生日</label>
                        <div class="layui-input-block">
                          <button id="birthday" class="layui-btn layui-btn-primary layui-btn-fluid layui-border-blue">请选择您的生日</button>
                        </div>
                        
                     </div><br>
                    <div class="layui-form layui-form-pane">
                        <label class="layui-form-label">所在城市</label>
                        <div class="layui-input-block">
                          <div id="city">
                              <button id="city_input" class="layui-btn layui-btn-primary layui-btn-fluid layui-border-green">请选择您的城市</button>
                          </div>
                        </div>
                     </div><br>
                     <div class="layui-form layui-form-pane" style="background: #fff;">
                            <label class="layui-form-label"><font color="red">* </font>您的性别</label>
                            <div class="layui-input-block">
                                <input type="radio" name="sex" value="1" id="a" title="男">
                                <input type="radio" name="sex" value="0" id="b" title="女">
                            </div>
                        </div>
                     </div><br>
                    <div class="layui-form layui-form-pane">
                        <label class="layui-form-label"><font color="red">* </font>您的微信</label>
                        <div class="layui-input-block">
                              <input type="text" id="weixin" lay-verify="required" placeholder="请输入您的微信" autocomplete="off" class="layui-input">
                          <!--<input type="text" id="weixin"  lay-verify="required"   autocomplete="off" placeholder="请输入您的微信"   class="layui-input">-->
                        </div>
                     </div><br>
                          <textarea placeholder="请输入您的个人介绍" class="layui-textarea" id="jieshao"></textarea>
                        <br>
                      </div>
                    <a id="toudi">
                            <div class="aui-list-img">
                                <h2><em>￥</em><?php echo $toudi_money;?></h2>
                                <h3><font>立即加入盲盒</font></h3>
                                <h5>被抽取后则在盲盒中消失哦</h5>
                            </div>
                  </a>
                    <br> <br> <br> <br> <br> <br> <br>
            </section> 
            
<?php
	include 'foot.php';
?>
	<script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="//cdn.staticfile.org/layer/2.3/layer.js"></script>
	<script src="//www.layuicdn.com/layui/layui.js"></script>
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


$('#toudi').click(function(){
   touxiang = $('#touxiang').attr('src');
   name = $('#name').val(); 
   birthday = $('#birthday').html(); 
   city = $('#city_input').html();
   sex = $("input[name='sex']:checked").val();
   weixin = $('#weixin').val();
   jieshao = $('#jieshao').val();
   userName = getCookie('userName');
   
   if(birthday=='请选择您的生日'|| !sex || !weixin){
       layer.msg('生日,性别,微信为必填项哦！');
       return false;
   }
   
   if(city=='请选择您的城市'){
       city = '';
   }
   
    if(!userName){
       layer.msg('获取cookie失败，请联系管理员！');
       return false;
    }
    
    var load = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./view/ajax.php?act=toudi",
		data: {touxiang,name,birthday,city,sex,weixin,jieshao,userName},
		type: "POST",
		dataType: "json",
		success: function (data) {
			layer.close(load);
			if(data.code==1){
                pay_cz('toudi',data.orderid);
			}else{
			    layer.msg(data.msg);
			}
		},
		error:function(data){
		    layer.close(load);
			layer.msg('服务器错误');
			return false;
		}
	})
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