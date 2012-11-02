<?php
	if($_POST['lawruledate']) $lawruledate=$_POST['lawruledate'];
	if($_POST['lawruledescr']) $lawruledescr=$_POST['lawruledescr'];
	if($_POST['orderby']) $orderby=$_POST['orderby'];
	else $orderby="T.LawRuleDate desc";
	if($_POST['letter']) $letter=$_POST['letter'];
	
	$pagelink=$rf."/lawrule/";
	if(!empty($organclassid)) $pagelink=$rf."/lawrule/$organclassid/";
	if(!empty($organid)) $pagelink=$rf."/lawrule/$organclassid/$organid/";
	
	$pageFormName="frmLawRuleList";
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
	$qrywhr.=" and T.IsPublic='YES'";
	if (!empty($organclassid)){
		$qrywhr.=" and O.OrganClassID='$organclassid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	if (!empty($lawruledate)){
		$qrywhr.=" and LawRuleDate='$lawruledate'";
	}
	if(!empty($letter)){
		$qrywhr.=" and SUBSTR(REPLACE(UPPER(CONVERT(Title USING utf8)),' ',''),1,1)=UPPER('$letter')";
	}
	$lawruledescr=mb_strtolower(trim($lawruledescr),'utf-8');
	if(!empty($lawruledescr)){
		$qrywhr.=" and (LOWER(CONVERT(LawRuleNo USING utf8)) like '%$lawruledescr%'";
		$qrywhr.=" or LOWER(CONVERT(Title USING utf8)) like '%$lawruledescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$lawruledescr%')";
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
			$("#lawruledate").val('');
			$("#lawruledescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#lawruledate').datepick({
			yearRange: '2000:<?=date('Y');?>',
			dateFormat: 'yy-mm-dd',
			minDate: 	new Date(2000, 1 - 1, 1),
			maxDate: '+12M',
			showStatus: true,
			showOn: 'both',
			buttonImageOnly: true,
			buttonImage: '<?=$rf;?>/js/jquery/jquery.datepick/calendar-blue.gif'
		});
	});
	
	function donwloadLink(param){
		$("#lawruleid").val(param);
		$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/process/action/lawruledownloadfile");
		$('#<?=$pageFormName;?>').submit();
	}
</script>
	<div class="listbg">
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
			<input type="hidden" name="lawruleid" id="lawruleid" value=""/>
			<input type="hidden" name="letter" id="letter" value=""/>
			<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;">
			
			
			<div style="float: ;">
				
				
<?php
	$qry="select SysID, SysDescr";
	$qry.=" from asu_progcombo";
	$qry.=" where ComboName='LAWRULESORTBY'";
	$qry.=" order by RowID";
?>
					<span>Эрэмбэ: </span>
					<select name="orderby" id="orderby" onchange="btnsrch.click();"><?=$con->COMBOFILL($qry, $orderby, 0, 1, 2);?></select>
				
			
			
				<span> Огноо: </span>
				<input type="text" name="lawruledate" id="lawruledate" size="10" value="<?=$lawruledate;?>"  style="width:155px;"/>
				<span>&nbsp;&nbsp;Хайлт: </span>
				<input type="text" name="lawruledescr" id="lawruledescr" value="<?=$lawruledescr;?>" size="20"  style="width:155px;"/>
				<input type="submit"  class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх"/>
				<input type="button"  class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд"/>
				
				<div class="clear"></div>
				
				<div class="spacer10"></div>
			
				<div style="padding: 3px">
<?php
	$qry="select SysID, SysDescr";
	$qry.=" from asu_progcombo";
	$qry.=" where ComboName='LETTER'";
	$qry.=" order by RowID";
	$rowl=$con->select($qry);
	$rowcountl=count($rowl);
	
	for ($jl=0; $jl<$rowcountl; $jl++){
?>

				
					<span style="padding: 3px; <?php if($letter==$rowl[$jl]['SysID']) echo "font-weight: bold; text-decoration: underline;";?>"><a href="javascript:" onclick="$('#letter').val('<?=$rowl[$jl]['SysID'];?>'); $('#btnsrch').click();"><?=$rowl[$jl]['SysDescr'];?></a></span>
<?php
	} 
?>
				</div>
			</div>
			
			
			<ul class="presslist">
				<li class="topbrdr1">
			
<?php
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_lawrule T";
		$qry.=$qrywhr;
		$qry.=" order by LawRuleDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if(empty($_GET['activepage'])) $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, O.OrganName,O.OrganClassID";
	$qry.=" from tbl_lawrule T";
	$qry.=$qrywhr;
	$qry.=" order by $orderby, CreateDate desc";
	
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
				<th width="8%">Дугаар</th>
				<th width="20%">Батлагдсан огноо</th>
				<th>Захирамжийн нэр</th>
				<!-- <th width="10%">Хавсралт файл</th> -->
			</tr>
<?php	
	$j1=0;
	$nid=$rowid;
	while ($j1<$rowcount1){
		if($j1%2==0) $bgcolor="row1";
		else $bgcolor="row2";
?>
			<tr class="<?=$bgcolor;?>">
				<td align="center"><?=++$nid;?>.</td>
				<td align="center"><?=$row1[$j1]['LawRuleNo'];?></td>
				<td align="center"><?=$row1[$j1]['LawRuleDate'];?></td>
				<td align="left"><a href="<?=$rf;?>/lawrule/detail/<?=$row1[$j1]['LawRuleID'];?>"><?=$row1[$j1]['Title'];?></a></td>
				<!-- 
				<td align="center">
<?php
		if($row1[$j1]['FileSource']){ 
?>
					<a href="javascript:" onclick="donwloadLink('<?=$row1[$j1]['LawRuleID'];?>');">[татах]</a>
<?php
		} 
?>
				</td> -->
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