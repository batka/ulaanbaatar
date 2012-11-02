<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php
	require_once 'headerstyle.php';
	
	if($_GET['photonewsid']) $photonewsid=$_GET['photonewsid'];
	$organclassid=$con->GetDescr("select OrganClassID from tbl_photonews T left join ref_organ O on T.OrganID=O.OrganID where T.IsShow='YES' and PhotoNewsID='$photonewsid'");
	$organid = $con->GetDescr("select OrganID from tbl_photonews where PhotoNewsID = '$photonewsid'");
	
	$pagelink1=$rf."/news/photo";
?>
<link type="text/css" rel="stylesheet" href="/js/jquery/jquery.validate/stylejqvalidate.css"/>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29342417-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
<header>
	<?php require_once 'header.php';?>
	<?php //require_once 'headerbottom.php';?>
</header>
<div class="container">
<div id="wrap">

<div class="rlpad">

<div class="spacer10"></div>

<!-- <ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Library</a> <span class="divider">/</span></li>
  <li class="active">Data</li>
</ul> -->

<div class="row-fluid">
	<div class="hdtitle">&nbsp;&nbsp;Фото мэдээ
		<?php if(!empty($organclassid)){?> :: <span style="text-transform: none;"><?php echo $con->GetDescr("select OrganClassName from ref_organclass where OrganClassID = '$organclassid'");?> </span> <?php }?>
		<?php if(!empty($organid)){?> :: <span style="text-transform: none;"><?php echo $con->GetDescr("select OrganName from ref_organ where OrganID = '$organid'");?> </span> <?php }?>
		</div>
  <div class="span3">
	  <?php $page="news/photo"; require_once 'newsorganclass.php';?>
			<?php require_once 'poll.php';?>
  </div>
  <div class="span8">
	  <?php require_once 'newsphotodetailcontent.php';?>
  </div>
</div>


	<div style="clear:both"></div>

</div><!-- /rlpad -->
</div><!-- /wrap -->
</div><!-- /container -->

<?php require_once 'footer.php';?>

<?php
	require_once 'footerjs.php';
?>
<script type="text/javascript" src="/js/jquery/jquery.validate/jquery.validate.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// We only want these styles applied when javascript is enabled
		$('div.content').css('display', 'block');

		// Initially set opacity on thumbs and add
		// additional styling for hover effect on thumbs
		var onMouseOutOpacity = 0.67;
		$('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
			mouseOutOpacity:   onMouseOutOpacity,
			mouseOverOpacity:  1.0,
			fadeSpeed:         'fast',
			exemptionSelector: '.selected'
		});
		
		// Initialize Advanced Galleriffic Gallery
		var gallery = $('#thumbs').galleriffic({
			delay:                     2500,
			numThumbs:                 6,
			preloadAhead:              5,
			enableTopPager:            false,
			enableBottomPager:         false,
			imageContainerSel:         '#slideshow',
			controlsContainerSel:      '#controls',
			captionContainerSel:       '#caption',
			loadingContainerSel:       '#loading',
			renderSSControls:          true,
			renderNavControls:         true,
			playLinkText:              'Тоглуулах',
			pauseLinkText:             'Зогсоох',
			prevLinkText:              '&lsaquo; Өмнөх зураг',
			nextLinkText:              'Дараах зураг &rsaquo;',
			nextPageLinkText:          'Дараах &rsaquo;',
			prevPageLinkText:          '&lsaquo; Өмнөх',
			enableHistory:             true,
			autoStart:                 true,
			syncTransitions:           true,
			defaultTransitionDuration: 900,
			onSlideChange:             function(prevIndex, nextIndex) {
				// 'this' refers to the gallery, which is an extension of $('#thumbs')
				this.find('ul.thumbs').children()
					.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
					.eq(nextIndex).fadeTo('fast', 1.0);

				// Update the photo index display
				this.$captionContainer.find('div.photo-index')
					.html('Зураг '+ (nextIndex+1) +' - '+ this.data.length);
			},
			onPageTransitionOut:       function(callback) {
				this.fadeTo('fast', 0.0, callback);
			},
			onPageTransitionIn:        function() {
				var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
				var nextPageLink = this.find('a.next').css('visibility', 'hidden');
				
				// Show appropriate next / prev page links
				if (this.displayedPage > 0)
					prevPageLink.css('visibility', 'visible');

				var lastPage = this.getNumPages() - 1;
				if (this.displayedPage < lastPage)
					nextPageLink.css('visibility', 'visible');

				this.fadeTo('fast', 1.0);
			}
		});

		/**************** Event handlers for custom next / prev page links **********************/

		gallery.find('a.prev').click(function(e) {
			gallery.previousPage();
			e.preventDefault();
		});

		gallery.find('a.next').click(function(e) {
			gallery.nextPage();
			e.preventDefault();
		});

		/****************************************************************************************/

		/**** Functions to support integration of galleriffic with the jquery.history plugin ****/

		// PageLoad function
		// This function is called when:
		// 1. after calling $.historyInit();
		// 2. after calling $.historyLoad();
		// 3. after pushing "Go Back" button of a browser
		function pageload(hash) {
			// alert("pageload: " + hash);
			// hash doesn't contain the first # character.
			if(hash) {
				$.galleriffic.gotoImage(hash);
			} else {
				gallery.gotoIndex(0);
			}
		}

		// Initialize history plugin.
		// The callback is called at once by present location.hash. 
		$.historyInit(pageload, "advanced.html");

		/****************************************************************************************/
	});
</script>
</body>
</html>