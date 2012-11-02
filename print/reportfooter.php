<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<html>
<head>
<?php require_once '../headerjsstyle.php'; ?>
</head>

<BODY bgcolor="#ffffff" leftmargin="0" topmargin="0" margin width="0" marginheight="0" rightmargin="0" bottommargin="0">

	<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#888888">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="0" bgcolor="#eeeeee">
			<tr valign="middle">
				<td height="20" width="33%">&nbsp;</td>
				<td align="center" width="34%">
					<input type="button" name="btnPrint" onClick="parent['mainFrame'].focus(); parent['mainFrame'].print();" value="<?=$strPrint;?>" />
				</td>
				<td align="right" width="33%">
					<input type="button" name="btnClose" onClick="parent.close();" value="<?=$strExit;?>" />
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
				
</BODY>
</html>
