<div class="hdtitle">Захирамж</div>
<div class="content">
		<table cellpadding="3" cellspacing="0" width="100%" class="btmbrdr">
		<tr>
			<th width="1%">№</th>
			<th width="10%">Огноо</th>
			<th>Гарчиг</th>
		</tr>
<?php
	$qry="select *";
	$qry.=" from tbl_lawrule";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 0, 10";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
		if($j%2==0) $bgcolor="row1";
		else $bgcolor="row2";
?>
			<tr class="<?=$bgcolor;?>">
				<td align="center"><?=$j+1;?>.</td>
				<td align="center"><?=$row[$j]['LawRuleDate'];?></td>
				<td><?=$row[$j]['Title'];?></td>
			</tr>
<?php
	$j++;
	} 
?>
		</table>
	</div>