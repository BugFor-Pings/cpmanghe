<?php
    include './head.php';
    $numrows = $DB->getColumn("SELECT count(*) FROM `pre_point` WHERE `user`='{$userInfo['user']}'");
?>
<div class="container" style="padding-top:70px;">
<div class="col-md-12 col-lg-10 center-block table-responsive" style="float: none;">
<table class="table table-bordered">
	<thead>
		<tr>
		    <th><center>编号</center></th>
			<th><center>金额</center></th>
			<th><center>类型</center></th>
			<th><center>内容</center></th>
			<th><center>时间</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
$pagesize=10;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

	        $mh_info = $DB->query("SELECT * FROM `pre_point` WHERE `user`='{$userInfo['user']}' ORDER BY `id` DESC limit $offset,$pagesize");
	        while($row = $mh_info->fetch()){
        	  	    echo '<tr class="text-center">
        	  	        <td>'.$row['id'].'</td>
        	  	        <td><font color="red">'.$row['money'].'</font></td>
        	  	        <td>'.$row['type'].'</td>
        	  	        <td>'.$row['content'].'</td>
        	  	        <td>'.$row['addtime'].'</td>
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