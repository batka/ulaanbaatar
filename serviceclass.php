<div id="column_2">
	<div id="menu_wrapper">
		<ul class="pcmlevel1">
			<li class="pcml1selected rdcmsSHOW">
				<div class="sectionFOR">
					<div class="level1selected"><a href="javascript:"><span>Төрийн үйлчилгээний чиглэл</span></a></div>
					<ul class="pcmlevel2">
<?php
	$qry="SELECT T.ServiceClassID,T.ServiceClassName,"; 
	$qry.=" IFNULL(COUNT(S.ServiceID), 0) AS ServiceCount"; 
	$qry.=" FROM ref_serviceclass T"; 
	$qry.=" LEFT JOIN"; 
	$qry.=" (";
	$qry.=" SELECT ServiceClassID, ServiceID"; 
	$qry.=" FROM tbl_service";
	$qry.=" WHERE IsShow='YES'"; 
	$qry.=" ) S"; 
	$qry.=" ON T.ServiceClassID=S.ServiceClassID"; 
	$qry.=" WHERE T.IsShow='YES'";
	$qry.=" GROUP BY T.ServiceClassID"; 
	$qry.=" ORDER BY T.ShowOrder";
	
//	$qry = "select ServiceClassID, ServiceClassName from ref_serviceclass";
//	$qry .= " where IsShow='YES'";
//	$qry .= " order by ShowOrder";
	//echo $qry; exit;
	$row1 = $con->select ( $qry );
	$rowcount1 = count ( $row1 );
	for($j1 = 0; $j1 < $rowcount1; $j1 ++) {
?>
								<li  class="pcml2selected rdcmsSHOW">
									<div class="overFOR"><a <?php if($serviceclassid==$row1[$j1]['ServiceClassID'])echo ' class="active" ';?>  href="<?=$rf;?>/service/<?=$row1[$j1]['ServiceClassID'];?>" title=""><span><?=$row1[$j1]['ServiceClassName'];?> (<?=$row1[$j1]['ServiceCount'];?>)</span></a></div>
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
<style type="text/css">
</style>