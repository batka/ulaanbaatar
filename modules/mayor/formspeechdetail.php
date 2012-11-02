<?php
	$newsid=$_GET['newsid'];
	$con->qryexec("update tbl_speech set SawCount = SawCount+1 where SpeechID='$newsid'");
	
	$qry="select T.*, DATE_FORMAT(T.SpeechDate,'%Y оны %m-р сарын %d') as date";
	$qry.=" from tbl_speech T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.OrganID='".MAYORID."'";
	$qry.=" and T.SpeechID='$newsid'";
	$row=$con->select($qry);
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <a href="<?=$rf?>/news/speech/"><?=$govformtitle;?></a></div></td>
			<td align="right">
			<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
			<?php
				$total = $con->GetDescr("SELECT count(*) FROM tbl_speech T WHERE T.IsShow='YES' AND T.OrganID='".MAYORID."'");
				$activepage = $con->GetDescr("select count(T.SpeechID) from tbl_speech T where T.IsShow = 'YES' and T.OrganID='".MAYORID."' and T.SpeechID > '$newsid'");
			?>
				<div style="float: left;">
					<?php 
						$qry="select T.SpeechID from tbl_speech T where T.IsShow = 'YES' and  T.OrganID='".MAYORID."' and  T.SpeechID > '$newsid' order by T.CreateDate limit 0,1";
						$previd = $con->GetDescr($qry);
						if(empty($previd)) $previd = $con->GetDescr("select T.SpeechID from tbl_speech T where T.IsShow = 'YES' and  T.OrganID='".MAYORID."' order by T.CreateDate limit 0,1");
						
						$qry="select T.SpeechID from tbl_speech T where T.IsShow = 'YES' and  T.OrganID='".MAYORID."' and T.SpeechID < '$newsid' order by  T.CreateDate desc limit 0,1";
						$nextid = $con->GetDescr($qry);
						if(empty($nextid)) $nextid = $con->GetDescr("select T.SpeechID from tbl_speech T where T.IsShow = 'YES' and T.OrganID='".MAYORID."' order by  T.CreateDate desc limit 0,1");
					?>
					<a href="<?=$rf?>/news/speech/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
					<a href="<?=$rf?>/news/speech/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
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
				<div class="descrtitle"><?=$row[0]['Title']?></div>
				<div class="descr"><?=str_replace("/files/editor", "$rfub/files/editor", $row[0]['Descr'])?></div>
				<div class="clear"></div>
			</div>
			<div class="dcontentbottom"><?=$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?></div>
			</div>
		</td>
	</tr>
	</table>
</div>