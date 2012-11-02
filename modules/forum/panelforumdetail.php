<?php
	$forumclassid=$_GET["forumclassid"];
	$forumtopicid=$_GET["forumtopicid"];
	
	
	$pageFileName=$rf_forum."/topic/".$forumclassid."/".$forumtopicid;
	$pageFormName='frmForumTopicReply';
	
	$qry="update tbl_forumtopic set SawCount=SawCount+1 where ForumTopicID='$forumtopicid'";
	$con->qryexec($qry);
	
	$qry="select T.*,";
	$qry.=" IF(DATEDIFF(NOW(),T.CreateDate)<=7,1,0) as IsNew,";
	$qry.=" ifnull(WorthCount,0) as WorthCount, ifnull(NoWorthCount,0) as NoWorthCount";
	$qry.=" from tbl_forumtopic T";
	$qry.=" left join (select ForumTopicID, count(*) as WorthCount from tbl_forumtopicrate where ForumTopicID='$forumtopicid' and RatingType='worth' group by ForumTopicID) FTR1 on T.ForumTopicID=FTR1.ForumTopicID";
	$qry.=" left join (select ForumTopicID, count(*) as NoWorthCount from tbl_forumtopicrate where ForumTopicID='$forumtopicid' and RatingType='noworth' group by ForumTopicID) FTR2 on T.ForumTopicID=FTR2.ForumTopicID";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumTopicID='$forumtopicid'";
	$row=$con->select($qry);
	$j=0;
	
	if($row[$j]['ForumTopicType']=='Discussion') $forumtopictype="Хэлэлцүүлэг";
	elseif($row[$j]['ForumTopicType']=='Question') $forumtopictype="Асуулт";
	elseif($row[$j]['ForumTopicType']=='Survey') $forumtopictype="Судалгаа";
	
	$islockedtopic=$row[$j]['IsLocked'];
	
	$forumtopicname = $row[$j]['Title'];
	
?>
<div class="mainborder">
	<table cellpadding="0" cellspacing="0" width="810" border="0">
		<tr>
			<td width="100%" nowrap="nowrap">
				<table cellpadding="0" cellspacing="0" align="left">
				<tr>
					<td class="mainleftimage"></td>
					<td class="maincenterimage">
						<div class="mainpagetitle">
							<?php 
								$qry="select Title";
								$qry.=" from tbl_forumclass T";
								$qry.=" where T.IsShow='YES'";
								$qry.=" and T.ForumClassID='$forumclassid'";
							?>
							<a href="<?=$rf_forum."/".$forumclassid;?>"><?=$con->GetDescr($qry);?></a>
						</div>
					</td>
					<td class="mainrightimage"></td>
				</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div class="bottomtitlebrigth">
	<?=strip_tags($con->GetDescr("select ForumIntro from tbl_forumclass T where T.IsShow='YES' and T.ForumClassID='$forumclassid'"));?>
</div>
<div class="bottomtitle">
	<?php $k=0; require 'panelforumdetailop.php'; ?>
</div>
<?php if($row[$j]['ForumTopicType']=="Survey") require 'panelforumdetailsurvey.php'; ?>
<table cellpadding="0" cellspacing="0" width="100%" style="border-top:solid 1px #EEEEEE;border-bottom:solid 1px #EEEEEE;" border="0" align="left">
<tr>
	<td>
		<div class="topic-name">
			<?=$forumtopicname;?> <span class="alert s" style="font-weight: normal">[<?=$forumtopictype;?>]</span>
		</div>
	</td>
	<td width="110"> 
		<div class="topic-info" >
		<table cellpadding="0" cellspacing="0" width="110" border="0">
			<tr>
				<td>
					<form id="frmForumTopicRating" method="post" action="<?=$rf;?>/processform.php?action=forumtopicrate" >
					<div class="topic-state">
				        <input type="hidden" name="forumtopicid" value="<?=$forumtopicid;?>">
				        <input type="hidden" name="ratingtype" id="ratingtype" value="">
				        <a href="javascript:void(0);" onclick="$('#ratingtype').val('noworth'); $('#frmForumTopicRating').submit();" class="topic-sigh sprite" title="Хэрэггүй" rel="nofollow">
				        	<?=$row[$j]['NoWorthCount'];?>
				        </a>
				        <a href="javascript:void(0);" onclick="$('#ratingtype').val('worth'); $('#frmForumTopicRating').submit();" class="topic-acclaim sprite" title="Хэрэгтэй" rel="nofollow">
					        <?=$row[$j]['WorthCount'];?>
					    </a>
					</div>
					</form>
				</td>
			</tr>	
		</table>
		</div>
	</td>
</tr>
</table>
<div style="clear: both;"></div>
<form id="<?=$pageFormName;?>" name="<?=$pageFormName;?>" method="post" action="<?=$pageFileName;?>">
<input type="hidden" id="showcount" name="showcount" value="<?=$_SESSION['uni_showcountselect'];?>">
<?php
	$isshowpage="NO";
	$showpagestep=10;
	$showcount=$_POST['showcount'];
	if(empty($showcount)){
		$showcount=20;
		$_SESSION['uni_showcountselect']=$showcount;
	} else $_SESSION['uni_showcountselect']=$showcount;
	$showpagecount=7;

	$qrywhr =" where T.IsShow='YES'";
	$qrywhr.=" and T.ForumTopicID='$forumtopicid'";

	$qry="select CEILING(count(*)/$showcount), count(*)";
	$qry.=" from tbl_forumpost T";
	$qry.=$qrywhr;
	//echo $qry;
	
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if(empty($_GET['activepage']) || $_GET['activepage']==0) $activepage=1;
	else $activepage=$_GET['activepage'];
	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$time = time();
	$qry="select T.*,";
	$qry.=" DATE_FORMAT(T.CreateDate, '%H цаг %i минут, %Y оны %m-р сарын %d') as ReplyDate1";
	$qry.=" from tbl_forumpost T";
	$qry.=$qrywhr;
	$qry.=" group by T.ForumPostID";
	$qry.=" order by T.CreateDate asc";
	$qry.=" limit $startrow, $showcount";
	$row=$con->select($qry);
	$rowcountpage=count($row);
	$j=0;
	while($j<$rowcountpage){
?>
<div class="topic-row clearfix" style="width: 100%;">
<?php 
	if($j==($rowcountpage-1)){
?>
	<a name="last"></a>
<?php 
	}
?>
	<div class="topic-row-floor">Нийт <?=$rowcount;?> бичлэгийн <strong><?=$j+($activepage-1)*$_SESSION['uni_showcountselect']+1;?></strong></div>
    <div class="author-info">
		<div class="author-other-info" style="line-height: 18px;">
			<div style="font-weight: bold;"><?=$row[$j]['FirstName'];?></div>
			<!-- <div><a href="mailto:<?=$row[$j]['Email'];?>" class="author-name1"><?=$row[$j]['Email'];?></a></div> -->
			<div>
				<?php 
					$temp = spliti("\.",$row[$j]['IpAddress']);
					for($k=0; $k<3; $k++){
						echo $temp[$k].".";
					}
					echo "XXX";
				?>
			</div>
		</div>
	</div>
	<div class="list-content">
		<?php if($j+($activepage-1)*$_SESSION['uni_showcountselect']+1>1){ ?><div style="font-weight:bold; padding-bottom:5px"><?=$row[$j]['Title'];?></div><?php } ?>
		<?php 
			if($j==0){
				$qry="select Descr";
				$qry.=" from tbl_forumtopic T";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and T.ForumTopicID = '$forumtopicid'";
				echo nl2br($con->GetDescr($qry));
			}else {
				echo nl2br($row[$j]['Descr']);	
			}
		?>
	</div>
	<div class="row-info clearfix">
		<div class="row-info-block">
			<div class="date" style="color: #666;"><?=$row[$j]['ReplyDate1'];?></div>
			<div class="row-info-action" >
				<div class="date">
					<?php if($islockedtopic=="NO"){ ?>
                    <a href="<?=$rf_forum."/topic/".$forumid."/".$forumclassid."/".$forumtopicid."/reply";?>" rel="nofollow" >Хариу бичих</a>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="height: 1px;"></div>
<?php
		$j++;
	}
?>
<div class="pageNav"><?php require 'panelpagego.php'; ?></div>
</form>
<div style="clear: both;"></div>