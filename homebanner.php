<style>
.container {
	width: ;
	padding: 0;
	margin: 0 auto;
	
}
.folio_block {
	position: relative;
}


/*--Main Container--*/
.main_view {
	float: left;
	position: relative;
}
/*--Window/Masking Styles--*/
.window {
	height:100px;	width: ;
	overflow: hidden; /*--Hides anything outside of the set width/height--*/
	position: relative;
}
.image_reel {
	position: absolute;
	top: 0; left: 0;
}
.image_reel img {float: left; width: ; height: 100px}

/*--Paging Styles--*/
.paging {
	position: absolute;
	bottom: 0px; right: 1px;
	width: 100px; height:30px;
	z-index: 100; /*--Assures the paging stays on the top layer--*/
	text-align: center;
	line-height: 30px;
	display: none; /*--Hidden by default, will be later shown with jQuery--*/
}
.paging a {
	padding: 3px 5px;
	text-decoration: none;
	color: #000;
	background: #a0a0a0; 
}
.paging a.active {
	font-weight: bold; 
	background: #ededed; 
}
</style>
<div class="container">
    <div class="folio_block">
        <div class="main_view">
            <div class="window">	
                <div class="image_reel">
<?php
	$qry="select *";
	$qry.=" from tbl_banner";
	$qry.=" where IsShow='YES' and BannerClassID='101'";
	$qry.=" and DATE_FORMAT(NOW(), '%Y-%m-%d') between StartDate and EndDate";
	$qry.=" order by ShowOrder";
	//echo $qry; exit;
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
		$qs1="bannerid=".$row[$j]['BannerID'];
		$imagesource=$drf."/files/banner/small/".$row[$j]['FileSource'];
		if (!empty($row[$j]['FileSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/banner/small/".$row[$j]['FileSource'];
			if (!empty($row[$j]['Url'])){
?>
                    <a href="<?=$row[$j]['Url'];?>" title="<?=$row[$j]['Title'];?>" target="_blank">
                    	<img src="<?=$imagesource;?>" alt=""/>
                    </a>
<?php
			} else {
?>
				<a href="javascript:" onclick="OpenWindow('print/printreport.php?fn=bannerdetail.php&qs1=<?=$qs1;?>',500); return false;">
					<img src="<?=$imagesource;?>" alt=""/>
				</a>
<?php 
			}
		}
	$j++;
	} 
?>
                </div>
            </div>
            <div class="paging">
<?php
	$j1=0; 
	while ($j1<$rowcount){
?>
                <a href="#" rel="<?=$j1+1;?>"><?=$j1+1;?></a>
<?php
	$j1++;
	} 
?>
            </div>
        </div>
    </div>	
</div>
<script type="text/javascript">

$(document).ready(function() {

	//Set Default State of each portfolio piece
	$(".paging").show();
	$(".paging a:first").addClass("active");
		
	//Get size of images, how many there are, then determin the size of the image reel.
	var imageWidth = $(".window").width();
	var imageSum = $(".image_reel img").size();
	var imageReelWidth = imageWidth * imageSum;
	
	//Adjust the image reel to its new size
	$(".image_reel").css({'width' : imageReelWidth});
	
	//Paging + Slider Function
	rotate = function(){	
		var triggerID = $active.attr("rel") - 1; //Get number of times to slide
		var image_reelPosition = triggerID * imageWidth; //Determines the distance the image reel needs to slide

		$(".paging a").removeClass('active'); //Remove all active class
		$active.addClass('active'); //Add active class (the $active is declared in the rotateSwitch function)
		
		//Slider Animation
		$(".image_reel").animate({ 
			left: -image_reelPosition
		}, 500 );
		
	}; 
	
	//Rotation + Timing Event
	rotateSwitch = function(){		
		play = setInterval(function(){ //Set timer - this will repeat itself every 3 seconds
			$active = $('.paging a.active').next();
			if ( $active.length === 0) { //If paging reaches the end...
				$active = $('.paging a:first'); //go back to first
			}
			rotate(); //Trigger the paging and slider function
		}, 7000); //Timer speed in milliseconds (3 seconds)
	};
	
	rotateSwitch(); //Run function on launch
	
	//On Hover
	$(".image_reel a").hover(function() {
		clearInterval(play); //Stop the rotation
	}, function() {
		rotateSwitch(); //Resume rotation
	});	
	
	//On Click
	$(".paging a").click(function() {	
		$active = $(this); //Activate the clicked paging
		//Reset Timer
		clearInterval(play); //Stop the rotation
		rotate(); //Trigger rotation immediately
		rotateSwitch(); // Resume rotation
		return false; //Prevent browser jump to link anchor
	});	
	
});
</script>
