<?php
	if($_POST['organclassid']) $organclassid=$_POST['organclassid'];
	if($_POST['organid']) $organid=$_POST['organid'];
	if($_POST['newsclassid']) $newsclassid=$_POST['newsclassid'];
	if($_POST['newsdate']) $newsdate=$_POST['newsdate'];
	if($_POST['newsdescr']) $newsdescr=$_POST['newsdescr']; 

	if(empty($newsclassid))$pagelink=$rf."/news/";
	else $pagelink=$rf."/news/$newsclassid/";
	
	$pageFormName="frmNewsList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=9;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=3;
	$showcountselect=$showcount;  
	
	$qrywhr=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qrywhr.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qrywhr.=" where T.IsShow='YES'";
	if (!empty($newsclassid)){
	$qrywhr.=" and NewsClassID='$newsclassid'";
	}
	if (!empty($organclassid)){
		$qrywhr.=" and O.OrganClassID='$organclassid'";
	}
	if (!empty($organid)){
		$qrywhr.=" and NO.OrganID='$organid'";
	}
	if (!empty($newsdate)){
		$qrywhr.=" and NewsDate='$newsdate'";
	}
	$newsdescr=mb_strtolower(trim($newsdescr),'utf-8');
	if(!empty($newsdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$newsdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$newsdescr%')";
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
			$("#newsclassid").val('');
			$("#newsdate").val('');
			$("#newsdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#newsdate').datepick({
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
			<span>Эх сурвалж: </span>
<?php
	$qry="select OrganClassID, OrganClassName";
	$qry.=" from ref_organclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder"; 
?>
			<select name="organclassid" id="organclassid" style="width: 130px"><?=$con->COMBOFILL($qry, $organclassid, 0, 1, 1)?></select>
			<span>&nbsp;&nbsp;Огноо: </span>
			<input type="text" name="newsdate" id="newsdate" size="10" value="<?=$newsdate;?>" style="width:135px;"/>
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="newsdescr" id="newsdescr" value="<?=$newsdescr;?>" size="20"  style="width:135px;"/>
			
			<input type="submit" class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button" class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд" />
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_news T";
		$qry.=$qrywhr;
		$qry.=" order by T.NewsDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, OrganName";
	$qry.=" from tbl_news T";
	$qry.=$qrywhr;
	$qry.=" group by T.NewsID";
	$qry.=" order by T.NewsDate desc, CreateDate desc";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
?>
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[$j1]['NewsDate'];?></p>
<?php
		if (!empty($row1[$j1]['OrganID'])){
?>
				<div class="org"><span><?=$row1[$j1]['OrganName'];?></span></div>
<?php
		}
		$imagesource=$drf."/files/news/small/".$row1[$j1]['ImageSource'];
		if (!empty($row1[$j1]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/news/small/".$row1[$j1]['ImageSource'];
?>
				<a href="<?=$rf;?>/news/detail/<?=$row1[$j1]['NewsID'];?>">
					<img src="<?=$imagesource?>" width="150" style="float: left; margin: 5px 10px 0 0"/>
				</a>
<?php
		} 
?>
				<h3><a title="" href="<?=$rf;?>/news/detail/<?=$row1[$j1]['NewsID'];?>"><?=$row1[$j1]['Title'];?></a></h3>
				<div><?=GetStrBr($row1[$j1]['Intro'], "350");?></div>
				<div style="text-align: right;"><a href="<?=$rf;?>/news/detail/<?=$row1[$j1]['NewsID'];?>" class="linkext"><?=$strMore;?></a></div>
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