<style type="text/css">
	a.pagenum{
		color: #303030;
		font-family: Arial;
		font-size: 12px;
		text-decoration: none;
		border: 1px solid #bbbbbb;
		background-color: #e3e3e3;
		padding-left: 3px;
		padding-right: 3px;
	}
	a.pagenum:HOVER{
		border: 1px solid #254e79;
	}
</style>

<div style="margin: 5px;">
<?php
	$num_size=$allrow/$showcount;
	if($pagenum>0){?>
		<a href="<?=$page_link.'1'?>" class="pagenum"><<</a>
		<a href="<?=$page_link.$pagenum?>" class="pagenum"><</a>
	<?php }
	$lastnum=0;
	
	$ifirst=0;
	$ilast=$num_size;
	
	if($pagenum-2>0){
		$ifirst=$pagenum-2;
	}
	$ilast=$ifirst+5;
	
	if($ilast>$num_size){
		$ilast=$num_size;
		if($ilast-5>0){
			$ifirst=$ilast-5;
		}else{$ifirst=0;}
	}
	
	if($ilast!=(int)$ilast) $ilast=(int)$ilast+1;
	for($i=(int)$ifirst; $i<$ilast; $i++){
		if($i==$pagenum){
	?>
		<a class="pagenum" style="background-color: #959595; color: #ffffff; cursor: default;" disabled><?=$i+1?></a>
	<?php }else{?>
		<a href="<?=$page_link.($i+1)?>" class="pagenum"><?=$i+1?></a>
	<?php }
	$lastnum=$i;
	}
	if($pagenum<$lastnum){
		if($num_size>(int)$num_size) $num_size=(int)$num_size+1;
		?>
		<a href="<?=$page_link.($pagenum+2)?>" class="pagenum">></a>
		<a href="<?=$page_link.($num_size)?>" class="pagenum">>></a>
<?php }
	if($num_size!=(int)$num_size)$num_size=(int)$num_size+1;
?>
	<span style="margin-left: 10px ;font-size: 12px; color: #303030;">Нийт хуудас: <strong><?=$num_size?></strong></span>
</div>