<div id="column_2">
	<div id="menu_wrapper">
		<ul class="pcmlevel1">
			<li class="pcml1selected rdcmsSHOW">
				<div class="sectionFOR">
<?php
	$qry="select OrganClassID, OrganClassName";
	$qry.=" from ref_organclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount){
?>

					<div class="level1selected"><a href="<?=$rf;?>/<?=$page;?>/<?=$row[$j]['OrganClassID'];?>"><span><?=$row[$j]['OrganClassName'];?></span></a></div>
					<ul class="pcmlevel2" <?php if($organclassid!=$row[$j]['OrganClassID']) echo "style='display: none';"; else echo "style='display: block';";?>>
<?php
	$qry = "select * from ref_organ";
	$qry .= " where IsShow='YES' and OrganClassID='".$row[$j]['OrganClassID']."'";
	$qry .= " order by ShowOrder";
	$row1 = $con->select ( $qry );
	$rowcount1 = count ( $row1 );
	for($j1 = 0; $j1 < $rowcount1; $j1 ++) {
?>
								<li class="pcml2selected rdcmsSHOW">
									<div class="overFOR"><a <?php if($organid==$row1[$j1]['OrganID'])echo ' class="active" ';?> href="<?=$rf;?>/<?=$page;?>/<?=$row[$j]['OrganClassID'];?>/<?=$row1[$j1]['OrganID'];?>" title=""><span><?=$row1[$j1]['OrganName'];?></span></a></div>
								</li>
<?php
	} 
?>
					</ul>
<?php
	$j++;
	} 
?>
				</div>
			</li>
		</ul>
	</div>
</div>
