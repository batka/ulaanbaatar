<?php
	require_once("libraries/connect.php");
	$con = new Database();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$pagetitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<?php
	if(isset($_GET['action'])) $action=$_GET['action'];
	if(isset($_REQUEST['newsid'])) $newsid=$_REQUEST['newsid'];
	if(isset($_REQUEST['photonewsid'])) $photonewsid=$_REQUEST['photonewsid'];
	if(isset($_REQUEST['videonewsid'])) $videonewsid=$_REQUEST['videonewsid'];
	
	if(isset($_REQUEST['lawruleid'])) $lawruleid=$_REQUEST['lawruleid'];
	if(isset($_REQUEST['proid'])) $proid=$_REQUEST['proid'];
	if(isset($_REQUEST['reportid'])) $reportid=$_REQUEST['reportid'];
	if(!empty($_POST['descr'])) $descr=asuUniConvert($_POST['descr'],1,0);
	
	if(!empty($_POST['securecode'])) $securecode=$_POST['securecode'];
	if(!empty($_POST['subject'])) $subject=asuUniConvert($_POST['subject']);
	if(!empty($_POST['writername'])) $writername=asuUniConvert($_POST['writername']);
	if(!empty($_POST['intro'])) $intro=asuUniConvert($_POST['intro']);
	$isshow='YES';
	
	if(isset($_REQUEST['pollid'])) $pollid=$_REQUEST['pollid'];
	
	if(!empty($_POST['forumclassid']))$forumclassid = $_POST['forumclassid'];
	if(!empty($_POST['forumtopicid']))$forumtopicid = $_POST['forumtopicid'];
	if(!empty($_POST['firstname']))$firstname = asuUniConvert(trim($_POST['firstname']));
	if(!empty($_POST['email']))$email = trim($_POST['email']);
	if(!empty($_POST['subject']))$subject = asuUniConvert(trim($_POST['subject']));
	if(!empty($_POST['message']))$message = asuUniConvert($_POST['message']);
	
	if(!empty($_POST['ratingtype'])) $ratingtype=asuUniConvert(trim($_POST['ratingtype']));
	if(!empty($_POST['choicetype'])) $choicetype=$_POST['choicetype'];
	
	// Мэдээний сэтгэгдэл
	if($action=="commentadd"){
		require_once "libraries/securimage/securimage.php";
		$secimg=new Securimage();
		$valid=$secimg->check($securecode);
		//echo $valid; exit;
		if($valid==true){
			$commentid=$con->GetNextID("tbl_newscomment","CommentID");
			$qry="insert into tbl_newscomment(NewsID, CommentID, WriterName, Descr, IsShow, CommentDate)";
			$qry.=" values('$newsid', '$commentid', '$writername', '$intro', '$isshow', NOW())";
			$con->qryexec($qry);
			GotoPage("","$rf/news/detail/$newsid");
		}
		else GotoPage("","$rf/news/detail/$newsid/strSecurcodeWrong");
	// Фото мэдээний сэтгэгдэл
	} elseif($action=="photocommentadd"){
		require_once "libraries/securimage/securimage.php";
		$secimg=new Securimage();
		$valid=$secimg->check($securecode);
		//echo $valid; exit;
		if($valid==true){
			$commentid=$con->GetNextID("tbl_photonewscomment","CommentID");
			$qry="insert into tbl_photonewscomment(PhotoNewsID, CommentID, WriterName, Descr, IsShow, CommentDate)";
			$qry.=" values('$photonewsid', '$commentid', '$writername', '$intro', '$isshow', NOW())";
			$con->qryexec($qry);
			GotoPage("","$rf/news/photo/detail/$photonewsid");
		}
		else GotoPage("","$rf/news/photo/detail/$photonewsid/strSecurcodeWrong");
	} elseif($action=="videocommentadd"){
		require_once "libraries/securimage/securimage.php";
		$secimg=new Securimage();
		$valid=$secimg->check($securecode);
		//echo $valid; exit;
		if($valid==true){
			$commentid=$con->GetNextID("tbl_videonewscomment","CommentID");
			$qry="insert into tbl_videonewscomment(VideoNewsID, CommentID, WriterName, Descr, IsShow, CommentDate)";
			$qry.=" values('$videonewsid', '$commentid', '$writername', '$intro', '$isshow', NOW())";
			$con->qryexec($qry);
			GotoPage("","$rf/news/video/detail/$videonewsid");
		}
		else GotoPage("","$rf/news/video/detail/$videonewsid/strSecurcodeWrong");
	} elseif($action=="lawruledownloadfile"){
		$qry="select * from tbl_lawrule where IsShow='YES' and LawRuleID='$lawruleid'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$filename = $drf."/files/lawrule/".$row[0]['FileSource'];
			$fileext=pathinfo($filename,PATHINFO_EXTENSION);
			if(is_file($filename)){
				header('Pragma: public');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/'.$fileext);
			    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
			    header('Content-Transfer-Encoding: binary');
			    header('Content-Length: '.filesize($filename));
			    ob_clean();
			    flush();
			    readfile($filename);
			} else GotoPage("Файл олдсонгүй!"); 
		}
		else GotoPage("Файл байхгүй!");
	} elseif($action=="prodownloadfile"){
		$qry="select * from tbl_pro where IsShow='YES' and ProID='$proid'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$filename = $drf."/files/pro/".$row[0]['FileSource'];
			$fileext=pathinfo($filename,PATHINFO_EXTENSION);
			if(is_file($filename)){
				header('Pragma: public');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/'.$fileext);
			    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
			    header('Content-Transfer-Encoding: binary');
			    header('Content-Length: '.filesize($filename));
			    ob_clean();
			    flush();
			    readfile($filename);
			} else GotoPage("Файл олдсонгүй!"); 
		}
		else GotoPage("Файл байхгүй!");
	} elseif($action=="reportdownloadfile"){
		$qry="select * from tbl_report where IsShow='YES' and ReportID='$reportid'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$filename = $drf."/files/report/".$row[0]['FileSource'];
			$fileext=pathinfo($filename,PATHINFO_EXTENSION);
			if(is_file($filename)){
				header('Pragma: public');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/'.$fileext);
			    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
			    header('Content-Transfer-Encoding: binary');
			    header('Content-Length: '.filesize($filename));
			    ob_clean();
			    flush();
			    readfile($filename);
			} else GotoPage("Файл олдсонгүй!"); 
		}
		else GotoPage("Файл байхгүй!");
	} elseif($action=="filedownloadfile"){
		$fileid=$_POST['fileid'];
		$qry="select * from tbl_file where IsShow='YES' and FileID='$fileid'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$filename = $drf."/files/file/".$row[0]['FileSource'];
			$fileext=pathinfo($filename,PATHINFO_EXTENSION);
			if(is_file($filename)){
				header('Pragma: public');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/'.$fileext);
			    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
			    header('Content-Transfer-Encoding: binary');
			    header('Content-Length: '.filesize($filename));
			    ob_clean();
			    flush();
			    readfile($filename);
			} else GotoPage("Файл олдсонгүй!"); 
		}
		else GotoPage("Файл байхгүй!");
	//Санал асуулга
	} elseif($action=="ctznpoll"){
		$pollid=$_POST['pollid'];
		$pollvoteid_chkd=$_POST['pollvoteid'];
		
		if($_SESSION['haant_s_poll'.$pollid]!='YES'){
			$qry =" update ctz_pollvote";
			$qry.=" set PollVote=PollVote+1";
			$qry.=" where PollVoteID='$pollvoteid_chkd'";
			$qry.=" and PollID='$pollid'";
			$con->qryexec($qry);
			
			$qry =" select * from ctz_poll";
			$qry.=" where PollID='$pollid'";
			$qry.=" and FirstDate='0000-00-00 00:00:00'";
			$rowcount=count($con->select($qry));
			
			$qry=" update ctz_poll set LastDate=Now()";
			if($rowcount>0) $qry.=", FirstDate=Now()";
			$qry.=" where PollID='$pollid'";
			$con->qryexec($qry);
			
			$_SESSION['haant_s_poll'.$pollid]='YES';
			GotoPage();
		} else GotoPage("Та санал өгсөн байна!", "back");

	}elseif ($action=="forumtopicreply"){
		if(!empty($_POST['securecode'])) $securecode=$_POST['securecode'];
		require_once "libraries/securimage/securimage.php";
		$secimg=new Securimage();
		$valid=$secimg->check($securecode);
//		echo $valid; exit;
		if($valid==true){
			$forumpostid = $con->GetNextID("tbl_forumpost", "ForumPostID");
			$ip = getRealIpAddr();		
			$qry="insert into tbl_forumpost (ForumPostID, ForumTopicID, Title, Descr, FirstName, Email, IpAddress, IsShow, CreateDate, UpdateDate)";
			$qry.=" values('$forumpostid','$forumtopicid','$subject','$message','$firstname','$email', '$ip','YES',NOW(),NOW())";
			$con->qryexec($qry);
			$_SESSION['alert_msg']="success";
		}else {
			GotoPage("Хамгаалалтын код буруу байна!");
		}
		GotoPage("");
	// Сэдвийг үнэлэх (хэрэгтэй|хэрэггүй)
	} elseif($action=="forumtopicrate"){
		if($_COOKIE['rating'.$forumtopicid]!='success'){ 
			if($ratingtype=="worth" || $ratingtype=="noworth"){
				if($ratingtype=="worth") $ratingpoint=5; elseif($ratingtype=="noworth") $ratingpoint=1;
				$ratingid=$con->GetNextID("tbl_forumtopicrate", "RateID");
				$qry="insert into tbl_forumtopicrate(ForumTopicID, RateID, RatingType, RatePoint, RateDate)";
				$qry.=" values('$forumtopicid', '$ratingid', '$ratingtype', '$ratingpoint', NOW())";
				if($con->qryexec($qry)>0){
					$expire=time()+60*60*24*30;
					setcookie("rating".$forumtopicid, "success", $expire);
					GotoPage("Үнэлгээ амжилттай боллоо!"); exit; 
				}
				else { GotoPage("Үнэлгээ өгөх амжилтгүй боллоо! Дахин оролдоно уу.","back"); exit; }
			} else { 
				GotoPage("Үнэлгээ хийгдсэнгүй!","back"); 
				exit; 
			}
		}else {
			GotoPage("Та үнэлгээ өгсөн байна!"); 
			exit;
		}
	// Судалгааны санал асуулга
	} elseif($action=="forumtopicsurveyvote"){
	if(!isset($_POST['surveyid'])){ GotoPage("Та судалгааны хариултуудаас сонголтоо хийнэ үү!","back"); exit; }
		$surveyid=$_POST['surveyid'];
		$ip = getRealIpAddr();
		if(empty($_COOKIE['survey'.$forumtopicid])){
			$qry="select * from tbl_forumtopicsurvey where ForumTopicID='$forumtopicid' and IsShow='YES'";
			$row=$con->select($qry);
			$rowcount=count($row);
			for($i=0;$i<$rowcount;$i++){
				$voteid = $con->GetNextID("tbl_forumtopicsurveyvote", "VoteID");
				if($i==0)$k=$voteid;
				$temp = $ip.$k;
				if(!empty($surveyid[$i])){
					$qry="insert into tbl_forumtopicsurveyvote(ForumTopicID, SurveyID, VoteID, VoteDate, MemberIP, IsShow)";
					$qry.=" values('$forumtopicid', '".$surveyid[$i]."', '$voteid', NOW(), '$temp', 'YES')";
					$con->qryexec($qry);
				}
			}
			$expire=time()+60*60*24*30;
			setcookie("survey".$forumtopicid, "success", $expire);
			GotoPage("Үнэлгээ амжилттай боллоо!"); exit;
		} else { GotoPage("Үнэлгээг өмнө нь өгсөн байна!","back"); exit; }
	} elseif($action=="massmailadd"){
		$mail=$_GET['mail'];
		if(empty($mail)){
			echo "<center><font color='red'>Мэйлээ бичнэ үү.</font></center>";
		}else{
			if(strrpos($mail, "@")<strrpos($mail, ".")){
				$qry="select count(*) as count";
				$qry.=" from tbl_massmail";
				$qry.=" where IsShow='YES'";
				$qry.=" and Massmail='$mail'";
				$count=$con->GetDescr($qry);
				if($count>0){
					echo "<center><font color='red'>Өмнө нь бүртгэгдсэн байна.</font></center>";
				}else{
					$massmailid = $con->GetNextID("tbl_massmail","MassmailID");
					$qry="insert into tbl_massmail (MassmailID, Massmail, IsShow, CreateDate)";
					$qry.=" values('$massmailid','$mail','YES',NOW())";
					$con->qryexec($qry);
				?>
					<center><font color='blue'>Амжилттай бүртгэлээ.</font></center>
					<script type="text/javascript">
						$('#massmail').val('');
					</script>
				<?php 
				}
			}else{
				echo "<center><font color='red'>Алдаатай бичсэн байна.</font></center>";
			}
		}
	} elseif($action=="budgetadd"){
		if(!empty($_POST['budgetclassid'])) $budgetclassid = $_POST['budgetclassid'];
		if(!empty($_POST['phonenumber'])) $phonenumber = $_POST['phonenumber'];
		if(!empty($_POST['address'])) $address = $_POST['address'];
		
		$budgetid = $con->GetNextID("tbl_budget","BudgetID");	
		if(!empty($_FILES["filesource"]["name"])){
			$fileext=strtolower(pathinfo($_FILES["filesource"]["name"], PATHINFO_EXTENSION));
			$uploadfile="$drf/files/budget/$budgetid.$fileext";
			if(move_uploaded_file($_FILES["filesource"]["tmp_name"], $uploadfile)) {
				$filename=$budgetid.".".$fileext;
			}
			else GotoPage("Файл хуулахад алдаа гарлаа!", "back");
		}
		$qry="insert into tbl_budget (BudgetID, BudgetClassID, Descr, PhoneNumber, Email, Address, FileSource, IsShow, CreateDate, UpdateDate)";
		$qry.=" values('$budgetid', '$budgetclassid', '$descr' ,'$phonenumber' ,'$email' ,'$address' ,'$filename', 'YES', NOW(), NOW())";
		$con->qryexec($qry);
		$_SESSION['alert_msg'] = 'success';
		GotoPage("");
	}elseif($action=="homevideochange"){
            $videoid=$_GET['videoid'];
            
            $qry="select T.*";
            $qry.=" from tbl_videonews T";
            $qry.=" where T.IsShow='YES'";
            $qry.=" and VideoNewsID='$videoid'";
            $row=$con->select($qry);
            $imagesource=$drf."/files/videos/small/".$row[0]['ImageSource'];
            if (!empty($row[0]['ImageSource']) && file_exists($imagesource)){
                $imagesource=$rf."/files/videos/small/".$row[0]['ImageSource'];
            } 
?>
        <div id="player" style="margin-top: 10px; text-align: center;">
                <div align="center">
            <a class="bluelink" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" target="_blank">
                <!--Get the Adobe Flash Player to see this video.-->
            Видео, дүрс бичлэгийг үзэхийн тулд Adobe Flash Player програмын шинэ хувилбарыг ЭНД дарж, татаж аван суулгах хэрэгтэй!
            </a></div>
        </div>
        <script type="text/javascript">
                var so = new SWFObject('<?=$rf;?>/mediaplayer/player.swf', 'ply', '240', '160', '9.0.124');
                so.addParam('allowscriptaccess', 'always');
                so.addParam('allowfullscreen', 'false');
                //so.addParam('quality', 'high');
                so.addParam('wmode', 'transparent');
                so.addVariable('file', '<?=$rf?>/files/videos/<?=$row[0]['FileSource']?>');
                so.addVariable('image', '<?=$imagesource;?>');
                so.addVariable('backcolor', '212121');
                so.addVariable('frontcolor', 'ffffff');
                so.addVariable('lightcolor', '666666');
                so.addVariable('bufferlength', '5');
                so.addVariable('volume', '80');
                so.addVariable('controlbar', '');
                so.addVariable('autostart', 'false');
                so.addVariable('stretching', 'exactfit');
                so.addVariable('repeat', 'list');
                so.addVariable('skin', '<?=$rf;?>/mediaplayer/skins/modieus.swf');
                so.write('player');
        </script>
    <?php }?>
</body>
</html>
