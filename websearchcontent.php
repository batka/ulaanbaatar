<?php
	$pageFormName="webSearch";
	$showcount=10;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}
	
	$weblink='ulaanbaatar.mn';
	
	$srch_v=trim($_POST['srch_v']);
	
	$qrywhr='';
	if(!empty($srch_v)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$srch_v%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$srch_v%')";
	}else{
		$showcount=0;
	}

	$qry = "
		select T.*, DATE_FORMAT(CreateDate, '%Y оны %m сарын %d') as date from(
			SELECT  NewsID, Title, Descr, CONCAT('files/news/xsmall/', ImageSource) as img, CreateDate, 'news' as TableType,
			'Цаг үеийн мэдээ' as TableName,
			CONCAT('/news/detail/', NewsID) as link
			FROM tbl_news 
			WHERE IsShow='YES'
			UNION
			
			SELECT  PhotoNewsID, Title, Descr, CONCAT('files/photonews/xsmall/', ImageSource) as img, CreateDate, 'photonews' as TableType,
			'Фото мэдээ' as TableName,
			CONCAT('/news/photo/detail/', PhotoNewsID) as link
			FROM tbl_photonews 
			WHERE IsShow='YES'
			UNION
			
			SELECT  SpeechID, Title, Descr, CONCAT('files/speech/xsmall/', ImageSource) as img, CreateDate, 'speech' as TableType,
			'Илтгэл хэлсэн үг' as TableName,
			CONCAT('/speech/detail/', SpeechID) as link
			FROM tbl_speech 
			WHERE IsShow='YES'
			UNION
			
			SELECT  PublicationNewsID, Title, Descr, CONCAT('files/publication/xsmall/', ImageSource) as img, CreateDate, 'publication' as TableType,
			'Хэвлэлийн тойм' as TableName,
			CONCAT('/publication/detail/', PublicationNewsID) as link
			FROM tbl_publicationnews 
			WHERE IsShow='YES'
			UNION
			
			SELECT  VideoNewsID, Title, Descr, CONCAT('files/videonews/xsmall/', ImageSource) as img, CreateDate, 'videonews' as TableType,
			'Дүрстэй мэдээ' as TableName,
			CONCAT('/news/video/detail/', VideoNewsID) as link
			FROM tbl_videonews 
			WHERE IsShow='YES'
			UNION
			
			SELECT  CreationID, Title, Descr, CONCAT('files/videonews/xsmall/', ImageSource) as img, CreateDate, 'creation' as TableType,
			'Бүтээн байгуулалт' as TableName,
			CONCAT('/creation/detail/', CreationID) as link
			FROM tbl_creation 
			WHERE IsShow='YES'
			UNION
			
			SELECT  HistoryID, TimeLine as Title, Descr, CONCAT('files/history/xsmall/', '') as img, CreateDate, 'history' as TableType,
			'Хотын түүх' as TableName,
			CONCAT('/history/', HistoryID) as link
			FROM tbl_history 
			WHERE IsShow='YES'
			UNION
			
			SELECT  ComcityID, Title, Descr, CONCAT('files/comcity/xsmall/', ImageSource) as img, CreateDate, 'comcity' as TableType,
			'Хамтын ажиллагаатай хотууд' as TableName,
			CONCAT('/comcity/detail/', ComcityID) as link
			FROM tbl_comcity 
			WHERE IsShow='YES'
			UNION
			
			SELECT  ProID, ProName as Title, ProDescr as Descr, CONCAT('files/pro/xsmall/', '') as img, CreateDate, 'pro' as TableType,
			'Төсөл, хөтөлбөр' as TableName,
			CONCAT('/pro/detail/', ProID) as link
			FROM tbl_pro 
			WHERE IsShow='YES'
			UNION
			
			SELECT  LawRuleID, Title, Descr, CONCAT('files/lawrule/xsmall/', '') as img, CreateDate, 'lawrule' as TableType,
			'Захирамж' as TableName,
			CONCAT('/lawrule/detail/', LawRuleID) as link
			FROM tbl_lawrule 
			WHERE IsShow='YES'
			AND IsPublic='YES'
			UNION
			
			SELECT  ReportID, Title, Descr, CONCAT('files/report/xsmall/', '') as img, CreateDate, 'report' as TableType,
			'Төсөв, НЭЗ-ийн зорилт' as TableName,
			CONCAT('/report/detail/', ReportID) as link
			FROM tbl_report 
			WHERE IsShow='YES'
			UNION
			
			SELECT  CouncilPromptnessID, Title, Descr, CONCAT('files/prompt/xsmall/', '') as img, CreateDate, 'prompt' as TableType,
			'Нийслэлийн шуурхай' as TableName,
			CONCAT('/prompt/detail/', CouncilPromptnessID) as link
			FROM mayor_councilpromptness 
			WHERE IsShow='YES'
			UNION
			
			SELECT  TenderID, Title, Descr, CONCAT('files/tender/xsmall/', '') as img, CreateDate, 'tender' as TableType,
			'Тендер' as TableName,
			CONCAT('/tender/detail/', TenderID) as link
			FROM tbl_tender 
			WHERE IsShow='YES'
			UNION
			
			SELECT  TrainningID, Title, Descr, CONCAT('files/trainning/xsmall/', '') as img, CreateDate, 'trainning' as TableType,
			'Сургалт' as TableName,
			CONCAT('/trainning/detail/', TrainningID) as link
			FROM tbl_trainning 
			WHERE IsShow='YES'
			UNION
			
			SELECT  EventID, Title, Descr, CONCAT('files/event/xsmall/', '') as img, CreateDate, 'event' as TableType,
			'Үйл явдал' as TableName,
			CONCAT('/event/detail/', EventID) as link
			FROM tbl_event 
			WHERE IsShow='YES'
			UNION
			
			SELECT  ServiceID, Title, Descr, CONCAT('files/service/xsmall/', '') as img, CreateDate, 'service' as TableType,
			'Төрийн үйлчилгээ' as TableName,
			CONCAT('/service/detail/', ServiceID) as link
			FROM tbl_service 
			WHERE IsShow='YES'
		) T
		where 1=1
	";
	$qry .= $qrywhr;
	$qry .= "order by T.CreateDate desc";
	$allrow=count($con->select($qry));
	$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
	
	$row=$con->select($qry);
	$rowcount=count($row)
	
?>

<style type="text/css">
	.generalsearch{
		color: #505050;
	}
	.generalsearch:FOCUS{
		color: #000000;
	}
</style>

<div class="hdtitle">&nbsp;&nbsp;Ерөнхий хайлт</div>
<div style="min-height: 480px;">
	<form id="webSearch" name="webSearch" action="<?=$rf?>/search" method="post">
		<center>
			<input type="text" size="60" id="srch_v" name="srch_v" class="generalsearch" value="<?=$srch_v?>" placeholder="Хайх утгаа оруулна уу...">
			<input type="submit" class="generalsearchb" value="Хайлт">
		</center>
		<div style="margin-top: 5px; padding: 5px;">
			<?php
				if($rowcount>0){
					for($i=0; $i<$rowcount; $i++){
			?>
			<div class="srchcontent">
				<div class="contenttitle"><a href="<?=$rf.$row[$i]['link']?>" target="_blank"><?=$row[$i]['Title']?></a></div>
				<div class="clear"></div>
				<div class="contentlink"><a href="<?=$rf.$row[$i]['link']?>" target="_blank"><?=$weblink.$row[$i]['link']?></a></div>
				<div>
				<?php 
				if(file_exists("$drf/{$row[$i]['img']}")){?>
					<img src="<?="$rf/{$row[$i]['img']}"?>" style="float: left; margin-right: 5px; margin-bottom: 5px;">
				<?php }?>
				<?=GetStrBr(strip_tags($row[$i]['Descr']), 600)?>
				</div>
				<div class="clear"></div>
				<div class="contentmore"><img src="<?=$rf?>/images/web/foldersearch.png"><?=$row[$i]['TableName']?> | <?=$row[$i]['date']?> | <a href="<?=$rf.$row[$i]['link']?>">Дэлгэрэнгүй</a></div>
				<div class="clear"></div>
			</div>
			<?php }
					require_once 'pagenumberpost.php';
				}else{?>
					<div style="text-align: center;"><?=$msg_nodata;?></div>
			<?php }?>
		</div>
	</form>
</div>