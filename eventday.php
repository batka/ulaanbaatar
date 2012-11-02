<style>
.contextitem ul{
	list-style: none;
	margin: 0;
	padding: 5px;
	background: #f2f2f2
}
.contextitem ul li{
	background: #ffffff;
	border-top: 2px solid #f6e8d5;
	margin-bottom: 5px; 
	padding: 5px 5px; 
}
.contextitem ul li h3{
	font-weight: normal;
	font-size: 12px
}
.contextitem div.righttxt{
	text-align: right;
	color: #999999
}
</style>
<div class="subhd" style="margin-top: 0; background: #7c5916">Ойролцоо үйл явдал</div>
<div class="contextitem">
<?php
	$qry="select StartDate, EndDate";
	$qry.=" from tbl_event";
	$qry.=" where IsShow='YES' and EventID='$eventid'";
	$row=$con->select($qry);
	$startday=$row[0]['StartDate'];
	$endday=$row[0]['EndDate'];
	
	$qry="select *";
	$qry.=" from tbl_event";
	$qry.=" where IsShow='YES'";
	$qry.=" and StartDate>='$startday' and EndDate<='$endday'";
	$qry.=" and EventID!='$eventid'";
	$qry.=" order by StartDate asc";
	$row=$con->select($qry);
	$rowcount=count($row);
?>
	<ul>
<?php 
	if($rowcount>0){
	
	$j=0;
	while ($j<$rowcount) {
?>
			<li>
				<div class="righttxt">Хугацаа: <?=$row[$j]['StartDate'];?> <?=$row[$j]['EndDate'];?></div>
<?php
		$imagesource=$drf."/files/event/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/event/small/".$row[$j]['ImageSource'];
?>
		<a href="<?=$rf;?>/event/detail/<?=$row[$j]['EventID'];?>"><img src="<?=$imagesource;?>" alt="<?=$row[$j]['Title'];?>" width="200" height="150" style="margin: 5px 15px;"/></a>
<?php
		} 
?>
				<h3 style="margin-top: 5px; text-align: center;"> <a href="<?=$rf;?>/event/detail/<?=$row[$j]['EventID'];?>"><?=$row[$j]['Title'];?></a></h3>
				<span>Хаана: <?=$row[$j]['OrganName'];?></span>
			</li>
<?php
	$j++;
	} 
	} else {
?>
	<div style="padding: 3px; text-align: center;">Ойролцоо үйл явдал байхгүй.</div>
<?php
	} 
?>
	</ul>
<?php
?>
</div>