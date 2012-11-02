<?php
	$title = $service[0]['Title'];
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_service";
	$qry.=" where IsShow='YES'";
	$qry.=" and ServiceClassID = '$serviceclassid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.ServiceID 
			FROM tbl_service T 
			WHERE T.IsShow='YES' 
			AND T.ServiceClassID='$serviceclassid' 
			ORDER BY LOWER(CONVERT(T.Title USING utf8))
		) T
		WHERE T.ServiceID='$serviceid'
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
		SELECT T.Num, T.ServiceID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.ServiceID 
			FROM tbl_service T 
			WHERE T.IsShow='YES' 
			AND T.ServiceClassID='$serviceclassid' 
			ORDER BY LOWER(CONVERT(T.Title USING utf8))
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
	
	//echo $qry; exit;
	$row=$con->select($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, ServiceClassName, OrganName, DATE_FORMAT(T.CreateDate, '%Y-%m-%d') as ServiceDate";
	$qry.=" from tbl_service T";
	$qry.=" left join ref_serviceclass NC on T.ServiceClassID=NC.ServiceClassID";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and ServiceID='$serviceid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/service/detail/<?=$prev['ServiceID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/service/detail/<?=$next['ServiceID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			
			
			
			<li class="topbrdr3">
				<p class="pmdate" style="float:right;">Огноо: <?=$row1[0]['ServiceDate'];?></p>
				
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
		$imagesource=$drf."/files/service/small/".$row1[0]['ImageSource'];
		if (!empty($row1[0]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/service/small/".$row1[0]['ImageSource'];
			$stringlong="280"; 
?>
				<img src="<?=$imagesource?>" width="300" style="float: left; margin: 5px 10px 0 0"/>
<?php
		} 
?>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
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
			<div class="clearfloats"></div>
		</ul>
	</div>
</div>