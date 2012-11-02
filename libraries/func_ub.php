<?php

function IsLoginAdmin($p_con, $p_moduleid = '') {
	if (! $_SESSION ['asuinfo_username']) {
		echo "<div align='center' style='padding-top:10px'><b class='warning1'>Та програм руу өөрийн эрхээр нэвтрээгүй байна!</b>";
		echo "<br><br><input type='button' value='&laquo; Буцах' onclick='window.open(\"./\",\"_parent\");'></div>";
		exit ();
	}
	if ($p_moduleid != "") {
		$qry = "select Privilege";
		$qry .= " from asu_basicuserpriv";
		$qry .= " where UserID='" . $_SESSION ['asuinfo_userid'] . "'";
		$qry .= " and ModuleID='$p_moduleid'";
		$row = $p_con->select ( $qry );
		//echo $qry;
		$rowcount = count ( $row );
		if ($row [0] [0] == 'NO' || $rowcount < 1) {
			echo "<div align='center' style='padding-top:10px'><b class='warning1'>Та програмын энэ модуль руу орох эрхгүй байна!</b>";
			echo "<br><br><input type='button' value='&laquo; Буцах' onclick='history.go(-1);'></div>";
			exit ();
		}
		return $row [0] [0];
	}
}

function SetProgUserPriv($p_con, $p_userid) {
	$qry = "delete from asu_basicuserpriv where UserID='$p_userid'";
	$p_con->qryexec ( $qry );
	
	$qry = "insert into asu_basicuserpriv(UserID, ModuleID, Privilege)";
	$qry .= " select '$p_userid', ModuleID, Priv from asu_progmodule order by ModuleID";
	$p_con->qryexec ( $qry );
}
function getDescrToArray( $descr){ 
		$sep = '<div style="page-break-after' ;
		$sep1='<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
		$i=-1;
		do{
			$i++;
			$j=strpos($descr, $sep );
			if($j=="") {
				$a[$i]=$descr;
				break;
			}
			$a[$i]=substr($descr, 0, $j);
			$descr=substr($descr, $j+strlen($sep1)-4,strlen($descr) );
		}while(TRUE);
		
		return $a ;
	}
function getDescrPage( $descr, $pagenum, $sublength=3 ){ 
	//Хуучин едитор дээр sublength=0 байна. Шинэ едитор дээр sublength=3 байна.
		$sep = '<div style="page-break-after' ;
		$sep1='<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
		$j=strpos($descr, $sep );
		$i=-1;
		do{
			$i++;
			$j=strpos($descr, $sep );
			if($j=="") {
				$a=$descr;
				break;
			}
			$a=substr($descr, 0, $j);
			$descr=substr($descr, $j+strlen($sep1)-$sublength,strlen($descr) );
		}while($i<($pagenum-1));
		
		return $a ;
		/*	$row=getDescrPage($row [0] ['Descr'],3);	for($i=0; $i<count($row); $i++)	echo $row;	*/
	}
?>