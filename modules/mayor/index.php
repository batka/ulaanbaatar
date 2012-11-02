<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<?php
	require_once "headerjsstyle.php";
?>
</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container" >
		<table cellpadding="0" cellspacing="0" width="100%"  style="margin-top: 5px;">
			<tr>
			<td width="650" valign="top">
				<?php
					require_once 'formspecnews.php';
					require_once 'banner.php';
				?>
				
			</td>
			<td width="350" valign="top"><?php require_once 'formindexmiddle.php';?></td>
			</tr>
		</table>
		
		<?php require_once 'formindexcenter1.php';?>
		
		<table cellpadding="0" cellspacing="0" width="100%" style="margin-top: 15px;">
			<tr>
				<td width="375" valign="top"><?php require_once 'formindexcenter3.php';?></td>
				<td width="15"></td>
				<td width="485" valign="top"><?php require_once 'formindexcenter4.php';?></td>
				<td width="15"></td>
				<td width="110" valign="top"><?php require_once 'formftf.php';?></td>
			</tr>
		</table>
		
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>				
				<td width="750" valign="top"><?php require_once 'formindexcenter5.php';?></td>
				<td width="15"></td>
				<td width="235" valign="top"><?php require_once 'formindexcenter6.php';?></td>
			</tr>
		</table>
	</div>	
	<?php require_once 'footer.php';?>
</BODY>
</HTML>