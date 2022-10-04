<?php
    include './head.php';
?>
<style>
.lyear-wrapper {
    position: relative;
}
.lyear-login {
    display: flex !important;
    min-height: 100vh;
    align-items: center !important;
    justify-content: center !important;
}
.login-center {
    background: #fff;
    min-width: 29.25rem;
    padding: 2.14286em 3.57143em;
    border-radius: 5px;
    margin: 2.85714em;
}
.login-header {
    margin-bottom: 1.5rem !important;
}
.login-center .has-feedback.feedback-left .form-control {
    padding-left: 38px;
    padding-right: 12px;
}
.login-center .has-feedback.feedback-left .form-control-feedback {
    left: 0;
    right: auto;
    width: 38px;
    height: 38px;
    line-height: 38px;
    z-index: 4;
    color: #dcdcdc;
}
.login-center .has-feedback.feedback-left.row .form-control-feedback {
    left: 15px;
}
</style>
</head>  
<body>
<div class="row lyear-wrapper">
  <div class="lyear-login">
    <div class="login-center">
      <div class="login-header text-center">
            <h3>后台登录</h3>
      </div>
        <div class="form-group has-feedback feedback-left">
          <input type="text" id="name" value="" class="form-control" placeholder="用户名" required="required"/>
          <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback feedback-left">
          <input type="password" id="pwd" class="form-control" placeholder="密码" required="required"/>
          <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group">
        	<button id="login" class="btn btn-block btn-primary">立即登录</button>
        </div>
      </form>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2021 <a target="_blank" href="#">后台管理中心</a></p>
      </footer>
    </div>
  </div>
</div>

  </div>
</div>

<?php
    include './foot.php';
?>
<script>
    $('#login').click(function(){
        name = $('#name').val();
        pwd = $('#pwd').val();
        
        if(!name || !pwd){
            layer.msg('请填写完整')
        }
        
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=login",
    		data: {name,pwd},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
                    layer.msg(data.msg,{icon:6});
                    window.location.href = './index.php';
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
</body>
</html>