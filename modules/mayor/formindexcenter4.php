<style type="text/css">
	.tableinfo{
		width: 100%;
		font-family: Tahoma;
		font-size: 12px;
	}
	
	.tableinfo tr{
	}
	
	.tableinfo td{
		color: #000000;
		font-size: 11px;
		padding: 2px;
		height: 20px;
	}
	
	.tableinfo a{
		color: #14385e;
		text-decoration: none;
	}
	.tableinfo a:HOVER{
		text-decoration: underline;
	}
</style>

<script type="text/javascript">
	var videocontabbefore="videocon1";
	var videoconmenubefore="videocontab1";
	var videocontab,videoconmenu;
	function showvideocontab(id){
		videocontab="videocon"+id;
		videoconmenu="videocontab"+id;
		document.getElementById(videocontabbefore).style.display="none";		
		document.getElementById(videocontab).style.display="block";

		document.getElementById(videoconmenubefore).className="";
		document.getElementById(videoconmenu).className="here";		

		videoconmenubefore=videoconmenu;
		videocontabbefore=videocontab;
	}
</script>
<div style="width: 485px; overflow: hidden;">
	<ul id="globalnav">
		<li><a style="cursor: pointer;" id="videocontab1" onclick="showvideocontab('1');" class="here">Фото мэдээ</a></li>
		<li><a style="cursor: pointer;" id="videocontab2" onclick="showvideocontab('2');">Дүрстэй мэдээ</a></li>
	</ul>
	<div style="border: 1px solid #ebebeb; background-color: #f6f7f7;  height: 100px">

		<div id="videocon1" style="display: block; padding: 5px; height: 95%; overflow: auto;">		
			<ul style="margin: 0; padding: 0">
			<?php
				$qry="select *, DATE_FORMAT(PhotoNewsDate,'%Y-%m-%d') as date from tbl_photonews";
				$qry.=" where IsShow='YES'";
				$qry.=" and ImageSource!=''";
				$qry.=" and OrganID='".MAYORID."'";
				$qry.=" order by PhotoNewsDate desc";
				$qry.=" limit 0, 2";
				$row=$con->select($qry);
				$rowcount=count($row);
			?>
			<?php
			if($rowcount>0){
				for($i=0; $i<$rowcount; $i++){
				$link="$rf/news/photonews/detail/".$row[$i]['PhotoNewsID']."/";
			?>
			<div style="width: 216px; height: 85px; margin-right: 3px; margin-bottom: 8px; float: left; overflow: hidden;">
				<div style="float: left; margin-right: 5px;">
				<?php if(!empty($row[0]['ImageSource']) && file_exists("$drfo/files/photonews/small/".$row[$i]['ImageSource'])){?>
					<a href="<?=$link?>"><img title="<?=asuUniConvert($row[$i]['Title'])?>" src="<?=$rfo?>/files/photonews/medium/<?=$row[$i]['ImageSource']?>" width="120" height="85" border="0"/></a>
				<?php }?>
				</div>
				<div style="color: #244d79; font-size: 11px; text-align: justify; line-height: 12px;">
					<div style="line-height: 12px; margin-bottom: 3px; text-align: left; margin-top: 3px;"><a href="<?=$link?>" style="color: #244d79; font-size: 13px; text-decoration: none;">
					<?=GetStrBr(asuUniConvert($row[$i]['Title']),40)?>
					</a></div>
					<div style="font-size: 10px; color: #999;"><?=$row[0]['date'];?></div>
				</div>
			</div>
				<?php
				}}else{?>
				<div class="notice"><?=$strnotfound?></div>
			<?php }?>
			</ul>
		</div>

		
		<div id="videocon2" style="display: none; padding: 5px; height: 95%; overflow: auto;">
			<ul style="margin: 0; padding: 0">	
			<?php
				$qry="select *, DATE_FORMAT(VideoNewsDate,'%Y-%m-%d') as date from tbl_videonews";
				$qry.=" where IsShow='YES'";
				$qry.=" and OrganID='$mayororganid'";
				$qry.=" order by VideoNewsDate desc";
				$allrow=$con->GetDescr("select count(*) from tbl_videonews where IsShow='YES' and OrganID='10102'");
				$qry.=" limit 0, 2";
				$row=$con->select($qry);
				$rowcount=count($row);
				
				if($rowcount>0){
				for($i=0; $i<$rowcount; $i++){
					$link="$rf/news/videonews/detail/".$row[$i]['VideoNewsID']."/";
			?>
				<div style="width: 250px; height: 85px; margin-right: 3px; margin-bottom: 8px; float: left; overflow: hidden;">
					<div style="float: left; margin-right: 5px;">
					<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drfo/files/videos/xsmall/".$row[$i]['ImageSource'])){?>
						<a href="<?=$link?>"><img title="<?=asuUniConvert($row[$i]['Title'])?>" src="<?=$rfo?>/files/videos/xsmall/<?=$row[$i]['ImageSource']?>" width="120" height="85" border="0"/></a>
					<?php }?>
					</div>
					<div style="color: #244d79; font-size: 11px; text-align: justify; line-height: 12px;">
						<div style="line-height: 12px; margin-bottom: 3px; text-align: left; margin-top: 3px;"><a href="<?=$link?>" style="color: #244d79; font-size: 13px; text-decoration: none;">
						<?=GetStrBr(asuUniConvert($row[$i]['Title']),40)?>
						</a></div>
						<div style="font-size: 10px; color: #999;"><?=$row[0]['date'];?></div>
					</div>
				</div>
			<?php }
			}else{?>
				<div class="notice"><?=$strnotfound?></div>
			<?php }?>
			</ul>
		</div>
	</div>
</div>
<div style="clear: both;"></div>