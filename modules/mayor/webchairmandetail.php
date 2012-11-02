<?php
	require_once 'libraries/connect.php';
	$con=new Database();
	
	$chairmanid=$_GET['chairmanid'];
        
        if(empty($chairmanid) || $chairmanid==101){
            $chairmanid=$con->GetDescr("select min(ChairmanID) from mayor_chairman");
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="chairman";
?>

</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenuchairman.php';?></td>
			<td width="600" valign="top">
			<?php
				$qry="select * from mayor_chairman";
				$qry.=" where IsShow='YES'";
				$qry.=" and ChairmanID='$chairmanid'";
				$row=$con->select($qry);
			?>
			<div class="formcenter">
			<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
				<td><div class=pageformtitle>Орлогч дарга &raquo; <?=mb_substr($row[0]['LastName'],0,1,'utf-8')?>.<?=$row[0]['FirstName']?></div></td>
					<td></td>
				</tr>
				<tr>
				<td colspan="2">
				<div class="pageform">
					<div class="descr">
						<?php if(count($row)>0){
							echo str_replace("/files", "$rfub/files", $row[0]['Descr']);
						?>
						<?php }else{?>
							<div class="notice"> <?=$strnotfound?></div>
						<?php }?>
					 </div>
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