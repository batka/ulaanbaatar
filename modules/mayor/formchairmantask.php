<?php
	
	$row1=$con->select("select left(LastName,1) as lname, FirstName from mayor_chairman where ChairmanID='$chairmanid'");
	$govformname=$row1[0]['lname'].".".$row1[0]['FirstName'];

	$page_link="$rf/chairman/task/".$chairmanid."/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
?>

<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><a href="<?=$rf?>/chairman/detail/<?=$chairmanid?>/"><?=$govformname?></a> &raquo; <?=$strchairmantask?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
	<?php
		$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
		$qry.=" from mayor_directortask";
		$qry.=" where IsShow='YES'";
		$qry.=" and Mayor='NO'";
		$qry.=" and ChairmanID='$chairmanid'";
		$qry.=" order by CreateDate desc";
		$allrow=$con->GetDescr("select count(*) from mayor_directortask where IsShow='YES' and Mayor='YES'");
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			
			if($rowcount==1){
				GotoPage("","$rf/chairman/task/".$row[0]['ChairmanID']."/detail/".$row[0]['DirectorTaskID']."/");
			}
			
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/chairman/task/".$row[$i]['ChairmanID']."/detail/".$row[$i]['DirectorTaskID']."/";
	?>
		<div class="dcontent">
			<div style="margin-bottom: 3px;">
				<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
			</div>
			<div class="descr">
			<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/directortask/".$row[$i]['ImageSource'])){?>
				<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rf?>/images/directortask/small/<?=$row[$i]['ImageSource']?>" width="120"/></a>
			<?php }
			if(!empty($row[$i]['Intro'])){
				echo GetStrBr(strip_tags($row[$i]['Intro']), 400);
			}else{
				echo GetStrBr(strip_tags($row[$i]['Descr']), 400);
			}
			?>
			<div class="clear"></div>
			</div>
			<div class="dcontentbottom">
				<?=$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?>
			</div>
			<a class="morelink" href="<?=$link?>"><?=$strMore?></a>
			<div class="clear"></div>
		</div>
	<?php }
		require_once 'pagenumber.php';
	}else{?>
		<div class="notice"><?=$strnotfound?></div>
	<?php }?>
	</div>
	</td>
</tr>
</table>			
</div>