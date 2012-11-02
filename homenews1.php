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
		$isshowpage="";
		$showpagestep=10;
	
		$showcount=$_POST['showcount'];
		if(empty($showcount)){
			$showcount=10;
			$_SESSION['uni_showcountselect']=$showcount;
		} else $_SESSION['uni_showcountselect']=$showcount;
		$showpagecount=7;
		
		$qrywhr =" where T.IsShow='YES'";
		if(!empty($forumclassid))$qrywhr.=" and T.ForumClassID='$forumclassid'";
		if(!empty($forumtopictype)) $qrywhr.=" and T.ForumTopicType='$forumtopictype'";
	
		$qry="select CEILING(count(*)/$showcount), count(*)";
		$qry.=" from tbl_forumtopic T";
		$qry.=$qrywhr;
		$row=$con->select($qry);
		$pagecount=$row[0][0];
		$rowcount=$row[0][1];
		
		if(empty($_GET['activepage']) || $_GET['activepage']==0) $activepage=1;
		else $activepage=$_GET['activepage'];
		$startrow=($activepage-1)*$showcount;
		if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
		
		$qry="select T.*,";
		$qry.=" DATE_FORMAT(T.CreateDate, '%H:%i, %Y оны %m-р сарын %d') as ForumTopicDate1,";
		$qry.=" IF(DATEDIFF(NOW(),T.CreateDate)<=7,1,0) as IsNew,";
		$qry.=" ifnull(WorthCount,0) as WorthCount, ifnull(NoWorthCount,0) as NoWorthCount";
		$qry.=" from tbl_forumtopic T";
		$qry.=" left join (select ForumTopicID, count(*) as WorthCount from tbl_forumtopicrate where RatingType='worth' group by ForumTopicID) FTR1 on T.ForumTopicID=FTR1.ForumTopicID";
		$qry.=" left join (select ForumTopicID, count(*) as NoWorthCount from tbl_forumtopicrate where RatingType='noworth' group by ForumTopicID) FTR2 on T.ForumTopicID=FTR2.ForumTopicID";
		$qry.=$qrywhr;
		$qry.=" group by T.ForumTopicID";
		$qry.=" order by T.CreateDate desc";
		$qry.=" limit $startrow, $showcount";
		$row=$con->select($qry);
		$rowcountpage=count($row);
		if($rowcountpage<1){
			$msg="Одоохондоо сэдэв оруулаагүй байна!"
	?>
			<tr><td colspan="3" class="s" align="center"><?=$msg;?></td></tr>
	<?php
		} else {
			$j=0;
			while($j<$rowcountpage){
				if($row[$j]['ForumTopicType']=='Discussion') $forumtopictype="Хэлэлцүүлэг";
				elseif($row[$j]['ForumTopicType']=='Question') $forumtopictype="Асуулт";
				elseif($row[$j]['ForumTopicType']=='Survey') $forumtopictype="Судалгаа";
				$recordcount=$con->GetDescr("select count(*) from tbl_forumpost where ForumTopicID='".$row[$j]['ForumTopicID']."'");
				$page=ceil($recordcount/20);
				$fullname=$row[$j]['FirstName'];
	?>
			<tr<?php if($j%2!=0){ ?> class="listbg"<?php } ?>>
				<td>
					<a href="<?=$rf_forum.'/topic/'.$row[$j]['ForumClassID']."/".$row[$j]['ForumTopicID'];?>">
						<?=$row[$j]['Title'];?></a>
					<span class="alert s">[<?=$forumtopictype;?>]</span>
					<br>
					<div class="remark">
						оруулсан <a href="<?=$rf;?>/<?=$row[$j]['MemberID'];?>"><?=$fullname;?></a>
	                    <?=$row[$j]['ForumTopicDate1'];?>
					</div>
				</td>
				<td class="remark">
	<?php
				$qry="select T.*,";
				$qry.=" DATE_FORMAT(T.CreateDate, '%H:%i, %Y оны %m-р сарын %d') as ReplyDate1";
				$qry.=" from tbl_forumpost T";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and T.ForumTopicID='".$row[$j]['ForumTopicID']."'";
				$qry.=" group by T.ForumPostID";
				$qry.=" order by T.CreateDate desc";
				$qry.=" limit 0, 1";
				$row2=$con->select($qry);
				$rowcount2=count($row2);
				$j2=0;
				$fullname=$row2[$j2]['FirstName'];
				if($rowcount2>0){
					$lnk=$rf_forum."/topic/".$row[$j]['ForumClassID']."/".$row[$j]['ForumTopicID']."/p/".$page."#last";
	?>
					<a href="<?=$lnk;?>">
						<?php if(!empty($row2[$j2]['Title']))echo $row2[$j2]['Title'];else echo GetStrBr($row2[$j2]['Descr'],30);?>
	                </a>
	                <br>
					Oруулсан: <a href="<?=$rf;?>/<?=$row2[$j2]['MemberID'];?>"><?=$fullname;?></a><br>
					<?=$row2[$j2]['ReplyDate1'];?>
	<?php
				}
	?>
				</td>
				<td class="s" align="center">
					<?=number_format($row[$j]['SawCount']);?> /
					<?=number_format($recordcount);?>
				</td>
			</tr>
	<?php
				$j++;
			}
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
