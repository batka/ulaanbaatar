<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<HTML>
<HEAD>
<?php
	require_once "../headerjsstyle.php";
	$fn = $_GET['fn'];
	$qs1 = $_GET['qs1'];
	$qs2 = $_GET['qs2'];
	$qs3 = $_GET['qs3'];
	$qs4 = $_GET['qs4'];
?>
</HEAD>

<frameset rows="*,35" frameborder="NO" border="0" framespacing="0">
  <frame src="<?=$fn;?><?php if($qs1!='') echo "?$qs1"; ?><?php if($qs2!='') echo "&$qs2"; ?><?php if($qs3!='') echo "&$qs3"; ?><?php if($qs4!='') echo "&$qs4"; ?><?php if($qs5!='') echo "&$qs5"; ?><?php if($qs6!='') echo "&$qs6"; ?><?php if($qs7!='') echo "&$qs7"; ?><?php if($qs8!='') echo "&$qs8"; ?><?php if($qs9!='') echo "&$qs9"; ?>" id="mainFrame" name="mainFrame">
  <frame src="reportfooter.php" id="bottomFrame" name="bottomFrame" scrolling="NO" noresize>
</frameset>

<noframes><body></body></noframes>

</html>
