<style type="text/css">
	a.pagenum{
		color: #2c436a;
		font-family: Arial;
		font-size: 11px;
		text-decoration: none;
		border: 1px solid #cccccc;
		background-color: #f0f0f0;
		padding: 1px;
		padding-left: 4px;
		padding-right: 4px;
		
		cursor: pointer;
		border-radius: 3px 3px;
		border-radius: 3px 3px;
		
		-moz-border-radius: 3px;
		-moz-border-radius-topright: 3px;
	
		-webkit-border-radius: 3px;
		-webkit-border-radius: 3px;
	}
	a.pagenum:HOVER{
		border: 1px solid #7fa7ea;
		background-color: #d5e4fd;
	}
</style>
<div class="clear"></div>
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
		<a class="pagenum" style="border-color: #7fa7ea; background-color: #b7d0fa; color: #1c4b9a; cursor: default;" disabled><?=$i+1?></a>
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
	<span style="margin-left: 10px ;font-size: 11px; color: #303030;">Нийт: <?=$allrow?></span>
</div>