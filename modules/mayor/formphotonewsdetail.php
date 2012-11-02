<style type="text/css">
  #gallery {
  	margin-top: 5px;
    padding: 5px;
    padding-top: 0px;
  }
  #descriptions {
    position: relative;
    height: 50px;
    background: #EEE;
    margin-top: 10px;
    width: 640px;
    padding: 10px;
    overflow: hidden;
  }
    #descriptions .ad-image-description {
      position: absolute;
    }
      #descriptions .ad-image-description .ad-description-title {
        display: block;
      }
  </style>

<script type="text/javascript">
$(function() {
  var galleries = $('.ad-gallery').adGallery();
  $('#switch-effect').change(
    function() {
      galleries[0].settings.effect = $(this).val();
      return false;
    }
  );
  $('#toggle-slideshow').click(
    function() {
      galleries[0].slideshow.toggle();
      return false;
    }
  );
  $('#toggle-description').click(
    function() {
      if(!galleries[0].settings.description_wrapper) {
        galleries[0].settings.description_wrapper = $('#descriptions');
      } else {
        galleries[0].settings.description_wrapper = false;
      }
      return false;
    }
  );
});
</script>

<?php
	$newsid=$_GET['newsid'];
	$noticetitle=$con->GetDescr("select NewsTypeName".$_SESSION['mayor_lang']." from mayor_newstype where NewsTypeLink='photonews'");
	$con->qryexec("update tbl_photonews set SawCount = SawCount+1 where PhotoNewsID='$newsid'");
?>

<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <a href="<?=$rf?>/news/photonews/"><?=$noticetitle;?></a></div></td>
			<td align="right">
			<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
			<?php
				$total = $con->GetDescr("select count(*) from tbl_photonews where IsShow = 'YES' and OrganID='$mayororganid'");
				$activepage = $con->GetDescr("select count(PhotoNewsID) from tbl_photonews where IsShow = 'YES' and OrganID='$mayororganid' and PhotoNewsID > '$newsid'");
			?>							
				<div style="float: left;">
					Нийт: <?=$total;?> - <?=$activepage+1;?>
				</div>
				<div style="float: right;">
					<?php 
						$qry="select PhotoNewsID from tbl_photonews where IsShow = 'YES' and OrganID='$mayororganid' and PhotoNewsID > '$newsid' order by PhotoNewsDate, CreateDate limit 0,1";
						$previd = $con->GetDescr($qry);
						if(empty($previd)) $previd = $con->GetDescr("select PhotoNewsID from tbl_photonews where IsShow = 'YES' and OrganID='$mayororganid' order by PhotoNewsDate, CreateDate limit 0,1");
						
						$qry="select PhotoNewsID from tbl_photonews where IsShow = 'YES' and OrganID='$mayororganid' and PhotoNewsID < '$newsid' order by PhotoNewsDate desc, CreateDate desc limit 0,1";
						$nextid = $con->GetDescr($qry);
						if(empty($nextid)) $nextid = $con->GetDescr("select PhotoNewsID from tbl_photonews where IsShow = 'YES' and OrganID='$mayororganid' order by PhotoNewsDate desc, CreateDate desc limit 0,1");
					?>
					<a href="<?=$rf?>/news/photonews/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
					<a href="<?=$rf?>/news/photonews/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
				</div>
				<div class="clear"></div>
			</div>
			</td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
   	 <?php
		$qry="select *, DATE_FORMAT(PhotoNewsDate,'%Y-%m-%d') as date from tbl_photonews";
		$qry.=" where IsShow='YES'";
		$qry.=" and OrganID='$mayororganid'";
		$qry.=" and PhotoNewsID='$newsid'";
		$row=$con->select($qry);
		$rowcount=count($row);		
		if($rowcount>0){
	?>
	<div class="descrtitle" style="margin-left: 5px;"><?=$row[0]['Title']?></div>
	<?php
    	$qry1="select * from tbl_photonewsimage";
    	$qry1.=" where IsShow='YES'";
    	$qry1.=" and PhotoNewsID='".$row[0]['PhotoNewsID']."'";
    	$qry1.=" order by ShowOrder";
    	$row1=$con->select($qry1);
    	$rowcount1=count($row1);
    	if($rowcount1>0){
	?>
	<div id="gallery" class="ad-gallery">
    	<div class="ad-image-wrapper" style="background-color: #f0f0f0;"></div>
    	<div class="ad-controls"></div>
    	<div class="ad-nav">
        	<div class="ad-thumbs">
          		<ul class="ad-thumb-list">
				<?php for($j=0; $j<$rowcount1; $j++){?>
				<li  style="float: left;">
					<a href="<?=$rfo?>/files/photonews/detail/small/<?=$row1[$j]['ImageSource']?>">
              			<img src="<?=$rfo?>/files/photonews/detail/xsmall/<?=$row1[$j]['ImageSource']?>" alt="<?=$row1[$j]['Title']?>" height="60">
             		</a>
				</li>
				<?php }?>
	        	</ul>
    		</div>
    	</div>
    </div>
	<?php }else{
		echo "<span class='notice'>Зураг оруулаагүй байна.</span>";
    }}?>
    <div class="dcontent">
	    <div class="descr">
	    	<?=$row[0]['Descr']?>
	    </div>
	    <div class="dcontentbottom" style="padding-top: 5px;">
			<?=$strImageCount.": ".$rowcount1." | ".$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?> 		
	   	</div>
   	</div>
   	</div>
	</td>
	</tr>
	</table>
</div>