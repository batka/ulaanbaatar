<div id="column_2">
	<div id="menu_wrapper">
		<ul class="pcmlevel1">
			<li class="pcml1selected rdcmsSHOW">
				<div class="sectionFOR">
					<div class="level1selected"><a href="javascript:"><span>Он цагийн хэлхээс</span></a></div>
					<ul class="pcmlevel2">
<?php
	$qry = "select HistoryID, TimeLine from tbl_history";
	$qry .= " where IsShow='YES' and OrganID='10101'";
	$qry .= " order by ShowOrder";
	//echo $qry; exit;
	$row1 = $con->select ( $qry );
	$rowcount1 = count ( $row1 );
	for($j1 = 0; $j1 < $rowcount1; $j1 ++) {
?>
								<li class="pcml2selected rdcmsSHOW">
									<div class="overFOR"><a href="<?=$rf;?>/history/<?=$row1[$j1]['HistoryID'];?>" title=""><span><?=$row1[$j1]['TimeLine'];?></span></a></div>
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
