<?php	
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	require_once 'headerjsstyle.php';
	
	if($_GET['eventid']) $eventid=$_GET['eventid'];
?>
</head>
<body>
<div class="conter">
<div id="main">
	<?php require_once 'header.php';?>
	<div class="clear"></div>
	<div>
		<div class="hdtitle3">&nbsp;&nbsp;Үйл явдал</div>
		<div style="float: left; width: 250px; margin-right: 10px">
			<?php require_once 'eventday.php';?>
		</div>
		<div style="float: left; width: 740px">
			<?php require_once 'eventdetailcontent.php';?>
		</div>
	</div>
	<div class="clear"></div>
	<?php require_once 'footer.php';?>
</div>
</div>
</body>
</html>