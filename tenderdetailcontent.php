<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_tender";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.TenderID 
			FROM tbl_tender T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.StartDate desc, T.CreateDate desc, T.EndDate desc
		) T
		WHERE T.TenderID='$tenderid'
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
		SELECT T.Num, T.TenderID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.TenderID 
			FROM tbl_tender T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.StartDate desc, T.CreateDate desc, T.EndDate desc
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
//	$qry.=" (select count(*) from tbl_tender where IsShow='YES' and TenderID <= '$tenderid') as TenderCount,";
//	$qry.=" (select TenderID from tbl_tender where IsShow='YES' and TenderID < '$tenderid' order by TenderID desc, CreateDate desc limit 1) as PrivTenderID,";
//	$qry.=" (select TenderID from tbl_tender where IsShow='YES' and TenderID > '$tenderid' order by TenderID asc, CreateDate desc limit 1) as NextTenderID";
//	$qry.=" from tbl_tender";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
	<div class="listbg">
		<form action="" name="frmTenderDetail" id="frmTenderDetail" method="post">
		<input type="hidden" name="tenderid" id="tenderid" value=""/>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/tender/detail/<?=$prev['TenderID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/tender/detail/<?=$next['TenderID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_tender T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and TenderID='$tenderid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<li class="topbrdr1">
			<p class="pmdate"><strong>Хугацаа: <?=$row1[0]['StartDate'];?> - <?=$row1[0]['EndDate'];?></strong></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
			<div align="center"><h2>Тендерийн урилга</h2></div>
			<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
			<div><?=$row1[0]['Descr'];?></div>
<?php
	if(!empty($row1[0]['Result'])){ 
?>
			<a name="result"></a>
			<div style="text-transform: uppercase; font-weight: bold;">Үр дүн:</div>
			<div style="margin-bottom: 10px; line-height: 1.5em"><?=$row1[0]['Result'];?></div>
<?php
	} 
?>
			<div style="text-transform: uppercase; font-weight: bold;">Холбоо барих мэдээлэл:</div>
			<div style="list-style: none; line-height: 1.5em">
<?php
	if(!empty($row1[0]['Telephone'])){ 
?>
				<dt>Утас: <?=$row1[0]['Telephone'];?></dt>
<?php
	} 
	if(!empty($row1[0]['Email'])){ 
?>
				<dt>И-мэйл хаяг: <?=$row1[0]['Email'];?></dt>
<?php
	} 
	if(!empty($row1[0]['Address'])){ 
?>
				<dt>Хаяг: <?=$row1[0]['Address'];?></dt>
<?php
	} 
?>
			</div>
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
	$("#tenderid").val(param);
	$("#frmTenderDetail").attr("action", "<?=$rf;?>/tendercessform.php?action=tenderdownloadfile");
	$("#frmTenderDetail").submit();
}
</script>