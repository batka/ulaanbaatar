<style type="text/css">
	table.calendar{
		font-size: 11px;
	}
	table.calendar tr{
		height: 21px;
	}
	table.calendar th{
		width: 25px;
		font-weight: normal;
	}
	table.calendar td{
		width: 25px;
		text-align: center;
		cursor: default;
		color: #484848;
	}
	.calendar-prev a, .calendar-next a{
		color: #000;
		text-decoration: none;
	}
	
	.calendar-prev a:HOVER, .calendar-next a:HOVER{
		color: #a90102;
	}
	#day1, #day7{
		color: #c92223;
	}
	
	.td_day{
		background-color: #eeeeee;
	}
	
	.td_day:HOVER{
		background-color: #e2e2e2;
	}
	
	.linkedday{
		font-weight: bold;
		color: #000000;
		text-decoration: none;
	}
</style>
<?php
	$ymd = GetYMDay($con);
    $time = mktime(0,0,0,$ymd['m'],$ymd['d'],$ymd['y']);
    $cy = date('Y', $time);
    $cm = date('n', $time);
    
    $by = $cy;
    $bm = $cm - 1;    
    if ($bm < 1) {$bm = 12; $by--;}
    
    $ay = $cy;
    $am = $cm + 1;    
    if ($am > 12) {$am = 1; $ay++;}
    
    $pn = array("&laquo;"=>"$rf/calendar/$by-$bm-1", "&raquo;"=>"$rf/calendar/$ay-$am-1");
    $today = date('j',$time);
	$days = array($today=>array(NULL,NULL,'<span style="display: block; height: 20px; line-height: 20px; border : 2px solid #f8d169;">'.$today.'</span>'));
	
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