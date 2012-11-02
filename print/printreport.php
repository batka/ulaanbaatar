<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<HTML>
<HEAD>
</HEAD>

<?php
	$fn=$_GET['fn'];
	$qs1=$_GET['qs1'];
	if(isset($_GET['qs2'])) $qs2=$_GET['qs2'];
	if(isset($_GET['qs3'])) $qs3=$_GET['qs3'];
	if(isset($_GET['qs4']))	$qs4=$_GET['qs4'];
	if(isset($_GET['qs5'])) $qs5=$_GET['qs5'];
	if(isset($_GET['qs6'])) $qs6=$_GET['qs6'];
	if(isset($_GET['qs7']))	$qs7=$_GET['qs7'];
	if(isset($_GET['qs8']))	$qs8=$_GET['qs8'];
	if(isset($_GET['qs9']))	$qs9=$_GET['qs9'];
?>
<frameset rows="*,28" frameborder="NO" border="0" framespacing="0">
  <frame src="<?=$fn;?><?php if(!empty($qs1)) echo "?$qs1"; ?><?php if(!empty($qs2)) echo "&$qs2"; ?><?php if(!empty($qs3)) echo "&$qs3"; ?>" id="mainFrame" name="mainFrame">
  <frame src="reportfooter.php" id="bottomFrame" name="bottomFrame" scrolling="NO" noresize>
</frameset>

<noframes><BODY></body></noframes>

</html>
