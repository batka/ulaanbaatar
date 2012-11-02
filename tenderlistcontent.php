<?php
	if($_POST['tenderdate']) $tenderdate=$_POST['tenderdate'];
	if($_POST['tenderdescr']) $tenderdescr=$_POST['tenderdescr']; 
	
	$pagelink=$rf."/tender/";
	if(!empty($organclassid)) $pagelink=$rf."/tender/$organclassid/";
	if(!empty($organid)) $pagelink=$rf."/tender/$organclassid/$organid/";
	
	$pageFormName="frmTenderList";
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
	if (!empty($tenderdate)){
		$qrywhr.=" and '$tenderdate' between StartDate and EndDate";
	}
	$tenderdescr=mb_strtolower(trim($tenderdescr),'utf-8');
	if(!empty($tenderdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$tenderdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$tenderdescr%')";
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
			$("#tenderdate").val('');
			$("#tenderdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#tenderdate').datepick({
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
	
	function donwloadLink(param){
		$("#tenderid").val(param);
		$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/process/action/tenderdownloadfile");
		$('#<?=$pageFormName;?>').submit();
	}
</script>
	<div class="listbg">
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
			<input type="hidden" name="tenderid" id="tenderid" value=""/>
			<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
				<span>Огноо: </span>
				<input type="text" name="tenderdate" id="tenderdate" size="10" value="<?=$tenderdate;?>"/>
				<span>&nbsp;&nbsp;Хайлт: </span>
				<input type="text" name="tenderdescr" id="tenderdescr" value="<?=$tenderdescr;?>" size="20"/>
				<input type="submit" class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх" style="padding: 1px;"/>
				<input type="button" class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд" style="padding: 1px;"/>
			</div>
			
			<div class="spacer10"></div>
			
			<ul class="presslist">
				<li class="topbrdr3">
			
<?php
	$qry="select CEILING(SUM(PageCount)/$showcount), SUM(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_tender T";
		$qry.=$qrywhr;
		$qry.=" order by EndDate desc) TT";
	//echo $qry;
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if(empty($_GET['activepage'])) $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, OrganName";
	$qry.=" from tbl_tender T";
	$qry.=$qrywhr;
	$qry.=" order by T.StartDate desc, T.CreateDate desc, EndDate desc";
	
	$rowid=$startrow;
	$qry.=" limit ".$rowid.", ".$showcount;
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
			<table cellpadding="3" cellspacing="1" width="100%" class="legal">
			<tr>
				<th width="1%">№</th>
				<th>Тендерийн нэр</th>
				<th width="13%">Нийтэлсэн<br>огноо</th>
				<th width="13%">Эцсийн<br>хугацаа</th>
				<th width="10%">Үр дүн</th>
			</tr>
<?php	
	$j1=0;
	$nid=$rowid;
	while ($j1<$rowcount1){
		if($j1%2==0) $bgcolor="row1";
		else $bgcolor="row2";
?>
			<tr class="<?=$bgcolor;?>">
				<td align="center" valign="top"><?=++$nid;?>.</td>
				<td align="left"><a href="<?=$rf;?>/tender/detail/<?=$row1[$j1]['TenderID'];?>"><?=$row1[$j1]['Title'];?></a></td>
				<td align="center"><?=$row1[$j1]['StartDate'];?></td>
				<td align="center"><?=$row1[$j1]['EndDate'];?></td>
				<td align="center">
<?php
		if($row1[$j1]['Result']){ 
?>
					<a href="<?=$rf;?>/tender/detail/<?=$row1[$j1]['TenderID'];?>#result">Үр дүн</a>
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
		<?php require_once 'formpagego.php';?>
<?php 
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			
			<div class="clear"></div>
			</li>
			</ul>
		</form>
	</div>