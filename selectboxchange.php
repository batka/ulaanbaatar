<?php
	require 'libraries/connect.php';
	$con = new Database();
	
	$sbstrselect=$_GET['sbstrselect'];
	$sbstrselect=$$sbstrselect;
	$sbdst=$_GET['sbdst'];
	echo "[";
	if ($sbdst=='#organid'){
		echo '{"optionValue": "", "optionDisplay": "'.$sbstrselect.'"}';
		$qry="select * from ref_organ";
		$qry.=" where IsShow='YES' and OrganClassID='".$_GET['id']."'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$j=0;
			while($j<$rowcount){
				echo ', {"optionValue": "'.$row[$j]['OrganID'].'", "optionDisplay": "'.$row[$j]['OrganName'].'"}';
				$j++;
			}
		} else echo ', {"optionValue": "", "optionDisplay": ""}';
	} elseif($sbdst=='#priceclasssub1id'){
		echo '{"optionValue": "", "optionDisplay": "'.$sbstrselect.'"}';
		$qry="select * from ref_priceclasssub1";
		$qry.=" where IsShow='YES' and PriceClassSubID='".$_GET['id']."'";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$j=0;
			while($j<$rowcount){
				echo ', {"optionValue": "'.$row[$j]['PriceClassSub1ID'].'", "optionDisplay": "'.$row[$j]['PriceClassSub1Name'].'"}';
				$j++;
			}
		} else echo ', {"optionValue": "", "optionDisplay": ""}';
	} elseif($sbdst=='#month'){
		echo '{"optionValue": "", "optionDisplay": "'.$sbstrselect.'"}';
		$qry="SELECT DATE_FORMAT(RegDate, '%m') AS RegMonth, DATE_FORMAT(RegDate, '%m-р сар') AS Title FROM tbl_pricenews";
		$qry.=" where DATE_FORMAT(RegDate, '%Y')='".$_GET['id']."'";
		$qry.=" group by RegMonth";
		$qry.=" order by RegMonth";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$j=0;
			while($j<$rowcount){
				echo ', {"optionValue": "'.$row[$j]['RegMonth'].'", "optionDisplay": "'.$row[$j]['Title'].'"}';
				$j++;
			}
		} else echo ', {"optionValue": "", "optionDisplay": ""}'';
	}
	echo "]";
?>