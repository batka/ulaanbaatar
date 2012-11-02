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
    jQuery('#mycarousel1').jcarousel({
        auto: 0,
        wrap: 'last',
        scroll: 3,
        animation: 	1000,
        initCallback: mycarousel_initCallback
    });
});

</script>

<style type="text/css">
	.carousel1 .jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 735px;
    height: 150px;
    padding: 0px 30px 0px 30px;
	}
	.carousel1 .jcarousel-skin-tango .jcarousel-clip-horizontal {
    width:  735px;
    height: 150px;
	}
	.carousel1 .jcarousel-skin-tango .jcarousel-item {
    width: 241px;
    height: 140px;
    padding-top: 10px;
	}
	.carousel1 .jcarousel-skin-tango .jcarousel-item-horizontal {
	margin-left: 0;
    margin-right: 5px;
	}
	.textdiv{
	float: left;
	padding-left: 2px;
	line-height: 12px;
	margin-bottom: 3px;
	height: 105px;
	width: 93px;
	overflow: hidden;
	}
</style>
<div class="carousel1">
<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
	<td><div class="indexformtitle">Засаг даргын шийдвэрлэх ажлууд</div></td>
		<td><a href="<?=$rf?>/governor/solvework/" class="indexformmorelink">Цааш<img src="<?=$rf?>/images/web/arrow.png" align="middle"/></a></td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="indexform" style="min-height: 150px;  padding: 0px; padding-top: 10px;">	
				<?php
					$qry="select *, DATE_FORMAT(StartDate,'%Y-%m-%d') as date from tbl_solvework";
					$qry.=" where IsShow='YES'";
					$qry.=" and OrganID='".MAYORID."'";
					$qry.=" order by StartDate desc, CreateDate desc";
					$qry.=" limit 0, 20";
					$row=$con->select($qry);
					$rowcount=count($row);
				?>		
				<ul id="mycarousel1" class="jcarousel-skin-tango">
					<?php
						if($rowcount>0){
						for($i=0; $i<$rowcount; $i++){
							$link="$rf/governor/solvework/detail/".$row[$i]['SolveWorkID']."/";
				    	if(!empty($row[$i]['ImageSource']) && file_exists("$drfo/files/solvework/small/".$row[$i]['ImageSource'])){
				    ?>
					
				   <li>
			   			<div style="height: 195px;">
				   			<div style="float: left">
				   				<a href="<?=$link?>"><img style="border: 1px solid #dddddd; padding: 2px;" src="<?=$rfo?>/files/solvework/small/<?=$row[$i]['ImageSource']?>" width="140" height="100" alt="" border="0" /></a>
				   			</div>
				   			<div class="textdiv"><a href="<?=$link?>" title="<?=asuUniConvert($row[$i]['Title'])?>" class="nonestyle" style="color: #244d79; font-size: 13px;">
							<?=asuUniConvert($row[$i]['Title'])?>
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
</div>