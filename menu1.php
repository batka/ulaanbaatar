<link href="<?=$rf;?>/js/jquery/dropdown/orange.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$rf;?>/js/jquery/dropdown/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?=$rf;?>/js/jquery/dropdown/jquery.dcmegamenu.1.3.3.js"></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-menu').dcMegaMenu({
		rowItems: '3',
		speed: 0,
		effect: 'fade'
	});
});
</script>
<div class="orange">  
<ul id="mega-menu" class="mega-menu">
	<li>
		<a href="">Улаанбаатар</a>
		<ul>
			<li>
				<a href="#">Монгол улсын нийслэл</a>
				<ul>
<?php
	$qry="select CapitalID, CapitalName";
	$qry.=" from capital_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CapitalName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['CapitalName'];?></a></li>
<?php
		$j++;
	} 
?>
					<li><a href="#">Хотын түүх</a></li>
				</ul>
			</li>
		</ul>
	</li>
	<li>
		<a href="">Мэдээ, мэдээлэл</a>
		<ul>
			<li>
				<a href="#" style="width: 470px">Цаг үеийн мэдээ</a>
				<ul>
<?php
	$qry="select NewsClassID, NewsClassName";
	$qry.=" from ref_newsclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	$i=$rowcount/3;
	while ($j<$i) {
?>
					<li><a href="#"><?=$row[$j]['NewsClassName'];?></a></li>
<?php
		$j++;
	} 
?>
				</ul>
			</li>
			<li>
				<a href="#"></a>
				<ul>
<?php
	$qry="select NewsClassID, NewsClassName";
	$qry.=" from ref_newsclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=$rowcount/3;
	while ($j<$rowcount/3+$i) {
?>
					<li><a href="#"><?=$row[$j]['NewsClassName'];?></a></li>
<?php
		$j++;
	} 
?>
				</ul>
			</li>
			<li>
				<a href="#"></a>
				<ul>
<?php
	$qry="select NewsClassID, NewsClassName";
	$qry.=" from ref_newsclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=$rowcount/2+$i;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['NewsClassName'];?></a></li>
<?php
		$j++;
	} 
?>
					<li><a href="#">Фото мэдээ</a></li>
					<li><a href="#">Дүрстэй мэдээ</a></li>
				</ul>
			</li>
			<li>
				<a href="#">Нээлттэй мэдээлэл</a>
			    <ul>
<?php
	$qry="select InfoClassID, InfoClassName";
	$qry.=" from ref_infoclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['InfoClassName'];?></a></li>
<?php
		$j++;
	} 
?>
				</ul>
			</li>
			<li>
				<a href="#">Зар мэдээ</a>
			    <ul>
<?php
	$qry="select NoticeClassID, NoticeClassName";
	$qry.=" from ref_noticeclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['NoticeClassName'];?></a></li>
<?php
		$j++;
	} 
?>
				</ul>
			</li>
			<li>
				<a href="#">Төрийн үйлчилгээ</a>
			    <ul>
<?php
	$qry="select ServiceClassID, ServiceClassName";
	$qry.=" from ref_serviceclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['ServiceClassName'];?></a></li>
<?php
		$j++;
	} 
?>
				</ul>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">Дүүргүүд</a>
		<ul>
			<li>
				<a href="#">Нийслэлийн дүүргүүд</a>
				<ul>
<?php
	$qry="select DistrictID, DistrictName";
	$qry.=" from district_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by DistrictName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['DistrictName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">Хэрэгжүүлэгч агентлаг</a>
		<ul>
			<li>
				 <a href="#" style="width: 570px">Нийслэлийн засаг даргын хэрэгжүүлэгч агентлаг</a>
				<ul>
<?php
	$qry="select AgencyID, AgencyName";
	$qry.=" from agency_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by AgencyName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	$i=$rowcount/3;
	while ($j<$i) {
?>
					<li><a href="#"><?=$row[$j]['AgencyName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
			<li>
				
				<ul style="margin-top: 31px">
<?php
	$qry="select AgencyID, AgencyName";
	$qry.=" from agency_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by AgencyName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=$i;
	while ($j<$rowcount/3+$i) {
?>
					<li><a href="#"><?=$row[$j]['AgencyName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
			<li>
				
				<ul style="margin-top: 31px">
<?php
	$qry="select AgencyID, AgencyName";
	$qry.=" from agency_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by AgencyName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=$rowcount/3+$i;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['AgencyName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
		</ul>
	</li>
<!-- 
	<li>
		<a href="#">Харьяа байгууллага</a>
		<ul>
			<li>
				 <a href="#" style="width: 370px">Нийслэлийн засаг даргын харьяа байгууллага</a>
				<ul>
<?php
	$qry="select RegionID, RegionName";
	$qry.=" from region_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by RegionName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount/2) {
?>
					<li><a href="#"><?=$row[$j]['RegionName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
			<li>
				<ul style="margin-top: 31px">
<?php
	$qry="select RegionID, RegionName";
	$qry.=" from region_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by RegionName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=$rowcount/2;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['RegionName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
		</ul>
	</li>
 -->
	<li>
		<a href="#">ЗАА харьяа байгууллага</a>
		<ul>
			<li>
				 <a href="#">Захиргаа аж ахуйн харьяа байгууллага</a>
				<ul>
<?php
	$qry="select ZAARegionID, ZAARegionName";
	$qry.=" from zaaregion_class";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ZAARegionName";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['ZAARegionName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
		</ul>
	</li>
	<li>
		<a href="#">MAP</a>
		<ul>
			<li>
				<a href="#">Газарзүйн байршил</a>
				<ul>
<?php
	$qry="select MapClassID, MapClassName";
	$qry.=" from ref_mapclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
?>
					<li><a href="#"><?=$row[$j]['MapClassName'];?></a></li>
<?php
	$j++;
	} 
?>
				</ul>
			</li>
		</ul>
	</li>
</ul>
</div>