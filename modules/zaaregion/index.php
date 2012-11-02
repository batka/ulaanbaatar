<?php
	require_once '../../libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	require_once $drf.'/headerjsstyle.php';
	
	if($_GET['url']) $url=$_GET['url'];
?>
<style type="text/css">
div.if, iframe { 
	margin:0; 
	padding:0; 
	height:2400px; 
}
iframe { 
	display:block; 
	width:100%; 
	border:none; 
}
</style>
</head>
<body>
<div class="conter">
<div id="main">
	<?php require_once $drf.'/header.php';?>
	<div class="clear"></div>
	<div>
		<div class="column_1"><?php require_once $drf.'/homenews.php';?></div>
		<div class="column_2">
			<?php require_once $drf.'/homecreation.php';?>
			<div style="height: 52px; border: 1px solid #cbcbcb; margin-top: 5px">
				<a href="http://www.mayor.mn" target="_blank"><img src="<?=$rf;?>/images/web/mayor.mn.jpg" width="250" height="52"/></a>
			</div>
			<?php require_once $drf.'/nzb.php';?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="h100">
<?php
	$qry="select Domain";
	$qry.=" from zaaregion_class";
	$qry.=" where IsShow='YES' and Url='$url'";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	if($rowcount>0){
?>
		<iframe src="<?=$row[0]['Domain'];?>" border="0" frameborder="0" id="iframeload"></iframe>
<?php
	} 
?>
	</div>
	<?php require_once $drf.'/footer.php';?>
</div>
</div>
</body>
</html>