<?php
	$page_link="$rf/council/conference/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
?>

<style type="text/css">
	.tableinfo{
		width: 100%;
		font-family: Tahoma;
		font-size: 12px;
	}
	
	.tableinfo th{
		background-color: #5e84b0;
		color: #ffffff;
		font-size: 11px;
		padding: 2px;
	}
	
	.tableinfo td{
		background-color: #e5e5e5;
		color: #000000;
		font-size: 11px;
		padding: 2px;
		height: 20px;
	}
	
	.tableinfo a{
		color: #000000;
		text-decoration: none;
	}
	.tableinfo a:HOVER{
		color: #023eac;
	}
</style>

<div class="formcenter">
	<div class="dcontenttitle"><?=$lmenutitle?></div>
	<div class="dcontent">
	<?php
		$qry="select *, DATE_FORMAT(CouncilConfDate,'%Y-%m-%d') as date";
		$qry.=" from mayor_councilconference";
		$qry.=" where IsShow='YES'";
		$qry.=" order by CouncilConfDate desc, CreateDate desc";
		$allrow=$con->GetDescr("select count(*) from mayor_councilconference where IsShow='YES'");
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){?>
		<table class="tableinfo">
			<tr>
				<th width="5%">№</th>
				<th width="41%">Хуралдаан</th>
				<th width="18%">Хэлэлцэх асуудал</th>
				<th width="18%">Хуралдааны тойм</th>
				<th width="18%">Хэвлэлийн мэдээ</th>
			</tr>
			<?php			
			$index=$pagenum*$showcount;
			for($i=0; $i<$rowcount; $i++){
			?>
			<tr>
				<td align="center"><?=($index+$i+1)?>.</td>
				<td align="center"><strong><?=$row[$i]['date']?></strong>-ны хуралдаан</td>
				<td align="center"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=conference.php&qs1=conferenceid=<?=$row[$i]['CouncilConfID'];?>&qs2=descr=Descr',600, 600); return false;">Дэлгэрэнгүй</a></td>
				<td align="center"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=conference.php&qs1=conferenceid=<?=$row[$i]['CouncilConfID'];?>&qs2=descr=Descr1',600, 600); return false;">Дэлгэрэнгүй</a></td>
				<td align="center"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=conference.php&qs1=conferenceid=<?=$row[$i]['CouncilConfID'];?>&qs2=descr=Descr2',600, 600); return false;">Дэлгэрэнгүй</a></td>
			</tr>
			<?php }?>
		</table>	
	</div>	
	<?php
		require_once 'pagenumber.php';
	}else{?>
		<div class="notice"><?=$strnotfound?></div>
	<?php }?>		
</div>