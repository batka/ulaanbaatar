<?php
	require_once 'libraries/connect.php';
	$con=new Database();
	
	$chairmanid=$_GET['chairmanid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="chairman";
	$chairmanid=$_GET['chairmanid'];
	$listworkid=$_GET['listworkid'];
	
	$row1=$con->select("select left(LastName,1) as lname, FirstName from mayor_chairman where ChairmanID='$chairmanid'");
	$govformname=$row1[0]['lname'].".".$row1[0]['FirstName'];
	
	$con->qryexec("update mayor_directorlistwork set SawCount = SawCount+1 where DirectorListWorkID='$listworkid'");
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenuchairman.php';?></td>
			<td width="600" valign="top">
				<?php
					$qry="select *, DATE_FORMAT(CreateDate,'%Y оны %m-р сарын %d') as date";
					$qry.=" from mayor_directorlistwork";
					$qry.=" where IsShow='YES'";
					$qry.=" and ChairmanID='$chairmanid'";
					$qry.=" and DirectorListWorkID='$listworkid'";
					$row=$con->select($qry);
				?>
				<div class="formcenter">
					<div class="dcontenttitle"><a href="<?=$rf?>/governor/detail/"><?=$govformname?></a> &raquo; <a href="<?=$rf?>/chairman/listwork/<?=$chairmanid?>/"><?=$strchairmanlistwork?></a></div>
					<div style="font-size:11px; color: #3b3b3b; background-color: #eaeaea; padding: 3px; padding-left: 15px;">
					<?php
						$total = $con->GetDescr("select count(*) from mayor_directorlistwork where IsShow = 'YES' and ChairmanID='$chairmanid'");
						$activepage = $con->GetDescr("select count(DirectorListWorkID) from mayor_directorlistwork where IsShow = 'YES' and ChairmanID='$chairmanid' and DirectorListWorkID > '$listworkid'");
					?>
					<div style="float: left;">
					Нийт: <?=$total;?> - <?=$activepage+1;?>
					</div>
						<div style="float: right; margin-right: 10px;">
							<?php 
								$qry="select DirectorListWorkID from mayor_directorlistwork where IsShow = 'YES' and ChairmanID='$chairmanid' and  DirectorListWorkID > '$listworkid' order by CreateDate limit 0,1";
								$previd = $con->GetDescr($qry);
								if(empty($previd)) $previd = $con->GetDescr("select DirectorListWorkID from mayor_directorlistwork where IsShow = 'YES' and ChairmanID='$chairmanid' order by CreateDate limit 0,1");
								
								$qry="select DirectorListWorkID from mayor_directorlistwork where IsShow = 'YES' and ChairmanID='$chairmanid' and DirectorListWorkID < '$listworkid' order by CreateDate desc limit 0,1";
								$nextid = $con->GetDescr($qry);
								if(empty($nextid)) $nextid = $con->GetDescr("select DirectorListWorkID from mayor_directorlistwork where IsShow = 'YES' and ChairmanID='$chairmanid' order by CreateDate desc");
							?>
							<a href="<?=$rf?>/chairman/listwork/<?=$chairmanid?>/detail/<?=$previd;?>/" class="nonestyle">&laquo; Өмнөх</a>
							|
							<a href="<?=$rf?>/chairman/listwork/<?=$chairmanid?>/detail/<?=$nextid;?>/" class="nonestyle">Дараах &raquo;</a>
						</div>
						<div class="clear"></div>
					</div>
					<div class="dcontent">
						<div class="descrtitle"><b><?=$row[0]['Title']?></b></div>
						<div class="descr"><?=$row[0]['Descr']?></div>
						<div class="clear"></div>
					</div>
					<div class="dcontentbottom"><?=$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?></div>
				</div>
			</td>
			<td width="200" valign="top"><?php require_once 'formwebleft.php';?></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>