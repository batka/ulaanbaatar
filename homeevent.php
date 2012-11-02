<?php
	$qry="select T.*, DATE_FORMAT(StartDate, '%Y.%m.%d') as StartDate, DATE_FORMAT(EndDate, '%Y.%m.%d') as EndDate";
	$qry.=" from tbl_event T";
	$qry.=" where T.IsShow='YES'";
	//$qry.=" and DATE_FORMAT(NOW(), '%Y-%m-%d')<=EndDate";
	$qry.=" order by EndDate desc";
	$qry.=" limit 0, 3";
	$row=$con->select($qry);
	$rowcount=count($row);
	if($rowcount>0){
?>

<div style="background: ">
<?php
	$j=0;
	while ($j<$rowcount){
?>
	<div style="border-bottom: 1px dotted #ffffff; padding: 10px; background: url('<?=$rf;?>/images/icon/event_icon.png') no-repeat left; padding-left: 44px;">
		<a href="<?=$rf;?>/event/detail/<?=$row[$j]['EventID'];?>"><?=GetStrBr($row[$j]['Title'], "50");?></a><br/>
		<div style="margin-top: 5px;">Хугацаа: <?=$row[$j]['StartDate'];?> - <?=$row[$j]['EndDate'];?></div>
	</div>
<?php
	$j++;
	} 
?>
</div>
<?php }?>