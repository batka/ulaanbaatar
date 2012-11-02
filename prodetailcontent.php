<?php
	
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_pro";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.ProID 
			FROM tbl_pro T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.CreateDate desc
		) T
		WHERE T.ProID='$proid'
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
		SELECT T.Num, T.ProID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.ProID 
			FROM tbl_pro T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
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
//	$qry.=" (select count(*) from tbl_pro where IsShow='YES' and ProID <= '$proid') as ProCount,";
//	$qry.=" (select ProID from tbl_pro where IsShow='YES' and ProID < '$proid' order by ProID desc, CreateDate desc limit 1) as PrivProID,";
//	$qry.=" (select ProID from tbl_pro where IsShow='YES' and ProID > '$proid' order by ProID asc, CreateDate desc limit 1) as NextProID";
//	$qry.=" from tbl_pro";
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
					<a href="<?=$rf;?>/pro/detail/<?=$prev['ProID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/pro/detail/<?=$next['ProID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_pro T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and ProID='$proid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<li class="topbrdr1">
<?php
		$filesource=$drf."/files/pro/".$row1[0]['FileSource'];
		if (!empty($row1[0]['FileSource']) && file_exists($filesource)){
			$filesource=$rf."/files/pro/".$row1[0]['FileSource'];
?>
			<p class="pmdate">Хавсралт файл: <span><a href="javascript:" onclick="downloadFile('<?=$row1[0]['ProID'];?>');">[татах]</a></span></p>
<?php
		} 
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
			<h2 style="padding: 3px"><?=$row1[0]['ProName'];?></h2>
			<div><?=$row1[0]['ProDescr'];?></div>
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