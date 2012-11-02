<div style="margin-top: 10px;">
	<?php if($newslink!='dailynews'){
		
		$qry="select T.*, DATE_FORMAT(T.NewsDate,'%Y-%m-%d') as date";
		$qry.=" from tbl_news T";
		$qry.=" left join tbl_newsorgan N";
		$qry.=" on T.NewsID = N.NewsID";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and N.OrganID='".MAYORID."'";
		$qry.=" group by T.NewsID";
		$qry.=" order by T.NewsDate desc, T.CreateDate desc";
		$qry.=" limit 0, 1";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$link="$rf/news/dailynews/detail/".$row[0]['NewsID']."/";
	?>
	<div class="formlefttitle">Цаг үеийн мэдээ</div>
	<div class="clear"></div>
		<div class="formsub" style="padding: 0px; padding-top: 5px;">			
			<ul style="margin: 0; padding: 0">
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc;">
					<div style="text-align: center; line-height: 1.1em">
<?php
			$imagesource=$drfo."/files/news/small/".$row[0]['ImageSource'];
		if (!empty($row[0]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rfo."/files/news/small/".$row[0]['ImageSource']; 
?>
			<a href="<?=$link?>" title="<?=$row[0]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="174"; style="border: 1px solid #c5ced7; padding: 2px"></a>
<?php
		} 
?>
				</div>
				<div style="font-size: 12px; line-height: 13px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79;"><?=GetStrBr($row[0]['Title'], "60");?></a></div>
				<div class="descr" style="font-size: 11px; margin: 0px;"><?=GetStrBr($row[0]['Intro'], "50");?><div>
				<div align="right">
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[0]['NewsDate'];?></span>
				</div>
				<div class="clear"></div>
			</li>
		</ul>
	</div>
	<?php }}?>
	<?php if($newslink!='publicationnews'){
		$qry="select T.*, DATE_FORMAT(PublicationNewsDate,'%Y-%m-%d') as date";
		$qry.=" from tbl_publicationnews T";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.OrganID='".MAYORID."'";
		$qry.=" order by PublicationNewsDate desc, CreateDate desc";
		$qry.=" limit 0, 1";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$link="$rf/news/publicationnews/detail/".$row[0]['PublicationNewsID']."/";
	?>
	<div class="formlefttitle">Хэвлэлийн тойм</div>
	<div class="clear"></div>
		<div class="formsub" style="padding: 0px; padding-top: 5px;">			
			<ul style="margin: 0; padding: 0">			
	
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc;">
					<div style="text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drfo."/files/publication/medium/".$row[0]['ImageSource'];
		if (!empty($row[0]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rfo."/files/publication/medium/".$row[0]['ImageSource']; 
?>
			<a href="<?=$link?>" title="<?=$row[0]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="174"; style="border: 1px solid #c5ced7; padding: 2px"></a>
<?php }?>
				</div>
				<div style="font-size: 12px; line-height: 13px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79;"><?=GetStrBr($row[0]['Title'], "60");?></a></div>
				<div class="descr" style="font-size: 11px; margin: 0px;"><?=GetStrBr($row[0]['Descr'], "50");?><div>
				<div align="right">
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[0]['date'];?></span>
				</div>
				<div class="clear"></div>
			</li>
		</ul>
	</div>
	<?php }}?>
	<?php if($newslink!='speech'){?>
	<?php
		$qry="select T.*, DATE_FORMAT(T.SpeechDate,'%Y-%m-%d') as date";
		$qry.=" from tbl_speech T";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.OrganID='".MAYORID."'";
		$qry.=" order by T.SpeechDate desc, T.CreateDate desc";
		$qry.=" limit 0, 1";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$link="$rf/news/speech/detail/".$row[0]['SpeechID']."/";
	?>
	<div class="formlefttitle">Илтгэл, хэлсэн үг</div>
	<div class="clear"></div>
		<div class="formsub" style="padding: 0px; padding-top: 5px;">			
			<ul style="margin: 0; padding: 0">			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc;">
					<div style="text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drfo."/files/speech/medium/".$row[0]['ImageSource'];
		if (!empty($row[0]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rfo."/files/speech/medium/".$row[0]['ImageSource']; 
?>
			<a href="<?=$link?>" title="<?=$row[0]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="174"; style="border: 1px solid #c5ced7; padding: 2px"></a>
<?php
		} 
?>
				</div>
				<div style="font-size: 12px; line-height: 13px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79;"><?=GetStrBr($row[0]['Title'], "60");?></a></div>
				<div class="descr" style="font-size: 11px; margin: 0px;"><?=GetStrBr($row[0]['Descr'], "50");?><div>
				<div align="right">
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[0]['date'];?></span>
				</div>
				<div class="clear"></div>
			</li>
		</ul>
	</div>
	<?php }}?>
	<?php if($newslink!='photonews'){?>
	<?php
		$qry="select T.*, DATE_FORMAT(T.PhotoNewsDate,'%Y-%m-%d') as date";
		$qry.=" from tbl_photonews T";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.OrganID='".MAYORID."'";
		$qry.=" order by T.PhotoNewsDate desc, T.CreateDate desc";
		$qry.=" limit 0, 1";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
			$link="$rf/news/photonews/detail/".$row[0]['PhotoNewsID']."/";
	?>
	<div class="formlefttitle">Фото мэдээ</div>
	<div class="clear"></div>
		<div class="formsub" style="padding: 0px; padding-top: 5px;">			
			<ul style="margin: 0; padding: 0">			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc;">
					<div style="text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drfo."/files/photonews/medium/".$row[0]['ImageSource'];
		if (!empty($row[0]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rfo."/files/photonews/medium/".$row[0]['ImageSource']; 
?>
			<a href="<?=$link?>" title="<?=$row[0]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="174"; style="border: 1px solid #c5ced7; padding: 2px"></a>
<?php
		} 
?>
				</div>
				<div style="font-size: 12px; line-height: 13px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79;"><?=GetStrBr($row[0]['Title'], "60");?></a></div>
				<div class="descr" style="font-size: 11px; margin: 0px;"><?=GetStrBr($row[0]['Descr'], "50");?><div>
				<div align="right">
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[0]['date'];?></span>
				</div>
				<div class="clear"></div>
			</li>
		</ul>
	</div>
	<?php }}?>
</div>