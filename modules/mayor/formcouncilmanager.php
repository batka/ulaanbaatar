<?php
	$page_link="$rf/council/manager/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
?>

<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
			<td><div class=pageformtitle><?=$lmenutitle?></div></td>
				<td></td>
			</tr>
			<tr>
			<td colspan="2">
			<div class="pageform">
	<?php
		$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
		$qry.=" from mayor_councilconsist";
		$qry.=" where IsShow='YES'";
		$qry.=" and PositionID='107'";
		$qry.=" order by CreateDate desc";
		$allrow=count($con->select($qry));
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			if($rowcount==1){
				GotoPage("","$rf/council/manager/detail/".$row[0]['CouncilManID']."/");
			}
			$link="$rf/council/manager/detail/".$row[$i]['CouncilManID']."/";
	?>
		<div class="dcontent">
			<div class="descr">
			<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/council/consist/".$row[$i]['ImageSource'])){?>
				<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rf?>/images/council/consist/small/<?=$row[$i]['ImageSource']?>" width="120"/></a>
			<?php }?>
			<div style="margin-bottom: 3px;">
				<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['LastName']." овогтой ".$row[$i]['FirstName']?></a>
			</div>
			<?=GetStrBr(strip_tags($row[$i]['Descr']), 400)?>
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