<div id="pcgcsfsubmitarea">
	<h1 style="padding: 0; margin: 0">Хэрэгжүүлэгч агентлаг</h1>
</div>
<div style="float: left; width: 428px">
	<?php require_once 'homeagencynews.php';?>
</div>
<style type="text/css">
.brderleft{
	border-left: 3px solid #666;
	margin-bottom: 10px
}
.brderleft a{
	color: #16387c
}
.brderleft h2{
	font-size: 11px;
	background: #eee;
	padding:3px 3px 3px 10px;
	color: #333
}
.brderleft .content{
	padding: 0 10px 10px 10px
}
.brderleft .content .img{
	float: left;
	margin-right: 10px
}
.brderleft .content .date{
	font-size: 10px;
	color: #999
}
.brderleft .content .descr{
	text-align: justify;
}
.brderleft .content .more{
	text-align: right;
	font-weight: bold;
}
</style>
<div style="float: left; margin-left: 10px; width: 354px">
<?php
	$qry="select *";
	$qry.=" from tbl_speech";
	$qry.=" where IsShow='YES'";
	$qry.=" order by SpeechDate desc";
	$qry.=" limit 1";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount){
?>
	<div class="brderleft">
		<h2 style="font-size: 11px">Хэлсэн үг</h2>
		<div class="content">
			<div style="margin-bottom: 5px; font-weight: bold;"><a href="#"><?=$row[$j]['Title'];?></a></div>
				
<?php
		$imagesource=$drf."/files/speech/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/speech/small/".$row[$j]['ImageSource']; 
?>
				<div class="img"><img src="<?=$imagesource;?>" title="" alt="" width="150"></div>
<?php
		} 
?>
			<div class="date"><span>Огноо: </span><?=$row[$j]['SpeechDate'];?></div>
			<div class="descr"><?=GetStrBr($row[$j]['Descr'], "150");?></div>
			<div class="more"><a href="" title="" class="ThemenLink">илүү</a></div>
  		</div>
 	</div>
<?php
	$j++;
	} 
?>
<?php
	$qry="select *";
	$qry.=" from tbl_speech";
	$qry.=" where IsShow='YES'";
	$qry.=" order by SpeechDate desc";
	$qry.=" limit 1";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount){
?>
	<div class="brderleft">
		<h2 style="font-size: 11px">Хэвлэлийн тойм</h2>
		<div class="content">
			<div style="margin-bottom: 5px; font-weight: bold;"><a href="#"><?=$row[$j]['Title'];?></a></div>
				
<?php
		$imagesource=$drf."/files/speech/small/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/speech/small/".$row[$j]['ImageSource']; 
?>
				<div class="img"><img src="<?=$imagesource;?>" title="" alt="" width="150"></div>
<?php
		} 
?>
			<div class="date"><span>Огноо: </span><?=$row[$j]['SpeechDate'];?></div>
			<div class="descr"><?=GetStrBr($row[$j]['Descr'], "150");?></div>
			<div class="more"><a href="" title="" class="ThemenLink">илүү</a></div>
  		</div>
 	</div>
<?php
	$j++;
	} 
?>
<?php require_once 'homeagencyphoto.php';?>
</div>
<div class="clear"></div>