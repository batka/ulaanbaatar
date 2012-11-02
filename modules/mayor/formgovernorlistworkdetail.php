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
	$creationid=$_GET['creationid'];
	$govformname=$con->GetDescr("select GovernorName".$_SESSION['mayor_lang']." from mayor_governor where GovernorLink='detail'");
	$con->qryexec("update tbl_creation set SawCount = SawCount+1 where CreationID='$creationid'");
?>

<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><a href="<?=$rf?>/governor/detail/"><?=$govformname?></a> &raquo; <a href="<?=$rf?>/governor/listwork/"><?=$govformtitle;?></a></div></td>
			<td align="right">
			<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
			<?php
				$total = $con->GetDescr("select count(*) from tbl_creation where IsShow = 'YES'");
				$activepage = $con->GetDescr("select count(CreationID) from tbl_creation where IsShow = 'YES' and CreationID > '$creationid'");
			?>						
				<div style="float: left;">
					Нийт: <?=$total;?> - <?=$activepage+1;?>
				</div>
				<div style="float: right;">
					<?php 
						$qry="select CreationID from tbl_creation where IsShow = 'YES' and CreationID > '$creationid' order by StartDate, CreateDate limit 0,1";
						$previd = $con->GetDescr($qry);
						if(empty($previd)) $previd = $con->GetDescr("select CreationID from tbl_creation where IsShow = 'YES' order by StartDate, CreateDate limit 0,1");
						
						$qry="select CreationID from tbl_creation where IsShow = 'YES' and CreationID < '$creationid' order by StartDate desc, CreateDate desc limit 0,1";
						$nextid = $con->GetDescr($qry);
						if(empty($nextid)) $nextid = $con->GetDescr("select CreationID from tbl_creation where IsShow = 'YES' order by StartDate desc, CreateDate desc limit 0, 1");
					?>
					<a href="<?=$rf?>/governor/listwork/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
					<a href="<?=$rf?>/governor/listwork/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
				</div>	
				<div class="clear"></div>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<div class="pageform">
   	 <?php
		$qry="select *, DATE_FORMAT(StartDate,'%Y-%m-%d') as date from tbl_creation";
		$qry.=" where IsShow='YES'";
		$qry.=" and OrganID='$mayororganid'";
		$qry.=" and CreationID='$creationid'";
		$row=$con->select($qry);
		$rowcount=count($row);		
		if($rowcount>0){
	?>
	<div class="descrtitle" style="margin-left: 5px; margin-top: 5px;"><?=$row[0]['Title']?></div>
	<?php
    	$qry1="select * from tbl_creationimage";
    	$qry1.=" where IsShow='YES'";
    	$qry1.=" and CreationID='".$row[0]['CreationID']."'";
    	$qry1.=" order by ShowOrder";
    	$row1=$con->select($qry1);
    	$rowcount1=count($row1);
    	if($rowcount1>0){
	?>
	<div id="gallery" class="ad-gallery">
    	<div class="ad-image-wrapper" style="background-color: #f0f0f0; padding: 0px;"></div>
    	<div class="ad-controls"></div>
    	<div class="ad-nav">
        	<div class="ad-thumbs">
          		<ul class="ad-thumb-list">
				<?php for($j=0; $j<$rowcount1; $j++){?>
				<li  style="float: left;">
					<a href="<?=$rfo?>/files/creation/detail/small/<?=$row1[$j]['ImageSource']?>">
              			<img src="<?=$rfo?>/files/creation/detail/xsmall/<?=$row1[$j]['ImageSource']?>" alt="<?=$row1[$j]['Title']?>" height="60">
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
   	</td>
	</tr>
	</table>
</div>