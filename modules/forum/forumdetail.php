<?php	
	require_once '../../libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	require_once '../../headerjsstyle.php';
	require_once 'headerjsstyle.php';
	$rf_forum =$rf."/forum";
?>
</head>
<body>
<div class="conter">
<div id="main">
	<?php require_once '../../header.php';?>
	<div class="clear"></div>
	<div>
		<div class="hdtitle3">&nbsp;&nbsp;Хэлэлцүүлэг, судалгаа</div>
		<div>
			<?php require_once 'panelforumdetail.php';?>
		</div>
	</div>
	<div class="clear"></div>
	<?php require_once '../../footer.php';?>
</div>
</div>
</body>
</html>