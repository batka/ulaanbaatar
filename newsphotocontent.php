<?php
	if($_POST['photonewsdate']) $photonewsdate=$_POST['photonewsdate'];
	if($_POST['photonewsdescr']) $photonewsdescr=$_POST['photonewsdescr']; 

	$pagelink=$rf."/news/photo/";
	if(!empty($organclassid)) $pagelink=$rf."/news/photo/$organclassid/";
	if(!empty($organid)) $pagelink=$rf."/news/photo/$organclassid/$organid/";
	
	$pageFormName="frmNewsPhotoList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=10;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showcount=10;
	$_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=5;
	$showcountselect=$showcount;
	
	$qrywhr=" where T.IsShow='YES'"; 
	if (!empty($organclassid)){
		$qrywhr.=" and O.OrganClassID='$organclassid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and T.OrganID='$organid'";
	}
	if (!empty($photonewsdate)){
		$qrywhr.=" and PhotoNewsDate='$photonewsdate'";
	}
	$photonewsdescr=mb_strtolower(trim($photonewsdescr),'utf-8');
	if(!empty($photonewsdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$photonewsdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$photonewsdescr%')";
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
			$("#photonewsdate").val('');
			$("#photonewsdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#photonewsdate').datepick({
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
		<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
			<span>Огноо: </span>
			<input type="text" name="photonewsdate" id="photonewsdate" size="10" value="<?=$photonewsdate;?>"/>
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="photonewsdescr" id="photonewsdescr" value="<?=$photonewsdescr;?>" size="20"/>
			<input type="submit"  class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button"  class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд"/>
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_photonews T";
		$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
		$qry.=$qrywhr;
		$qry.=" order by PhotoNewsDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, O.OrganName,O.OrganClassID";
	$qry.=" from tbl_photonews T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=$qrywhr;
	$qry.=" order by T.PhotoNewsDate desc, CreateDate desc";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
		if($j1%2==1) $marginl="margin-left: 10px";
		else $marginl="";
?>
			<div style="float: left; width: 49%; height:380px; <?=$marginl;?>">
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[$j1]['PhotoNewsDate'];?></p>
<?php
		$imagesource=$drf."/files/photonews/small/".$row1[$j1]['ImageSource'];
		if (!empty($row1[$j1]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/photonews/small/".$row1[$j1]['ImageSource'];
			$stringlong="280"; 
?>
				<a href="<?=$rf;?>/news/photo/detail/<?=$row1[$j1]['PhotoNewsID'];?>">
					<img src="<?=$imagesource;?>" width="345" style="margin: 5px 0px"/>
				</a>
<?php
		} 
?>
				<h2 style="font-size: 130%; font-weight: bold;"><a title="<?=$row1[$j1]['Title'];?>" href="<?=$rf;?>/news/photo/detail/<?=$row1[$j1]['PhotoNewsID'];?>"><?=GetStrBr($row1[$j1]['Title'], "80");?></a></h2>
				<div class="clear"></div>
			</li>
			</div>
<?php
		if($j1%2==1) {
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
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</ul>
		</form>
	</div>