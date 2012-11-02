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
?>
<link rel='stylesheet' type='text/css' href='/js/jquery/fullcalendar/theme.css' />
<link rel='stylesheet' type='text/css' href='/js/jquery/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='/js/jquery/fullcalendar/fullcalendar.print.css' media='print' />

<script src="/js/jquery.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script type='text/javascript'>
		$(document).ready(function() {
			$('#calendar').fullCalendar({
				theme: true,
				editable: false,
				events: "/json-events.php",
				loading: function(bool) {
					if (bool) $('#loading').show();
					else $('#loading').hide();
				}
			});
		});
		</script>
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
	<script src="/js/jquery.js"></script>
    <script src="/js/jquery.min.js"></script>
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

	<div>
		<div class="hdtitle">&nbsp;&nbsp;Үйл явдал</div>
		<div style="padding:0px 20px;">
			<?php require_once 'eventlistcontent.php';?>
		</div>
	</div>


</div><!-- /rlpad -->
</div><!-- /wrap -->
</div><!-- /container -->

<?php require_once 'footer.php';?>

<?php
	require_once 'footerjs.php';
?>
<script type='text/javascript' src='/js/jquery/fullcalendar/fullcalendar.js'></script>


</body>
</html>