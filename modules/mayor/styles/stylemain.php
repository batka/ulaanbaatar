<?php
	//$body_bg="body-bg.jpg";
?>
<style type="text/css">
	body{
		font-family: Tahoma;
		margin: 0px;
		padding: 0px;
		<?php
			if(!empty($body_bg))
				echo "background:url('$rf/images/web/bg/body-bg.jpg') no-repeat fixed center;";
		?>
	}
	
	div.header{
		margin: 1px auto;
		width: 1000px;
		height: 80px;
		padding: 0px;
		background:url('<?=$rf?>/images/web/header_bg.jpg') no-repeat;
	}
	
	div.header img{
		border: 1px;
	}
		
	div.container{
		margin: 0px auto;
		padding: 0px 5px 15px 5px;
		width: 1000px;
		min-height: 400px;
	}
	
	div.footer{
		font-size: 11px;
		bottom: 0px;
		width: 1000px;
		height: 30px;
		margin: auto;
		padding: 0px;
		background-color: #eeeeee;
		border: 1px solid #eeeeee;
	}
	
	div.footer a{
		color: #244d79;
		text-decoration: none;
	}
	div.footer a:HOVER{
		text-decoration: underline;
	}
	
	img {
		border: none;
	}
	
	div.topmenu{
	}
	
	ul#globalnav {
	font-size: 11px;
	font-weight: bold;
	position: relative;
	width:100%;
	height: 22px;
	padding:0px;
	margin:0;
	list-style:none;
	line-height:1.1em;
	border-bottom: 2px solid #970f11;
	}
	
	ul#globalnav li {
		float:left;
		padding-top: 0px;
		margin: 0px;
		background-color: #fff;
		list-style: none;
	}
	
	ul#globalnav a {
		display:block;
		color:#343434;
		text-decoration:none;
		padding: 5px 8px 5px 8px;
	}
	
	ul#globalnav a.here {
		color: #ffffff;
		background:#970f11;			
		border-top-left-radius: 8px 8px;
		border-top-right-radius: 3px 3px;
		
		-moz-border-radius-topleft: 8px;
		-moz-border-radius-topright: 3px;
	
		-webkit-border-top-left-radius: 8px;
		-webkit-border-top-right-radius: 3px;
	}
	
	ul#globalnav a:active,
	ul#globalnav a.here:link,
	ul#globalnav a.here:visited {
		background:#ffffff;
	}
	
	ul#globalnav a:hover{}
	
	ul#globalnav a.here:link,
	ul#globalnav a.here:visited {
		position:relative;
	}
	
	.indexformtitle{
	margin-top: 15px;
	float: left;
	color: #ffffff;
	font-size: 11px;
	font-weight: bold;
	height: 22px;
	line-height: 22px;
	padding-left: 10px;
	padding-right: 10px;
	background:#a90102;
	border-bottom: 2px solid #a90102;
	
	border-top-left-radius: 8px 8px;
	border-top-right-radius: 3px 3px;
	
	-moz-border-radius-topleft: 8px;
	-moz-border-radius-topright: 3px;
	
	-webkit-border-top-left-radius: 8px;
	-webkit-border-top-right-radius: 3px;
	}
	
	.pageformtitle{
	margin-top: 5px;
	float: left;
	color: #ffffff;
	font-size: 11px;
	font-weight: bold;
	height: 19px;
	line-height: 22px;
	padding-left: 10px;
	padding-right: 10px;
	background:#a90102;
	border-bottom: 2px solid #a90102;
	
	border-top-left-radius: 8px 8px;
	border-top-right-radius: 3px 3px;
	
	-moz-border-radius-topleft: 8px;
	-moz-border-radius-topright: 3px;
	
	-webkit-border-top-left-radius: 8px;
	-webkit-border-top-right-radius: 3px;
	}
	
	.pageformtitle a{
		color: #ffffff;
		text-decoration: none;
	}
	
	.pageformtitle a:HOVER{
		text-decoration: underline;
	}
	
	.formlefttitle{
	margin-top: 5px;
	color: #a90102;
	font-size: 11px;
	font-weight: bold;
	height: 21px;
	line-height: 22px;
	padding-left: 5px;
	}
	
	.indexformmorelink{
		float: right;
		padding-right: 5px;
		font-size: 11px;
		height: 22px;
		line-height: 22px;
		color: #7f7f7f;
		text-decoration: none;
		text-transform: lowercase;
	}
	
	.indexformmorelink img{
		width: 13px;
		height: 13px;
		border: 0px;
	}
	
	.indexform{
		padding: 5px;
		background-color: #f6f7f7;
		border: 1px solid #ebebeb;
		border-top: 2px solid #a90102;
	}
	
	.pageform{
		padding: 5px;
		border-top: 2px solid #a90102;
	}
	
	.formsub{
		padding: 5px;
		background-color: #f6f7f7;
		border-top: 2px solid #a90102;
	}
	
	.districta{
		text-decoration: none;
		color: #14385e;
		font-family: Arial;
		font-size: 11px;
		font-weight: bold;
	}
	
	.districtimg{
		float: left;
		margin-right: 27px;
		padding: 4px;
		background-color: #dfdfdf;
		
		border-top-left-radius: 8px 8px;
		border-top-right-radius: 8px 8px;
		
		-moz-border-radius-topleft: 8px;
		-moz-border-radius-topright: 8px;
		
		-webkit-border-top-left-radius: 8px;
		-webkit-border-top-right-radius: 8px;
		
		border-bottom-left-radius: 5px 5px;
		border-bottom-right-radius: 5px 5px;
		
		-moz-border-radius-bottomleft: 5px;
		-moz-border-radius-bottomright: 5px;
		
		-webkit-border-bottom-left-radius: 5px;
		-webkit-border-bottom-right-radius: 5px;
	}
	
	.districtimg img{
		border: 0px;
	}
	
	.ftflink{
		display: block;
		margin-top: 5px;
	}
	.ftflink img{
		border: 1px solid #eeeeee;
	}
	
</style>