<?php
	$qry="select T.*, DATE_FORMAT(StartDate, '%Y.%m.%d') as StartDate, DATE_FORMAT(EndDate, '%Y.%m.%d') as EndDate";
	$qry.=" from tbl_trainning T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" order by StartDate desc, EndDate desc";
	$qry.=" limit 0, 5";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	if($rowcount>0){
?>
<div class="subhd" style="background: #7c5916"">Сургалт</div>
<div style="background: #f2f2f2">
<?php
	$j=0;
	while ($j<$rowcount){
?>
	<div style="border-bottom: 1px dotted #ffffff; padding: 10px">
		<?=$j+1;?>. <a href="<?=$rf;?>/trainning#<?=$row[$j]['TrainningID']?>"><?=GetStrBr($row[$j]['Title'], "50");?></a><br/>
		<div style="margin-top: 5px; background: url('<?=$rf;?>/images/icon/icon_calendar.gif') no-repeat left; padding-left: 18px; height: 15px; color: #999999">Хугацаа: <?=$row[$j]['StartDate'];?> - <?=$row[$j]['EndDate'];?></div>
	</div>
<?php
	$j++;
	} 
?>
</div>
<?php }?>