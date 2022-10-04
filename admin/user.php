<?php
  include './head.php';
    $user = trim(daddslashes($_GET['user']));
    if($user){
    	$numrows = $DB->getColumn("SELECT count(*) FROM `pre_user` where `user` like '%{$user}%'");
    }else{
    	$numrows = $DB->getColumn("SELECT count(*) FROM `pre_user`");
    }
?>
<style>
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
</style>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">                  
            <div class="card">
              <div class="card-header">
                <h4 class="text-center">用户列表</h4>
				<ul class="card-actions">
                  <li> <span>共有<?php echo $numrows;?>条记录</span> </li>
                </ul>
              </div>
              <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 block" style="float: none;">
              	<br>
              	    <form action="" method="GET">
                      <div class="input-group">
                        <input type="text" name="user" class="form-control" value="<?php echo $_GET['user']?>" placeholder="输入账号进行搜索">
                        <span class="input-group-btn">
                          <input type="submit" class="btn btn-default">搜索</button>
                        </span>
                      </div>
                     </form>
                    </div>
              <div class="card-body" style="padding: 6px 6px 6px 6px;">
			  
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">头像</th>
                        <th class="text-center">账号</th>
                        <th class="text-center">余额</th>
                        <th class="text-center">性别</th>
                        <th class="text-center">年龄</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
$pagesize=10;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);
	if(!empty($user)){
	    $link = '&user='.$user;
	    $mh_info = $DB->query("SELECT * FROM `pre_user` WHERE `user` like '%{$user}%' ORDER BY `id` DESC limit $offset,$pagesize");
	}else{
	    $mh_info = $DB->query("SELECT * FROM `pre_user` ORDER BY `id` DESC limit $offset,$pagesize");
	}
	        while($row = $mh_info->fetch()){
    			 if($row['status']==1){
                    $row['status'] = '<span onclick="stauts('.$row['id'].',0)" class="label label-success"><b>正常</b></span>';
                  }else{
                    $row['status'] = '<span onclick="stauts('.$row['id'].',1)" class="label label-secondary"><b>封禁</b></span>';
                  }
                  if(!$row['touxiang']){
                      $row['touxiang'] = '../public/index/img/touxiang/moren.png';
                  }
                  if($row['sex']==1){
                      $row['sex'] = '<span class="label label-info"><b>男</b></span>';
                  }elseif($row['sex']=='0'){
                      $row['sex'] = '<span class="label label-pink"><b>女</b></span>';
                  }else{
                      $row['sex'] = '<span class="label label-dark"><b>无</b></span>';
                  }
        	  	    echo '<tr class="text-center">
        	  	        <td>'.$row['id'].'</td>
        	  	        <td><img onclick="getimg(\''.$row['touxiang'].'\')" class="img-thumbnail img-circle" width="50" src="'.$row['touxiang'].'"></td>
        	  	        <td><a href="./point.php?user='.$row['user'].'">'.$row['user'].'</a></td>
        	  	        <td>'.$row['rmb'].'</td>
        	  	        <td>'.$row['sex'].'</td>
        	  	        <td>'.$row['age'].'</td>
        	  	        <td>'.$row['status'].'</td>
        	  	        <td>
            	  	        <button onclick="mh_info('.$row['id'].')"  class="btn btn- btn-xs btn-success"><i class="mdi mdi-account-edit fa-1-5x"></i></button>
            	  	        <button onclick="del(\''.$row['user'].'\')" class="btn btn- btn-xs btn-danger"><i class="mdi mdi-delete fa-1-5x"></i></button>
        	  	        </td>
          	        </tr>';
	}
?>
        </tbody>
      </table>
    </div>
      <?php
echo'<center><ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul></center>';
?>
				

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
    function getimg(url){
    	layer.open({
    	  type: 1,
    	  title: false,
    	  area: ['auto'],
    	  shadeClose: true,
    	  skin: 'beijing_kong', 
    	  content: ('<center><img src="'+url+'"  style="width: 320px;height: 410px;"></center>')
    	});
    }

    function del(user){
        layer.confirm('您确定要删除用户: '+user+'吗?', {
    	  btn: ['确认','算了'] //按钮
    	}, function(){
            var load = layer.load(3, {shade:[0.1,'#fff']});
        	$.ajax({
        		url: "./ajax.php?act=user_del",
        		data: {user},
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
        	});
    	});
    }

    function stauts(id,stauts){
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=user_status",
    		data: {id,stauts},
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
    	});
    }

    function mh_info(id){
        var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=user_info",
    		data: {id},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
    			    data = data.data;
    			    if(data.sex==0){
    			        data.sex = '女';
    			    }else{
    			        data.sex = '男';
    			    }
    			    if(!data.touxiang){
    			        data.touxiang = '../public/index/img/touxiang/moren.png';
    			    }
                    layer.alert(1,{
                        title:'用户信息',
                        skin: 'layui-layer-molv',
                        btn:false,
                        content:'<center><div class="am-form-file" style="border-radius: 20%;height:150px;"><input type="file" onchange="fileUpload(this,\'tx\')"><img id="touxiang" style="border-radius: 20%;" width="88" src="'+data.touxiang+'" alt=""></div></center><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">序号</span><input disabled type="text" class="form-control" id="id" value="'+id+'"></div><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">余额</span><input type="number" class="form-control" id="rmb" value="'+data.rmb+'"></div><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">生日</span><input type="date" class="form-control" id="birthday" value="'+data.birthday+'"></div><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">性别</span><input type="text" class="form-control" id="sex" value="'+data.
                       sex+'"></div><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">微信</span><input type="text" class="form-control" id="weixin" value="'+data.weixin+'"></div><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">城市</span><input type="text" class="form-control" id="city" value="'+data.city+'"></div><div class="col-xs-12"><textarea class="form-control" id="jieshao" name="example-textarea-input" rows="6" placeholder="个人介绍">'+data.jieshao+'</textarea><br><div class="input-group m-b-10"><span class="input-group-addon" id="basic-addon3">密码</span><input type="text" class="form-control" id="pwd" value="'+data.
                      pwd+'"></div><br><button onclick="change()" class="btn btn-primary btn-block"> 确认修改</button></div>'
                    });
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
    }
    
    function change(){
       id = $('#id').val();
       touxiang = $('#touxiang').attr('src');
       rmb = $('#rmb').val(); 
       birthday = $('#birthday').val(); 
       city = $('#city').val();
       sex = $("#sex").val();
       weixin = $('#weixin').val();
       jieshao = $('#jieshao').val(); 
       pwd = $('#pwd').val(); 
       
        if(sex=='女'){
            sex = '0';
        }else{
            sex = '1';
        }
       
       var load = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=user_change",
    		data: {id,touxiang,rmb,birthday,city,sex,weixin,jieshao,pwd},
    		type: "POST",
    		dataType: "json",
    		success: function (data) {
    			layer.close(load);
    			if(data.code==1){
                    layer.msg(data.msg,{icon:6})
    			}else{
    			    alert(data.msg);
    			}
    		},
    		error:function(data){
    		    layer.close(load);
    			layer.msg('服务器错误');
    			return false;
    		}
    	});
    }
    
    
    function fileUpload(obj, des){
    	var fileObj = $(obj)[0].files[0];
    	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
    		return;
    	}
    	var formData = new FormData();
    	formData.append("file",fileObj);
    	var ii = layer.load(3, {shade:[0.1,'#fff']});
    	$.ajax({
    		url: "./ajax.php?act=file_opload",
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
    			    alert(data.msg);
    			}
    		},
    		error:function(data){
    			layer.msg('服务器错误');
    			return false;
    		}
    	})
    }
</script>