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

?>