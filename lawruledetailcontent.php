<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_lawrule";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$qry.=" and IsPublic='YES'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.LawRuleID 
			FROM tbl_lawrule T 
			WHERE T.IsShow='YES'
			AND T.IsPublic='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.LawRuleDate desc, CreateDate desc
		) T
		WHERE T.LawRuleID='$lawruleid'
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
		SELECT T.Num, T.LawRuleID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.LawRuleID 
			FROM tbl_lawrule T 
			WHERE T.IsShow='YES'
			AND T.IsPublic='YES' 
			AND T.OrganID='$organid'
			ORDER BY T.LawRuleDate desc, CreateDate desc
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
//	$qry.=" (select count(*) from tbl_lawrule where IsShow='YES' and LawRuleID <= '$lawruleid') as LawRuleCount,";
//	$qry.=" (select LawRuleID from tbl_lawrule where IsShow='YES' and LawRuleID < '$lawruleid' order by LawRuleID desc, CreateDate desc limit 1) as PrivLawRuleID,";
//	$qry.=" (select LawRuleID from tbl_lawrule where IsShow='YES' and LawRuleID > '$lawruleid' order by LawRuleID asc, CreateDate desc limit 1) as NextLawRuleID";
//	$qry.=" from tbl_lawrule";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
	<div class="listbg">
		<form action="" name="frmLawRuleDetail" id="frmLawRuleDetail" method="post">
		<input type="hidden" name="lawruleid" id="lawruleid" value=""/>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/lawrule/detail/<?=$prev['LawRuleID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/lawrule/detail/<?=$next['LawRuleID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			
<?php
	$qry="select T.*, OrganName,DATE_FORMAT(LawRuleDate,'%Y') as YYYY,";
	$qry.=" DATE_FORMAT(LawRuleDate,'%m') as MM,";
	$qry.=" DATE_FORMAT(LawRuleDate,'%d') as DD";	
	$qry.=" from tbl_lawrule T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and LawRuleID='$lawruleid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<li class="topbrdr1">
<?php
		$filesource=$drf."/files/lawrule/".$row1[0]['FileSource'];
		if (!empty($row1[0]['FileSource']) && file_exists($filesource)){
			$filesource=$rf."/files/lawrule/".$row1[0]['FileSource'];
?>
			<p class="pmdate">Хавсралт файл: <span><a href="javascript:" onclick="downloadFile('<?=$row1[0]['LawRuleID'];?>');">[татах]</a></span></p>
<?php
		} 
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
			<?php 
			?>
			
			<br>
			<p class="pmdate">Огноо: <?=$row1[0]['LawRuleDate'];?></p>
			<br>
			<br>
			<div style="width: 100%; text-align: center;" >
				<center>
				<div  style="width: 300px; ">
					<h2 style="padding: 3px; text-align: center; font-size: 14px; font-family: arial; font-weight: bold;"><?=$row1[0]['Title'];?></h2>
				</div>
				</center>
			</div>
			<br>
			<br>
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
		</ul>
		</form>
	</div>
<script type="text/javascript">
function downloadFile(param){
	$("#lawruleid").val(param);
	$("#frmLawRuleDetail").attr("action", "<?=$rf;?>/processform.php?action=lawruledownloadfile");
	$("#frmLawRuleDetail").submit();
}
</script>