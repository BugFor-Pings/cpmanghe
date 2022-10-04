<?php
    include './head.php';
    $numrows = $DB->getColumn("SELECT count(*) FROM `pre_user` WHERE `upsite`='{$siteInfo['id']}");
?>
<div class="container" style="padding-top:70px;">
<div class="col-md-12 col-lg-10 center-block table-responsive" style="float: none;">
<table class="table table-bordered">
	<thead>
		<tr>
			<th><center>头像</center></th>
			<th><center>用户名</center></th>
			<th><center>性别</center></th>
			<th><center>年龄</center></th>
			<th><center>状态</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
$pagesize=10;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

	        $user_info = $DB->query("SELECT * FROM `pre_user` WHERE `upsite`='{$siteInfo['id']}' ORDER BY `id` DESC limit $offset,$pagesize");
	        if($numrows){
	            while($row = $user_info->fetch()){
    			 if($row['status']=='1'){
                    $row['status'] = '<span onclick="" class="label label-success"><b>正常</b></span>';
                  }else{
                    $row['status'] = '<span onclick="" class="label label-danger"><b>封禁</b></span>';
                  }
                  if($row['sex']=='1'){
                      $row['sex'] = '<span class="label label-info"><b>男</b></span>';
                  }elseif($row['sex']=='0'){
                      $row['sex'] = '<span class="label label-warning"><b>女</b></span>';
                  }else{
                      $row['sex'] = '<span class="label label-danger"><b>暂无</b></span>';
                  }
                  if(!$row['age']){
                      $row['age'] = '<span class="label label-danger"><b>暂无</b></span>';
                  }
                  if(!$row['touxiang']){
                      $row['touxiang'] = '../public/index/img/touxiang/moren.png';
                  }
        	  	    echo '<tr class="text-center">
        	  	        <td><img onclick="getimg(\''.$row['touxiang'].'\')" class="img-thumbnail img-circle" width="50" src="'.$row['touxiang'].'"></td>
        	  	        <td>'.$row['user'].'</td>
        	  	        <td>'.$row['sex'].'</td>
        	  	        <td>'.$row['age'].'</td>
        	  	        <td>'.$row['status'].'</td>
          	        </tr>';
	}
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
