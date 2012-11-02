<?php
session_start ();

require_once ("_mn.inc.php");
require_once ("config.lib.php");

class Database {
	private $hConn;
	private $hSelDB;
	
	public function __construct($p_db = 'db') {
		ob_start ();
		global $cfg;
		
		$this->hConn = @mysql_connect ( $cfg [$p_db] ['host'], $cfg [$p_db] ['user'], $cfg [$p_db] ['password'] );
		if (! $this->hConn) {
			die ( "'" . $cfg [$p_db] ['host'] . "'дээрх мэдээллийн баазын сервертэй холбогдох боломжгүй байна!\n" . mysql_error () );
		}
		
		$this->hSelDB = @mysql_select_db ( $cfg [$p_db] ['name'], $this->hConn );
		if (! $this->hSelDB) {
			die ( "'" . $cfg [$p_db] ['host'] . "' сервер дээр '" . $cfg [$p_db] ['name'] . "' нэртэй мэдээллийн бааз байхгүй байна: " . mysql_error () );
		}
		mysql_query ( "SET NAMES 'utf8'", $this->hConn );
		return $this->hConn;
	}
	
	public function __destruct() {
		if (is_resource ( ($this->hConn) )) {
			@mysql_close ( $this->hConn );
			//			ob_clean();
			ob_end_flush ();
		}
	}
	
	public function getfieldnum($p_qry) {
		$hRes = @mysql_query ( $p_qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn );
			throw new Exception ( $err );
		}
		$ret = mysql_num_fields ( $hRes );
		mysql_free_result ( $hRes );
		return $ret;
	}
	
	public function select($p_qry) {
		$hRes = @mysql_query ( $p_qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn );
			throw new Exception ( $err );
		}
		$arReturn = array ();
		//echo $p_qry;
		while ( $hRow = mysql_fetch_array ( $hRes, MYSQL_BOTH ) ) {
			$arReturn [] = $hRow;
		}
		mysql_free_result ( $hRes );
		return $arReturn;
	}
	
	public function insert($p_table, $p_qryfields, $p_qryvalues) {
		$qry = "INSERT INTO $p_table($p_qryfields) VALUES($p_qryvalues)";
		$hRes = @mysql_query ( $qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn ) . "\n Query: " . $qry;
			throw new Exception ( $err );
		}
		//mysql_free_result($hRes);
		return mysql_affected_rows ();
	}
	
	public function update($p_table, $p_qryset, $p_qrywhere) {
		$qry = "UPDATE $p_table SET $p_qryset WHERE $p_qrywhere";
		$hRes = @mysql_query ( $qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn ) . "\n Query: " . $qry;
			throw new Exception ( $err );
		}
		//mysql_free_result($hRes);
		return mysql_affected_rows ();
	}
	
	public function delete($p_table, $p_qrywhere) {
		$qry = "DELETE FROM $p_table WHERE $p_qrywhere";
		$hRes = @mysql_query ( $qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn ) . "\n" . $qry;
			throw new Exception ( $err );
		}
		//mysql_free_result($hRes);
		return mysql_affected_rows ();
	}
	
	public function qryexec($p_qry) {
		$hRes = @mysql_query ( $p_qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn ) . "\n Query: " . $p_qry;
			throw new Exception ( $err );
		}
		//mysql_free_result($hRes);
		return mysql_affected_rows ();
	}
	
	public function qryopen($p_qry) {
		$hRes = @mysql_query ( $p_qry, $this->hConn );
		if (! $hRes) {
			$err = mysql_error ( $this->hConn ) . "\n Query: " . $p_qry;
			throw new Exception ( $err );
		}
		$ret = mysql_num_rows ( $hRes );
		mysql_free_result ( $hRes );
		return $ret;
	}
	
	public function COMBOFILLPIC($p_qry, $p_sval, $p_code0, $p_code1, $p_isall = 0) {
		global $strNewAlbum;
		
		$row = $this->select ( $p_qry );
		$rowcount = count ( $row );
		$j = 0;
		while ( $j < $rowcount ) {
			echo "<option value='" . $row [$j] [$p_code0] . "'";
			if ($p_sval == $row [$j] [$p_code0])
				echo " selected";
			echo ">" . $row [$j] [$p_code1] . "</option>";
			$j ++;
		}
		if ($p_isall == 1) {
			echo "<option value=''";
			if ($p_sval == '')
				echo "selected";
			echo ">" . $strNewAlbum . "</option>";
		}
	}
	
	public function COMBOFILL($p_qry, $p_sval, $p_code0, $p_code1, $p_isall = 0) {
		global $strSelect;
		global $strSelectAll;
		
		$row = $this->select ( $p_qry );
		$rowcount = count ( $row );
		$j = 0;
		if ($p_isall == 1) {
			echo "<option value=''";
			if ($p_sval == '')
				echo "selected";
			echo ">" . $strSelectAll . "</option>";
		} else if ($p_isall == 0) {
			echo "<option value=''";
			echo ">" . $strSelect . "</option>";
		}
		while ( $j < $rowcount ) {
			echo "<option value='" . $row [$j] [$p_code0] . "'";
			if ($p_sval == $row [$j] [$p_code0])
				echo " selected";
			echo ">" . $row [$j] [$p_code1] . "</option>";
			$j ++;
		}
	}
	
	public function COMBOFILLNUM($p_s, $p_start, $p_end, $p_select) {
		$num = $p_start;
		echo "<option value=''>$p_s</option>";
		while ( $num <= $p_end ) {
			echo "<option value='" . $num . "'";
			if ($num == $p_select)
				echo " selected";
			echo ">" . $num . "</option>";
			$num ++;
		}
		echo $p_select;
	}
	
	public function GetDescr($p_qry) {
		$row = $this->select ( $p_qry );
		return $row [0] [0];
	}
	
	public function GetNextID($p_table, $p_field, $p_len = 4, $p_start = 7, $p_str = '') {
		$qry = "select substring($p_field, $p_start, $p_len)";
		$qry .= " from $p_table";
		$qry .= " where left($p_field, 6)=DATE_FORMAT(CURDATE(),'%y%m%d')";
		$qry .= " order by substring($p_field, $p_start, $p_len) desc limit 0, 1";
		$vid = $this->GetDescr ( $qry );
		$vid += 1;
		$s = '';
		for($i = 1; $i <= $p_len - strlen ( $vid ); $i ++)
			$s .= '0';
		$rd = $this->GetDescr ( "select DATE_FORMAT(CURDATE(),'%y%m%d')" );
		$vid = $rd . $p_str . $s . $vid;
		return $vid;
	}
	
	public function GetNextID3($p_table, $p_field) {
		$qry = "select $p_field";
		$qry .= " from $p_table";
		$qry .= " order by $p_field desc limit 0, 1";
		$vid = $this->GetDescr ( $qry );
		if ($vid == "")
			$vid = "100";
		$vid += 1;
		return $vid;
	}
	
	public function GetCircleID($p_table, $p_field, $p_value) {
		$qry = "select $p_field";
		$qry .= " from $p_table";
		$row = $this->select ( $qry );
		$rowcount = count ( $row );
		$j = 0;
		while ( $j <= $rowcount ) {
			if ($j == $rowcount)
				return $row [0] [0];
			if ($row [$j] [0] == $p_value && $j + 1 < $rowcount)
				return $row [$j + 1] [0];
			$j ++;
		}
	}
	
	public function GetPrevID($p_table, $p_field, $p_value) {
		$qry = "select $p_field";
		$qry .= " from $p_table";
		$row = $this->select ( $qry );
		$rowcount = count ( $row );
		$j = 0;
		while ( $j <= $rowcount ) {
			if ($row [$j] [0] == $p_value && $j - 1 > 0)
				return $row [$j - 1] [0];
			if ($row [0] [0] == $p_value)
				return $row [$rowcount - 1] [0];
			$j ++;
		}
	}
}
require_once ("func_asu.php");
require_once 'func_ub.php';
?>
