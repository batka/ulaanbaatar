<?php
	$qry="select count(*) as TotalCount,";
	$qry.=" (select count(*) from tbl_event where IsShow='YES' and EventID <= '$eventid') as EventCount,";
	$qry.=" (select EventID from tbl_event where IsShow='YES' and EventID < '$eventid' order by EventID desc, StartDate desc, CreateDate desc limit 1) as PrivEventID,";
	$qry.=" (select EventID from tbl_event where IsShow='YES' and EventID > '$eventid' order by StartDate desc, CreateDate desc limit 1) as NextEventID";
	$qry.=" from tbl_event";
	$qry.=" where IsShow='YES'";
	//echo $qry; exit;
	$row=$con->select($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_event T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and EventID='$eventid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
?>
	<ul class="presslist">
<?php 
	if ($rowcount1>0){ 
?>
		<div style="background: #fff; margin-bottom: 10px; padding: 3px 10px">
				<div style="float: left;">Нийт: <?=$row[0]['TotalCount'];?> - <?=$row[0]['EventCount'];?></div>
				<div style="float: right;">
<?php	
	if(!empty($row[0]['PrivEventID'])){
?>
					<a href="<?=$rf;?>/event/detail/<?=$row[0]['PrivEventID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
<?php
	} else {
?>
					&laquo; Өмнөх</a>&nbsp;|&nbsp;
<?php 
	}
	if(!empty($row[0]['NextEventID'])){
?> 
					<a href="<?=$rf;?>/event/detail/<?=$row[0]['NextEventID'];?>">Дараах &raquo;</a>
<?php
	} else {
?>
					Дараах &raquo;
<?php
	} 
?>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr3">
				<p class="pmdate">Хугацаа: <?=$row1[0]['StartDate'];?> - <?=$row1[0]['EndDate'];?></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
		$imagesource=$drf."/files/event/small/".$row1[0]['ImageSource'];
		if (!empty($row1[0]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/event/small/".$row1[0]['ImageSource'];
			$stringlong="280"; 
?>
				<img src="<?=$imagesource?>" width="300" style="float: left; margin: 5px 10px 0 0"/>
<?php
		} 
?>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
				<div><?=$row1[0]['Descr'];?></div>
				<span><strong>Хаана:</strong> <?=$row1[0]['Where'];?></span>
				<div class="clear"></div>
			</li>
<?php
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
	</ul>
</div>