<?php $today=$con->GetDescr("SELECT DATE_FORMAT(NOW(), '%Y-%m-%d')");?>
<div style="padding: 0px;">
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr valign="bottom">
		<td><div class="indexformtitle">Календарь</div></td>
		<td><a href="<?=$rf?>/calendar/<?=$today?>/" class="indexformmorelink">Цааш<img src="<?=$rf?>/images/web/arrow.png" align="middle"/></a></td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<div class="indexform" style="min-height: 160px; padding-left: 5px">			
				<?php require_once 'formcalendar.php';?>
			</div>
		</td>
	</tr>
	</table>
</div>