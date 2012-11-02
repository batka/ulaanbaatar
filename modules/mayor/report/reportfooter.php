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
	input{
		font-size: 12px;
	}
</style>
</HEAD>

<BODY bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0">
	<table width="100%" border="0" cellspacing="3" cellpadding="0" bgcolor="#a2a2a2">
		<tr valign="bottom">
			<td height="10" width="33%">&nbsp;</td>
			<td align="center" width="34%">
				<input type="button" name="btnPrint" value="Хэвлэх" onClick="parent['mainFrame'].focus(); parent['mainFrame'].print();">
			</td>
			<td align="right" width="33%">
				<input type="button" name="btnClose" value="Гарах" onClick="parent.close();">
			</td>
		</tr>
	</table>				
</BODY>
</HTML>
