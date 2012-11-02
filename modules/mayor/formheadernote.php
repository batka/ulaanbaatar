<?php
	$row1=$con->select("select * from mayor_webheaderlink where IsShow='YES' order by rand()");
	$rowcount1=count($row1);
	if($rowcount1>0){
?>

<div style="width: 1000px; height: 130px;">
	<a href="http://<?=$row1[0]['HeaderLink']?>">
		<img width="1000" height="130" src="<?=$rf?>/images/headerlink/<?=$row1[0]['ImageSource']?>" style="border: 0;"/>
	</a>
</div>
<?php }?>