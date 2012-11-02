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

	$pagelink1=$rf."/budget";
	$pageFormName="BudgetForm";
?>
<style type="text/css" media="screen">
	@import url(<?=$rf;?>/admin/js/jquery/jquery.validate/stylejqvalidate.css);
</style>
<style type="text/css">
	.budgetul{
		padding: 5px 10px;
		margin: 0;
		margin-left: 10px;
	}
	.budgetul{
		list-style: none;
	}
	.budgetul li{
		float: left;
		min-width: 250px;
		margin: 2px;
		margin-bottom: 5px;
	}
	.budgethead{
		margin-left: 12px;
		font-size: 12px;
		color: #044573;
	}
	.subbut{
		margin-top: 5px;
		padding: 4px;
		background-color: #ffffff;
	}
	.subbut:HOVER {
		background-color: #e1e1e1;
	}
	#request{
		display: none;
		float: right;
		font-size: 14px;
		color: red;
		margin-right: 420px;
	}
}
</style>
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
<script type="text/javascript" src="<?=$rf;?>/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/jquery.validate/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$pageFormName?>").validate({
		rules: {
			email:{
				required:		true,
				email:		true
			},
			address:"required"
		},
		messages: {
			email:{
				required: "И-мэйлээ бичнэ үү!",
				email: "И-мэйл зөв бичнэ үү!"
			},
			address:"Хаягаа бичнэ үү!"
		}
	});
	var editor = CKEDITOR.replace('descr',
		{
			toolbar : 'Basic',
		 	filebrowserBrowseUrl : '<?=$rf?>/js/ckfinder/ckfinder.html',
		 	filebrowserImageBrowseUrl : '<?=$rf?>/js/ckfinder/ckfinder.html?type=Images',
		 	filebrowserFlashBrowseUrl : '<?=$rf?>/js/ckfinder/ckfinder.html?type=Flash',
		 	filebrowserUploadUrl : '<?=$rf?>/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		 	filebrowserImageUploadUrl : '<?=$rf?>/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		 	filebrowserFlashUploadUrl : '<?=$rf?>/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		 	filebrowserWindowWidth : '600',
		 	filebrowserWindowHeight : '700',
		 	width: 950,
		 	height: 200
		 } 
	);
});
</script>

<?php if($_SESSION['alert_msg'] == 'success'){
	$_SESSION['alert_msg']='';
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#request").fadeToggle("slow", "linear");
	setTimeout("$('#request').fadeToggle('slow', 'linear')",2000);
});	
</script>
<?php }?>
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
		<div class="hdtitle">&nbsp;&nbsp;Нийслэлийн 2013 оны төсвийн төслийн санал өгөх</div>
		<div class="listbg" style="min-height: 480px; padding-bottom: 5px">
		<form  id="<?=$pageFormName?>" name="<?=$pageFormName?>" action="processform.php?action=budgetadd" method="post" enctype="multipart/form-data">
			<div style="padding: 10px; font-size: 16px; text-align: center; color: #414141;">
				Иргэн та Нийслэлийн 2013 оны төсвийн төсөлд саналаа өгнө үү.
			</div>
			<?php
				$qry="select *";
				$qry.=" from tbl_budgetclass";
				$qry.=" where IsShow='YES'";
				$qry.=" order by ShowOrder";
				$row=$con->select($qry);
				$rowcount=count($row);
			?>
			<div class="budgethead">Чиглэл:<div id="request">Таны саналыг хүлээн авлаа.</div></div>
			<ul class="budgetul">
				<?php for($i=0; $i<$rowcount; $i++){?>
					<li style="min-width:12% !important; margin-right:20px;">
						<input type="radio" name="budgetclassid" value="<?=$row[$i]['BudgetClassID']?>" id="budgetradio<?=$i?>" <?php if($i==0) echo "checked"?> />
						<label for="budgetradio<?=$i?>" style="vertical-align: top;"><?=$row[$i]['BudgetClassName']?></label> 
					</li>
				<?php }?>
			</ul>
			<div class="clear"></div>
			<div class="budgethead" style="margin-top: 5px; margin-bottom: 5px;">Санал:</div>
			<center>
				<textarea id="descr" name="descr" style="width:97%; min-height:100px;" ><?=$row[0]['Descr'];?></textarea>
			</center>
			<div class="budgethead" style="margin-top: 5px; margin-bottom: 5px;">Хавсралт файл:</div>
			<div style="margin-left: 20px;"><input type="file" id="filesource" name="filesource" size="60"/></div>
			<div style="margin: 5px; margin-top: 15px; padding: 5px; border-top: 1px solid #ffffff;">
				<table>
					<tr>
						<td>Утас :</td>
						<td><input type="text" id="phonenumber" name="phonenumber" size="40"/></td>
					</tr>
					<tr>
						<td>И-мэйл :<?=$strRequiredField?></td>
						<td><input type="text" id="email" name="email" size="40"/></td>
					</tr>
					<tr>
						<td>Хаяг :<?=$strRequiredField?></td>
						<td><input type="text" id="address" name="address" size="100"/></td>
					</tr>
				</table>
				<center>
					<input type="submit" class="btn" value="Илгээх" onclick="return confirm('Санал илгээхийг зөвшөөрч байна уу?');" class="subbut">
				</center>
			</div>
		</form>
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
</body>
</html>