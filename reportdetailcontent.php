<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_report";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.ReportID 
			FROM tbl_report T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.ReportDate desc, CreateDate desc
		) T
		WHERE T.ReportID='$reportid'
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
		SELECT T.Num, T.ReportID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.ReportID 
			FROM tbl_report T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.ReportDate desc, CreateDate desc
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
//	$qry.=" (select count(*) from tbl_report where IsShow='YES' and ReportID <= '$reportid') as ReportCount,";
//	$qry.=" (select ReportID from tbl_report where IsShow='YES' and ReportID < '$reportid' order by ReportID desc, ReportDate desc, CreateDate desc limit 1) as PrivReportID,";
//	$qry.=" (select ReportID from tbl_report where IsShow='YES' and ReportID > '$reportid' order by ReportDate desc, CreateDate desc limit 1) as NextReportID";
//	$qry.=" from tbl_report";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
	<div class="listbg">
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_report T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and ReportID='$reportid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/report/detail/<?=$prev['ReportID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/report/detail/<?=$next['ReportID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr1">
				<p class="pmdate">Огноо: <?=$row1[0]['ReportDate'];?></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span class="ressort"><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
				<h2 style="padding: 3px; text-align: center;"><?=$row1[0]['Title'];?></h2>
<?php
		$filesource=$drf."/files/report/".$row1[0]['FileSource'];
		if (!empty($row1[0]['FileSource']) && file_exists($filesource)){
			$filesource=$rf."/files/report/".$row1[0]['FileSource'];
?>
				<div>Хавсралт файл:
				<a href="javascript:" onclick="downloadFile('<?=$row1[0]['ReportID'];?>');"><img src="<?=$rf;?>/images/icon/16x16/attachment.png" align="absmiddle">[татах]</a></div>
<?php
		} 
?>		
				<div><?=$row1[0]['Descr'];?></div>
				<div class="clear"></div>
			</li>
<?php
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</ul>
	</div>

<script type="text/javascript">
	function downloadFile(param){
		//$("#reportid").val(param);
		//$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/processform.php?action=reportdownloadfile");
		//$("#<?=$pageFormName;?>").submit();
		window.location.href="<?=$rf;?>/processform.php?action=reportdownloadfile&reportid="+param;
	}
</script>