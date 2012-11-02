<link id="base-css" media="all" type="text/css" href="<?=$rf;?>/js/jquery/jcausel/stylesheet.css" rel="stylesheet">
<script src="<?=$rf;?>/js/jquery/jcausel/carousel.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.infiniteCarousel').infiniteCarousel();
	});
</script>

<div class="infiniteCarousel">
  <div style="overflow: hidden;" id="flickrgallery">
    <ul>
<?php
	$qry=" select T.*";
	$qry.=" from tbl_photonews T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" order by PhotoNewsDate desc";
	$qry.=" limit 20";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
		$imagesource=$drf."/files/photonews/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/photonews/xsmall/".$row[$j]['ImageSource']; 
?>
      <li><a href="<?=$rf;?>/news/photo/detail/<?=$row[$j]['PhotoNewsID'];?>" title="<?=$row[$j]['Title'];?>"><img src="<?=$imagesource;?>"/></a></li>
<?php
		}
	$j++;
	} 
?>
    </ul>
  </div>
</div> 