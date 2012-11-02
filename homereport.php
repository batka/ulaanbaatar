<div id="content" style="margin-bottom: 10px">
	<table class="textualData links" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td colspan="3" style="background: #ededed; font-weight: bold;">Төлөвлөгөө, тайлан</td>
	</tr>
	<tr>
		<th width="1%">№</th>
		<th width="10%">Огноо</th>
		<th>Гарчиг</th>
	</tr>
<?php
	$qry="select *";
	$qry.=" from tbl_report";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ReportDate desc, CreateDate desc";
	$qry.=" limit 0, 5";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
	<tr>
		<td class="odd"><?=$j+1;?>.</td>
	  	<td class="odd" align="center"><?=$row[$j]['ReportDate']?></td>
	  	<td class="odd" align="left"><a href="<?=$rf;?>/report/detail/<?=$row[$j]['ReportID']?>"><?=$row[$j]['Title']?></a></td>
	</tr>
<?php
	$j++;
	} 
?>
	</table>
</div>