<?php
	require_once ("../../libraries/connect.php");
	$con = new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once 'headerjsstyle.php';
?>
</HEAD>
<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"	rightmargin="0" bottommargin="0">
<table cellpadding="0" cellspacing="0" width="1000" border="0" align="center">
<tr>
    <td colspan="3">
        <?php require_once "../header.php"; ?>
    </td>
</tr>
<tr >
    <td width="5"></td>
    <td valign="top" width="1000" align="left">
    	<table cellpadding="0" cellspacing="0" width="1000" border="0">
        <tr>
        	<td height="10"></td>
        </tr>
        <tr valign="top">
        	<td width="810" align="left">
           		<?php require_once 'panelforumtopicadd.php';?>
            </td>
            <td width="10" align="left" ></td>
            <td width="180">
            	<?php require_once '../formright.php';?>
            </td>
        </tr>
        <tr>
        	<td height="5"></td>
        </tr>
        </table>	
    </td>
	<td width="5"></td>
</tr>
<tr>
	<td colspan="3"><?php require_once '../footer.php';?></td>
</tr>
</table>
</BODY>
</HTML>