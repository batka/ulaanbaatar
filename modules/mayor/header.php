<?php
	global $rf, $module;
	
	if(!empty($module)){
		$qry="select * from mayor_webtopmenu where IsShow='YES' and TopMenuLink='$module'";
		$row=$con->select($qry);
		$menutitle=$row[0]['TopMenuName'.$_SESSION['mayor_lang']];
	}
	
	$mn="/";
	$en="/en/";
?>

<div style="width: 1000px; margin: auto;">
	<div style="float: right">
			<a href="<?=$mn?>" class="mnlang">
				<?=$strMongolia?>
			</a>
			<a href="<?=$mn?>" class="mnlang" style="text-decoration: none;">
				<img src="<?=$rf?>/images/flag/mn.gif" width="16" style="vertical-align: middle">&nbsp;
			</a>
			<span style="color: #000; font-size: 11px;">|</span>						
			<a href="<?=$en?>" class="enlang" style="text-decoration: none;">
				<img src="<?=$rf?>/images/flag/uk.gif" width="16" style="vertical-align: middle">
			</a>
			<a href="<?=$en?>" class="enlang">
				Англи
			</a>
	</div>
	<div class="clear"></div>
</div>
<div class="header">
	<table cellpadding="0" cellspacing="0" height="80" width="100%">
		<tr height="60">
			<td>
			</td>
		</tr>
		<tr height="20">
			<td align="right" valign="bottom">
				<?php require_once 'formtopmenu.php';?>
			</td>
		</tr>
	</table>
</div>
