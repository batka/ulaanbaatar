<link rel="stylesheet" type="text/css" href="<?=$rf?>/js/jquery/jquery.gallery/style.css" />
<script src="<?=$rf?>/js/jquery/jquery.gallery/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?=$rf?>/js/jquery/jquery.gallery/jquery-galleryview-1.1/jquery.galleryview-1.1.js" type="text/javascript"></script>
<script src="<?=$rf?>/js/jquery/jquery.gallery//jquery-galleryview-1.1/jquery.timers-1.1.2.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#photos').galleryView({
			panel_width: 258,
			panel_height: 258,
			frame_width: 90,
			frame_height: 60
		});
	});
</script>
<div style="margin-top: 10px;">
	<div class="subhd">Бүтээн байгуулалт</div>
	<!--- image gallery--->           	
           	<div id="photos" class="galleryview" style="margin-top: 5px">
<?php
	$qry="select *";
	$qry.=" from tbl_creation";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 0, 10";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			  	<div class="panel" style="overflow: hidden;">
<?php
		$imagesource=$drf."/files/creation/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/creation/small/".$row[$j]['ImageSource']; 
?>
					<img src="<?=$imagesource?>" height="258" />
<?php
		} 
?>
			    	<div class="panel-overlay" style="text-decoration: none;">
			      		<a href="<?=$rf;?>/creation/detail/<?=$row[$j]['CreationID'];?>" ><strong ><?=$row[$j]['Title']?></strong></a>
			   		</div>
			  	</div>
<?php
	$j++;
	} 
?>
			  	<ul class="filmstrip">
<?php
	$j1=0;
	while ($j1<$rowcount){ 
		$imagesource=$drf."/files/creation/small/".$row[$j1]['ImageSource'];
		if (!empty($row[$j1]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/creation/small/".$row[$j1]['ImageSource'];
?>
				    <li><img src="<?=$imagesource;?>" alt="<?=$row[$j1]['Title']?>" /></li>
<?php
		}
	$j1++;
	} 
?>
			  	</ul>
			</div>
</div>