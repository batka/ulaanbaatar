<script type="text/javascript">

function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        auto: 0,
        wrap: 'last',
        scroll: 5,
        initCallback: mycarousel_initCallback
    });
});

</script>

<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
	<td><div class="indexformtitle">Засаг даргын хийсэн ажлууд</div></td>
		<td><a href="<?=$rf?>/governor/listwork/" class="indexformmorelink">Цааш<img src="<?=$rf?>/images/web/arrow.png" align="middle"/></a></td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="indexform" style="min-height: 150px;  padding: 0px; padding-top: 10px;">			
				<ul id="mycarousel" class="jcarousel-skin-tango">
					<?php
						$qry="select *, DATE_FORMAT(StartDate,'%Y-%m-%d') as date from tbl_creation";
						$qry.=" where IsShow='YES'";
						$qry.=" and OrganID='".MAYORID."'";
						$qry.=" order by StartDate desc, CreateDate desc";
						$allrow=$con->GetDescr("select count(*) from tbl_creation where IsShow='YES' and OrganID='".MAYORID."'");
						$qry.=" limit 0, 20";
						$row=$con->select($qry);
						$rowcount=count($row);
						
						if($rowcount>0){
						for($i=0; $i<$rowcount; $i++){
							$link="$rf/governor/listwork/detail/".$row[$i]['CreationID']."/";
				    	if(!empty($row[$i]['ImageSource']) && file_exists("$drfo/files/creation/medium/".$row[$i]['ImageSource'])){
				    ?>
					
				   <li>
			   			<div style="height: 195px;">
				   			<center>
				   				<a href="<?=$link?>"><img style="border: 1px solid #dddddd; padding: 2px;" src="<?=$rfo?>/files/creation/medium/<?=$row[$i]['ImageSource']?>" width="175" height="100" alt="" border="0" /></a>
				   			</center>
				   			<div style="line-height: 12px; margin-bottom: 3px; text-align: left; padding: 5px; height: 20px; overflow: hidden;"><a href="<?=$link?>" title="<?=asuUniConvert($row[$i]['Title'])?>" class="nonestyle" style="color: #244d79; font-size: 13px;">
							<?=$row[$i]['Title']?>
							</a></div>
			   			</div>
				   </li>
				   <?php }
				       }
				    }?>
				</ul>
			</div>
		</td>
	</tr>
</table>