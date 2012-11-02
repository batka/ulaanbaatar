<?php
	if($_POST['reportdate']) $reportdate=$_POST['reportdate'];
	if($_POST['reportdescr']) $reportdescr=$_POST['reportdescr']; 
	
	$pagelink=$rf."/report/";
	$pageFormName="frmReportList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=30;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=3;
	$showcountselect=$showcount;  
	
	$qrywhr=" left join ref_organ O on T.OrganID=O.OrganID";
	$qrywhr.=" where T.IsShow='YES'";
	if (!empty($organclassid)){
		$qrywhr.=" and O.OrganClassID='$organclassid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	if (!empty($reportdate)){
		$qrywhr.=" and ReportDate='$reportdate'";
	}
	$reportdescr=mb_strtolower(trim($reportdescr),'utf-8');
	if(!empty($reportdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$reportdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$reportdescr%')";
	} 
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#<?=$pageFormName;?>").attr("action", "<?=$PHP_SELF;?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$('#activepage option:first').attr('selected', 'selected');
			$("#organclassid").val('');
			$("#organid").val('');
			$("#reportdate").val('');
			$("#reportdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#reportdate').datepick({
			yearRange: '2309:<?=date('Y');?>',
			dateFormat: 'yy-mm-dd',
			minDate: '-12M',
			maxDate: '+12M',
			showStatus: true,
			showOn: 'both',
			buttonImageOnly: true,
			buttonImage: '<?=$rf;?>/js/jquery/jquery.datepick/calendar-blue.gif'
		});
	});
	
</script>
	<div class="listbg" >
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
			<input type="hidden" name="reportid" id="reportid" value=""/>
			<div style="padding: 5px;" align="right">
				<span>Огноо: </span>
				<input type="text" name="reportdate" id="reportdate" size="10" value="<?=$reportdate;?>"/>
				<span>&nbsp;&nbsp;Хайлт: </span>
				<input type="text" name="reportdescr" id="reportdescr" value="<?=$reportdescr;?>" size="20"/>
				<input type="submit"  class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх" style="padding: 1px;"/>
				<input type="button"  class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд" style="padding: 1px;"/>
			</div>
			
			<div class="spacer10"></div>
			
			<div id="content" style="margin-bottom:10px">
<?php
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_report T";
		$qry.=$qrywhr;
		$qry.=" order by ReportDate desc, T.CreateDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if(empty($_GET['activepage'])) $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, OrganName";
	$qry.=" from tbl_report T";
	$qry.=$qrywhr;
	$qry.=" order by T.ReportDate desc, T.CreateDate desc";
	
	$rowid=$startrow;
	$qry.=" limit ".$rowid.", ".$showcount;
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
				<table class="textualData links" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 5px;">
				<tr>
					<th width="1%">№</th>
					<th width="10%">Огноо</th>
			        <th>Гарчиг</th>
			        <th width="12%">Хавсралт файл</th>
				</tr>
<?php
	$j1=0;
	$nid=$rowid;
	while ($j1<$rowcount1){
?>
				<tr>
					<td class="odd"><?=++$nid;?>.</td>
			  		<td class="odd" align="center"><?=$row1[$j1]['ReportDate']?></td>
			  		<td class="odd" align="left"><a href="<?=$rf;?>/report/detail/<?=$row1[$j1]['ReportID']?>"><?=$row1[$j1]['Title']?></a></td>
					<td class="odd" align="center" style="text-align: center;">
<?php
		$filesource=$drf."/files/report/".$row1[$j1]['FileSource'];
		if (!empty($row1[$j1]['FileSource']) && file_exists($filesource)){
			$filesource=$rf."/files/report/".$row1[$j1]['FileSource'];
?>
			<a href="javascript:" onclick="downloadFile('<?=$row1[$j1]['ReportID'];?>');">[татах]</a>
<?php
	} 
?>
					</td>
				</tr>
<?php
	$j1++;
	} 
?>
				</table>
			</div>
			<?php require_once 'formpagego.php';?>
<?php 
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clearfloats"></div>
		</form>
	</div>

<script type="text/javascript">
	function downloadFile(param){
		$("#reportid").val(param);
		$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/processform.php?action=reportdownloadfile");
		$("#<?=$pageFormName;?>").submit();
	}
</script>