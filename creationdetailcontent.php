<script type="text/javascript">
	$(document).ready(function(){
		$('#photos').galleryView({
			panel_width: 850,
			panel_height: 500,
			frame_width: 90,
			frame_height: 60
		});
	});
</script>
<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_creation";
	$qry.=" where IsShow='YES'";
	$qry.=" and CreationClassID = '$creationclassid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.CreationID 
			FROM tbl_creation T 
			WHERE T.IsShow='YES' 
			AND T.CreationClassID='$creationclassid' 
			ORDER BY CreationDate desc
		) T
		WHERE T.CreationID='$creationid'
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
		SELECT T.Num, T.CreationID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.CreationID 
			FROM tbl_creation T 
			WHERE T.IsShow='YES' 
			AND T.CreationClassID='$creationclassid' 
			ORDER BY CreationDate desc
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
//	$qry.=" (select count(*) from tbl_creation where IsShow='YES' and CreationID <= '$creationid') as CreationCount,";
//	$qry.=" (select CreationID from tbl_creation where IsShow='YES' and CreationID < '$creationid' order by CreationID desc, CreateDate desc limit 1) as PrivCreationID,";
//	$qry.=" (select CreationID from tbl_creation where IsShow='YES' and CreationID > '$creationid' order by CreateDate desc limit 1) as NextCreationID";
//	$qry.=" from tbl_creation";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, CreationClassName, OrganName, DATE_FORMAT(StartDate, '%Y.%m.%d') as StartDate, DATE_FORMAT(EndDate, '%Y.%m.%d') as EndDate";
	$qry.=" from tbl_creation T";
	$qry.=" left join ref_creationclass NC on T.CreationClassID=NC.CreationClassID";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and T.CreationID='$creationid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 3px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> - <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/creation/detail/<?=$prev['CreationID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/creation/detail/<?=$next['CreationID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr">
				<p class="pmdate">Хугацаа: <?=$row1[0]['StartDate'];?> - <?=$row1[0]['EndDate'];?></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
				<!--- image gallery--->           	
           	<div id="photos" class="galleryview" style="margin-top: 5px;" >
<?php
	$qry="select *";
	$qry.=" from tbl_creationimage";
	$qry.=" where IsShow='YES' and CreationID='$creationid'";
	$qry.=" order by ShowOrder";
	$row2=$con->select($qry);
	$rowcount2=count($row2);
	
	$j2=0;
	while ($j2<$rowcount2){
?>
			  	<div class="panel" >
<?php
		$imagesource=$drf."/files/creation/detail/".$row2[$j2]['ImageSource'];
		if (!empty($row2[$j2]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/creation/detail/".$row2[$j2]['ImageSource']; 
?>
					<img src="<?=$imagesource?>" width="100%" height="100%"/>
<?php
		} 
?>
			    	<div class="panel-overlay">
			      		<h2 style="font-size: 12px; text-align: left;"><?=$row2[$j2]['Title']?></h2>
			   		</div>
			  	</div>
<?php
	$j2++;
	} 
?>
			  	<ul class="filmstrip" >
<?php
	$j3=0;
	while ($j3<$rowcount2){ 
		$imagesource=$drf."/files/creation/detail/xsmall/".$row2[$j3]['ImageSource'];
		if (!empty($row2[$j3]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/creation/detail/xsmall/".$row2[$j3]['ImageSource'];
?>
				    <li><img src="<?=$imagesource;?>" alt="<?=$row2[$j3]['Title']?>" /></li>
<?php
		}
	$j3++;
	} 
?>
			  	</ul>
			</div>
				<div style="margin-top: 10px"><?=$row1[0]['Descr'];?></div>
				<div class="clear"></div>
			</li>
<?php
	} else {
?>
			<div style="text-align: center; padding: 5px"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</ul>
	</div>
</div>