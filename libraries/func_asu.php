<?php

function GotoPage($p_alertstr, $p_gotopage = '') {
	$p_alertstr = trim ( $p_alertstr );
	if ($p_alertstr != "")
		echo "<script type='text/javascript'>alert('$p_alertstr');</script>";
	if ($p_gotopage == "") {
		if ($p_alertstr != "")
			echo "<script type='text/javascript'>window.open('" . $_SERVER ['HTTP_REFERER'] . "','_parent');</script>";
		else
			header ( "location: " . $_SERVER ['HTTP_REFERER'] );
	} else if ($p_gotopage == "back") {
		echo "<script type='text/javascript'>history.go(-1);</script>";
	} else {
		if ($p_alertstr != "")
			echo "<script type='text/javascript'>window.open('$p_gotopage','_parent');</script>";
		else
			header ( "location: $p_gotopage" );
	}
	exit;
}

function GetStrBr($p_str, $p_len) {
	if (mb_strlen ( $p_str, "utf-8" ) <= $p_len)
		return $p_str;
	$v_pos = mb_strpos ( $p_str, " ", $p_len, "utf-8" );
	if ($v_pos == 0)
		$res = $p_str;
	else
		$res = mb_substr ( $p_str, 0, $v_pos, "utf-8" );
	return trim ( $res ) . " ...";
}

function GetFullDateTime($p_con, $p_isshowtime='YES'){
	if($p_isshowtime=="YES")
		$qry = "SELECT DATE_FORMAT(NOW(), '%Y.%m.%d %H:%i:%s')";
	else
		$qry = "SELECT DATE_FORMAT(NOW(), '%Y.%m.%d')";
	$vrow = $p_con->select($qry);
	return $vrow[0][0];
}

function GetFullDate($p_con, $p_isfull = 'YES') {
	if ($p_isfull == "YES" && ($_SESSION ['asuinfo_lang'] == "" || $_SESSION ['asuinfo_lang'] == "mn")) {
		$qry = "SELECT DATE_FORMAT(NOW(), '%Y оны %m-р сарын %d')";
	} else {
		$qry = "SELECT DATE_FORMAT(NOW(), '%Y.%m.%d')";
	}
	$vrow = $p_con->select ( $qry );
	return $vrow [0] [0];
}

function GetWeekDayName($p_con, $p_date=''){
	if($p_date=="") $p_date=GetFullDateTime($p_con, "NO");
	$garag=date('w', mktime(0, 0, 0, substr($p_date,5,2), substr($p_date,8,2)+1, substr($p_date,0,4)));
	global $day_of_week;
	return $day_of_week[$garag];
}

function VisitorCalc($p_con) {
	if ((! isset ( $_SESSION ['asuinfo_visitorcount'] ))) {
		$timestamp = time ();
		$ip = getRealIpAddr ();
		$file = $_SERVER ['HTTP_REFERER'];
		
		$qry = "insert into asu_visitor(timestamp, ip, file, VisitDate)";
		$qry .= " values('$timestamp', '$ip', '$file', NOW())";
		$p_con->qryexec ( $qry );
		
		$qry = "update asu_visitorcount set VisitorCount=VisitorCount+1, UpdateDate=NOW()";
		$p_con->qryexec ( $qry );
		
		$qry = " select VisitorCount, DATE_FORMAT(StartDate, '%Y.%m.%d') as StartDate";
		$qry .= " from asu_visitorcount";
		$row = $p_con->select ( $qry );
		$_SESSION ['asuinfo_visitorcount'] = $row [0] [0];
		$_SESSION ['asuinfo_visitorsdate'] = $row [0] [1];
	}
}

function GetMailHeader($p_mail, $p_mailcc = '') {
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
	$headers .= "From: $p_mail" . "\r\n";
	$headers .= "Reply-To: $p_mail" . "\r\n";
	$headers .= "Return-Path: $p_mail" . "\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion () . "\r\n";
	if ($p_mailcc != '')
		$headers .= "Bcc: $p_mailcc" . "\r\n";
	return $headers;
}

function UploadFile($p_filename, $p_filepath, $p_isimg = 'YES') {
	if ($_FILES ["$p_filename"] ["name"] != "") {
		$fileext = strtolower ( substr ( $_FILES ["$p_filename"] ["name"], strlen ( $_FILES ["$p_filename"] ["name"] ) - 3, 3 ) );
		if ($p_isimg == "YES") {
			if ($fileext != "gif" && $fileext != "jpg") {
				GotoPage ( "Зургийн өргөтгөл нь (*.jpg) юмуу (*.gif) байх ёстой!", "back" );
			} else if ($_FILES ["$p_filename"] ["size"] > 1024 * 1024) {
				GotoPage ( "Зургийн хэмжээ 1MB (1024KB)-аас ихгүй байх ёстой!", "back" );
			}
		}
		$filepath = $p_filepath . "." . $fileext;
	} else
		$filepath = '';
	if ($filepath != '') {
		if (! move_uploaded_file ( $_FILES ["$p_filename"] ["tmp_name"], $filepath )) {
			print "Possible file upload attack!  Here's some debugging info:\n";
			echo $filepath;
			print_r ( $_FILES );
			exit ();
		}
	}
	return $filepath;
}

function getFileExt($filename){
	$path_info = pathinfo($filename);
	return $path_info['extension'];
}

function GetFTPUpload($p_filesrc, $p_filesource, $p_filepath) {
	global $cfg;
	$con_ftp = ftp_connect ( $cfg ['ftp'] ['host'] ) or die ( "Couldn't connect to " . $cfg ['ftp'] ['host'] );
	$login_ftp = ftp_login ( $con_ftp, $cfg ['ftp'] ['user'], $cfg ['ftp'] ['password'] );
	if (! $login_ftp) {
		echo "FTP connection has failed!";
		echo "Attempted to connect to " . $cfg ['ftp'] ['host'] . " for user " . $cfg ['ftp'] ['user'];
		exit ();
	}
	$fileext = strtolower ( substr ( $_FILES [$p_filesrc] ["name"], strlen ( $_FILES [$p_filesrc] ["name"] ) - 3, 3 ) );
	$filepathfull = $p_filepath . "." . $fileext;
	
	$destination_file = $cfg ['ftp'] ['filesource_to'] . $filepathfull;
	$source_file = $p_filesource;
	$upload = ftp_put ( $con_ftp, $destination_file, $source_file, FTP_BINARY );
	if (! $upload) {
		echo "FTP upload has failed!";
	} else {
		//echo "Uploaded $source_file to ".$cfg['ftp']['host']." as $destination_file";
	}
	ftp_close ( $con_ftp );
	return $filepathfull;
}

function GetStrRepl($p_str) {
	$res = $p_str;
	$res = str_replace ( "<", "", $res );
	$res = str_replace ( ">", "", $res );
	return $res;
}

function getRealIpAddr() {
	if (! empty ( $_SERVER ['HTTP_CLIENT_IP'] )) {
		//check ip from share internet
		$ip = $_SERVER ['HTTP_CLIENT_IP'];
	} elseif (! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
		//to check ip is pass from proxy
		$ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER ['REMOTE_ADDR'];
	}
	return $ip;
}

function asuUniConvert($txt, $type=1, $ishtmlentity=1){
	global $letters_unicode, $letters_nonunicode, $charset;
	$txt=trim($txt);
	switch($type){
		case 0: // unicode iig windows cryllic ruu hurvuulne
			$txt = str_replace($letters_unicode,$letters_nonunicode,trim($txt)); 
		break;
		case 1: // windows cryllic iig unicode ruu hurvuulne
			$txt = str_replace($letters_nonunicode,$letters_unicode,trim($txt));
		break;
	}
	if($ishtmlentity==1) $txt=htmlentities($txt,ENT_QUOTES,$charset);
	if(get_magic_quotes_gpc()) $txt=stripslashes($txt);
	return $txt;
}

function asuIsUserLogin($p_con, $p_httphost) {
	if ($_SESSION ['asuinfo_username'] == '' || stristr ( $_SERVER ['HTTP_HOST'], $p_httphost ))
		return true;
	$username = $_SESSION ['asuinfo_username'];
	$timeoutseconds = 300;
	$timestamp = time ();
	$timeout = $timestamp - $timeoutseconds;
	$table = "asu_useronline";
	
	$p_con->qryexec ( "delete from $table where ip='$_SERVER[REMOTE_ADDR]'" );
	$p_con->qryexec ( "delete from $table where timestamp<$timeout" );
	
	$qry = "select *";
	$qry .= " from $table";
	$qry .= " where UserName='$username'";
	$row = $this->select ( $qry );
	$rowcount = count ( $row );
	if ($rowcount > 0) {
		session_destroy ();
		GotoPage ( "\'$username\' hereglegcheer program ruu nevtersen baina!" );
		exit ();
	} else {
		$ip = $_SERVER ['REMOTE_ADDR'];
		$qry = "insert into $table(timestamp, ip, file, UserName, CreateDate)";
		$qry .= " values('$timestamp', '$ip', '$PHP_SELF', '$username', NOW())";
		$p_con->qryexec ( $qry );
	}
}

function asuCropImage($nw, $nh, $source, $dest) {
	
	require_once ("thumbnail.inc.php");
	$thumb = new Thumbnail ( $source );
	
	if (empty ( $nw ) || empty ( $nh )) {
		if (empty ( $nw ))
			$thumb->resize ( "", $nh );
		elseif (empty ( $nh ))
			$thumb->resize ( $nw, "" );
	} else {
		$size = getimagesize ( $source );
		$imgw = $size [0];
		$imgh = $size [1];
		
		if ($imgw > $imgh)
			$thumb->resize ( "", $nh );
		elseif ($imgw < $imgh)
			$thumb->resize ( $nw, "" );
		else
			$thumb->resize ( $nw, $nh );
		
		if ($nw == $nh)
			$thumb->cropFromCenter ( $nw );
		else
			$thumb->crop ( 0, 0, $nw, $nh );
	}
	$thumb->save ( $dest, 90 );
}

function massMail($title,$sendmail,$bodymsg,$con){
	$qry="select * from tbl_massmail where IsShow = 'YES' order by CreateDate";
	$row = $con->select($qry);
	$rowcount = count($row);
	$mails = '';
	for($i=0; $i<$rowcount; $i++){
	
		$mails.= $row[$i]['`Massmail`'];
		if($i<$rowcount-1 && ($i+1)%100!=0 )$mails.=";";
	
		if(($i+1)%100==0){
			$rs = mail($sendmail,"$title :: www.ulaanbaatar.mn",$bodymsg,GetMailHeader($mails));
		$mails = '';
		}
	
	}
	if($mails!=''){
		$rs = mail($mails,"$title :: www.ulaanbaatar.mn",$bodymsg,GetMailHeader($sendmail));
	}
	//$rs = mail('erdenebat_15@yahoo.com;er.erdenebat@gmail.com',"$title :: www.badamjunai.mn",$bodymsg,GetMailHeader($sendmail));
	return $rs;
}
?>