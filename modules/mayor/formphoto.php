<link href="<?=$rf?>/js/jquery/NFLightBox/css/nf.lightbox.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?=$rf?>/js/jquery/NFLightBox/js/NFLightBox.js" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
	    var settings = { containerResizeSpeed: 350};
	    var url = "<?=$rf?>/js/jquery/NFLightBox/";
	    $('#gallery a').lightBox(settings, url);
    });
</script>

<style type="text/css">
    #gallery
    {	
    	padding-left: 2px;
    	padding-top: 8px;
    	padding-bottom: 5px;
    }
    #gallery ul
    {
    	margin: 0px;
    	padding: 0px;
        list-style: none;
    }
    #gallery ul li
    {
        display: inline;
    }
    #gallery ul img
    {
        margin-right: 5px;
        margin-bottom: 5px;
    }
    #gallery ul a:hover img
    {
        opacity:0.6;
		filter:alpha(opacity=60); /* For IE8 and earlier */
    }
</style>

<?php
	$albumid=$_GET['albumid'];
	
	$con->qryexec("update mayor_album set SawCount = SawCount+1 where AlbumID='$albumid'");
	$row1=$con->select("select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date from mayor_album where AlbumID='$albumid'");

	$qry="select * from mayor_albumphoto";
	$qry.=" where IsShow='YES'";
	$qry.=" and AlbumID='$albumid'";
	$qry.=" order by CreateDate desc";
	$row=$con->select($qry);
	$rowcount=count($row);
?>

<div class="formcenter">
<div class="dcontenttitle"><a href="<?=$rf?>/gallery/"><?=$strImageGallery?></a></div>
<div style="font-size:11px; color: #3b3b3b; background-color: #eaeaea; padding: 3px; padding-left: 15px;">
<?php
	$total = $con->GetDescr("select count(*) from mayor_album where IsShow = 'YES'");
	$activepage = $con->GetDescr("select count(AlbumID) from mayor_album where IsShow = 'YES'and AlbumID > '$albumid'");
?>
<div style="float: left;">
Нийт: <?=$total;?> - <?=$activepage+1;?>
</div>
	<div style="float: right; margin-right: 10px;">
		<?php 
			$qry="select AlbumID from mayor_album where IsShow = 'YES' and  AlbumID > '$albumid' order by CreateDate limit 0,1";
			$previd = $con->GetDescr($qry);
			if(empty($previd)) $previd = $con->GetDescr("select AlbumID from mayor_album where IsShow = 'YES' order by CreateDate limit 0,1");
			
			$qry="select AlbumID from mayor_album where IsShow = 'YES' and AlbumID < '$albumid' order by CreateDate desc limit 0,1";
			$nextid = $con->GetDescr($qry);
			if(empty($nextid)) $nextid = $con->GetDescr("select AlbumID from mayor_album where IsShow = 'YES' order by CreateDate desc limit 0,1");
		?>
		<a href="<?=$rf?>/gallery/<?=$previd;?>/photo/" class="nonestyle">&laquo; Өмнөх</a>
		|
		<a href="<?=$rf?>/gallery/<?=$nextid;?>/photo/" class="nonestyle">Дараах &raquo;</a>
	</div>
<div class="clear"></div>
</div>
<div class="dcontent">
	<div class="descr" style="margin-bottom: 10px;">
		<div class="descrtitle"><?=$row1[0]['Title']?></div>
		<?=$row1[0]['Descr']?>
	</div>		
      	<div id="gallery">
    	   <ul>
       	<?php for($i=0; $i<$rowcount; $i++){
        		if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/gallery/".$row[$i]['ImageSource'])){
        	?>
            <li><a href="<?=$rf?>/images/gallery/medium/<?=$row[$i]['ImageSource']?>" title="<?=$row[$i]['Descr']?>">
                <img src="<?=$rf?>/images/gallery/small/<?=$row[$i]['ImageSource']?>" height="85" style="border: 0px;"/>
            </a></li>
           <?php }}?>
        </ul>
    </div>
       <div class="clear"></div>
</div>
    <div class="dcontentbottom">
		<?=$strImageCount.": ".$rowcount." | ".$strSaw.": ".$row1[0]['SawCount']?> | <?=$strDate.": ".$row1[0]['date']?> 		
   	</div>
   </div>