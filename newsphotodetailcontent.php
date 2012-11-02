<link rel="stylesheet" href="<?=$rf;?>/js/jquery/jquery.galleriffic/galleriffic-5.css" type="text/css" />
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.galleriffic/jquery.history.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.galleriffic/jquery.galleriffic.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.galleriffic/jquery.opacityrollover.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#frmPhotoCommentAdd").validate({
			rules: {
				writername:		"required",
				intro:	 		"required",
				securecode:		"required"
				
			},
			messages: {
				writername:		"Нэрээ оруулна уу!",
				intro:			"Сэтгэгдэл оруулна уу!",
				securecode:		"Хамгаалах код оруулна уу!"
			}
		});
	});
</script>
<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_photonews";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.PhotoNewsID 
			FROM tbl_photonews T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.PhotoNewsDate desc, CreateDate desc
		) T
		WHERE T.PhotoNewsID='$photonewsid'
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
		SELECT T.Num, T.PhotoNewsID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.PhotoNewsID 
			FROM tbl_photonews T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.PhotoNewsDate desc, CreateDate desc
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
//	$qry.=" (select count(*) from tbl_photonews where IsShow='YES' and PhotoNewsID <= '$photonewsid') as PhotoNewsCount,";
//	$qry.=" (select PhotoNewsID from tbl_photonews where IsShow='YES' and PhotoNewsID < '$photonewsid' order by PhotoNewsID desc, PhotoNewsDate desc, CreateDate desc limit 1) as PrivPhotoNewsID,";
//	$qry.=" (select PhotoNewsID from tbl_photonews where IsShow='YES' and PhotoNewsID > '$photonewsid' order by PhotoNewsDate desc, CreateDate desc limit 1) as NextPhotoNewsID";
//	$qry.=" from tbl_photonews";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_photonews T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and PhotoNewsID='$photonewsid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/news/photo/detail/<?=$prev['PhotoNewsID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/news/photo/detail/<?=$next['PhotoNewsID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[0]['PhotoNewsDate'];?></p>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
<?php
	$qry="select *";
	$qry.=" from tbl_photonewsimage";
	$qry.=" where IsShow='YES' and PhotoNewsID='$photonewsid'";
	$qry.=" order by ImageID";
	//echo $qry; exit;
	$row3=$con->select($qry);
	$rowcount3=count($row3);
	
	if($rowcount3>0){
?>
			<!-- Start Advanced Gallery Html Containers -->				
				<div class="navigation-container">
					<div id="thumbs" class="navigation">
						<a class="pageLink prev" style="visibility: hidden;" href="#" title="Өмнөх хуудас"></a>
					
						<ul class="thumbs noscript">

<?php 
	$j3=0;
	while ($j3<$rowcount3){
?>






							<li>
<?php 
		$imagesource=$drf."/files/photonews/detail/small/".$row3[$j3]['ImageSource'];
		if (!empty($row3[$j3]['ImageSource']) && file_exists($imagesource)){
			$imagesource=$rf."/files/photonews/detail/xsmall/".$row3[$j3]['ImageSource'];
			$imagesource1=$rf."/files/photonews/detail/small/".$row3[$j3]['ImageSource'];
?>
								<a class="thumb" name="<?=$row3[$j3]['ShowOrder'];?>" href="<?=$imagesource1;?>" title="<?=$row3[$j3]['Title'];?>">
								
									<img src="<?=$imagesource;?>" alt="" />
								</a>
<?php
		}
?>
								<div class="caption">
									<div class="image-title"><?=$row3[$j3]['Title'];?></div>
								</div>
							</li>
<?php 
	$j3++;
	} 
?>
						</ul>
						<a class="pageLink next" style="visibility: hidden;" href="#" title="Дараах хуудас"></a>
					</div>
				</div>
				
				

				
				
				<div id="gallery" class="content">
					<div class="slideshow-container">
						<div id="controls" class="controls"></div>
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
						<div id="caption" class="caption-container">
							<div class="photo-index"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

<?php
	} 
?>
				<div><?=$row1[0]['Descr'];?></div>
				<div class="clear"></div>
			</li>
			<div style="margin: 10px 0px; background: #fff; padding: 5px 10px;">
				<h2 style="border-bottom: 2px solid #ccc">Сэтгэгдэл</h2>
					<div>
						<form action="<?=$rf;?>/process/action/photocommentadd" name="frmPhotoCommentAdd" id="frmPhotoCommentAdd" method="post">
						<input type="hidden" name="photonewsid" id="photonewsid" value="<?=$photonewsid;?>"/>
						<table cellpadding="2" cellspacing="3" width="100%" style="background: #f8f8f8">
						<tr>
							<td></td>
							<td><?php if(!empty($msg)) echo $$msg;?></td>
						</tr>
						<tr>
							<td align="right" valign="top" width="20%">Нэр: <?=$strRequiredField;?></td>
							<td align="left"><input type="text" name="writername" id="writername" size="30" maxlength="30"/></td>
						</tr>
						<tr>
							<td align="right" valign="top">Сэтгэгдэл: <?=$strRequiredField;?></td>
							<td align="left"><textarea name="intro" id="intro" cols="70" rows="3"></textarea></td>
						</tr>
						<tr>
							<td valign="top" align="right">Хамгаалалтын код: <?=$strRequiredField;?></td>
							<td align="left">
								<img id="secureimage" src="<?=$rf;?>/libraries/securimage/securimage_show.php?sid=<?=md5(uniqid(time()));?>" align="absmiddle">
				              	<a href="javascript:" onclick="document.getElementById('secureimage').src = '<?=$rf;?>/libraries/securimage/securimage_show.php?sid=' + Math.random(); return false;" title="Кодыг өөрчлөх"><img src="<?=$rf;?>/images/icon/refresh.png" align="absmiddle"></a>
				                <div style="padding-top:5px"><input type="text" id="securecode" name="securecode" value="" maxlength="10" size="15"></div>
							</td>
						</tr>
						<tr>
							<td align="right"></td>
							<td align="left"><input type="submit" name="bntSend" id="bntSend" value="Илгээх"/></td>
						</tr>
						</table>
						</form>
					</div>
					
<?php
	$qry="select *, DATE_FORMAT(CommentDate, '%Y оны %m-р сар %dнд %H:%s') as CommentDate1";
	$qry.=" from tbl_photonewscomment";
	$qry.=" where IsShow='YES' and PhotoNewsID='$photonewsid'";
	$qry.=" order by CommentDate asc";
	$row2=$con->select($qry);
	$rowcount2=count($row2);
	
	$j2=0;
	while ($j2<$rowcount2){
?>
						<div style="background: #f8f8f8; margin-top: 5px; padding: 10px">
							<div style="float: left; font-size: 24px; font-family: Georgia; color: #33558e; border-right: 1px solid #bbbbaa; padding-right: 5px; margin: 0px 5px"><?=$j2+1;?>.</div>
							<div style="float: left; padding: 3px 5px;">
								<div><span style="color: #999999"><?=$row2[$j2]['CommentDate1'];?>,</span> <span style="color: #0077aa"><?=$row2[$j2]['WriterName'];?>:</span> </div>
								<div class="descr" style="float: left; padding: 3px 0px 0px 0px"><?=nl2br($row2[$j2]['Descr']);?></div>
							</div>
							<div class="clear"></div>		
						</div>
<?php
	$j2++;
	} 
?>
			</div>
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