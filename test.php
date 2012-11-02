<?php
	echo "123"; exit;
	require_once 'libraries/connect.php';
	$con = new Database ( );
	
	echo "13"; exit;
	$qry="select Title, ImageSource";
	$qry.=" from capital_header";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	echo $qry; exit;
	$row=$con->select($qry);
	$rowcount=count($row); 
	
	$j=0;
	while ($j<$rowcount){
		$imagesource=$drf."/files/header/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/header/small/".$row[$j]['ImageSource'];
?>
		<li>
			<a href=""><img src="<?=$imagesource;?>" alt="" title="" width="1373" height="375" /></a>
		</li>
<?php
	$j++;
	} 
?>