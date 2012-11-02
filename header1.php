<style type="text/css" media="screen, projection">
#ticker	{
	position: relative;
}
#ticker .cursor {
	display: inline-block; 
	background: #565c61; 
	width: 0.6em; 
	height: 1em; 
	text-align: center;
}
#ticker p{
	margin-bottom: 0.8em;
}
#ticker code {
	margin: 0.4em 0.4em; 
	display: block;
}
#ticker .next {
	position: absolute;
	bottom: 1em;
}
</style>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.animated.innerfade.js"></script>
<script src="<?=$rf;?>/js/jquery/jquery.jticker/jquery.jticker.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#ticker").ticker({
	 		cursorList:  " ",
	 		rate:        10,
	 		delay:       4000
		}).trigger("play").trigger("play"); 
		jQuery("#ticker").trigger("play");	
  	});
  	
	$(document).ready(
		function(){
			$('ul#animated-panorama').animatedinnerfade({
				speed: 2000,
				timeout: 15000,
				type: 'sequence',
				containerheight: '70px',
				containerwidth: '798px',
				animationSpeed: 30000,
				animationtype: 'fade',
	            controlBox: 'none',
				controlBoxClass: 'mycontrolboxclass',
                controlButtonsPath: 'img',
    	        displayTitle: 'yes' 
			});
	
			$('ul#animated-portfolio').animatedinnerfade({
				speed: 5000,
				timeout: 15000,
				type: 'random',
				containerheight: '300px',
				containerwidth: '270px',
				animationSpeed: 30000,
				animationtype: 'fade',
				bgFrame: 'none',
				controlBox: 'none',
				displayTitle: 'none'
			});
	});
</script>
<div class="hdmenu"><?php require_once 'menu.php';?></div>
<div class="hdlogo"><a href="<?=$rf;?>/home"><img src="<?=$rf;?>/images/web/logo.png"/></a></div>

<div class="hdmap">
	<ul id="animated-panorama">
<?php
	$qry="select Title, ImageSource";
	$qry.=" from capital_header";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row); 
	
	$j=0;
	while ($j<$rowcount){
		$imagesource=$drf."/files/header/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/header/small/".$row[$j]['ImageSource'];
?>
		<li>
			<img src="<?=$imagesource;?>" alt="" title=""/>
		</li>
<?php
		}
	$j++;
	} 
?>
	</ul>
</div>
<div class="clear"></div>
<div class="rdhd1"><a href="<?=$rf;?>/" ><img src="<?=$rf;?>/images/web/home.png"/>НҮҮР</a></div>
<div class="rdhd">
	 <div id="ticker" style="padding-left: 5px">
<?php
	$qry="select NewsID, Title, NewsDate"; 
	$qry.=" from tbl_news";
	$qry.=" where IsShow='YES'";
	//$qry.=" and NewsDate=DATE_FORMAT(NOW(), '%Y-%m-%d')";
	$qry.=" order by NewsDate desc, CreateDate desc";
	$qry.=" limit 50";
	//echo $qry; exit;
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
	    <div><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>"><?=GetStrBr($row[$j]['Title'], "100");?>. [<?=$row[$j]['NewsDate'];?>]</a></div>
<?php
	$j++;
	} 
?>
	</div>
</div>
<div class="blhd"><strong>Өнөөдөр:</strong> <?=GetFullDate($con).", ".GetWeekDayName($con);?></div>
<div id="rightlogo"></div>