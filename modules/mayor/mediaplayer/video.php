<script	type="text/javascript" src="<?=$rf;?>/mediaplayer/swfobject.js"></script>
<?php
	$qry="select *";
	$qry.=" from tbl_newsvideo";
	$qry.=" where IsShow='YES'";
	$qry.=" order by NewsVideoDate desc";
	$qry.=" limit 0,1";
	$row=$con->select($qry);
	$rowcount=count($row); 
?>
	<div id="player">
		<div align="center">
	    <a class="bluelink" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" target="_blank">
		<!--Get the Adobe Flash Player to see this video.-->
	    Видео, дүрс бичлэгийг үзэхийн тулд Adobe Flash Player програмын шинэ хувилбарыг ЭНД дарж, татаж аван суулгах хэрэгтэй!
	    </a></div>
	</div>
<script type="text/javascript">
	var so = new SWFObject('<?=$rf;?>/mediaplayer/player.swf', 'ply', '210', '210', '9.0.124');
	so.addParam('allowscriptaccess', 'always');
	so.addParam('allowfullscreen', 'true');
	//so.addParam('quality', 'high');
	so.addParam('wmode', 'transparent');
	so.addVariable('file', '<?=$rf?>/video/<?=$row[0]['FileSource']?>');
	so.addVariable('image', '<?=$rf;?>/images/newsvideo/small/<?=$row[0]['ImageSource']?>');
	so.addVariable('backcolor', '212121');
	so.addVariable('frontcolor', 'ffffff');
	so.addVariable('lightcolor', '666666');
	so.addVariable('playlistsize', '93');
	so.addVariable('bufferlength', '5');
	so.addVariable('volume', '80');
	so.addVariable('controlbar', 'over');
	so.addVariable('autostart', 'false');
	so.addVariable('stretching', 'exactfit');
	so.addVariable('repeat', 'list');
	//so.addVariable("image", encodeURIComponent("get_thumb.php?objectid=411&imgonly&big&file=file.jpg"));
	so.addVariable('skin', '<?=$rf;?>/mediaplayer/skins/snel.swf');
	so.write('player');
</script>