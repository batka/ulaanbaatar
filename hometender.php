<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_tender T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	$qry.=" order by EndDate desc";
	$qry.=" limit 0, 3";
	$row=$con->select($qry);
	$rowcount=count($row);
	if($rowcount>0){
?>
<div class="">
		<ul style="margin:0;">
<?php 
	$j=0;
	while ($j<$rowcount) {
?>
			<li style="padding: 12px 5px; margin-bottom: 5px; list-style: none; ">
				<div class="righttxt">Хугацаа: <?=$row[$j]['StartDate'];?> - <?=$row[$j]['EndDate'];?></div>
				<p style="margin-top: 5px"> <a href="<?=$rf;?>/tender/detail/<?=$row[$j]['TenderID'];?>"><?=$row[$j]['Title'];?></a></p>
				<span>Захиалагч: <?=$row[$j]['OrganName'];?></span>
			</li>
<?php
	$j++;
	} 
?>
	</ul>
</div>
<?php }?>