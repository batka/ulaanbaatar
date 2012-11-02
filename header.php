<style type="text/css" media="screen, projection">
#newsline	{
	position: relative;
}
#newsline .cursor {
	display: inline-block; 
	background: #c4dfff; 
	width: 0.6em; 
	height: 0.9em; 
	text-align: center;
}
#newsline p{
	margin-bottom: 0.8em;
}
#newsline code {
	margin: 0.4em 0.4em; 
	display: block;
}
#newsline .next {
	position: absolute;
	bottom: 1em;
}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#newsline").ticker({
	 		cursorList:  " ",
	 		rate:        10,
	 		delay:       4000
		}).trigger("play").trigger("play"); 
		jQuery("#newsline").trigger("play");	
  	});
  	
	$(document).ready(
		function(){
			$('ul#animated-panorama').animatedinnerfade({
				speed: 2000,
				timeout: 15000,
				type: 'sequence',
				containerheight: '70px',
				containerwidth: '798px',
				animationSpeed: 30000,
				animationtype: 'fade',
	            controlBox: 'none',
				controlBoxClass: 'mycontrolboxclass',
                controlButtonsPath: 'img',
    	        displayTitle: 'yes' 
			});
	
			$('ul#animated-portfolio').animatedinnerfade({
				speed: 5000,
				timeout: 15000,
				type: 'random',
				containerheight: '300px',
				containerwidth: '270px',
				animationSpeed: 30000,
				animationtype: 'fade',
				bgFrame: 'none',
				controlBox: 'none',
				displayTitle: 'none'
			});
	});
</script>
<div class="head">
	<div class="container">
		<a href="<?=$rf;?>/home"><div id="logo"><img src="/images/logo.jpg"/></div></a>
	</div><!-- /container -->
</div>

<div class="navbar navbar-static-top">
<?php require_once 'menu.php';?>
</div>
