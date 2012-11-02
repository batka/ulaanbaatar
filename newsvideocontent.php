<style type="text/css">
.imgover{
	
}
.imgout{
	opacity: 0.7;
	filter:alpha(opacity=70);	
}
</style>
<?php
	if($_POST['videonewsdate']) $videonewsdate=$_POST['videonewsdate'];
	if($_POST['videonewsdescr']) $videonewsdescr=$_POST['videonewsdescr']; 
	
	$pagelink=$rf."/news/video/";
	if(!empty($organclassid)) $pagelink=$rf."/news/video/$organclassid/";
	if(!empty($organid)) $pagelink=$rf."/news/video/$organclassid/$organid/";
	
	$pageFormName="frmNewsVideoList";
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
	if (!empty($videonewsdate)){
		$qrywhr.=" and VideoNewsDate='$videonewsdate'";
	}
	$videonewsdescr=mb_strtolower(trim($videonewsdescr),'utf-8');
	if(!empty($videonewsdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$videonewsdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$videonewsdescr%')";
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
			$("#videonewsdate").val('');
			$("#videonewsdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#videonewsdate').datepick({
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
			
			<span>&nbsp;&nbsp;Огноо: </span>
			<input type="text" name="videonewsdate" id="videonewsdate" size="10" value="<?=$videonewsdate;?>"/>
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="videonewsdescr" id="videonewsdescr" value="<?=$videonewsdescr;?>" size="20"/>
			<input type="submit" class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button" class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд"/>
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_videonews T";
		$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
		$qry.=$qrywhr;
		$qry.=" order by VideoNewsDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, O.OrganName,O.OrganClassID";
	$qry.=" from tbl_videonews T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=$qrywhr;
	$qry.=" order by T.VideoNewsDate desc, CreateDate desc";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
	if($j1%3!=0) $marginl="margin-left: 10px";
		else $marginl="";
?>
			<div style="float: left; width: 49%; min-height:250px; <?=$marginl;?>">
				<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[$j1]['VideoNewsDate'];?></p>
<?php
		$imagesource=$drf."/files/videos/small/".$row1[$j1]['ImageSource'];
		if (!empty($row1[$j1]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/videos/small/".$row1[$j1]['ImageSource'];
			$stringlong="280"; 
?>
				<a href="<?=$rf;?>/news/video/detail/<?=$row1[$j1]['VideoNewsID'];?>" class="imgout" onmouseover="this.className='imgover'" onmouseout="this.className='imgout'">
					<img src="<?=$imagesource?>" width="345" style="margin: 5px 0px; height:auto !important;"/>
				</a>
<?php
		} 
?>
				<h2 style="font-size: 130%; font-weight: bold;"><a title="" href="<?=$rf;?>/news/video/detail/<?=$row1[$j1]['VideoNewsID'];?>"><?=GetStrBr($row1[$j1]['Title'], "80");?></a></h2>
				<div><?=GetStrBr($row1[$j1]['Intro'], "350");?></div>
				<div class="clear"></div>
				</li>
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
		</ul>
		</form>
	</div>