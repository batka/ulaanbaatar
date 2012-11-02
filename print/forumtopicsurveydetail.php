<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<style type="text/css" media="all">
	@import url("<?=$rf;?>/modules/forum/styles/forumdetail.css");
</style>
</head>

<BODY>
<div style="padding:5px">
	<div>
		<?php require_once "reportheader.php"; ?>
	</div>
<div><?php require_once "../headerjsstyle.php"; ?></div>

<?php
	$forumtopicid=$_GET['forumtopicid'];
	
	$qry="select T.*,";
	$qry.=" IF(DATEDIFF(NOW(),CreateDate)<=7,1,0) as IsNew";
	$qry.=" from tbl_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumTopicID='$forumtopicid'";
	//echo $qry;
	$row=$con->select($qry);
	$j=0;
	
	$qry="select *";
	$qry.=" from tbl_forumtopicsurveyvote";
	$qry.=" where IsShow='YES'";
	$qry.=" and ForumTopicID='$forumtopicid'";
	//echo $qry;
	$rowsum=$con->select($qry);
	$rowcountsum=count($rowsum);
	
	$qry="select T.*, SV.VoteCount";
	$qry.=" from tbl_forumtopicsurvey T";
	$qry.=" left join (select ForumTopicID, SurveyID, count(*) as VoteCount from tbl_forumtopicsurveyvote group by ForumTopicID, SurveyID) SV on T.ForumTopicID=SV.ForumTopicID and T.SurveyID=SV.SurveyID";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumTopicID='$forumtopicid'";
	$qry.=" order by T.SurveyID";
	//echo $qry;
	$rowsurv=$con->select($qry);
	$rowcountsurv=count($rowsurv);
	if($rowcountsurv>0){
?>
<div class="pane" style="padding: 8px; list-style: none;">
	<span class="l">
		<img src="<?=$rf;?>/images/web/poll_topic.gif" title="Судалгааны асуулга" align="absmiddle"> 
		<?=$row[$j]['Title'];?>
	</span>
	<ul id="poll" style="padding-top:8px;">
<?php
		$jsurv=0;
		while($jsurv<$rowcountsurv){
			if(!empty($rowcountsum)){
				$voteproc=round(($rowsurv[$jsurv]['VoteCount']*100)/$rowcountsum,2);
			}else $voteproc=0;
?>
		<li style="padding-bottom:3px; font: 11px tahoma;">
           	<?=$rowsurv[$jsurv]['PollOption'];?>
			<?php if($voteproc>0){ ?><b>(<?=$voteproc;?>%)</b><?php } ?>
            <div style="width:<?=$voteproc;?>%;"></div>
		</li>
<?php
			$jsurv++;
		}
?>
	</ul>
	<div align="center">
		<div class="remark">
		<?php 
			$qry="select MemberIP from tbl_forumtopicsurveyvote where IsShow='YES' and ForumTopicID='".$row[$j]['ForumTopicID']."' group by MemberIP";
			$row = $con->select($qry);
			$rowcount = count($row);
		?>
		(Энэ судалгаанд нийт <b><?=$rowcount;?></b> хэрэглэгч оролцсон)</div>
    </div>
</div>
<?php
	}
?>
</div>

</BODY>
</html>
