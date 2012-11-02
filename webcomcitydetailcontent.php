<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_comcity";
	$qry.=" where IsShow='YES'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.ComcityID 
			FROM tbl_comcity T 
			WHERE T.IsShow='YES' 
			ORDER BY CreateDate desc
		) T
		WHERE T.ComcityID='$comcityid'
	";
	$currentcount=$con->GetDescr($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, DATE_FORMAT(T.CreateDate,'%Y-%m-%d') as date";
	$qry.=" from tbl_comcity T";
	$qry.=" where T.IsShow='YES' and T.ComcityID='$comcityid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
				<?php 
					$qry="select T.ComcityID from tbl_comcity T where T.IsShow = 'YES' and T.ComcityID > '".$row1[0]['ComcityID']."' order by T.CreateDate limit 0,1";
					$previd = $con->GetDescr($qry);
					if(empty($previd)) $previd = $con->GetDescr("select T.ComcityID from tbl_comcity T where T.IsShow = 'YES' order by T.CreateDate limit 0,1");
					
					$qry="select T.ComcityID from tbl_comcity T  where T.IsShow = 'YES'  and T.ComcityID < '".$row1[0]['ComcityID']."' order by T.CreateDate desc limit 0,1";
					$nextid = $con->GetDescr($qry);
					if(empty($nextid)) $nextid = $con->GetDescr("select T.ComcityID from tbl_comcity T where T.IsShow = 'YES' order by  T.CreateDate desc limit 0,1");
				?>
					<a href="<?=$rf;?>/comcity/detail/<?=$previd;?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/comcity/detail/<?=$nextid;?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[0]['date'];?></p>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
<?php
		$imagesource=$drf."/files/comcity/medium/".$row1[0]['ImageSource'];
		if (!empty($row1[0]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/comcity/medium/".$row1[0]['ImageSource'];
?>
				<center><img src="<?=$imagesource?>" <?php if($w>420)echo ' width="420" ';?>  style="margin: 0 10px 0 0"/></center>
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