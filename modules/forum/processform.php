<?php
	require_once("../../libraries/connect.php");
	$con = new Database();
?>
<HTML>
<HEAD>
<TITLE>processform</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$action=$_GET['action'];
	$memberid=$_SESSION['asubi_memberid'];
	$ipaddress=getRealIpAddr();
	
	if(!empty($_POST['title'])) $title=asuUniConvert(trim($_POST['title']));
	if(!empty($_POST['subject'])) $subject=asuUniConvert(trim($_POST['subject']));
	if(!empty($_POST['descr'])) $descr=asuUniConvert(trim($_POST['descr']));
	if(!empty($_POST['message'])) $message=asuUniConvert(trim($_POST['message']));
	
	if(!empty($_POST['forumclassid'])) $forumclassid=$_POST['forumclassid'];
	if(!empty($_POST['forumid'])) $forumid=$_POST['forumid'];
	if(!empty($_POST['forumtopicid'])) $forumtopicid=$_POST['forumtopicid'];
	if(!empty($_POST['forumtopictypeadd'])) $forumtopictypeadd=$_POST['forumtopictypeadd'];
	if(!empty($_POST['forumtopicname'])) $forumtopicname=asuUniConvert(trim($_POST['forumtopicname']));
	if(!empty($_POST['isnotifyme'])) $isnotifyme=$_POST['isnotifyme']; else $isnotifyme="NO";

	if(!empty($_POST['ratingtype'])) $ratingtype=asuUniConvert(trim($_POST['ratingtype']));
	if(!empty($_POST['choicetype'])) $choicetype=$_POST['choicetype'];

// Сэдэв тавих, асуулт асуух, судалгаа авах
	if($action=="forumtopicadd"){
		$forumtopicid=$con->GetNextID("asubi_forumtopic", "ForumTopicID");
		$qry="insert into asubi_forumtopic(ForumID,ForumClassID,ForumTopicID,ForumTopicType, Title, CreateDate, Descr,ChoiceType, MemberID, IsShow,IsNotifyMe)";
		$qry.=" values('$forumid','$forumclassid','$forumtopicid','$forumtopictypeadd','$forumtopicname',NOW(),'$descr','$choicetype','$memberid','YES','$isnotifyme')";
	
		$con->qryexec("SET AUTOCOMMIT=0;");
		$con->qryexec("START TRANSACTION;");
		
		if($con->qryexec($qry)>0){
			$replyid=$con->GetNextID("asubi_forumpost", "ForumPostID");
			$qry="insert into asubi_forumpost(ForumPostID, ForumTopicID,Title, Descr, CreateDate, PostMemberID, IsShow)";
			$qry.=" values('$replyid', '$forumtopicid', '$forumtopicname', '$descr', NOW(), '$memberid', 'YES')";
			$con->qryexec($qry);
		}
		if($forumtopictypeadd=="Survey"){
			$polloption=$_POST['polloption'];
			for($i=0;$i<count($polloption);$i++){
				if(!empty($polloption[$i])){
					$surveyid=$con->GetNextID("asubi_forumtopicsurvey", "SurveyID");
					$qry="insert into asubi_forumtopicsurvey(ForumTopicID, SurveyID, PollOption, IsShow)";
					$qry.=" values('$forumtopicid', '$surveyid', '".$polloption[$i]."', 'YES')";
					$con->qryexec($qry);
				}
			}
		}
		
		$qry="select count(*) from asubi_memberevent where Date=DATE_FORMAT(NOW(),'%Y-%m-%d') and MemberID='".$_SESSION['asubi_memberid']."' and Event='FORUMADD'";
		if($con->GetDescr($qry)<1){
			$qry="insert into asubi_memberevent(MemberID, Event, EventID, Date, CreateDate)";
			$qry.=" values('".$_SESSION['asubi_memberid']."','FORUMADD', '".$_SESSION['asubi_memberid']."',DATE_FORMAT(NOW(),'%Y-%m-%d'),NOW())";
			$con->qryexec($qry);
		}
		
		$con->qryexec("COMMIT;"); 
		$con->qryexec("SET AUTOCOMMIT=1;");
		
		GotoPage("", $rf_forum."/topic/$forumid/$forumclassid/$forumtopicid");
// Сэдвийг үнэлэх (хэрэгтэй|хэрэггүй)
	} elseif($action=="forumtopicrate"){
		if($ratingtype=="worth" || $ratingtype=="noworth"){
			$qry="select * from asubi_forumtopicrate where ForumTopicID='$forumtopicid' and MemberID='$memberid'";
			if($con->qryopen($qry)<1){
				if($ratingtype=="worth") $ratingpoint=5; elseif($ratingtype=="noworth") $ratingpoint=1;
				$ratingid=$con->GetNextID("asubi_forumtopicrate", "RateID");
				$qry="insert into asubi_forumtopicrate(ForumTopicID, RateID, RatingType, RatePoint, RateDate, MemberID)";
				$qry.=" values('$forumtopicid', '$ratingid', '$ratingtype', '$ratingpoint', NOW(), '$memberid')";
				if($con->qryexec($qry)>0){ GotoPage("Үнэлгээ амжилттай боллоо!"); exit; }
				else { GotoPage("Үнэлгээ өгөх амжилтгүй боллоо! Дахин оролдоно уу.","back"); exit; }
			} else { GotoPage("Үнэлгээг өмнө нь өгсөн байна!","back"); exit; }
		} else { GotoPage("Үнэлгээ хийгдсэнгүй!","back"); exit; }
// Сэдэвд хариу бичих
	} elseif($action=="forumtopicreply"){
		$replyid=$con->GetNextID("asubi_forumpost", "ForumPostID");
		
		$con->qryexec("SET AUTOCOMMIT=0;");
		$con->qryexec("START TRANSACTION;");
		
		$qry="insert into asubi_forumpost(ForumTopicID,ForumPostID,Title,Descr,CreateDate,PostMemberID, IsShow)";
		$qry.=" values('$forumtopicid', '$replyid', '$subject', '$message', NOW(), '$memberid', 'YES')";
		if($con->qryexec($qry)>0){
			
			$qry="select count(*) from asubi_memberevent where Date=DATE_FORMAT(NOW(),'%Y-%m-%d') and MemberID='".$_SESSION['asubi_memberid']."' and Event='FORUMPOSTED' and EventID='".$forumtopicid."'";
			if($con->GetDescr($qry)<1){
				$qry="insert into asubi_memberevent(MemberID, Event, EventID, Date, CreateDate)";
				$qry.=" values('".$_SESSION['asubi_memberid']."','FORUMPOSTED', '".$forumtopicid."', NOW(), NOW())";
				$con->qryexec($qry);
			}
			
			$qry="select T.ForumID, T.ForumClassID, T.MemberID, T1.RowID from asubi_forumtopic T left join asubi_member T1 on T.MemberID=T1.MemberID where T.ForumTopicID='$forumtopicid'";
			$mem=$con->select($qry);
			
			if($mem[0]['MemberID']!=$_SESSION['asubi_memberid'] && !empty($mem[0]['MemberID'])){
				$userid=$mem[0]['RowID'];
				$str="<a href=\"$rf/modules/forum/topic/".$mem[0]['ForumID']."/".$mem[0]['ForumClassID']."/$forumtopicid\">".mb_substr($_SESSION['asubi_memberlastname'],0,1,'UTF8').".".$_SESSION['asubi_memberfirstname']." нь таны хэлэлцүүлэгт сэтгэгдэл үлдээсэн байна.</a>";
				$qry="insert into cometchat_announcements(announcement, `time`, `to`, eventid, eventtype, memberid, subid, date)";
				$qry.=" values('$str',UNIX_TIMESTAMP(),$userid, '$forumtopicid', 'FORUMCOMMENT', '".$_SESSION['asubi_memberid']."', '$replyid', NOW())";
				$con->qryexec($qry);
			}
			
			$temp = $con->GetDescr("select MemberID from asubi_forumtopic where ForumTopicID = '$forumtopicid'");
			if($temp!=$memberid){
				$qry="update asubi_forumtopic set IsNotifyMe = 'YES' where ForumTopicID = '$forumtopicid'";
				$con->qryexec($qry);
			}
			$qry="select PostMemberID from asubi_forumpost where ForumTopicID = '$forumtopicid' and PostMemberID != '$temp' group by PostMemberID";
			$row = $con->select($qry);
			$rowcount = count($row);
			for($i=0;$i<$rowcount;$i++){
				$qry="insert into asubi_forumreliation(ForumTopicID,MemberID,ForumPostID,CreateDate)";
				$qry.=" values('$forumtopicid','".$row[$i]['PostMemberID']."','$replyid',NOW())";
				$con->qryexec($qry);
			}
			
			$con->qryexec("COMMIT;"); 
			$con->qryexec("SET AUTOCOMMIT=1;");
			
			GotoPage("","$rf_forum/topic/$forumid/$forumclassid/$forumtopicid");exit;
		}
		else { GotoPage("Амжилтгүй боллоо! Дахин оролдоно уу.","back"); exit; }
// Судалгааны санал асуулга
	} elseif($action=="forumtopicsurveyvote"){
		if(!isset($_POST['surveyid'])){ GotoPage("Та судалгааны хариултуудаас сонголтоо хийнэ үү!","back"); exit; }
		$qry="select * from asubi_forumtopicsurveyvote where ForumTopicID='$forumtopicid' and MemberID='$memberid'";
		if($con->qryopen($qry)<1){
			$surveyid=$_POST['surveyid'];
			$qry="select * from asubi_forumtopicsurvey where ForumTopicID='$forumtopicid' and IsShow='YES'";
			$row=$con->select($qry);
			$rowcount=count($row);
			for($i=0;$i<$rowcount;$i++){
				if(!empty($surveyid[$i])){
					$qry="insert into asubi_forumtopicsurveyvote(ForumTopicID, SurveyID, VoteDate, MemberID, IsShow)";
					$qry.=" values('$forumtopicid', '".$surveyid[$i]."', NOW(), '$memberid', 'YES')";
					$con->qryexec($qry);
				}
			}
			GotoPage("Үнэлгээ амжилттай боллоо!"); exit;			
		} else { GotoPage("Үнэлгээг өмнө нь өгсөн байна!","back"); exit; }
	}elseif ($action=="lockaction"){
		$lock = $_POST['lock'];
		$qry="update asubi_forumtopic set";
		$qry.=" IsLocked = '$lock'";
		$qry.=" where ForumTopicID = '$forumtopicid'";
		$con->qryexec($qry);
		GotoPage('');
	}
?>
</HEAD>
<BODY bgcolor="#ffffff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
</BODY>
</HTML>