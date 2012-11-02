<?php
	$qry="select * from mayor_director";
	$qry.=" where IsShow='YES'";
	$qry.=" and Mayor='YES'";
	$row=$con->select($qry);
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
	<td><div class=pageformtitle><?=$govformtitle?></div></td>
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