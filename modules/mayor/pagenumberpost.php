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
<input type="hidden" name="pagenum" id="pagenum" value="<?=$pagenum?>">
<div style="margin: 5px;">
<?php
	$num_size=$allrow/$showcount;
	if($pagenum>0){?>
		<a href="javascript:" onclick="document.getElementById('pagenum').value=<?=0?>; document.<?=$pageFormName?>.submit();" class="pagenum"><<</a>
		<a href="javascript:" onclick="document.getElementById('pagenum').value=<?=$pagenum-1?>; document.<?=$pageFormName?>.submit();" class="pagenum"><</a>
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
		<a href="javascript:" onclick="document.getElementById('pagenum').value=<?=$i?>; document.<?=$pageFormName?>.submit();" class="pagenum"><?=$i+1?></a>
	<?php }
	$lastnum=$i;
	}
	if($pagenum<$lastnum){
		if($num_size>(int)$num_size) $num_size=(int)$num_size+1;
		?>
		<a href="javascript:" onclick="document.getElementById('pagenum').value=<?=$pagenum+1?>; document.<?=$pageFormName?>.submit();" class="pagenum">></a>
		<a href="javascript:" onclick="document.getElementById('pagenum').value=<?=$num_size-1?>; document.<?=$pageFormName?>.submit();" class="pagenum">>></a>
<?php }
	if($num_size!=(int)$num_size)$num_size=(int)$num_size+1;
?>
	<span style="margin-left: 10px ;font-size: 12px; color: #303030;">Нийт хуудас: <strong><?=$num_size?></strong></span>
</div>