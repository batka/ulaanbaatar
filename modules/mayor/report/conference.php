<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<HTML>
<HEAD>
<?php
	require_once "../headerjsstyle.php";
?>
<style type="text/css">
	table{
		font-family: Tahoma;
		font-size: 12px;
		line-height: 18px;
	}
</style>
</HEAD>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0" style="background-color: white;">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><?php require_once "reportheader.php"; ?></td>
	</tr>
	

<?php
	$conferenceid=$_GET['conferenceid'];
	$descr=$_GET['descr'];
	$repnotice='Хэлэлцэх асуудал';
	switch ($descr){
		case 'Descr1': {$repnotice='Хуралдааны тойм'; break;}
		case 'Descr2': {$repnotice='Хэвлэлийн мэдээ'; break;}
	}
	
	$qry="select Title, $descr";
	$qry.=" from mayor_councilconference";
	$qry.=" where CouncilConfID='$conferenceid'";
	$row=$con->select($qry);
?>
	<tr bgcolor="#a2a2a2">
		<td><div style="padding: 2 5 2 5; color: #fff; font-size: 12px;">Зөвлөлийн хуралдаан &raquo; <?=$repnotice?></div></td>
	</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
			<tr>
				<td><div class="descr"><?=$row[0][$descr];?></div></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

</BODY>
</HTML>