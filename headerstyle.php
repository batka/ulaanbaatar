<title><?=$pagetitle1;?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="<?=$rf;?>/images/web/icon.gif" rel="SHORTCUT ICON">

	<link href="/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
  body {
    padding-top: 0px;
    padding-bottom: 0;
  }
  .sidebar-nav {
    padding: 9px 0;
  }
  @media (max-width: 767px) {
	  body {
	    padding-top: 60px;
	    padding-bottom: 40px;
	  }
  }
</style>
    <link href="/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
    <!-- <link rel="stylesheet" href="/nivo-slider.css" type="text/css" media="screen" /> -->
    <link rel="stylesheet" href="/js/jquery/jquery.galleriffic/galleriffic-5.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/js/jquery/jquery.datepick/smoothness.datepick.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.sudoSlider.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").sudoSlider({
				controlsShow:false,
				numeric:false,
				auto:true,
				fade:true,
				pause:'5000',
				continuous:true,
				slideCount:2,				
			});
		});	
	</script>
	
	<script type="text/javascript">
		$('.dropdown-toggle').dropdown()
	</script>
		<script type="text/javascript">
			$(function () {
		    $('body').on('hover.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function (e) {
		      e.preventDefault()
		      $(this).tab('show')
		    })
		  })
		</script>