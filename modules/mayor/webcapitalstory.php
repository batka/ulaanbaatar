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

	$page_link="$rf/capital/story/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
	
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenucapital.php';?></td>
			<td width="600" valign="top">
				<div class="formcenter">
					<div class="dcontenttitle"><?=$noticetitle?></div>
					<?php
						$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
						$qry.=" from mayor_capitalstory";
						$qry.=" where IsShow='YES'";
						$qry.=" order by CreateDate desc";
						$allrow=$con->GetDescr("select count(*) from mayor_capitalstory where IsShow='YES'");
						$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
						$row=$con->select($qry);
						$rowcount=count($row);
						if($rowcount>0){
						for($i=0; $i<$rowcount; $i++){
							$link="$rf/capital/story/detail/".$row[$i]['CapitalStoryID']."/";
					?>
						<div class="dcontent">
							<div style="margin-bottom: 3px;">
								<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
							</div>
							<div class="descr">
							<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/capital/capstory/".$row[$i]['ImageSource'])){?>
								<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rf?>/images/capital/capstory/small/<?=$row[$i]['ImageSource']?>" height="120"/></a>
							<?php }
							if(!empty($row[$i]['Intro'])){
								echo strip_tags(GetStrBr($row[$i]['Intro'], 400));
							}else{
								echo strip_tags(GetStrBr($row[$i]['Descr'], 400));
							}
							?>
							<div class="clear"></div>
							</div>
							<div class="dcontentbottom">
								<?=$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?> 
								<a class="morelink" href="<?=$link?>"><?=$strMore?></a>
							</div>
						</div>
					<?php }
						require_once 'pagenumber.php';
					}else{?>
						<div class="notice"><?=$strnotfound?></div>
					<?php }?>					
				</div>
			</td>
			<td width="200" valign="top"></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>