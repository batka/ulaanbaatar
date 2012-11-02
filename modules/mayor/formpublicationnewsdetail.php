<?php
	$newsid=$_GET['newsid'];
	
	$con->qryexec("update tbl_publicationnews set SawCount = SawCount+1 where  PublicationNewsID='$newsid'");
		
	$qry="select *, DATE_FORMAT(PublicationNewsDate,'%Y оны %m-р сарын %d') as date";
	$qry.=" from tbl_publicationnews";
	$qry.=" where IsShow='YES'";
	$qry.=" and OrganID='$mayororganid'";
	$qry.=" and PublicationNewsID='$newsid'";
	$row=$con->select($qry);
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <a href="<?=$rf?>/news/publicationnews/"><?=$govformtitle;?></a></div></td>
			<td align="right">
			<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 135px;">
			<?php
				$total = $con->GetDescr("select count(*) from tbl_publicationnews where IsShow = 'YES' and OrganID='$mayororganid'");
				$activepage = $con->GetDescr("select count(PublicationNewsID) from tbl_publicationnews where IsShow = 'YES' and OrganID='$mayororganid' and PublicationNewsID > '$newsid'");
			?>
				<div style="float: left;">
					<?php 
						$qry="select PublicationNewsID from tbl_publicationnews where IsShow = 'YES' and OrganID='$mayororganid' and  PublicationNewsID > '$newsid' order by CreateDate limit 0,1";
						$previd = $con->GetDescr($qry);
						if(empty($previd)) $previd = $con->GetDescr("select PublicationNewsID from tbl_publicationnews where IsShow = 'YES' and OrganID='$mayororganid' order by CreateDate limit 0,1");
						
						$qry="select PublicationNewsID from tbl_publicationnews where IsShow = 'YES' and OrganID='$mayororganid' and PublicationNewsID < '$newsid' order by CreateDate desc limit 0,1";
						$nextid = $con->GetDescr($qry);
						if(empty($nextid)) $nextid = $con->GetDescr("select PublicationNewsID from tbl_publicationnews where IsShow = 'YES' and OrganID='$mayororganid' order by CreateDate desc limit 0,1");
					?>
					<a href="<?=$rf?>/news/publicationnews/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
					<a href="<?=$rf?>/news/publicationnews/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
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