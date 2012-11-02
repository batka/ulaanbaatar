<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php
	require_once 'headerstyle.php';
	if(isset($_GET['organclassid'])) $organclassid=$_GET['organclassid'];
	if(isset($_GET['organid'])) $organid=$_GET['organid'];
	$pagelink1=$rf."/tender";
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29342417-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
<header>
	<?php require_once 'header.php';?>
	<?php //require_once 'headerbottom.php';?>
</header>
<div class="container">
<div id="wrap">

<div class="rlpad">

<div class="spacer10"></div>

<!-- <ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Library</a> <span class="divider">/</span></li>
  <li class="active">Data</li>
</ul> -->

<div class="row-fluid">
	<div class="hdtitle">Тендер
		<?php if(!empty($organclassid)){?> :: <span style="text-transform: none;"><?php echo $con->GetDescr("select OrganClassName from ref_organclass where OrganClassID = '$organclassid'");?> </span> <?php }?>
		<?php if(!empty($organid)){?> :: <span style="text-transform: none;"><?php echo $con->GetDescr("select OrganName from ref_organ where OrganID = '$organid'");?> </span> <?php }?></div>
  <div class="span3">
	  <?php require_once 'newsorganclass.php';?>
	  <?php require_once 'poll.php';?>
  </div>
  <div class="span8">
	  <?php require_once 'tenderlistcontent.php';?>
  </div>
</div>
	
	<div style="clear:both"></div>

</div><!-- /rlpad -->
</div><!-- /wrap -->
</div><!-- /container -->

<?php require_once 'footer.php';?>

<?php
	require_once 'footerjs.php';
?>
</body>
</html>