<?php
	if($_POST['prodate']) $prodate=$_POST['prodate'];
	if($_POST['prodescr']) $prodescr=$_POST['prodescr']; 

	
	if(!empty($organid)) $pagelink=$rf."/prompt/101/10102/";
	
	$pageFormName="frmPromptList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=20;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=3;
	$showcountselect=$showcount;  
	
	//$qrywhr=" left join ref_organ O on T.OrganID=O.OrganID";
	$qrywhr.=" where T.IsShow='YES'";
//	if (!empty($organclassid)){
//		$qrywhr.=" and O.OrganClassID='$organclassid'";
//	}
//	if (!empty($organid)){
//		$qrywhr.=" and T.OrganID='$organid'";
//	}
//	if (!empty($prodate)){
//		$qrywhr.=" and '$prodate' between ProDate and ";
//	}
	$prodescr=mb_strtolower(trim($prodescr),'utf-8');
	if(!empty($prodescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$prodescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$prodescr%')";
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
			$("#prodate").val('');
			$("#prodescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#prodate').datepick({
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
	<div class="listbg">
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
		<input type="hidden" name="proid" id="proid" value=""/>
		<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
			<!-- <span>Огноо: </span>
			<input name="prodate" id="prodate" size="10" value="<?=$prodate;?>"/>
			 -->
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="prodescr" id="prodescr" value="<?=$prodescr;?>" size="50"/>
			<input type="submit"  class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх" style="padding: 1px;"/>
			<input type="button"  class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд" style="padding: 1px;"/>
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from mayor_councilpromptness T";
		$qry.=$qrywhr;
		$qry.=" order by T.CreateDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*";
	$qry.=" from mayor_councilpromptness T";
	$qry.=$qrywhr;
	$qry.=" order by T.CreateDate desc";
	
	$rowid=$startrow;
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){
?>
		<li class="topbrdr1">
			<table cellpadding="5" cellspacing="1" width="100%" class="legal">
			<tr align="center">
				<th>№</th>
				<th width="15%">Огноо</th>
				<th>Нийслэлийн шуурхай</th>
				<th width="10%">Биелэлт</th>
			</tr>
<?php 
	$j1=0;
	$nid=$rowid;
	while ($j1<$rowcount1){
		if($j1%2==0) $bgclass="row1";
		else $bgclass="row2";
?>
		<tr class="<?=$bgclass;?>">
			<td width="1%" valign="top"><?=++$nid;?>.</td>
			<td align="center"><?=$row1[$j1]['PromptDate'];?></td>
			<td valign="top" align="left"><a href="<?=$rf;?>/prompt/detail/<?=$row1[$j1]['CouncilPromptnessID'];?>" title="<?=$row1[$j1]['Title'];?>"><?=$row1[$j1]['Title'];?></a></td>
			<td align="center">
				<?php if(!empty($row1[$j1]['Descr1'])){?>
				<img src="<?=$rf;?>/images/web/morefile.png" style="float: left;">
				<a href="<?=$rf;?>/prompt/detail/<?=$row1[$j1]['CouncilPromptnessID'];?>#execution" title="<?=$row1[$j1]['Title'];?>">биелэлт</a>
				<?php }?>
			</td>
		</tr>
<?php
	$j1++;
	} 
?>
			</table>
		</li>
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
	</div>
<script type="text/javascript">
function downloadFile(param){
	$("#proid").val(param);
	$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/processform.php?action=prodownloadfile");
	$("#<?=$pageFormName;?>").submit();
}
</script>