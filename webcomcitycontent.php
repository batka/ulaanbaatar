<?php
	if($_POST['srchval']) $srchval=$_POST['srchval'];

	$pageFormName="frmComcity";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=9;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=3;
	$showcountselect=$showcount;  
	
	$srchval=mb_strtolower(trim($srchval),'utf-8');
	if(!empty($srchval)){
		$qrywhr.=" and (LOWER(CONVERT(T.Title USING utf8)) like '%$srchval%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$srchval%')";
	} 
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#<?=$pageFormName;?>").attr("action", "<?=$PHP_SELF;?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$("#srchval").val('');
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
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="srchval" id="srchval" value="<?=$srchval;?>" size="20"/>
			<input type="submit" class="btn" style="padding: 4px 14px;" style="padding: 1px;" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button" class="btn" style="padding: 4px 14px;" style="padding: 1px;" name="btnall" id="btnall" value="Бүгд"/>
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
			
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_comcity T";
		$qry.=" where IsShow='YES'";
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
	
	$qry="select T.*, DATE_FORMAT(T.CreateDate,'%Y-%m-%d') as date";
	$qry.=" from tbl_comcity T";
	$qry.=" where IsShow='YES'";
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
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[$j1]['date'];?></p>
				<h2><a title="" href="<?=$rf;?>/comcity/detail/<?=$row1[$j1]['ComcityID'];?>"><?=$row1[$j1]['Title'];?></a></h2>
				<?php
						$imagesource=$drf."/files/comcity/medium/".$row1[$j1]['ImageSource'];
						if (!empty($row1[$j1]['ImageSource']) && file_exists($imagesource)){
							$size=getimagesize($imagesource);
								$w=$size[0];
								$h=$size[1];
								$imagesource=$rf."/files/comcity/medium/".$row1[$j1]['ImageSource'];
								
								$imgsize = getimagesize("$drf/files/comcity/medium/".$row1[$j1]['ImageSource']);
								$W=420;
								if($W>$imgsize[0]){
									$W=$imgsize[0];
								}
				?>
								<center><a href="<?=$rf;?>/comcity/detail/<?=$row1[$j1]['ComcityID'];?>">
									<img src="<?=$imagesource?>" width="<?=$W?>" style="margin: 0 10px 0 0"/>
								</a></center>
				<?php
						} 
				?>
				<div><?=GetStrBr($row1[$j1]['Intro'], "350");?></div>
				<div style="text-align: right;"><a href="<?=$rf;?>/comcity/detail/<?=$row1[$j1]['ComcityID'];?>" class="linkext"><?=$strMore;?></a></div>
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