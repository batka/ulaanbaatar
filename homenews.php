<link id="base-css" media="all" type="text/css" href="<?=$rf;?>/js/jquery/yslider/base.css?ver=1" rel="stylesheet">
<link id="theme-css" media="all" type="text/css" href="<?=$rf;?>/js/jquery/yslider/theme.css?ver=1" rel="stylesheet">
<script src="<?=$rf;?>/js/jquery/yslider/jquery.yslider.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#contentslider").accessNews({
		title : false,
		subtitle : false,
		imgHeight : "200px",
		contentHeight : "150px",
		carouselHeight : "90px",
		width : "373",
		speed : "slow",
		slideBy : "3",
		slideShowInterval : 5000,
		slideShowDelay : 1000,
		autoplay : true,
		continuousPaging : true
	});
});
</script>
<div class="hdtitle">&nbsp;&nbsp;Мэдээ, мэдээлэл</div>
<div style="float: left; margin-right: 5px;">	
<ul id="contentslider">
<?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.IsSpecial = 'YES'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 3";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
	<li>
<?php
		$imagesource=$drf."/files/news/medium/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/medium/".$row[$j]['ImageSource'];
?>
		<a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>"><img src="<?=$imagesource;?>" alt="<?=$row[$j]['Title'];?>" width="82" height="40" /></a>
<?php
		} 
?>
		<h3><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "20")?></a></h3>
		<p><?=GetStrBr($row[$j]['Intro'], "300");?> <br /><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" style="text-align: right;">&raquo; <?=$strMore;?></a></p>
	</li>
<?php
	$spec[$j] = $row[$j]['NewsID'];
	$j++;
	} 
?>
</ul>
</div>
<style type="text/css">
/*globalnav*/

ul#globalnav {
	font-size: 11px;
	font-weight: bold;
	position: relative;
	width:100%;
	height: 22px;
	padding:0px;
	margin:0;
	list-style:none;
	line-height:1em;
	border-left:1px solid #e9e9e9;
}

ul#globalnav li {
	float:left;
	padding-top: 1px;
	margin: 0px;
	background-color: #fff;
	border-top:1px solid #e9e9e9;
	border-right:1px solid #e9e9e9;
	list-style: none;
}

ul#globalnav a {
	display:block;
	color:#343434;
	text-decoration:none;
	background:#f0f0f0;
	padding: 5px 8px 5px 8px;
}

ul#globalnav a.here {
	background:#ffffff;
}

ul#globalnav a:active,
ul#globalnav a.here:link,
ul#globalnav a.here:visited {
	background:#ffffff;
}

ul#globalnav a:hover{}

ul#globalnav a.here:link,
ul#globalnav a.here:visited {
	position:relative;
}
</style>
<script type="text/javascript">
	var newstabbefore="news1";
	var newsmenubefore="newstab1";
	var newstab,newsmenu;
	function shownewstab(id){
		newstab="news"+id;
		newsmenu="newstab"+id;
		document.getElementById(newstabbefore).style.display="none";		
		document.getElementById(newstab).style.display="block";

		document.getElementById(newsmenubefore).className="";
		document.getElementById(newsmenu).className="here";		

		newsmenubefore=newsmenu;
		newstabbefore=newstab;
	}

	var newscontabbefore="newscon1";
	var newsconmenubefore="newscontab1";
	var newscontab,newsconmenu;
	function shownewscontab(id){
		newscontab="newscon"+id;
		newsconmenu="newscontab"+id;
		document.getElementById(newscontabbefore).style.display="none";		
		document.getElementById(newscontab).style.display="block";

		document.getElementById(newsconmenubefore).className="";
		document.getElementById(newsconmenu).className="here";		

		newsconmenubefore=newsconmenu;
		newscontabbefore=newscontab;
	}
</script>
<div style="width: 349px; float: right;">
	<ul id="globalnav">
		<li><a style="cursor: pointer;" id="newscontab1" onclick="shownewscontab('1');" class="here">Шинэ</a></li>
		<li><a style="cursor: pointer;" id="newscontab2" onclick="shownewscontab('2');">Хот</a></li>
		<li><a style="cursor: pointer;" id="newscontab3" onclick="shownewscontab('3');">Дүүрэг</a></li>
		<li><a style="cursor: pointer;" id="newscontab4" onclick="shownewscontab('4');">Агентлаг</a></li>
		<li><a style="cursor: pointer;" id="newscontab5" onclick="shownewscontab('5');">ЗАА Байгууллага</a></li>
	</ul>
	<div style="height: 432px; border: 1px solid #e9e9e9;">
		<div id="newscon1" style="display: block; padding: 5px; height: 97.5%; overflow: auto;">		
			<ul style="margin: 0; padding: 0">			
<?php
	$qry="select *";
	$qry.=" from tbl_news";
	$qry.=" where IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and NewsID != '".$spec[2]."'";
	$qry.=" order by NewsDate desc, CreateDate desc";
	$qry.=" limit 0, 8";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
			</ul>
		</div>

		<div id="newscon2" style="display: none; padding: 5px; height: 97.9%; overflow: auto;">
			<ul style="margin: 0; padding: 0">			
<?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
	$qry.=" and OrganClassID='101'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 8";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
			</ul>
		</div>
		<div id="newscon3" style="display: none; padding: 5px; height: 97.9%; overflow: auto;">
			<ul style="margin: 0; padding: 0">			
<?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
	$qry.=" and OrganClassID='102'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 8";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
			</ul>
		</div>
		<div id="newscon4" style="display: none; padding: 5px; height: 97.9%; overflow: auto;">
			<ul style="margin: 0; padding: 0">			
<?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
	$qry.=" and OrganClassID='103'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 8";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
			</ul>
		</div>
		<div id="newscon5" style="display: none; padding: 5px; height: 97.9%; overflow: auto;">
			<ul style="margin: 0; padding: 0">			
<?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
	$qry.=" and OrganClassID='105'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 8";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
			</ul>
		</div>
	</div>
</div>
<div class="clear"></div>
