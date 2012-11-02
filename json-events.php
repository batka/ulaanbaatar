<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
	
	$qry="select *";
	$qry.=" from tbl_event";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;	
	$str="";
	while ($j<$rowcount){
		$str[$j]['id']=$row[$j]['EventID'];
		$str[$j]['title']=GetStrBr($row[$j]['Title'], "100");
		$str[$j]['start']=$row[$j]['StartDate'];
		$str[$j]['end']=$row[$j]['EndDate'];
		$str[$j]['url']=$rf."/event/detail/".$row[$j]['EventID'];
		$j++;
	}
	echo json_encode($str);

?>
