<?php
	require_once("libraries/connect.php");
	$con = new Database();
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE><?=$pagetitleprog;?></TITLE>
</HEAD>

<BODY bgcolor="#ffffff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<?php
	
	$action=$_GET['action'];
	
	if(!empty($_GET['lang'])) $lang=$_GET['lang'];
	if(!empty($_POST['backlink'])) $backlink=$_POST['backlink'];
	
	if(!empty($_POST['descr'])) $descr=asuUniConvert($_POST['descr'],1,0);
	if(!empty($_POST['descr1'])) $descr1=asuUniConvert($_POST['descr1'],1,0);
	if(!empty($_POST['newstype'])) $newstype = $_POST['newstype'];
	if(!empty($_POST['newsid'])) $newsid = $_POST['newsid'];
	if(!empty($_POST['title'])) $title = asuUniConvert($_POST['title']);
	if(!empty($_POST['newsclassid'])) $newsclassid = $_POST['newsclassid'];
	if(!empty($_POST['albumid']))$albumid = $_POST['albumid'];
	if(!empty($_POST['startdate']))$startdate = $_POST['startdate'];
	if(!empty($_POST['enddate']))$enddate = $_POST['enddate'];
	if(!empty($_POST['starttime']))$starttime = $_POST['starttime'];
	if(!empty($_POST['endtime']))$endtime = $_POST['endtime'];
	if(!empty($_POST['location']))$location = asuUniConvert($_POST['location']);
	if(!empty($_POST['spec']))$spec = $_POST['spec'];
	else $spec = 'NO';
	
	if(!empty($_POST['lawruleid'])) $lawruleid=$_POST['lawruleid'];
	if(!empty($_POST['errandid'])) $errandid=$_POST['errandid'];
	
	if($action=="changelang"){
		if($lang=="mn"){
			$_SESSION['mayor_lang']="mn";
		}elseif($lang=="en"){
			$_SESSION['mayor_lang']="en";
		}
		echo $_SESSION['mayor_lang'];
		GotoPage("", $backlink);
	} elseif($action=="lawruledownloadfile"){
		$qry="select * from tbl_lawrule where IsShow='YES' and LawRuleID='$lawruleid'";
		$row=$con->select($qry); echo $qry;
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
			} //else GotoPage("Файл олдсонгүй!"); 
		}
	//	else GotoPage("Файл байхгүй!");
	} elseif($action=="erranddownloadfile"){
		$qry="select * from mayor_errand where IsShow='YES' and ErrandID='$errandid'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$filename = $drf."/files/errand/".$row[0]['FileSource'];
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
	} 
?>
</BODY>