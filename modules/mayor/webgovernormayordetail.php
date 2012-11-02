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

	$mayorid=$_GET['mayorid'];
	$govformtitle=$con->GetDescr("select GovernorName".$_SESSION['mayor_lang']." from mayor_governor where GovernorLink='mayors'");
	$con->qryexec("update mayor_director set SawCount = SawCount+1 where DirectorID='$taskid'");
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
					$qry="select *, DATE_FORMAT(CreateDate,'%Y оны %m-р сарын %d') as date, DATE_FORMAT(StartDate,'%Y') as sdate, DATE_FORMAT(EndDate,'%Y') as edate";
					$qry.=" from mayor_director";
					$qry.=" where IsShow='YES'";
					$qry.=" and Mayor='NO'";
					$qry.=" and DirectorID='$mayorid'";
					$row=$con->select($qry);
				?>
				<div class="formcenter">
					<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
						<td><div class=pageformtitle><a href="<?=$rf?>/governor/mayors/"><?=$govformtitle;?></a></div></td>
							<td align="right">
							<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
							<?php
								$total = $con->GetDescr("select count(*) from mayor_director where IsShow = 'YES' and Mayor='NO'");
								$activepage = $con->GetDescr("select count(DirectorID) from mayor_director where IsShow = 'YES' and Mayor='NO' and DirectorID > '$mayorid'");
							?>						
								<div style="float: left;">
									Нийт: <?=$total;?> - <?=$activepage+1;?>
								</div>
								<div style="float: right;">
									<?php 
										$qry="select DirectorID from mayor_director where IsShow = 'YES' and Mayor='NO' and  DirectorID > '$mayorid' order by StartDate, CreateDate limit 0,1";
										$previd = $con->GetDescr($qry);
										if(empty($previd)) $previd = $con->GetDescr("select DirectorID from mayor_director where IsShow = 'YES' and Mayor='NO' order by StartDate, CreateDate limit 0,1");
										
										$qry="select DirectorID from mayor_director where IsShow = 'YES' and Mayor='NO' and DirectorID < '$mayorid' order by StartDate desc, CreateDate desc limit 0,1";
										$nextid = $con->GetDescr($qry);
										if(empty($nextid)) $nextid = $con->GetDescr("select DirectorID from mayor_director where IsShow = 'YES' and Mayor='NO' order by StartDate desc, CreateDate desc limit 0,1");
									?>
									<a href="<?=$rf?>/governor/mayors/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
									<a href="<?=$rf?>/governor/mayors/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
								</div>	
								<div class="clear"></div>
							</div>
							</td>
						</tr>
						<tr>
					<td colspan="2">
					<div class="pageform">
						<div class="descrtitle"><b><?=$row[0]['Title']?> (<?=$row[0]['sdate']?>-<?=$row[0]['edate']?>)</b></div>
						<div class="descr">
						<?php if(!empty($row[0]['ImageSource']) && file_exists("$drf/images/director/".$row[0]['ImageSource'])){?>
							<img src="<?=$rf?>/images/director/<?=$row[0]['ImageSource']?>" width="190" style="float: left; border: 1px solid #dddddd; padding: 2px;">
						<?php }?>
							<?=$row[0]['Descr']?>
						</div>
						<div class="clear"></div>
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