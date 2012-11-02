<?php
	if($_POST['serviceclassid']) $serviceclassid=$_REQUEST['serviceclassid'];
	if($_POST['servicedate']) $servicedate=$_POST['servicedate'];
	if($_POST['servicedescr']) $servicedescr=$_POST['servicedescr']; 

	
	if(!empty($serviceclassid))$pagelink=$rf."/service/$serviceclassid/";
	else $pagelink=$rf."/service/";
	
	$pageFormName="frmServiceList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=9;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showcount=20;
	$_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=5;
	$showcountselect=$showcount;  
	
	$qrywhr=" where T.IsShow='YES'";
	if (!empty($serviceclassid)){
	$qrywhr.=" and ServiceClassID='$serviceclassid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	if (!empty($servicedate)){
		$qrywhr.=" and ServiceDate='$servicedate'";
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
			$("#serviceclassid").val('');
			$("#servicedescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$("select#organclassid").change(function(){
			changeSelectBox('<?=$rf;?>/selectboxchange.php', '#organclassid', '#organid', 'strSelectAll', '<?=$organid;?>');
		});
		$("select#organclassid").change();
	});
</script>
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
		<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
			<span>Эх сурвалж: </span>
<?php
	$qry="select OrganClassID, OrganClassName";
	$qry.=" from ref_organclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder"; 
?>
			<select name="organclassid" id="organclassid" style="width: 130px"><?=$con->COMBOFILL($qry, $organclassid, 0, 1, 1)?></select>
			<span>&nbsp;&nbsp;Хайлт: </span>	
			<input type="text" name="servicedescr" id="servicedescr" value="<?=$servicedescr;?>" size="25"/>
			<input class="btn" style="padding: 4px 14px;"  type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input class="btn" style="padding: 4px 14px;"  type="button" name="btnall" id="btnall" value="Бүгд"/>
			
		</div>
		
		<div class="clear"></div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_service T";
		$qry.=$qrywhr;
		$qry.=" order by LOWER(CONVERT(Title USING utf8)))TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, OrganName, DATE_FORMAT(T.CreateDate, '%Y-%m-%d') as ServiceDate";
	$qry.=" from tbl_service T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=$qrywhr;
	$qry.=" order by LOWER(CONVERT(T.Title USING utf8))";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
?>
			<div class="brderleft">
				<a href="<?=$rf;?>/service/detail/<?=$row1[$j1]['ServiceID'];?>"><h2 style="font-size: 11px"><?=$row1[$j1]['Title'];?></h2></a>
		  		<div class="clear"></div>
			</div>
<?php
	$j1++;
	} 
?>
		<div style="border-top: 1px solid #eee;"></div>
		<?php require_once 'formpagego.php';?>
<?php 
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</ul>
		</form>
