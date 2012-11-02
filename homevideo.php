<style>
.contextitem ul{
	list-style: none;
	margin: 0;
	padding: 5px;
	background: #f2f2f2
}
.contextitem ul li{
	background: #ffffff;
	border-top: 2px solid #f6e8d5;
	margin-bottom: 5px; 
	padding: 5px 5px; 
}
.contextitem ul li h3{
	font-weight: normal;
	font-size: 12px
}
.contextitem div.righttxt{
	text-align: right;
	color: #999999
}

.videolist li{
    float: left;
}
</style>
<?php
	$qry="select T.*";
	$qry.=" from tbl_videonews T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 0, 3";
	$row=$con->select($qry);
	$rowcount=count($row);
	if($rowcount>0){
            $imagesource="/files/videos/small/".$row[0]['ImageSource'];
            if (!empty($row[0]['ImageSource']) && file_exists($imagesource)){
                $imagesource="/files/videos/small/".$row[0]['ImageSource'];
            } 
?>
<script	type="text/javascript" src="/mediaplayer/swfobject.js"></script>

<script type="text/javascript">
function changeVideo(videoid){
	loadPage('#ajaxvideoplayer','/processform.php?action=homevideochange&videoid='+videoid);
};
</script>

<div class="contextitem" style="margin-bottom: 5px;">
    <div id="ajaxvideoplayer">
        <div id="player" style="margin-top: 10px; text-align: center;">
                <div align="center">
            <a class="bluelink" href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" target="_blank">
                <!--Get the Adobe Flash Player to see this video.-->
            Видео, дүрс бичлэгийг үзэхийн тулд Adobe Flash Player програмын шинэ хувилбарыг ЭНД дарж, татаж аван суулгах хэрэгтэй!
            </a></div>
        </div>
        <script type="text/javascript">
                var so = new SWFObject('/mediaplayer/player.swf', 'ply', '340', '200', '9.0.124');
                so.addParam('allowscriptaccess', 'always');
                so.addParam('allowfullscreen', 'false');
                //so.addParam('quality', 'high');
                so.addParam('wmode', 'transparent');
                so.addVariable('file', '/files/videos/<?=$row[0]['FileSource']?>');
                so.addVariable('image', '<?=$imagesource;?>');
                so.addVariable('backcolor', '212121');
                so.addVariable('frontcolor', 'ffffff');
                so.addVariable('lightcolor', '666666');
                so.addVariable('bufferlength', '5');
                so.addVariable('volume', '80');
                so.addVariable('controlbar', '');
                so.addVariable('autostart', 'false');
                so.addVariable('stretching', 'exactfit');
                so.addVariable('repeat', 'list');
                so.addVariable('skin', '/mediaplayer/skins/modieus.swf');
                so.write('player');
        </script>
    </div>
    <?php if($rowcount>1){?>
    <div>
        <ul class="videolist">
            <?php for($i=0; $i<$rowcount; $i++){
                $imagesource="/files/videos/xsmall/".$row[$i]['ImageSource'];
            ?>
            <li>
                <a href="javascript: changeVideo(<?=$row[$i]['VideoNewsID'];?>)">
                    <img src="<?=$imagesource?>" title="<?=$row[$i]['Title']?>" width="60" height="40"/>
                </a>
            </li>
            <?php }?>
        </ul>
    </div>
    <?php }?>
    <div style="clear: both;"></div>
    <div class="more" style="float: right;"><a href="/news/video" target="_blank" title="" class="ThemenLink">дэлгэрэнгүй</a></div>
    <div style="clear: both;"></div>
</div>
<?php }?>