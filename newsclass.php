<div id="column_2">
	<div id="menu_wrapper">
		<ul class="pcmlevel1">
			<li class="pcml1selected rdcmsSHOW">
				<div class="sectionFOR">
					<div class="level1selected"><a href="<?=$rf;?>/news"><span>Цаг үеийн мэдээ</span></a></div>
					<ul class="pcmlevel2">
<?php
	$qry="SELECT T.NewsClassID,T.NewsClassName,"; 
	$qry.=" IFNULL(COUNT(S.NewsID), 0) AS NewsCount"; 
	$qry.=" FROM ref_newsclass T"; 
	$qry.=" LEFT JOIN"; 
	$qry.=" (";
	$qry.=" SELECT NewsClassID, NewsID"; 
	$qry.=" FROM tbl_news";
	$qry.=" WHERE IsShow='YES'"; 
	$qry.=" ) S"; 
	$qry.=" ON T.NewsClassID=S.NewsClassID"; 
	$qry.=" WHERE T.IsShow='YES'";
	$qry.=" GROUP BY T.NewsClassID"; 
	$qry.=" ORDER BY T.ShowOrder";
	
	
	$row = $con->select ( $qry );
	$rowcount = count ( $row );
	for($j = 0; $j < $rowcount; $j ++) {
?>
								<li class="pcml2selected rdcmsSHOW">
									<div class="overFOR"><a <?php if($newsclassid==$row[$j]['NewsClassID'])echo ' class="active" ';?> href="<?=$rf;?>/news/<?=$row[$j]['NewsClassID'];?>" title=""><span><?=$row[$j]['NewsClassName'];?> (<?=$row[$j]['NewsCount'];?>)</span></a></div>
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
