<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	require_once 'headerjsstyle.php';
	
	$pagelink1=$rf."/comcity";
	if($_GET['comcityid']) $comcityid=$_GET['comcityid'];
?>
<link type="text/css" rel="stylesheet" href="<?=$rf;?>/js/jquery/jquery.validate/stylejqvalidate.css"/>
<script type="text/javascript" src="<?=$rf?>/js/jquery/jquery.validate/jquery.validate.js"></script>
</head>
<body>
<div class="conter">
<div id="main">
	<?php require_once 'header.php';?>
	<div class="clear"></div>
	<div>
		<div class="hdtitle">&nbsp;&nbsp;Хамтын ажиллагаатай хотууд</div>
		<div style="float: left; width: 240px; margin-right: 10px">
			<?php require_once 'newsorganclass.php';?>
			<?php require_once 'poll.php';?>
		</div>
		<div style="float: left; width: 750px">
			<?php require_once 'webcomcitydetailcontent.php';?>
		</div>
	</div>
	<div class="clear"></div>
	<?php require_once 'footer.php';?>
</div>
</div>
</body>
</html>