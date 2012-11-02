<?php 
	$qry="select *";
	$qry.=" from tbl_banner";
	$qry.=" where IsShow='YES' and BannerClassID='102'";
	$qry.=" and DATE_FORMAT(NOW(), '%Y-%m-%d') between StartDate and EndDate";
	$qry.=" order by ShowOrder";
	//echo $qry; exit;
	$row=$con->select($qry);
	$rowcount=count($row);
?>
<div style="margin-top: 10px; border: 1px solid #ededed; padding: 2px">
<?php 
	$j=0;
	while ($j<$rowcount){
		$qs1="bannerid=".$row[$j]['BannerID'];
		$fileext=strtolower(pathinfo($row[$j]['FileSource'], PATHINFO_EXTENSION));
		if ($fileext=='swf'){
?>
	<EMBED pluginspage=http://www.macromedia.com/go/getflashplayer src="<?=$rf?>/files/banner/<?=$row[$j]['FileSource']?>" width="254" type=application/x-shockwave-flash quality="1" wmode="Window" menu="true" loop="true" play="true" scale="exactfit"></EMBED>
<?php
		} else { 
			$filesource=$drf."/files/banner/small/".$row[$j]['FileSource'];
			if (!empty($row[$j]['FileSource']) && file_exists($filesource)){ 
				$filesource=$rf."/files/banner/small/".$row[$j]['FileSource']; 
				if (!empty($row[$j]['Url'])){
?>
	<a href="<?=$row[$j]['Url']?>" target="_blank">
    	<img src="<?=$filesource;?>" width="254" title="<?=$row[$j]['Title']?>">
    </a>
<?php
    			} else { 
?>
	<a href="javascript:" onclick="OpenWindow('print/printreport.php?fn=bannerdetail.php&qs1=<?=$qs1;?>',500); return false;">
		<img src="<?=$filesource;?>" width="254" title="<?=$row[$j]['Title']?>"/>
	</a>
<?php
				}
			}
		}
	$j++;
	} 
?>
</div>