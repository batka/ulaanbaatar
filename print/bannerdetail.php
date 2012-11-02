<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	require_once '../headerjsstyle.php'; 
	if(isset($_GET['bannerid'])) $bannerid=$_GET['bannerid'];
?>
</head>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0">

	<table width="100%" border="0" cellspacing="2" cellpadding="2">
	<tr>
		<td><?php require_once "reportheader.php"; ?></td>
	</tr>
<?php
	$qry="select T.*";
	$qry.=" from tbl_banner T";
	$qry.=" where BannerID='$bannerid'";
	//echo $qry;
	$row=$con->select($qry);
?>
	<tr bgcolor="#5D86C6">
		<td><div style="padding: 2 5 2 5;"><b style="color: #fff">Баннер, сурталчилгаа</b></div></td>
	</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
			<tr valign="top">
				<td><div><b style="font-size:12px;"><?=$row[0]['Title'];?></b></div></td>
			</tr>
			<tr>
				<td><div align="justify" style="line-height: 1.5em"><?=$row[0]['Descr'];?></div></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

</BODY>
</html>
