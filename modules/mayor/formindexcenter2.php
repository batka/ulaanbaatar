<div style="margin-top: 15px; min-height: 50px; text-align: center;">
	<?php
		$qry="select *";
		$qry.=" from district_class";
		$qry.=" where IsShow='YES'";		
		$qry.=" order by DistrictID";
		$row=$con->select($qry);
		$rowcount=count($row);
		for($i=0; $i<$rowcount; $i++){
	?>
	<div class="districtimg" style="<?php if($i==$rowcount-1) echo "margin-right: 0px;"?>">
		<a href="<?=$row[$i]['Domain']?>" target="_blank" class="districta" title="<?=$row[$i]['DistrictName']?>">
			<img src="<?=$rf?>/images/district/<?=$row[$i]['ImageSource']?>"/>
			<div><?=$row[$i]['ShortName']?></div>
		</a>
	</div>
	<?php }?>
	<div class="clear"></div>
</div>