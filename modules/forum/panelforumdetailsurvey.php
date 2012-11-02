<?php
	$rowcountsum=0;
	$rowcountvote=0;
	if(!empty($_SESSION['tbl_memberid'])){
		$qry="select *";
		$qry.=" from tbl_forumtopicsurveyvote";
		$qry.=" where IsShow='YES'";
		$qry.=" and ForumTopicID='".$row[$j]['ForumTopicID']."'";
		//echo $qry;
		$rowsum=$con->select($qry);
		$rowcountsum=count($rowsum);
		
		$qry="select *";
		$qry.=" from tbl_forumtopicsurveyvote";
		$qry.=" where IsShow='YES'";
		$qry.=" and ForumTopicID='".$row[$j]['ForumTopicID']."'";
		$qry.=" and MemberID='".$_SESSION['tbl_memberid']."'";
		//echo $qry;
		$rowvote=$con->select($qry);
		$rowcountvote=count($rowvote);
	}
	$qry="select T.*, SV.VoteCount";
	$qry.=" from tbl_forumtopicsurvey T";
	$qry.=" left join (select ForumTopicID, SurveyID, count(*) as VoteCount from tbl_forumtopicsurveyvote group by ForumTopicID, SurveyID) SV on T.ForumTopicID=SV.ForumTopicID and T.SurveyID=SV.SurveyID";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumTopicID='".$row[$j]['ForumTopicID']."'";
	$qry.=" order by T.SurveyID";
	//echo $qry;
	$rowsurv=$con->select($qry);
	$rowcountsurv=count($rowsurv);
	if($rowcountsurv>0){
		$str_frmaction="$rf/processform.php?action=forumtopicsurveyvote";
?>
<script type="text/javascript">
	function isSelected(){
		k=0;
		$('.vote').each(function(index){
			if($(this).is(':checked')==true)k=1;
		});
		if(k==1){
			if(isGiveYou()){
				alert('Та энэ судалгаанд оролцсон байна!');
				return false;
			}else return true;
		}else {
			alert('Та сонголтоо хийнэ үү!');
			return false;
		}
	}
	function isGiveYou(){
		if(getCookie('survey<?=$forumtopicid;?>')=='success')return true;
		else return false;
	}
	function getCookie(c_name)
	{
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++)
		{
		  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		  x=x.replace(/^\s+|\s+$/g,"");
		  if (x==c_name)
		    {
		    	return unescape(y);
		    }
		}
	}
</script>
<form id="frmForumTopicSurveyVote" method="post" action="<?=$str_frmaction;?>" onsubmit="if(!isSelected())return false;">
<input name="forumclassid" value="<?=$forumclassid;?>" type="hidden">
<input name="forumid" value="<?=$forumid;?>" type="hidden">
<input name="forumtopicid" value="<?=$forumtopicid;?>" type="hidden">
<div class="pane" style="padding: 8px;">
	<span class="l">
		<img src="<?=$rf;?>/images/web/poll_topic.gif" title="Судалгааны асуулга" align="absmiddle"> 
		<?=$row[$j]['Title'];?>
	</span>	
	<ul id="poll" style="padding-top:8px">
<?php
		if($row[$j]['ChoiceType']=="Multiple") $choicetype="checkbox";
		elseif($row[$j]['ChoiceType']=="Single") $choicetype="radio";
		else $choicetype="radio";
		
		$jsurv=0;
		while($jsurv<$rowcountsurv){
?>
		<li style="padding-bottom:3px" >
			<input id="surveyid<?=$jsurv+1;?>" name="surveyid[]" value="<?=$rowsurv[$jsurv]['SurveyID'];?>" type="<?=$choicetype;?>" class="vote">
           	<label for="surveyid<?=$jsurv+1;?>"><?=$rowsurv[$jsurv]['PollOption'];?></label>
			<?php if($rowcountvote>0){ $voteproc=round(($rowsurv[$jsurv]['VoteCount']*100)/$rowcountsum,2); ?>
			<?php if($voteproc>0){ ?><b>(<?=$voteproc;?>%)</b><?php } ?>
            <div style="width:<?=$voteproc;?>%;"></div>
            <?php } ?>
		</li>
<?php
			$jsurv++;
		}
?>
	</ul>
	<div align="center">
<?php
		if($row[$j]['IsLocked']=="YES"){
?>
		<div class="s">Анхаар! Энэ сэдэв түгжээтэй учир үнэлэх боломжгүй.</div>
<?php
		} else {
?>
		<input  name="eventSubmitDoVote" value="Үнэлэх"  type="submit">
<!--		<button class="bluebutton" name="eventSubmitDoVote" type="submit" <?php if(empty($_SESSION['tbl_memberid']))echo ' disabled ';?>>Үнэлэх</button>-->
<?php
		}
		$qs1="forumtopicid=".$row[$j]['ForumTopicID'];
?>
		<input name="eventViewDoVoteRes" value="Үр дүнг харах" type="button" onclick="OpenWindow('<?=$rf;?>/print/printreport.php?fn=<?=$rf;?>/print/forumtopicsurveydetail.php&qs1=<?=$qs1;?>',500); return false;">
<!--		<button class="bluebutton" name="eventViewDoVoteRes" type="button" onclick="OpenWindow('<?=$rf;?>/print/printdetail.php?fn=<?=$rf;?>/print/forumtopicsurveydetail.php&qs1=<?=$qs1;?>',500); return false;">Үр дүнг харах</button>-->
<?php
	if(!empty($_COOKIE['survey'.$forumtopicid])){
?>
		<div class="remark" style="margin-top: 5px;">
		Та өмнө нь санал өгсөн байна.<br>
		<?php 
			$qry="select MemberIP from tbl_forumtopicsurveyvote where IsShow='YES' and ForumTopicID='".$row[$j]['ForumTopicID']."' group by MemberIP";
			$row = $con->select($qry);
			$rowcount = count($row);
		?>
		(Энэ судалгаанд нийт <b><?=$rowcount;?></b> иргэн оролцсон)</div>
<?php
	}
?>
    </div>
</div>
</form>
<?php
	}
?>
