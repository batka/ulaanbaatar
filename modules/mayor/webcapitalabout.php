<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="capital";
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenucapital.php';?></td>
			<td width="600" valign="top">
			<?php
				$qry="select * from mayor_capital";
				$qry.=" where IsShow='YES'";
				$qry.=" and CapitalLink='about'";
				$row=$con->select($qry);
			?>
			<div class="formcenter">
				<div class="dcontenttitle"><?=$row[0]['CapitalName'.$_SESSION['mayor_lang']]?></div>
				<div class=dcontent>
					<div class="descr">
						<?php if(count($row)>0){?>
							<?=$row[0]['Descr']?>
						<?php }else{?>
							<span class="notice">Хандалт буруу байна!</span>
						<?php }?>
					 </div>
				</div>
			</div>
			</td>
			<td width="200" valign="top"></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>