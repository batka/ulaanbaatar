<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="nzdtg";
	$aboutid=$_GET['aboutid'];
	$formtitle=$con->GetDescr("select AboutName".$_SESSION['mayor_lang']." from mayor_nzdtgabout where AboutID='$aboutid'");
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenunzdtg.php';?></td>
			<td width="600" valign="top">
				<?php
					$qry="select *";
					$qry.=" from mayor_nzdtgabout";
					$qry.=" where IsShow='YES'";
					$qry.=" and AboutID='$aboutid'";
					$row=$con->select($qry);
				?>
				<div class="formcenter">
					<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
						<td><div class=pageformtitle><?=$strnzdtgabout?> &raquo; <?=$formtitle?></div></td>
							<td align="right">
							<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
							</div>
							</td>
						</tr>
						<tr>
						<td colspan="2">
						<div class="pageform">
							<div class="descr"><?=$row[0]['Descr']?></div>
							<div class="clear"></div>
						</div>
						</td>
					</tr>
					</table>	
				</div>
			</td>
			<td width="200" valign="top"><?php require_once 'formwebleft.php';?></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>