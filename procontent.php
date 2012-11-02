<?php
	if($_POST['prodate']) $prodate=$_POST['prodate'];
	if($_POST['prodescr']) $prodescr=$_POST['prodescr']; 

	
	$pagelink=$rf."/pro/";
	if(!empty($organclassid)) $pagelink=$rf."/pro/$organclassid/";
	if(!empty($organid)) $pagelink=$rf."/pro/$organclassid/$organid/";
	
	$pageFormName="frmProList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=20;
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
	if (!empty($prodate)){
		$qrywhr.=" and '$prodate' between ProDate and ";
	}
	$prodescr=mb_strtolower(trim($prodescr),'utf-8');
	if(!empty($prodescr)){
		$qrywhr.=" and (LOWER(CONVERT(ProName USING utf8)) like '%$prodescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.ProDescr USING utf8)) like '%$prodescr%')";
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
		$qry.=" from tbl_pro T";
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
	
	$qry="select T.*, OrganName";
	$qry.=" from tbl_pro T";
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
				<th>Төсөл, хөтөлбөрийн нэр</th>
				<th width="15%">Хэрэгжих хугацаа</th>
				<th width="5%">Хавсралт файл</th>
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
			<td valign="top"><a href="<?=$rf;?>/pro/detail/<?=$row1[$j1]['ProID'];?>" title="<?=$row1[$j1]['ProName'];?>"><?=GetStrBr($row1[$j1]['ProName'], 80);?></a></td>
			<td align="center"><?=$row1[$j1]['ContinueTime'];?></td>
			<td align="center">
<?php
		$filesource=$drf."/files/pro/".$row1[$j1]['FileSource'];
		if (!empty($row1[$j1]['FileSource']) && file_exists($filesource)){
			$filesource=$rf."/files/pro/".$row1[$j1]['FileSource'];
?>
			<a href="javascript:" onclick="downloadFile('<?=$row1[$j1]['ProID'];?>');">[татах]</a>
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