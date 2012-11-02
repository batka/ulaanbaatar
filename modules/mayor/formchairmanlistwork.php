<?php
	
	$row1=$con->select("select left(LastName,1) as lname, FirstName from mayor_chairman where ChairmanID='$chairmanid'");
	$govformname=$row1[0]['lname'].".".$row1[0]['FirstName'];

	$page_link="$rf/chairman/listwork/".$chairmanid."/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
?>

<div class="formcenter">
	<div class="dcontenttitle"><a href="<?=$rf?>/chairman/detail/<?=$chairmanid?>/"><?=$govformname?></a> &raquo; <?=$strchairmanlistwork?></div>
	<?php
		$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
		$qry.=" from mayor_directorlistwork";
		$qry.=" where IsShow='YES'";
		$qry.=" and ChairmanID='$chairmanid'";
		$qry.=" order by CreateDate desc";
		$allrow=$con->GetDescr("select count(*) from mayor_directorlistwork where IsShow='YES' and ChairmanID='$chairmanid'");
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/chairman/listwork/".$row[$i]['ChairmanID']."/detail/".$row[$i]['DirectorListWorkID']."/";
	?>
		<div class="dcontent">
			<div style="margin-bottom: 3px;">
				<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
			</div>
			<div class="descr">
			<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/directorlistwork/".$row[$i]['ImageSource'])){?>
				<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rf?>/images/directorlistwork/small/<?=$row[$i]['ImageSource']?>" width="120"/></a>
			<?php }
			if(!empty($row[$i]['Intro'])){
				echo GetStrBr(strip_tags($row[$i]['Intro']), 300);
			}else{
				echo GetStrBr(strip_tags($row[$i]['Descr']), 300);
			}
			?>
			<div class="clear"></div>
			</div>
			<div class="dcontentbottom">
				<?=$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?>
			</div>
			<a class="morelink" href="<?=$link?>"><?=$strMore?></a>
			<div class="clear"></div>
		</div>
	<?php }
		require_once 'pagenumber.php';
	}else{?>
		<div class="notice"><?=$strnotfound?></div>
	<?php }?>					
</div>