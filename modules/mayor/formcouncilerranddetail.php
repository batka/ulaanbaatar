<?php
	$newsid=$_GET['newsid'];
	
	$con->qryexec("update mayor_errand set SawCount = SawCount+1 where ErrandID='$newsid'");
	
	$qry="select T.*, DATE_FORMAT(T.ErrandDate,'%Y оны %m-р сарын %d') as date";
	$qry.=" from mayor_errand T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ErrandID='$newsid'";
	$row=$con->select($qry);
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
					<td><div class=pageformtitle><?=$menutitle?> &raquo; <a href="<?=$rf?>/council/errand/"><?=$govformtitle;?></a></div></td>
						<td align="right">
						<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
						<?php
							$total = $con->GetDescr("SELECT count(*) FROM mayor_errand T WHERE T.IsShow='YES'");
							$activepage = $con->GetDescr("select count(T.ErrandID) from mayor_errand T where T.IsShow = 'YES' and T.ErrandID < '$newsid'");
						?>
							<div style="float: left;">
								<?php 
									$qry="select T.ErrandID from mayor_errand T where T.IsShow = 'YES' and  T.ErrandID < '$newsid' order by T.ErrandDate desc, T.CreateDate desc limit 0,1";
									$previd = $con->GetDescr($qry);
									if(empty($previd)) $previd = $con->GetDescr("select T.ErrandID from mayor_errand T where T.IsShow = 'YES' order by T.ErrandDate desc, T.CreateDate desc limit 0,1");
									
									$qry="select T.ErrandID from mayor_errand T where T.IsShow = 'YES' and T.ErrandID > '$newsid' order by T.ErrandDate, T.CreateDate limit 0,1";
									$nextid = $con->GetDescr($qry);
									if(empty($nextid)) $nextid = $con->GetDescr("select T.ErrandID from mayor_errand T where T.IsShow = 'YES' order by T.ErrandDate, T.CreateDate limit 0,1");
								?>
								<a href="<?=$rf?>/council/errand/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
								<a href="<?=$rf?>/council/errand/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
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
		<div class="descr"><?=$row[0]['Descr']?></div>
		<div class="clear"></div>
	</div>
	<div class="dcontentbottom"><?=$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?></div>
	</div>
	</td>
	</tr>
	</table>
</div>