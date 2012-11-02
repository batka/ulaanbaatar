<script type="text/javascript">
	$(document).ready(function(){
		$("#frmVideoCommentAdd").validate({
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
	$qry.=" from tbl_videonews";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID = '$organid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.VideoNewsID 
			FROM tbl_videonews T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.VideoNewsDate desc, CreateDate desc
		) T
		WHERE T.VideoNewsID='$videonewsid'
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
		SELECT T.Num, T.VideoNewsID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.VideoNewsID 
			FROM tbl_videonews T 
			WHERE T.IsShow='YES' 
			AND T.OrganID='$organid' 
			ORDER BY T.VideoNewsDate desc, CreateDate desc
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
//	$qry.=" (select count(*) from tbl_videonews where IsShow='YES' and VideoNewsID <= '$videonewsid') as VideoNewsCount,";
//	$qry.=" (select VideoNewsID from tbl_videonews where IsShow='YES' and VideoNewsID < '$videonewsid' order by VideoNewsID desc, VideoNewsDate desc, CreateDate desc limit 1) as PrivVideoNewsID,";
//	$qry.=" (select VideoNewsID from tbl_videonews where IsShow='YES' and VideoNewsID > '$videonewsid' order by VideoNewsDate desc, CreateDate desc limit 1) as NextVideoNewsID";
//	$qry.=" from tbl_videonews";
//	$qry.=" where IsShow='YES'";
//	//echo $qry; exit;
//	$row=$con->select($qry);
?>
	<div class="listbg">
<?php
	$qry="select T.*, OrganName";
	$qry.=" from tbl_videonews T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and VideoNewsID='$videonewsid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/news/video/detail/<?=$prev['VideoNewsID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/news/video/detail/<?=$next['VideoNewsID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[0]['VideoNewsDate'];?></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
		$imagesource=$drf."/files/videos/small/".$row1[0]['ImageSource'];
		if (!empty($row1[0]['ImageSource']) && file_exists($imagesource)){
			$imagesource=$rf."/files/videos/small/".$row1[0]['ImageSource'];
		} 
?>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
<?php if (!empty($row1[0]['FileSource']) && file_exists($drf."/files/videos/".$row1[0]['FileSource'])){?>
<div id="player" style="margin-top: 10px; text-align: center;">
	<div align="center">
    <a class="bluelink" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" target="_blank">
	<!--Get the Adobe Flash Player to see this video.-->
    Видео, дүрс бичлэгийг үзэхийн тулд Adobe Flash Player програмын шинэ хувилбарыг ЭНД дарж, татаж аван суулгах хэрэгтэй!
    </a></div>
</div>
<script type="text/javascript">
	var so = new SWFObject('<?=$rf;?>/mediaplayer/player.swf', 'ply', '600', '400', '9.0.124');
	so.addParam('allowscriptaccess', 'always');
	so.addParam('allowfullscreen', 'false');
	//so.addParam('quality', 'high');
	so.addParam('wmode', 'transparent');
	so.addVariable('file', '<?=$rf?>/files/videos/<?=$row1[0]['FileSource']?>');
	so.addVariable('image', '<?=$imagesource;?>');
	so.addVariable('backcolor', '212121');
	so.addVariable('frontcolor', 'ffffff');
	so.addVariable('lightcolor', '666666');
	so.addVariable('bufferlength', '5');
	so.addVariable('volume', '80');
	so.addVariable('controlbar', 'over');
	so.addVariable('autostart', 'false');
	so.addVariable('stretching', 'exactfit');
	so.addVariable('repeat', 'list');
	so.addVariable('skin', '<?=$rf;?>/mediaplayer/skins/modieus.swf');
	so.write('player');
</script>
<?php }?>
				<div><?=$row1[0]['Descr'];?></div>
				<div class="clear"></div>
				<div class="clearfloats"></div>
			</li>
			<div style="margin: 10px 0px; background: #fff; padding: 5px 10px;">
				<h2 style="border-bottom: 2px solid #ccc">Сэтгэгдэл</h2>
					<div>
						<form action="<?=$rf;?>/process/action/videocommentadd" name="frmVideoCommentAdd" id="frmVideoCommentAdd" method="post">
						<input type="hidden" name="videonewsid" id="videonewsid" value="<?=$videonewsid;?>"/>
						<table cellpadding="2" cellspacing="3" width="100%" style="background: #f8f8f8">
						<tr>
							<td></td>
							<td><?php if(!empty($msg)) echo $msg;?></td>
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
	$qry.=" from tbl_videonewscomment";
	$qry.=" where IsShow='YES' and VideoNewsID='$videonewsid'";
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