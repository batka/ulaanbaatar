<div class="formcenter" style="margin-right: 0px;">
<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$lmenutitle?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
	<?php
		$qry="select * from mayor_councilposition where IsShow='YES' order by ShowOrder";
		$row=$con->select($qry);
		$rowcount=count($row);
		for($i=0; $i<$rowcount; $i++){
			$qry1="select * from mayor_councilconsist where IsShow='YES' and PositionID='".$row[$i]['PositionID']."'";
			$row1=$con->select($qry1);
			$rowcount1=count($row1);
			if($rowcount1>0){
	?>
	
		<div>
			<?php for($j=0; $j<$rowcount1; $j++){
				if($row1[$j]['PositionID']==101){
			?>
				<div style="background-color: #dadada; width: 250px; padding: 5px; margin: auto; margin-bottom: 10px;">
					<?php if(!empty($row1[$j]['ImageSource']) && file_exists("$drf/images/council/consist/small/".$row1[$j]['ImageSource'])){?>
						<img src="<?=$rf?>/images/council/consist/small/<?=$row1[$j]['ImageSource']?>" height="130"/ style="float: left; margin-right: 5px;">
					<?php }?>
					<div class="descrtitle" style="font-size: 12px; font-weight: normal;"><?=$row[$i]['PositionName']?></div>
					<div class="descr"><?=mb_substr($row1[$j]['LastName'], 0, 1, 'utf-8').".".$row1[$j]['FirstName']?></div>
				<div class="clear"></div>
				</div>
			<?php }else{?>
				<div style="float: left; background-color: #dadada; width: 175px; padding: 5px; margin-right: 9px; margin-bottom: 10px;">
					<?php if(!empty($row1[$j]['ImageSource']) && file_exists("$drf/images/council/consist/small/".$row1[$j]['ImageSource'])){?>
						<img src="<?=$rf?>/images/council/consist/small/<?=$row1[$j]['ImageSource']?>" height="100"/ style="float: left; margin-right: 5px;">
					<?php }?>
					<div class="descrtitle" style="font-size: 12px; font-weight: normal;"><?=$row[$i]['PositionName']?></div>
					<div class="descr"><?=mb_substr($row1[$j]['LastName'], 0, 1, 'utf-8').".".$row1[$j]['FirstName']?></div>
				<div class="clear"></div>
				</div>
			<?php }}?>
		</div>
	<?php }}?>
	<div class="clear"></div>
	
		</div>
		</td>
	</tr>
	</table>
</div>