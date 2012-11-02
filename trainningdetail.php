<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	require_once 'headerjsstyle.php';
	
	if($_GET['trainningid']) $trainningid=$_GET['trainningid'];
//	if(isset($_GET['organclassid'])) $organclassid=$_GET['organclassid'];
//	else $organclassid="101";
//	if(isset($_GET['organid'])) $organid=$_GET['organid'];
	
	$organid = $con->GetDescr("select OrganID from tbl_trainning where TrainningID = '$trainningid'");
	$organclassid = $con->GetDescr("select OrganClassID from ref_organ where OrganID = '$organid'");
	
	$pagelink1=$rf."/trainning";
?>
</head>
<body>
<div class="conter">
<div id="main">
	<?php require_once 'header.php';?>
	<div class="clear"></div>
	<div>
		<div class="hdtitle1">&nbsp;&nbsp;Сургалт
		<?php if(!empty($organclassid)){?> :: <span style="text-transform: none;"><?php echo $con->GetDescr("select OrganClassName from ref_organclass where OrganClassID = '$organclassid'");?> </span> <?php }?>
		<?php if(!empty($organid)){?> :: <span style="text-transform: none;"><?php echo $con->GetDescr("select OrganName from ref_organ where OrganID = '$organid'");?> </span> <?php }?>
		</div>
		<div style="float: left; width: 240px; margin-right: 10px">
			<?php require_once 'newsorganclass.php';?>
			<?php require_once 'poll.php';?>
		</div>
		<div style="float: left; width: 750px">
			<?php require_once 'trainningdetailcontent.php'; ?>
		</div>
	</div>
	<div class="clear"></div>
	<?php require_once 'footer.php';?>
</div>
</div>
</body>
</html>