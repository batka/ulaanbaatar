<?php
	$newsid=$_GET['newsid'];
	
	$con->qryexec("update tbl_videonews set SawCount = SawCount+1 where VideoNewsID='$newsid'");
		
	$qry="select *, DATE_FORMAT(VideoNewsDate,'%Y оны %m-р сарын %d') as date";
	$qry.=" from tbl_videonews";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID='$mayororganid'";
	$qry.=" and VideoNewsID='$newsid'";
	$row=$con->select($qry);
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <a href="<?=$rf?>/news/videonews/"><?=$govformtitle;?></a></div></td>
			<td align="right">
			<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
			<?php
				$total = $con->GetDescr("select count(*) from tbl_videonews where IsShow = 'YES' and OrganID='$mayororganid'");
				$activepage = $con->GetDescr("select count(VideoNewsID) from tbl_videonews where IsShow = 'YES' and OrganID='$mayororganid' and VideoNewsID > '$newsid'");
			?>
				<div style="float: left;">
					<?php 
						$qry="select VideoNewsID from tbl_videonews where IsShow = 'YES' and OrganID='$mayororganid' and  VideoNewsID > '$newsid' order by VideoNewsDate limit 0,1";
						$previd = $con->GetDescr($qry);
						if(empty($previd)) $previd = $con->GetDescr("select VideoNewsID from tbl_videonews where IsShow = 'YES' and OrganID='$mayororganid' order by VideoNewsDate limit 0,1");
						
						$qry="select VideoNewsID from tbl_videonews where IsShow = 'YES' and OrganID='$mayororganid' and VideoNewsID < '$newsid' order by VideoNewsDate desc limit 0,1";
						$nextid = $con->GetDescr($qry);
						if(empty($nextid)) $nextid = $con->GetDescr("select VideoNewsID from tbl_videonews where IsShow = 'YES' and OrganID='$mayororganid' order by VideoNewsDate desc limit 0,1");
					?>
					<a href="<?=$rf?>/news/videonews/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
					<a href="<?=$rf?>/news/videonews/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
				</div>							
				<div style="float: right;">
					Нийт: <?=$total;?> - <?=$activepage+1;?>
				</div>
				<div class="clear"></div>
			</div>
			</td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
	<div class="dcontent">
		<?php if(!empty($row[0]['FileSource']) && file_exists("$drfo/files/videonews/".$row[$i]['FileSource'])){?>
			<center><div id="player">
	 			<a class="bluelink" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" target="_blank">
					<!--Get the Adobe Flash Player to see this video.-->
				    Видео, дүрс бичлэгийг үзэхийн тулд Adobe Flash Player програмын шинэ хувилбарыг ЭНД дарж, татаж аван суулгах хэрэгтэй!
			    </a>
			</div></center>
			<script type="text/javascript">
				var so = new SWFObject('<?=$rfo;?>/mediaplayer/player.swf', 'ply', '550', '400', '9.0.124');
				so.addParam('allowscriptaccess', 'always');
				so.addParam('allowfullscreen', 'true');
				//so.addParam('quality', 'high');
				so.addParam('wmode', 'transparent');
				so.addVariable('file', 'http://ulaanbaatar.mn/files/videos/<?=$row[0]['FileSource'];?>');
				so.addVariable('image','');
				so.addVariable('backcolor', '212121');
				so.addVariable('frontcolor', 'ffffff');
				so.addVariable('lightcolor', '666666');
				so.addVariable('playlistsize', '93');
				so.addVariable('bufferlength', '5');
				so.addVariable('volume', '80');
				so.addVariable('controlbar', 'over');
				so.addVariable('autostart', 'false');
				so.addVariable('stretching', 'exactfit');
				so.addVariable('repeat', 'list');
				//so.addVariable("image", encodeURIComponent("get_thumb.php?objectid=411&imgonly&big&file=file.jpg"));
				so.addVariable('skin', '<?=$rf;?>/mediaplayer/skins/snel.swf');
				so.write('player');
			</script>			
		<?php }?>		
		<div class="descrtitle" style="margin-top: 10px;"><?=$row[0]['Title']?></div>
		<div class="descr"><?=$row[0]['Descr']?></div>
		<div class="clear"></div>
	</div>
	<div class="dcontentbottom"><?=$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?></div>
	</div>
	</td>
	</tr>
	</table>
</div>