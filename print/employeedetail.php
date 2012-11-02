<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<?php
	require_once "headerjsstyle.php";
?>
<style type="text/css" media="screen">
	@import url( <?=$rf;?>/styles/stylemain.css);
</style>
</head>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0" style="background-image:none">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
			<tr>
				<td colspan="2"><?php require_once "reportheader.php"; ?></td>
			</tr>
<?php
	if(isset($_GET['employeeid'])) $employeeid=$_GET['employeeid'];
	$qry="select T.*, DepartmentName, PositionName";
	$qry.=" from tbl_employee T";
	$qry.=" left join ref_department D on T.DepartmentID=D.DepartmentID";
	$qry.=" left join ref_position P on T.PositionID=P.PositionID";
	$qry.=" where EmployeeID='$employeeid'";
	$row=$con->select($qry);
?>
			<tr bgcolor="#5D86C6">
				<td colspan="2"><div style="padding: 2 5 2 5;"><b class="white">АЛБАН ХААГЧИЙН МЭДЭЭЛЭЛ</b></div></td>
			</tr>
			<tr valign="top">
				<td colspan="2">
					<?php if(!empty($row[0]['ImageSource'])){ ?>
                        <div align="center"><img src="<?=$rf;?>/files/employee/<?=$row[0]['ImageSource'];?>" width="150" align="absmiddle"></div>
                    <?php } ?>
                    </td>
			</tr>
			<tr valign="top">
				<td colspan="2" align="center"><b class="blue"><?=mb_strtoupper($row[0]['EmployeeName'], 'UTF-8');?></b></td>
			</tr>
			<tr valign="top">
				<td width="20%" nowrap>Хэлтэс, алба:</td>
				<td><b><?=$row[0]['DepartmentName'];?></b></td>
			</tr>
			<tr valign="top">
				<td nowrap>Албан тушаал:</td>
				<td><b><?=$row[0]['PositionName'];?></b></td>
			</tr>
			<tr valign="top">
				<td nowrap>Хариуцсан ажил:</td>
				<td><b><?=$row[0]['Job'];?></b></td>
			</tr>
			<tr valign="top">
				<td nowrap>И-мэйл:</td>
				<td><b><a class="blue" href="mailto:<?=$row[0]['Email'];?>" target="_blank"><?=$row[0]['Email'];?></a></b></td>
			</tr>
			<tr valign="top">
				<td nowrap>Утас:</td>
				<td><b><?=$row[0]['Telephone'];?></b></td>
			</tr>
			<?php if(!empty($row[0]['Descr'])){ ?>
			<tr valign="top">
				<td colspan="2"><div align="justify"><?=$row[0]['Descr'];?></div></td>
			</tr>
			<?php } ?>
			</table>
		</td>
	</tr>
	</table>

</BODY>
</html>
