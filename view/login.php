<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>用户中心</title>
  <link href="//lib.baomitu.com/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//s1.pstatp.com/cdn/expire-1-M/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <script src="//lib.baomitu.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="//lib.baomitu.com/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--[if lt IE 9]>
    <script src="//lib.baomitu.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="container" style="padding-top:10px;">
	<div class="col-xs-12 col-sm-10 col-md-10 col-lg-6 center-block" style="float: none;">
            <div class="text-center">
                <div class="input-group">
        			<span class="input-group-addon">账号</span>
        			<input type="text" id="user" value="" class="form-control" placeholder="请输入用户名">
        		</div><br>
        		<div class="input-group">
        			<span class="input-group-addon">密码</span>
        			<input type="text" id="pwd" class="form-control" placeholder="请输入密码">
        		</div><br>
        		<button id="login" class="btn btn-success btn-block">立即登录</button>
        		<hr>
        		<!--<button class="btn btn-info"><li class="fa fa-qq"> QQ快捷登录</li></button>-->
        		<!--<hr>-->
    			<div class="alert alert-danger">无需注册，登陆自动生成账号</div>
            </div>
        
    </div>
    
    <div style="display:none">
        <script type="text/javascript" src="https://s9.cnzz.com/z_stat.php?id=1280241151&web_id=1280241151"></script>
    </div>

    
   <script src="//s1.pstatp.com/cdn/expire-1-M/layer/2.3/layer.js"></script>
   <script>
        $('#login').click(function(){
            user = $('#user').val();
            pwd = $('#pwd').val();
            
            if(!user || !pwd){
                layer.msg("请填写完整");
                return false;
            }
            
            var load = layer.load({time:false});
            $.ajax({
                  url: "./view/ajax.php?act=user_login",
                  data: {user,pwd},
                  type: "POST",
                  dataType: "json",
                  success: function(data){
                      layer.close(load);
                      if(data.code==1){
                         if(data.user){
                             layer.alert(1,{
                                 title:'友情提示',
                                 closeBtn:0,
                                 btn:'好的了解',
                                 content:'<div class="alert alert-success"><center>'+data.msg+'</center></div><hr>您的账号：'+data.user+'<br>您的密码：'+data.pwd
                             },function(){
                                window.parent.location.reload();
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                             });
                         }else{
                             layer.msg(data.msg,{icon:6});
                             window.parent.location.reload();
                             var index = parent.layer.getFrameIndex(window.name);
                             parent.layer.close(index);
                         }
                      }else{
                         layer.msg(data.msg,{icon:5}); 
                      }
                  },
                  error: function(data){
                      layer.close(load);
                      layer.msg("未知错误");
                  }
              });
        });
    </script>
</body>
</html>