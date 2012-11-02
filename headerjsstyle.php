<title><?=$pagetitle1;?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="<?=$rf;?>/images/web/icon.gif" rel="SHORTCUT ICON">

<style type="text/css" media="screen">
	@IMPORT url("<?=$rf;?>/styles/stylemain.css");
	@IMPORT url("<?=$rf;?>/styles/styleindex.css");
	@IMPORT url("<?=$rf;?>/styles/menu.css");
	@IMPORT url("<?=$rf;?>/styles/stylelist.css");	
	@import url( <?=$rf;?>/js/jquery/jquery.datepick/smoothness.datepick.css);
	<?php
		$qry="select *";
		$qry.=" from tbl_themes";
		$qry.="	where IsShow='YES'";
		$qry.="	and IsSelect='YES'";
		$row=$con->select($qry);
		
		if(!empty($row[0]['FileSource']) && file_exists("$drf/styles/themes/{$row[0]['FileSource']}")){
	?>
	@import url("<?=$rf;?>/styles/themes/<?=$row[0]['FileSource']?>");
	<?php }?>
</style>

<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.MetaData.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/asu.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/asujquery.js"></script>

<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.datepick/jquery.datepick-mn.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var windowWidth = $(window).width();
		var temp = Math.ceil((windowWidth - 1000)/2)-120;
		$('.conter').before('<div class="logouigar" ><img src="<?=$rf;?>/images/web/logo_uigar.jpg"/></div>');
		$('.logouigar').css('left',temp);
	})
</script>
<script	type="text/javascript" src="<?=$rf;?>/mediaplayer/swfobject.js"></script>
<?php require_once 'mobile.php';?>