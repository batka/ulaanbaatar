<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="gallery";
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="800" valign="top"><?php require_once 'formphoto.php';?></td>
			<td width="200" valign="top"><?php require 'formwebleft.php';?></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>