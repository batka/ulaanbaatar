<?php
	$pageFormName="frmCalendarList";
	
	$showcount=10;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}
	
	$today=$con->GetDescr("SELECT DATE_FORMAT(NOW(), '%Y-%m-%d')");
?>

<style type="text/css">
	table.calendar{
		font-size: 13px;
	}
	table.calendar tr{
		height: 21px;
	}
	table.calendar th{
		font-weight: normal;
		width: 40px;
	}
	table.calendar td{
		width: 25px;
		text-align: center;
		cursor: default;
		color: #706f6f;
	}
	.calendar-prev a, .calendar-next a{
		color: #000;
		text-decoration: none;
	}
	
	.calendar-prev a:HOVER, .calendar-next a:HOVER{
		color: #a90102;
	}
	#day6, #day7{
		color: #c92223;
	}
	
	.td_day{
		background-color: #eeeeee;
	}
	
	.td_day:HOVER{
		background-color: #e2e2e2;
	}
	
	.linkedday{
		font-weight: bolder;
		color: #000000;
		text-decoration: none;
	}
</style>

<div class="formcenter">
<form action="<?=$REQUEST_URI?>" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
	<td><div class=pageformtitle><a href="<?=$rf?>/calendar/<?=$today?>/">Календарь</a></div></td>
		<td></td>
	</tr>
	<tr>
	<td colspan="2">
	<div class="pageform">
	<div style="height: 180px;"><center>
		<?php
		    $cy = $_GET['Y'];
		    $cm = $_GET['M'];
		    $cd = $_GET['D'];
		    
		    $by = $cy;
		    $bm = $cm - 1;    
		    if ($bm < 1) {$bm = 12; $by--;}
		    
		    $ay = $cy;
		    $am = $cm + 1;    
		    if ($am > 12) {$am = 1; $ay++;}
		    
		    $pn = array("&laquo;"=>"$rf/calendar/$by-$bm-1", "&raquo;"=>"$rf/calendar/$ay-$am-1");
			
			$qry = "SELECT  DISTINCT DATE_FORMAT(LawRuleDate, '%d') AS date1 FROM tbl_lawrule 
					WHERE LawRuleDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES' and IsPublic='YES'
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(ErrandDate, '%d') AS date1 FROM mayor_errand 
					WHERE ErrandDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES'
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(PromptDate, '%d') AS date1 FROM mayor_councilpromptness 
					WHERE PromptDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES'
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(T.NewsDate, '%d') AS date1 FROM tbl_news T
					left join tbl_newsorgan N
					on T.NewsID = N.NewsID
					WHERE T.NewsDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and T.IsShow='YES'
					and N.OrganID='".MAYORID."'
					group by T.NewsID
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(PublicationNewsDate, '%d') AS date1 FROM tbl_publicationnews
					WHERE PublicationNewsDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES'
					and OrganID='".MAYORID."'
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(SpeechDate, '%d') AS date1 FROM tbl_speech
					WHERE SpeechDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES'
					and OrganID='".MAYORID."'
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(PhotoNewsDate, '%d') AS date1 FROM tbl_photonews
					WHERE PhotoNewsDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES'
					and OrganID='".MAYORID."'
					UNION
					
					SELECT  DISTINCT DATE_FORMAT(VideoNewsDate, '%d') AS date1 FROM tbl_videonews
					WHERE VideoNewsDate BETWEEN '".$cy."-".$cm."-1 00:00:00' AND '".$ay."-".$am."-0 00:00:00'
					and IsShow='YES'
					and OrganID='".MAYORID."'
					";
			$row = $con->select($qry);
			$rowcount=count($row);
			for($i=0; $i<$rowcount; $i++){
				$days[(int)$row[$i][0]]=array("$rf/calendar/$cy-$cm-".$row[$i][0],"linked-day");
			}
			
			echo generate_calendar($cy,$cm, $days, 2, NULL, 0, $pn);
		?>
	</center></div>
	<div style="border-bottom: 1px solid #aaaaaa; padding: 5px; font-size: 11px; text-align: justify; color: #363131;">
		Засаг даргын захирамж, Албан даалгавар, Нийслэлийн шуурхай, 
		Цаг үеийн мэдээ, Хэвлэлийн тойм, Илтгэл хэлсэн үг, Фото мэдээ, Дүрстэй мэдээнүүдийг энэ календариас шүүж үзэх болно.
	</div>
	<?php
		$qry="SELECT Title, DATE_FORMAT(LawRuleDate, '%Y-%m-%d') AS date1, LawRuleID AS id, '' AS link, 'Засаг даргын захирамж' AS type, 'lawrule' as report FROM tbl_lawrule
		WHERE LawRuleDate='".$cy."-".$cm."-".$cd." 00:00:00' and IsPublic='YES'
		UNION
		
		SELECT Title, DATE_FORMAT(ErrandDate, '%Y-%m-%d') AS date1, ErrandID AS id, '' AS link, 'Албан даалгавар' AS type, 'errand' as report FROM mayor_errand
		WHERE ErrandDate='".$cy."-".$cm."-".$cd." 00:00:00'
		UNION
		
		SELECT Title, DATE_FORMAT(PromptDate, '%Y-%m-%d') AS date1, CouncilPromptnessID AS id, '' AS link, 'Нийслэлийн шуурхай' AS type, 'prompt' as report FROM mayor_councilpromptness
		WHERE PromptDate='".$cy."-".$cm."-".$cd." 00:00:00'
		UNION
		
		SELECT Title, DATE_FORMAT(T.NewsDate, '%Y-%m-%d') AS date1, T.NewsID AS id, '/news/dailynews/detail/' AS link, 'Цаг үеийн мэдээ' AS type, '' as report FROM tbl_news T
		left join tbl_newsorgan N
		on T.NewsID = N.NewsID
		WHERE T.NewsDate='".$cy."-".$cm."-".$cd." 00:00:00'
		and T.IsShow='YES'
		and N.OrganID='".MAYORID."'
		UNION
		
		SELECT Title, DATE_FORMAT(PublicationNewsDate, '%Y-%m-%d') AS date1, PublicationNewsID AS id, '/news/publicationnews/detail/' AS link, 'Хэвлэлийн тойм' AS type, '' as report FROM tbl_publicationnews
		WHERE PublicationNewsDate='".$cy."-".$cm."-".$cd." 00:00:00'
		and IsShow='YES'
		and OrganID='".MAYORID."'
		UNION
		
		SELECT Title, DATE_FORMAT(SpeechDate, '%Y-%m-%d') AS date1, SpeechID AS id, '/news/speech/detail/' AS link, 'Илтгэл, хэлсэн үг' AS type, '' as report FROM tbl_speech
		WHERE SpeechDate='".$cy."-".$cm."-".$cd." 00:00:00'
		UNION
		
		SELECT Title, DATE_FORMAT(PhotoNewsDate, '%Y-%m-%d') AS date1, PhotoNewsID AS id, '/news/photonews/detail/' AS link, 'Фото мэдээ' AS type, '' as report FROM tbl_photonews
		WHERE PhotoNewsDate='".$cy."-".$cm."-".$cd." 00:00:00'
		and IsShow='YES'
		and OrganID='".MAYORID."'
		UNION
		
		SELECT Title, DATE_FORMAT(VideoNewsDate, '%d') AS date1, VideoNewsID AS id, '/news/videonews/detail/' AS link, 'Дүрстэй мэдээ' AS type, '' as report FROM tbl_videonews
		WHERE VideoNewsDate='".$cy."-".$cm."-".$cd." 00:00:00'
		and IsShow='YES'
		and OrganID='".MAYORID."'
		";
		$row=$con->select($qry);
		$rowcount=count($row);
	?>
	<div style="margin-top: 10px; margin-bottom: 15px;">
		<div style="font-size: 12px; color: #42413c; float: left"><?=$cy." оны ".$cm." сарын ".$cd." өдрийн мэдээ"?></div>
		<div style="float: right; font-size: 12px; color: #42413c; margin-right: 10px;">Нийт: <?=$rowcount?></div>
		<div class="clear"></div>
	</div>
	<?php
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link=$rf.$row[$i]['link'].$row[$i]['id']."/";
	?>
		<div class="dcontent"  style="border-color: #eeeeee">
			<?php
			if(empty($row[$i]['report'])){
			?>
			<a href="<?=$link?>" class="nonestyle" style="color: #244d79; font-size: 14px;">
				<?=GetStrBr($row[$i]['Title'], 180)?>
			</a>
			<?php }elseif ($row[$i]['report']=='lawrule'){?>
				<a href="javascript:none();" class="nonestyle" style="color: #244d79; font-size: 14px;" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=governororder.php&qs1=lawruleid=<?=$row[$i]['id'];?>',600, 600); return false;"><?=GetStrBr($row[$i]['Title'], 180)?></a>
			<?php }elseif ($row[$i]['report']=='errand'){?>
				<a href="javascript:none();" class="nonestyle" style="color: #244d79; font-size: 14px;" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilerrand.php&qs1=errandid=<?=$row[$i]['id'];?>&qs2=descr=Descr',600, 600); return false;"><?=GetStrBr($row[$i]['Title'], 180)?></a>
			<?php }elseif ($row[$i]['report']=='prompt'){?>
				<a href="javascript:none();" class="nonestyle" style="color: #244d79; font-size: 14px;" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilprompt.php&qs1=promptid=<?=$row[$i]['id'];?>&qs2=descr=Descr',600, 600); return false;"><?=GetStrBr($row[$i]['Title'], 180)?></a>
			<?php }?>
			<div>
				<div class="dcontentbottom" style="float: left; margin-top: 0px; font-size: 11px;">
					<?=$row[$i]['type']?>
				</div>
			</div>
		<div class="clear"></div>
		</div>
	<?php }
	//	require_once 'pagenumberpost.php';
	}else{?>
		<div class="notice"><?=$strnotfound?></div>
	<?php }?>
	</div>
		</td>
	</tr>
	</table>
</form>
</div>