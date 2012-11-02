<?php
	if($_POST['speechdate']) $speechdate=$_POST['speechdate'];
	if($_POST['speechdescr']) $speechdescr=$_POST['speechdescr'];

	$pagelink=$rf."/speech/";
	if(!empty($organclassid)) $pagelink=$rf."/speech/$organclassid/";
	if(!empty($organid))$pagelink=$rf."/speech/$organclassid/$organid/";
	
	$pageFormName="frmSpeechList";
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
	if (!empty($speechclassid)){
		$qrywhr.=" and SpeechClassID='$speechclassid'";
	}
	if (!empty($organclassid)){
		$qrywhr.=" and O.OrganClassID='$organclassid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	if (!empty($speechdate)){
		$qrywhr.=" and SpeechDate='$speechdate'";
	}
	$speechdescr=mb_strtolower(trim($speechdescr),'utf-8');
	if(!empty($speechdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$speechdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$speechdescr%')";
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
			$("#speechclassid").val('');
			$("#speechdate").val('');
			$("#speechdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#speechdate').datepick({
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
	<div class="listbg">
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
		<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
			<span>Огноо: </span>
			<input type="text" name="speechdate" id="speechdate" size="10" value="<?=$speechdate;?>"/>
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="speechdescr" id="speechdescr" value="<?=$speechdescr;?>" size="20"/>
			<input type="submit" class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button" class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд"/>
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_speech T";
		$qry.=" left join ref_organ O";
		$qry.=" on T.OrganID = O.OrganID";
		$qry.=$qrywhr;
		$qry.=" order by SpeechDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, O.OrganName,O.OrganClassID";
	$qry.=" from tbl_speech T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=$qrywhr;
	$qry.=" order by T.SpeechDate desc, CreateDate desc";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
		if($j1%2!=0) $marginl="margin-left: 10px";
		else $marginl="";
?>
		<div style="float: left; width: 100%; <?=$marginl;?>" >
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[$j1]['SpeechDate'];?></p>
				<h2><a title="" href="<?=$rf;?>/speech/detail/<?=$row1[$j1]['SpeechID'];?>"><?=GetStrBr($row1[$j1]['Title'], "80");?></a></h2>
<?php
		$imagesource=$drf."/files/speech/small/".$row1[$j1]['ImageSource'];
		if (!empty($row1[$j1]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/speech/small/".$row1[$j1]['ImageSource'];
?>
				<a href="<?=$rf;?>/speech/detail/<?=$row1[$j1]['SpeechID'];?>">
					<img src="<?=$imagesource?>" width="150" style="float: left; margin: 5px 10px 0 0"/>
				</a>
<?php
		} 
?>
				
				<div><?=GetStrBr($row1[$j1]['Descr'], "350");?></div>
				<div style="text-align: right;"><a href="<?=$rf;?>/speech/detail/<?=$row1[$j1]['SpeechID'];?>" class="linkext"><?=$strMore;?></a></div>
				<div class="clear"></div>
			</li>
		</div>
<?php
	if($j1%2==1){
?>
		<div class="clear"></div>
<?php 
	}
	$j1++;
	} 
?>
		<?php require_once 'formpagego.php';?>
<?php 
	} else {
?>
			<div style="text-align: center;" ><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</ul>
		</form>
	</div>