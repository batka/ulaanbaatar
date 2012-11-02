<?php
	$page_link="$rf/governor/mayors/page/";
	$showcount=12;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$govformtitle;?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
	<?php
		$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date, DATE_FORMAT(StartDate,'%Y') as sdate, DATE_FORMAT(EndDate,'%Y') as edate from mayor_director";
		$qry.=" where IsShow='YES'";
		$qry.=" and Mayor='NO'";
		$qry.=" order by StartDate desc, CreateDate desc";
		$allrow=$con->GetDescr("select count(*) from mayor_director where IsShow='YES' and Mayor='NO'");
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/governor/mayors/detail/".$row[$i]['DirectorID']."/";
	?>			
			<div class="descr" style="width: 130px; height: 200px; text-align: left; padding-left: 5px; float: left; margin-right: 7px;">
				<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/director/".$row[$i]['ImageSource'])){?>
					<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rf?>/images/director/small/<?=$row[$i]['ImageSource']?>" width="120" height="150"/></a>
				<?php }?>
				<div style="margin-bottom: 3px;">
					<a href="<?=$link?>" class="descrtitle" style="font-size: 12px;"><?=$row[$i]['Title']?></a>
					<br/><span style="font-size: 11px; color: #a3a3a3;">Огноо: <?=$row[0]['sdate']?>-<?=$row[0]['edate']?></span>
				</div>
				<div class="clear"></div>
			</div>
	<?php }?>
	<div class="clear"></div>
	<?php 
		require_once 'pagenumber.php';
	}else{?>
		<div class="notice"><?=$strnotfound?></div>
	<?php }?>
		</div>
		</td>
	</tr>
	</table>
</div>