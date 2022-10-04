var domain = 'http://'+document.domain+'/'+window.location.pathname+'/';

var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

function loading(msg){
	layer.msg(msg, {
		icon:16,
		shade:[0.1, '#000'],
	})
}

function logout(msg) {
	setCookie('userName','');
	setCookie('userToken','');
	layer.alert(msg, {
		  skin: 'layui-layer-molv',
		  title:'小贴士'
		  ,closeBtn: 0
		}, function(){
		    location.reload();
		});
}

function pay_cz(mod,orderid,money=false,chouqu=false){
	var loading = layer.load(2, { shade: false });
	
	user = getCookie('userName');
	if(!user || !orderid){
	    layer.msg('缺少参数');
	    return false;
	}
	$.ajax({
    	type : 'POST',
    	url : './view/ajax.php?act=pay_cz',
    	dataType : 'json',
    	data:{user,mod,orderid,money,chouqu},
    	success : function(data) {
    		layer.close(loading);
    		if(data.code == 1){
    		    rmb_zf = '';
    		    if(getCookie('userToken') && mod!='chongzhi'){
    		        rmb_zf = '<button class="xc2" onclick="rmb(\''+user+'\',\''+mod+'\',\''+data.orderno+'\',\''+money+'\',\''+chouqu+'\')">余额支付</button><hr>';
    		    }
    			layer.alert('<center><h1><big>￥'+data.money+'</big></h1><br><button class="xc1" onclick="dopay(\'alipay\',\''+data.orderno+'\',\''+chouqu+'\')"><img width="20" src="pay/icon/alipay.ico" class="logo">支付宝</button> <button class="xc1" onclick="dopay(\'qqpay\',\''+data.orderno+'\',\''+chouqu+'\')"><img width="20" src="pay/icon/qqpay.ico" class="logo">QQ钱包</button> <button class="xc1" onclick="dopay(\'wxpay\',\''+data.orderno+'\',\''+chouqu+'\')"><img width="20" src="pay/icon/wechat.ico" class="logo">微信支付</button><hr>'+rmb_zf+'支付过程中请勿关闭页面',{
    				btn:[],
    				title:'提交订单成功',
    			});
    		}else{
    			layer.msg(data.msg);
    		}
	},
	error:function(data){
		layer.msg('系统繁忙，请稍后再试');
		return false;
	}
	});
}

function dopay(type,orderid){
	window.location.href='./pay/epayapi.php?type='+type+'&orderid='+orderid;
}

function rmb(user,mod,orderid,money=false,chouqu=false){
    var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
    	type:'POST',
    	url:'./view/ajax.php?act=rmb_zf',
    	dataType : 'json',
    	data:{user,mod,orderid,money},
    	success : function(data) {
    		layer.close(ii);
    		if(data.code==1){
    			layer.msg(data.msg,{icon:6});
    			if(mod=='chouqu'){
    			    mod = 'index';
    			    window.location.href = './?mod='+mod+'&orderid='+orderid+'&chouqu='+chouqu;
    			}else{
			        window.location.href = './?mod='+mod+'&orderid='+orderid;
    			}
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

function qiandao(user){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
    	type:'POST',
    	url:'./view/ajax.php?act=qiandao',
    	dataType : 'json',
    	data:{user},
    	success : function(data) {
    		layer.close(ii);
    		if(data.code==1){
    			getimg('../public/index/img/qiandao.gif','#');
    		}else{
    			layer.msg(data.msg);
    		}
    	},
    	error:function(data){
    		layer.msg('系统繁忙，请稍后再试');
    		return false;
    	}
    });
}

function manghe_zidong(){
    var load = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./view/ajax.php?act=manghe_zidong",
		data: {},
		type: "POST",
		dataType: "json",
		success: function (data) {
			layer.close(load);
			if(data.code==1){
			    if(!data.data.touxiang || !data.data.birthday || !data.data.city){
			        layer.alert("您未设置个人信息，请去用户中心设置！<hr>头像，生日，城市未必填哦！<hr>设置完成后即可使用自动填入功能！嘻嘻嘻");
			        return false;
			    }
			    $('#touxiang').attr('src',data.data.touxiang);
			    $('#name').val(data.data.name);
			    $('#birthday').html(data.data.birthday);
			    $('#city_input').html(data.data.city);
			 //   $('#'+data.sex).prop('checked','checked');
			    $('#weixin').val(data.data.weixin);
			    $('#jieshao').val(data.data.jieshao);
			    
                // layer.msg(data.msg,{icon:6});
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



function daili(){
    var load = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./view/ajax.php?act=daili",
		data: {},
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

function user_set(){
     layer.open({
	   type: 2,
	   title: '设置个人信息',
	   shadeClose: false,
	   closeBtn:2,
	   scrollbar: false,
	   area: ['310px', '520px'],
	   content: '?mod=set'
	});
}

function user_setChange(){
   touxiang = $('#touxiang').attr('src');
   name = $('#name').val(); 
   birthday = $('#birthday').html(); 
   city = $('#city_input').html();
   sex = $("input[name='sex']:checked").val();
   weixin = $('#weixin').val();
   jieshao = $('#jieshao').val();
   userName = getCookie('userName');
   pwd = $('#pwd').val();
   
   if(birthday=='请选择您的生日'|| !sex || !weixin){
       layer.msg('生日,性别,微信为必填项哦！');
       return false;
   }
   
   if(city=='请选择您的城市'){
       city = '';
   }
   
   var load = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./view/ajax.php?act=user_setChange",
		data: {touxiang,name,birthday,city,sex,weixin,jieshao,userName,pwd},
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
	})
}


function qiandao(user){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
    	type:'POST',
    	url:'./view/ajax.php?act=qiandao',
    	dataType : 'json',
    	data:{user},
    	success : function(data) {
    		layer.close(ii);
    		if(data.code==1){
    			getimg('../public/index/img/qiandao.gif','#');
    		}else{
    			layer.msg(data.msg);
    		}
    	},
    	error:function(data){
    		layer.msg('系统繁忙，请稍后再试');
    		return false;
    	}
    });
}

function manghe(mod,order_id){
        var load = loading('盲盒抽取中···');
        
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./view/ajax.php?act=manghe_null",
    		data: {mod},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
                    window.setTimeout(function(){
                        layer.close(load);
                        layer.open({
                    	  type: 1,
                    	  title: false,
                    	  area: ['auto'],
                    	  shadeClose: false,
                    	  closeBtn: false,
                    	  skin: 'beijing_kong',
                    	  content: ('<center><a onclick="pay_cz(\'chouqu\',\''+order_id+'\',false,\''+mod+'\');"><img src="../public/index/img/mh.png" style="width: 320px;height: 320px;"></a></center>')
                    	});
                    }, 0);
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
}
   
   function manghe_btn(mod,order_id){
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./view/ajax.php?act=manghe",
    		data: {mod,order_id},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    		    layer.close(load);
    			if(data.code==1){
    			    if(mod=='nan'){
    			        title = '男生盲盒';
    			    }else{
    			        title = '女生盲盒';
    			    }
        			layer.alert(1,{
        			    title:'盲盒信息',
        			    btn:false,
        			    title:'',
        			    closeBtn:'',
        			    content:'<center><img src="./public/index/img/user-003.png"><br><br>恭喜您,成功抽取到了一个'+title+'<br><a href="./?mod=manghe" style="display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px;color:#fff;background-color:#5cb85c;border-color:#4cae4c;display:block;width:100%;">立即查看</a>'
        			});
    			}else{
    			    layer.alert(data.msg+'<br>您的订单号：'+order_id+'<br>请截图保存联系客服！');
    			}
    		},
    		error:function(data){
    		    layer.close(load);
    			layer.msg('系统繁忙，请稍后重试');
    			return false;
    		}
    	})
   }
 

function setCookie(name,value){
	var exp = new Date();
	exp.setTime(exp.getTime() + 30*100000000);
	document.cookie = name + "="+ escape (value) + ";path=/;expires=" + exp.toGMTString();
}


function getimg(img,url,close,type,target=0){
		if(type=='1'){
			var style='width: 320px;height: 410px;';
		}else if(type=='2'){
			var style='width: 340px;height: 390px;';
		}else if(type=='3'){
			var style='width: 340px;height: 450px;';
		}else if(type=='4'){
			var style='width: 320px;height: 300px;';
		}else{
			var style='width: 320px;height: 320px;';
		}
		
		if(target==1){
			var page = 'target="_blank"';
		}
	layer.open({
	  type: 1,
	  title: false,
	  area: ['auto'],
	  shadeClose: false,
	  closeBtn: close,
	  skin: 'beijing_kong', //没有背景色
	  content: ('<center><a '+page+' href="'+url+'"><img src="'+img+'" style="'+style+'"></a></center>')
	}
	);
}

function jf_logs(){
	layer.open({
		skin: 'auto-layer',
		type: 2,
		title: '积分明细',
		shadeClose: true,
		closeBtn:2,
		shade: false,
		scrollbar: false,
		area: ['','600px'],
		content: '?mod=logs'
	});
}



function getCookie(name){
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
		return unescape(arr[2]);
	else
		return null;
}
