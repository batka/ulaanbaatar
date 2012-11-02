<?php
	
	$qry="select count(*) as TotalCount";
	$qry.=" from mayor_councilpromptness";
	$qry.=" where IsShow='YES'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.CouncilPromptnessID 
			FROM mayor_councilpromptness T 
			WHERE T.IsShow='YES'
			ORDER BY T.CreateDate desc
		) T
		WHERE T.CouncilPromptnessID='$promptid'
	";
	$currentcount=$con->GetDescr($qry);
	
	if($currentcount==$totalrow){
		$nextcount=1;
		$prevcount=$totalrow-1;
	}elseif($currentcount==1) {
		$nextcount=$currentcount+1;
		$prevcount=$totalrow;
	}elseif($currentcount>1 && $currentcount<$totalrow){
		$nextcount=$currentcount+1;
		$prevcount=$currentcount-1;
	}
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num, T.CouncilPromptnessID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.CouncilPromptnessID 
			FROM mayor_councilpromptness T 
			WHERE T.IsShow='YES' 
			ORDER BY T.CreateDate desc
		) T
		WHERE T.Num='$nextcount'
		OR T.Num='$prevcount'
	";
	$records=$con->select($qry);
	$recordcount=count($records);
	for($j=0; $j<$recordcount; $j++){
		if($records[$j]['Num']==$nextcount){
			$next=$records[$j];
		}else{
			$prev=$records[$j];
		}
	}

//	$qry="select count(*) as TotalCount,";
//	$qry.=" (select count(*) from mayor_councilpromptness where IsShow='YES' and ProID <= '$proid') as ProCount,";
//	$qry.=" (select ProID from mayor_councilpromptness where IsShow='YES' and ProID < '$proid' order by ProID desc, CreateDate desc limit 1) as PrivProID,";
//	$qry.=" (select ProID from mayor_councilpromptness where IsShow='YES' and ProID > '$proid' order by ProID asc, CreateDate desc limit 1) as NextProID";
//	$qry.=" from mayor_councilpromptness";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
	<div class="listbg">
		<form action="" name="frmProDetail" id="frmProDetail" method="post">
		<input type="hidden" name="proid" id="proid" value=""/>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/prompt/detail/<?=$prev['CouncilPromptnessID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/prompt/detail/<?=$next['CouncilPromptnessID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			
<?php
	$qry="select T.*";
	$qry.=" from mayor_councilpromptness T";
	$qry.=" where T.IsShow='YES' and CouncilPromptnessID='$promptid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<li class="topbrdr1">
<?php 
		if (!empty($organid)){
?>
				<div class="org"><span><?=$con->GetDescr("select OrganName from ref_organ where OrganID = '$organid'");?></span></div>
<?php
		}
?>
			<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
			<div><?=$row1[0]['Descr'];?></div>
			<?php if(!empty($row1[0]['Descr1'])){?>
			<div id="execution" style="border-bottom: 1px solid #ededed;"><h2 style="text-align:center; padding: 3px; margin: 0;">Биелэлт</h2></div>
			<div><?=$row1[0]['Descr1'];?></div>
			<?php }?>
			<div class="clear"></div>
		</li>
<?php 
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
		</ul>
		</form>
	</div>
<script type="text/javascript">
function downloadFile(param){
	$("#proid").val(param);
	$("#frmProDetail").attr("action", "<?=$rf;?>/processform.php?action=prodownloadfile");
	$("#frmProDetail").submit();
}
</script>