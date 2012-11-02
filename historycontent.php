<?php
	$qry=" select TimeLine, Descr";
	$qry.=" from tbl_history";
	$qry.=" where IsShow='YES' and HistoryID='$historyid'";
	$row1=$con->select($qry);
	$rowcount1=count($row1);
?>
<div class="listbg">
	<ul class="presslist">
		<li class="topbrdr">
<?php
	if($rowcount1>0){ 
?>
			<h2><?=$row1[0]['TimeLine'];?></h2>
			<div><?=$row1[0]['Descr'];?></div>
<?php
	} else { 
?>
	<div style="padding: 5px; text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
		</li>
	</ul>
</div>