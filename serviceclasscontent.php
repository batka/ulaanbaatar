<?php
	if($_POST['organclassid']) $organclassid=$_POST['organclassid'];
	if($_POST['organid']) $organid=$_POST['organid'];
	if($_POST['servicedescr']) $servicedescr=$_POST['servicedescr']; 

	$pagelink=$rf."/service/class/$serviceclassid";
	$pageFormName="frmServiceList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=9;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=3;
	$showcountselect=$showcount;  
	
	$qrywhr=" where T.IsShow='YES'"; 
	//$qrywhr.=" and ServiceClassID='$serviceclassid'";
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	$servicedescr=mb_strtolower(trim($servicedescr),'utf-8');
	if(!empty($servicedescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$servicedescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$servicedescr%')";
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
			$("#servicedate").val('');
			$("#servicedescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#servicedate').datepick({
			yearRange: '2309:<?=date('Y');?>',
			dateFormat: 'yy-mm-dd',
			minDate: '-12M',
			maxDate: '+12M',
			showStatus: true,
			showOn: 'both',
			buttonImageOnly: true,
			buttonImage: '<?=$rf;?>/js/jquery/jquery.datepick/calendar-blue.gif'
		});
		$("select#organclassid").change(function(){
			changeSelectBox('<?=$rf;?>/selectboxchange.php', '#organclassid', '#organid', 'strSelectAll', '<?=$organid;?>');
		});
		$("select#organclassid").change();
	});
</script>
<div id="column_1">
	<div class="pcgcHOME">
		<div id="pcgcsfsubmitarea">
			<h1 style="padding: 0; margin: 0"><?=$con->GetDescr("select ServiceClassName from ref_serviceclass where ServiceClassID='$serviceclassid'");?></h1>
		</div>
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
			<div style="padding: 5px;">
				<span>Эх сурвалж: </span>
<?php
	$qry="select OrganClassID, OrganClassName";
	$qry.=" from ref_organclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder"; 
?>
				<select name="organclassid" id="organclassid" style="width: 150px"><?=$con->COMBOFILL($qry, $organclassid, 0, 1, 1)?></select>
				<select nam  e="organid" id="organid" style="width: 150px"></select>
				<span>&nbsp;&nbsp;Хайлт: </span>
				<input type="text" name="servicedescr" id="servicedescr" value="<?=$servicedescr;?>" size="20"/>
				<input type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
				<input type="button" name="btnall" id="btnall" value="Бүгд"/>
			</div>
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_service T";
		$qry.=$qrywhr;
		$qry.=" order by CreateDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, OrganName";
	$qry.=" from tbl_service T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=$qrywhr;
	$qry.=" order by CreateDate desc";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
?>
			<div class="brderleft">
				<h2 style="font-size: 11px"><?=$row1[$j1]['OrganName'];?></h2>
				<div class="content" style="font-size: 12px">
					<div style="margin-bottom: 5px; font-weight: bold;"><a href="<?=$rf;?>/service/detail/<?=$row1[$j1]['ServiceID'];?>"><?=$row1[$j1]['Title'];?></a></div>
					<div class="descr"><?=GetStrBr($row1[$j1]['Descr'], "200");?></div>
					<div class="more"><a href="<?=$rf;?>/service/detail/<?=$row1[$j1]['ServiceID'];?>" title="" class="ThemenLink">илүү</a></div>
		  		</div>
		 	</div>
<?php
	$j1++;
	} 
?>
		<?php require_once 'formpagego.php';?>
<?php 
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</form>
	</div>
</div>