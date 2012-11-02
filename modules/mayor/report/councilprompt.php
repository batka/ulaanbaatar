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
		line-height: 15px;
	}
</style>
</HEAD>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0" style="background-color: white;">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><?php require_once "reportheader.php"; ?></td>
	</tr>
<?php
	$promptid=$_GET['promptid'];
	$descr=$_GET['descr'];
	$repnotice='&raquo; Үүрэг даалгавар';
	switch ($descr){
		case 'Descr1': {$repnotice='';}
	}
	
	$qry="select Title, $descr, DATE_FORMAT(PromptDate,'%Y-%m-%d') as date";
	$qry.=" from mayor_councilpromptness";
	$qry.=" where CouncilPromptnessID='$promptid'";
	$row=$con->select($qry);
?>
	<tr bgcolor="#a2a2a2">
		<td><div style="padding: 2 5 2 5; color: #fff; font-size: 12px;">Нийслэлийн удирдах ажилтнуудын шуурхай <?=$repnotice?></div></td>
	</tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
			<tr>
				<td>
				<div class="descr">
				<?php if($descr=='Descr1'){?>
					<center><strong><?=$row[0]['date'];?> шуурхайн биелэлт</strong></center></br>
				<?php }?>
				<?=$row[0][$descr];?>
				</div>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

</BODY>
</HTML>