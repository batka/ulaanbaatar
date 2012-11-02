<?php
	$page_link="$rf/council/consultor/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
?>

<div class="formcenter">
	<div class="dcontenttitle"><?=$lmenutitle?></div>
	<?php
		$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
		$qry.=" from mayor_councilconsist";
		$qry.=" where IsShow='YES'";
		$qry.=" and (PositionID='110' or PositionID='111')";
		$qry.=" order by CreateDate desc";
		$allrow=$con->GetDescr("select count(*) from mayor_councilconsist where IsShow='YES' and (PositionID='109' or PositionID='110')");
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/council/consultor/detail/".$row[$i]['CouncilManID']."/";
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