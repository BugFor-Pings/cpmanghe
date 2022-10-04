<?php
    include './head.php';
    if($_COOKIE['userToken']==md5($userInfo['name'].$userInfo['pwd'])){
       exit('<script>alert("您已经登陆");window.location.href="./index.php"</script>');
    }
?>
<div class="container" style="padding-top:70px;">
	<div class="col-xs-12 col-sm-10 col-md-10 col-lg-6 center-block" style="float: none;">
            <div class="text-center">
                <h1>用户注册</h1>
                <hr>
                <div class="input-group">
        			<span class="input-group-addon">用户名</span>
        			<input type="text" id="name" value="" class="form-control" placeholder="请输入用户名">
        		</div><br>
        		<div class="input-group">
        			<span class="input-group-addon"> 密 码 </span>
        			<input type="text" id="pwd" class="form-control" placeholder="请输入密码">
        		</div><br>
        		<button id="reg" class="btn btn-danger">立即注册</button>
        		<hr>
                <div class="row clearfix">
            		<div class="col-md-6 col-xs-6 column">
            		    <a href="login.php" class="btn btn-success">立即登录</a>
            		</div>
            		<div class="col-md-6 col-xs-6 column">
            		    <a href="res.php" class="btn btn-warning">忘记密码</a>
            		</div>
            	</div>
            </div>
        
    </div>
    
   <script src="//s1.pstatp.com/cdn/expire-1-M/layer/2.3/layer.js"></script>
   <script>
        $('#reg').click(function(){
            name = $('#name').val();
            pwd = $('#pwd').val();
            
            if(!name || !pwd){
                layer.msg("请填写完整");
                return false;
            }
            
            var load = layer.load({time:false});
            $.ajax({
                  url: "./ajax.php?act=userReg",
                  data: {name,pwd},
                  type: "POST",
                  dataType: "json",
                  success: function(data){
                      layer.close(load);
                      if(data.code==1){
                         layer.msg(data.msg,{icon:6});
                         alert('注册成功');
                         window.location.href = './login.php';
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