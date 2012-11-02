<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="governor";

	$taskid=$_GET['taskid'];
	$govformname=$con->GetDescr("select GovernorName".$_SESSION['mayor_lang']." from mayor_governor where GovernorLink='detail'");
	$govformtitle=$con->GetDescr("select GovernorName".$_SESSION['mayor_lang']." from mayor_governor where GovernorLink='task'");
	$con->qryexec("update mayor_directortask set SawCount = SawCount+1 where DirectorTaskID='$taskid'");
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenugovernor.php';?></td>
			<td width="600" valign="top">
				<?php
					$qry="select *, DATE_FORMAT(CreateDate,'%Y оны %m-р сарын %d') as date";
					$qry.=" from mayor_directortask";
					$qry.=" where IsShow='YES'";
					$qry.=" and Mayor='YES'";
					$qry.=" and DirectorTaskID='$taskid'";
					$row=$con->select($qry);
				?>
				<div class="formcenter">
				<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
					<td><div class=pageformtitle><a href="<?=$rf?>/governor/detail/"><?=$govformname?></a> &raquo; <a href="<?=$rf?>/governor/task/"><?=$govformtitle;?></a></div></td>
						<td align="right">
						<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
						<?php
							$total = $con->GetDescr("select count(*) from mayor_directortask where IsShow = 'YES' and Mayor='YES'");
							$activepage = $con->GetDescr("select count(DirectorTaskID) from mayor_directortask where IsShow = 'YES' and Mayor='YES' and DirectorTaskID > '$taskid'");
						?>						
							<div style="float: left;">
								Нийт: <?=$total;?> - <?=$activepage+1;?>
							</div>
							<div style="float: right;">
								<?php 
									$qry="select DirectorTaskID from mayor_directortask where IsShow = 'YES' and Mayor='YES' and  DirectorTaskID > '$taskid' order by CreateDate limit 0,1";
									$previd = $con->GetDescr($qry);
									if(empty($previd)) $previd = $con->GetDescr("select DirectorTaskID from mayor_directortask where IsShow = 'YES' and Mayor='YES' order by CreateDate limit 0,1");
									
									$qry="select DirectorTaskID from mayor_directortask where IsShow = 'YES' and Mayor='YES' and DirectorTaskID < '$taskid' order by CreateDate desc limit 0,1";
									$nextid = $con->GetDescr($qry);
									if(empty($nextid)) $nextid = $con->GetDescr("select DirectorTaskID from mayor_directortask where IsShow = 'YES' and Mayor='YES' order by CreateDate desc");
								?>
								<a href="<?=$rf?>/governor/task/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
								<a href="<?=$rf?>/governor/task/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
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
			</td>
			<td width="200" valign="top"><?php require_once 'formwebleft.php';?></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>