<?php
	
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_speech";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.SpeechID 
			FROM tbl_speech T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.SpeechDate desc, CreateDate desc
		) T
		WHERE T.SpeechID='$speechid'
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
		SELECT T.Num, T.SpeechID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.SpeechID 
			FROM tbl_speech T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.SpeechDate desc, CreateDate desc
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
//	$qry.=" (select count(*) from tbl_speech where IsShow='YES' and SpeechID <= '$speechid') as SpeechCount,";
//	$qry.=" (select SpeechID from tbl_speech where IsShow='YES' and SpeechID < '$speechid' order by SpeechID desc, SpeechDate desc, CreateDate desc limit 1) as PrivSpeechID,";
//	$qry.=" (select SpeechID from tbl_speech where IsShow='YES' and SpeechID > '$speechid' order by SpeechDate desc, CreateDate desc limit 1) as NextSpeechID";
//	$qry.=" from tbl_speech";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_speech T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and SpeechID='$speechid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/speech/detail/<?=$prev['SpeechID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/speech/detail/<?=$next['SpeechID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[0]['SpeechDate'];?></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
<?php 
		$imagesource=$drf."/files/speech/small/".$row1[0]['ImageSource'];
		if (!empty($row1[0]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/speech/small/".$row1[0]['ImageSource'];
			$stringlong="280"; 
?>
				<img src="<?=$imagesource?>" width="300" style="float: left; margin: 5px 10px 0 0"/>
<?php
		} 
?>
				<div style="font-size: 12px; text-align: justify; line-height: 1.5em"><?=$row1[0]['Descr'];?></div>
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
</div>