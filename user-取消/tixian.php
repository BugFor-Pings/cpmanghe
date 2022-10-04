<?php
    include './head.php';
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">提现配置</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon">收款姓名</span>
                    <input type="text" value="<?php echo $siteInfo['tx_xm']?>" id="tx_xm" class="form-control" placeholder="">
                </div><br>
                <div class="input-group">
                    <span class="input-group-addon">收款账号</span>
                    <input type="text" value="<?php echo $siteInfo['tx_zh']?>" id="tx_zh" class="form-control" placeholder="">
                </div><br>
                <div class="input-group">
                    <span class="input-group-addon">收款类型</span>
                    <select id="tx_type" class="form-control">
                      <?php
                        foreach($tx_type as $k=>$v){
                            if($k==$siteInfo['tx_type']){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                            echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
                        }
                      ?>
                    </select>
                </div><br>
                <div class="input-group">
                    <span class="input-group-addon">收款图</span>
                    <input type="text" value="<?php echo $siteInfo['tx_skt']?>" disabled="" id="tx_skt" class="form-control" placeholder="">
                    <span class="input-group-btn">
                        <div class="am-form-file">
                            <input type="file" onchange="fileUpload(this, 'tx')"><button class="btn btn-info" onclick="fileUpload(this, 'tx_skt')" type="button">上传</button>
                        </div>
                    </span>
                     <span class="input-group-btn">
                        <button class="btn btn-success" onclick="show()" type="button">查看</button>
                    </span>
                </div><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button onclick="tx_config()" type="button" class="btn btn-primary">提交更改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<div class="container" style="padding-top:70px;">
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">申请提现</h3>
	</div>
	<br>
	<div class="col-xs-12 col-sm-10 col-md-8 col-lg-12 center-block" style="float: none;">
            <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal"><li class="fa fa-cog fa-1x"></li><br>配置类型/二维码</button>
            <hr>
        <div class="input-group">
            <span class="input-group-addon">我的余额</span>
            <input type="number" value="<?php echo $userInfo['rmb']?>" disabled="" class="form-control" placeholder="">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon">申请金额</span>
            <input type="number" id="rmb" class="form-control" placeholder="">
        </div><br>
        <button onclick="tixian()" class="btn btn-success btn-block">立即提现</button>
        <br>
</div>
</div>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">提现记录</h3>
	</div>
	<br>
	<div class="col-xs-12 col-sm-10 col-md-8 col-lg-12 center-block table-responsive" style="float: none;">
<table class="table table-bordered">
	<thead>
		<tr>
			<th><center>编号</center></th>
			<th><center>金额</center></th>
			<th><center>申请时间</center></th>
			<th><center>提现时间</center></th>
			<th><center>状态</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
$pagesize=10;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

	        $mh_info = $DB->query("SELECT * FROM `pre_tixian` WHERE `user`='{$userInfo['user']}' ORDER BY `id` DESC limit $offset,$pagesize");
	        while($row = $mh_info->fetch()){
    			 if($row['status']==1){
                    $row['status'] = '<span onclick="" class="label label-success"><b>已提现</b></span>';
                  }else{
                    $row['status'] = '<span onclick="" class="label label-info"><b>处理中</b></span>';
                  }
        	  	    echo '<tr class="text-center">
        	  	        <td>'.$row['id'].'</td>
        	  	        <td>'.$row['money'].'</td>
        	  	        <td>'.$row['addtime'].'</td>
        	  	        <td>'.$row['endtime'].'</td>
        	  	        <td>'.$row['status'].'</td>
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
	</tbody>
</table>
</div>
</div>
</div>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>

function show(){
    getimg($('#tx_skt').val());
}

function getimg(src){
	layer.open({
	  type: 1,
	  title: false,
	  area: ['auto'],
	  shadeClose: false,
	  closeBtn: true,
	  skin: 'beijing_kong', //没有背景色
	  content: ('<center><img src="'+src+'" style="width: 320px;height: 320px;"></center>')
	}
	);
}

function tixian(){
    rmb = $('#rmb').val();
    
    if(!rmb){
        layer.msg('请先输入提现金额',{icon:5});
        return false;
    }
    
    var load = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./ajax.php?act=tixian",
		data: {rmb},
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
}

function tx_config(){
    tx_skt = $('#tx_skt').val();
    tx_zh = $('#tx_zh').val();
    tx_xm = $('#tx_xm').val();
    tx_type = $('#tx_type').val();
    
    var load = layer.load(3, {shade:[0.1,'#fff']});
	$.ajax({
		url: "./ajax.php?act=tx_config",
		data: {tx_skt,tx_zh,tx_xm,tx_type},
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
}

function fileUpload(obj,des){
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
                $('#tx_skt').val(data.path);
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
</script>