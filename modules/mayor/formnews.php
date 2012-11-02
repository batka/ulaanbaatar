<?php
	$page_link="$rf/governor/mayors/page/";
	$showcount=10;
	if(!empty($_GET['page']))$pagenum=$_GET['page']-1;
	else $pagenum=0;
	//$noticetitle=$con->GetDescr("select NewsTypeName".$_SESSION['mayor_lang']." from mayor_newstype where NewsTypeLink='news'");
?>
<div class="formcenter">
	<div class="dcontenttitle"><?=$noticetitle;?></div>
	<div class="notice"><?=$strnotfound?></div>
</div>