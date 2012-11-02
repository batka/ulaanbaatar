<?php
	if($_POST['trainningdate']) $trainningdate=$_POST['trainningdate'];
	if($_POST['trainningdescr']) $trainningdescr=$_POST['trainningdescr']; 
	
	$pagelink=$rf."/trainning/";
	if(!empty($organclassid)) $pagelink=$rf."/trainning/$organclassid/";
	if(!empty($organid)) $pagelink.=$rf."/trainning/$organclassid/$organid/";
	$pageFormName="frmTrainningList";
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
	if (!empty($trainningdate)){
		$qrywhr.=" and '$trainningdate' between StartDate and EndDate";
	}
	$trainningdescr=mb_strtolower(trim($trainningdescr),'utf-8');
	if(!empty($trainningdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$trainningdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$trainningdescr%')";
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
			$("#trainningdate").val('');
			$("#trainningdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#trainningdate').datepick({
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
		$("#trainningid").val(param);
		$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/process/action/trainningdownloadfile");
		$('#<?=$pageFormName;?>').submit();
	}
</script>
	<div class="listbg">
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
			<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
				<span>Огноо: </span>
				<input type="text" name="trainningdate" id="trainningdate" size="10" value="<?=$trainningdate;?>"/>
				<span>&nbsp;&nbsp;Хайлт: </span>
				<input type="text" name="trainningdescr" id="trainningdescr" value="<?=$trainningdescr;?>" size="20"/>
				<input type="submit" class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх" style="padding: 1px;"/>
				<input type="button" class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд" style="padding: 1px;"/>
			</div>
			
			<div class="spacer10"></div>
			
			<ul class="presslist">
			
<?php
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_trainning T";
		$qry.=$qrywhr;
		$qry.=" order by EndDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if(empty($_GET['activepage'])) $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, OrganName";
	$qry.=" from tbl_trainning T";
	$qry.=$qrywhr;
	$qry.=" order by T.StartDate desc, EndDate desc";
	
	$rowid=$startrow;
	$qry.=" limit ".$rowid.", ".$showcount;
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 

	$j1=0;
	$nid=$rowid;
	while ($j1<$rowcount1){
		if($j1%2==0) $bgcolor="row1";
		else $bgcolor="row2";
?>
			<a name="<?=$row1[$j1]['TrainningID'];?>"></a>
			<li class="topbrdr3" style="border-color: #f6e8d5">
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
?>
				<p class="pmdate">Хугацаа: <?=$row1[$j1]['StartDate'];?> - <?=$row1[$j1]['EndDate'];?></p>
				<h3 style="margin: 5px 0; font-size: 12px; font-weight: normal;"><a href="<?=$rf;?>/trainning/detail/<?=$row1[$j1]['TrainningID'];?>"><?=$row1[$j1]['Title'];?></a></h3>
				<?php if($row1[$j1]['TrainningWhere']){?>
				<strong style="color: #999">Хаана:</strong> <?=$row1[$j1]['TrainningWhere'];?> |
				<?php }?>
				<?php if($row1[$j1]['TrainningWho']){?>
				<strong style="color: #999">Зааварлагч:</strong> <?=$row1[$j1]['TrainningWho'];?> |
				<?php }?>
				<?php if($row1[$j1]['PeopleCount']){?>
				<strong style="color: #999">Хүний тоо:</strong> <?=$row1[$j1]['PeopleCount'];?> |
				<?php }?>
				<?php if($row1[$j1]['Finance']){?>
				<strong style="color: #999">Санхүүжүүлэгч:</strong> <?=$row1[$j1]['Finance'];?>
				<?php }?>
				<div class="clear"></div>
			</li>
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
			</ul>
		</form>
	</div>