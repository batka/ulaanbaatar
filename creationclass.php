<div id="column_2">
	<div id="menu_wrapper">
		<ul class="pcmlevel1">
			<li class="pcml1selected rdcmsSHOW">
				<div class="sectionFOR">
					<div class="level1selected"><a href="<?=$rf;?>/creation"><span>Бүтээн байгуулалтын чиглэл</span></a></div>
					<ul class="pcmlevel2">
<?php
	$qry="SELECT T.CreationClassID,T.CreationClassName,"; 
	$qry.=" IFNULL(COUNT(S.CreationID), 0) AS CreationCount"; 
	$qry.=" FROM ref_creationclass T"; 
	$qry.=" LEFT JOIN"; 
	$qry.=" (";
	$qry.=" SELECT CreationClassID, CreationID"; 
	$qry.=" FROM tbl_creation";
	$qry.=" WHERE IsShow='YES'"; 
	$qry.=" ) S"; 
	$qry.=" ON T.CreationClassID=S.CreationClassID"; 
	$qry.=" WHERE T.IsShow='YES'";
	$qry.=" GROUP BY T.CreationClassID"; 
	$qry.=" ORDER BY T.ShowOrder";
	
//	$qry = "select * from ref_creationclass";
//	$qry .= " where IsShow='YES'";
//	$qry .= " order by ShowOrder";
	$row = $con->select ( $qry );
	$rowcount = count ( $row );
	for($j = 0; $j < $rowcount; $j ++) {
?>
								<li class="pcml2selected rdcmsSHOW">
									<div class="overFOR"><a <?php if($creationclassid==$row[$j]['CreationClassID'])echo ' class="active" ';?> href="<?=$rf;?>/creation/<?=$row[$j]['CreationClassID'];?>" title=""><span><?=$row[$j]['CreationClassName'];?> (<?=$row[$j]['CreationCount'];?>)</span></a></div>
								</li>
<?php
	} 
?>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>
