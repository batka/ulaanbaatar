<?php
	$page_link="$rf/gallery/page/";
	$showcount=5;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;

	$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date from mayor_album";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$allrow=$con->GetDescr("select count(*) from mayor_album where IsShow='YES'");
	$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
	$row=$con->select($qry);
	$rowcount=count($row);
?>
<div class="formcenter">
	<div class="dcontenttitle"><?=$strImageGallery?></div>
	<?php if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/gallery/".$row[$i]['AlbumID']."/photo/";
			if($i%2!=0) $float='right'; else $float='left';
	?>
		<div style="width: 380px; float: <?=$float?>; margin-bottom: 5px;">
			<div class="dcontent" style="height: 150px; position: relative;">
				<div class="descr">
				    <?php
				    	$qry1="select ImageSource from mayor_albumphoto";
				    	$qry1.=" where IsShow='YES'";
				    	$qry1.=" and AlbumID='".$row[$i]['AlbumID']."'";
				    	$qry1.=" order by CreateDate";
				    	$row1=$con->select($qry1);
				    	$rowcount1=count($row1);
				    	if(!empty($row1[0]['ImageSource']) && file_exists("$drf/images/gallery/".$row1[0]['ImageSource'])){
				    ?>
				    	<a href="<?=$link?>" class="descrtitle"><img class="dcontentimg" src="<?=$rf?>/images/gallery/small/<?=$row1[0]['ImageSource']?>" width="140"/></a>
				    <?php }else{?>
				    	<a href="<?=$link?>" class="descrtitle"><img class="dcontentimg" src="<?=$rf?>/images/web/no_image.jpeg" width="140"/></a>
				    <?php }?>
				    <div style="margin-bottom: 3px;">
						<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
					</div>
				    <?=GetStrBr(strip_tags($row[$i]['Descr']), 300);?>
			    	<div class="clear"></div>
				</div>
			    <div class="dcontentbottom" style="position:absolute; float: left; bottom: 5px;">
					<?=$strImageCount.": ".$rowcount1." | ".$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?> 		
	    		</div>
	    	</div>
    	</div>
    <?php if($i%2!=0){?>
    	<div class="clear"></div>
    <?php }}?>
     	<div class="clear"></div>
	<?php 
		require_once 'pagenumber.php';
		}else{?>
    	<div class="notice"><?=$strnotfound?></div>
    <?php }?>
</div>