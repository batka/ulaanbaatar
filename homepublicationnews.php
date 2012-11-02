<?php
	$qry="select *";
	$qry.=" from tbl_publicationnews";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 1";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount){
?>
	<div class="brderleft">
		
		<div>
			<div style="margin-bottom: 5px; font-weight: bold;"><a href="<?=$rf;?>/publication/detail/<?=$row[$j]['PublicationNewsID'];?>"><h5><?=GetStrBr($row[$j]['Title'], "80");?></5></a></div>
				
<?php
		$imagesource=$drf."/files/speech/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/speech/small/".$row[$j]['ImageSource']; 
?>
				<div class="img"><img src="<?=$imagesource;?>" title="" alt="" width="150" style="margin-right: 15px;"></div>
<?php
		} 
?>
			<span style="font-size: 10px; color: #999; text-align:right;">Огноо: <?=$row[$j]['SpeechDate'];?></span>
			<div class="descr"><?=GetStrBr($row[$j]['Descr'], "200");?></div>
			<div class="more"><a href="<?=$rf;?>/publication/detail/<?=$row[$j]['PublicationNewsID'];?>" title="">дэлгэрэнгүй</a></div>
  		</div>
 	</div>
<?php
	$j++;
	} 
?>