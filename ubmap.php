<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once 'headerjsstyle.php';
?>
<!-- key: 	ABQIAAAAqJlUmKWBsPz4CkGlGUzfyxTFPfTHWeyKrxsUNWQquLfG2ZJ1ZBTblhdXqYUMY-G2l46EZPwzGPpIug
			ABQIAAAAqJlUmKWBsPz4CkGlGUzfyxTKnUXmXgP_7t4tNvtHk4ZuyJHGoxSIM7w3OG0mGs5XlkEMcbI8-QvT4g 
 -->
 <link rel="stylesheet" type="text/css" media="all"	href="<?=$rf;?>/js/google.map/style.css" />
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAqJlUmKWBsPz4CkGlGUzfyxTFPfTHWeyKrxsUNWQquLfG2ZJ1ZBTblhdXqYUMY-G2l46EZPwzGPpIug" type="text/javascript"></script>
<script src="<?=$rf;?>/js/google.map/load.js" type="text/javascript"></script>
<script src="<?=$rf;?>/js/google.map/fw.js" type="text/javascript"></script>
<script src="<?=$rf;?>/js/google.map/ggmap.js" type="text/javascript"></script>
<script>
	var messages = {"js.loading":"Уншиж байна ...","js.location":"Байрлал","js.area":"Талбай","js.print.text.please.input.text":"Текстээ оруулна уу?","js.area.km2":"Талбай (km<sup>2</sup>)","js.street.title":"Гудамж, өргөн чөлөө","js.location.lng":"Уртраг","js.localarea":"Нутаг дэвсгэр","js.location.lat":"Өргөрөг","js.road.title":"Зам засвар - 2011","js.measure":"Зай хэмжих","js.measure.total.length":"Урт","js.area.m2":"Талбай (m<sup>2</sup>)"};
</script>
</HEAD>
<style type="text/css">

.mapclass li a{
	padding: 5px;
	background: #ddd; 
	border-bottom: 1px solid #ededed; 
}
.mapclass li a {
	text-decoration: none;
	display: block;
}
.mapclass li a:hover, li.sub a:hover {
	background: #f2f2f2
}
.mapclass ul{
	list-style-position: outside; 
	list-style: none;
	padding: 0; 
	margin: 0
}
.mapclass ul li.sub a{
	padding: 5px 5px 5px 15px;
	background: #ddd; 
	border-bottom: 1px solid #ededed; 
}
</style>
<body onload="ggmap.init('container');" onunload="GUnload()">
<div class="conter">
<div id="main">
	<?php require_once 'header.php';?>
	<div class="clear"></div>
	<div style="margin-top: 10px">
		<div style="border: 1px solid #dadada; background: #ededed; width: 300px; float: left;">
			<div style="background: #dadada">
				<div style="padding: 5px; border-bottom: 1px solid #dadada">
					<strong>Хайлт: </strong><br/>
					<input type="text" name="mapsrch" id="mapsrch" value="<?=$mapsrch;?>" size="40"/>
					<input type="button" name="btnsearch" id="btnsearch" value="Хайх"/>
				</div>
			</div>
			<div id="leftpane">
				<div id="content">
					<ul>
<?php
	$qry="select MapClassID, MapClassName";
	$qry.=" from ref_mapclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
						<li class="maincategory">
							<span><?=$row[$j]['MapClassName'];?></span>
						</li>
<?php
		$qry="select MapClassSubID, MapClassSubName, (select count(*) from tbl_map where IsShow='YES' and T.MapClassSubID=MapClassSubID) as OrganCount";
		$qry.=" from ref_mapclasssub T";
		$qry.=" where IsShow='YES' and MapClassID='".$row[$j]['MapClassID']."'";
		$qry.=" order by ShowOrder";
		//echo $qry; exit;
		$row1=$con->select($qry);
		$rowcount1=count($row1);
		
		$j1=0;
		while ($j1<$rowcount1){
?>
						<li	onclick="request('<?=$rf;?>/maclasssub.php',{mapclasssubid:<?=$row1[$j1]['MapClassSubID'];?>},'content');">
							<span class="subcategory"><?=$row1[$j1]['MapClassSubName'];?> (<?=$row1[$j1]['OrganCount'];?>)</span>
						</li>
<?php
		$j1++;
		} 
	$j++;
	}
?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div style="float: right; width: 690px; border: 1px solid #dadada">
		<div style="padding: 5px; background: url('<?=$rf;?>/images/web/head_top_bg_line.png') repeat-x; text-align: right;">
			<a href="#" class="tool_measure"
				onclick="ggmap.measure();request('/get/public.do',{},'content');return false;">Зай хэмжих
			</a>
			<a href="#" class="tool_area"
				onclick="ggmap.area();request('/get/public.do',{},'content');return false;">Талбай хэмжих
			</a>
			<a href="#" class="tool_location"
				onclick="ggmap.location();return false;">Байршил
			</a>
			<a href="#" class="tool_print"
				onclick="ggmap.clear();openNewWindow('toolprint','/print.do',663,750,100, 50);return false;">Хэвлэх
			</a>
			<a href="#" class="tool_refresh"
				onclick="ggmap.clear();request('/get/public.do',{},'content');return false;">Цэвэрлэх
			</a>
		</div>
		<div id="loader">Уншиж байна...</div>
   		<div id="container" style="width: 100%; height: 500px"></div>
    </div>
	<div class="clear"></div>
    <?php require_once 'footer.php';?>
</div>
</div>
</body>
</html>