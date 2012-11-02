<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="capital";
	$noticetitle=$con->GetDescr("select CapitalName".$_SESSION['mayor_lang']." from mayor_capital where CapitalLink='story'");

	$storyid=$_GET['storyid'];
	$con->qryexec("update mayor_capitalstory set SawCount = SawCount+1 where CapitalStoryID='$storyid'");
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenucapital.php';?></td>
			<td width="600" valign="top">
				<?php
					$qry="select *, DATE_FORMAT(CreateDate,'%Y оны %m-р сарын %d') as date";
					$qry.=" from mayor_capitalstory";
					$qry.=" where IsShow='YES'";
					$qry.=" and CapitalStoryID='$storyid'";
					$row=$con->select($qry);
				?>
				<div class="formcenter">
					<div class="dcontenttitle"><a href="<?=$rf?>/capital/story/"><?=$noticetitle?></a> &raquo; <?=GetStrBr($row[0]['Title'], 50)?></div>
					<div style="font-size:12px; color: #3b3b3b; background-color: #eaeaea; padding: 3px; padding-left: 15px;">
					<?php
						$total = $con->GetDescr("select count(*) from mayor_capitalstory where IsShow = 'YES'");
						$activepage = $con->GetDescr("select count(CapitalStoryID) from mayor_capitalstory where IsShow = 'YES' and CapitalStoryID > '$storyid'");
					?>
					Нийт: <?=$total;?> - <?=$activepage+1;?>
					<div style="float: right; margin-right: 10px;">
						<?php 
							$qry="select CapitalStoryID from mayor_capitalstory where IsShow = 'YES' and  CapitalStoryID > '$storyid' order by CreateDate limit 0,1";
							$previd = $con->GetDescr($qry);
							if(empty($previd)) $previd = $con->GetDescr("select CapitalStoryID from mayor_capitalstory where IsShow = 'YES' order by CreateDate limit 0,1");
							
							$qry="select CapitalStoryID from mayor_capitalstory where IsShow = 'YES' and CapitalStoryID < '$storyid' order by CreateDate desc limit 0,1";
							$nextid = $con->GetDescr($qry);
							if(empty($nextid)) $nextid = $con->GetDescr("select CapitalStoryID from mayor_capitalstory where IsShow = 'YES' order by CreateDate desc");
						?>
						<a href="<?=$rf?>/capital/story/detail/<?=$previd;?>/" class="nonestyle">Өмнөх</a>
						|
						<a href="<?=$rf?>/capital/story/detail/<?=$nextid;?>/" class="nonestyle">Дараах</a>
					</div>
					</div>
					<div class="dcontent">
						<div class="descr"><?=$row[0]['Descr']?></div>
						<div class="clear"></div>
					</div>
					<div class="dcontentbottom"><?=$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?></div>
				</div>
			</td>
			<td width="200" valign="top"></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>