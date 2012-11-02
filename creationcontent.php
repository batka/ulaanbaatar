<?php
	if($_POST['creationdescr']) $creationdescr=$_POST['creationdescr']; 

	$pagelink=$rf."/creation/";
	if(!empty($creationclassid)) $pagelink.="/$creationclassid/";
	$pageFormName="frmCreationList";
	$action="";
	$isshowpage="NO";
	$showcount=$_POST['showcount'];
	if($showcount==""){
		$showcount=6;
		$_SESSION['ub_showcountselect']=$showcount;
	} else $_SESSION['ub_showcountselect']=$showcount;
	$showpagecount=3;
	$showcountselect=$showcount;  
	
	$qrywhr=" where T.IsShow='YES'"; 
	$creationdescr=mb_strtolower(trim($creationdescr),'utf-8');
	if(!empty($creationdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$creationdescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$creationdescr%')";
	} 
	if(!empty($creationclassid))$qrywhr.=" and T.CreationClassID = '$creationclassid'";
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#<?=$pageFormName;?>").attr("action", "<?=$PHP_SELF;?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$('#activepage option:first').attr('selected', 'selected');
			$("#creationdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
	});
</script>
	<div class="listbg">
		<form action="" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
		<div style="margin: 0px 10px 0px 10px; padding: 5px 0px; border-bottom: 1px dotted #ffffff;" align="right">
			<span>Хайлт: </span>
			<input type="text" name="creationdescr" id="creationdescr" value="<?=$creationdescr;?>" size="50"/>
			<input type="submit" class="btn" style="padding: 4px 14px;" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button" class="btn" style="padding: 4px 14px;" name="btnall" id="btnall" value="Бүгд"/>
		</div>
		
		<div class="spacer10"></div>
		
		<ul class="presslist">
<?php	
	$qry="select CEILING(Sum(PageCount)/$showcount), Sum(RowCount)";
	$qry.=" from(";
		$qry.=" select  count(*) as PageCount, count(*) as RowCount";
		$qry.=" from tbl_creation T";
		$qry.=$qrywhr;
		$qry.=" order by CreateDate desc)TT";
	//echo $qry; 
	$row=$con->select($qry);
	$pagecount=$row[0][0];
	$rowcount=$row[0][1];
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];

	$startrow=($activepage-1)*$showcount;
	if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
	
	$qry="select T.*, CreationClassName";
	$qry.=" from tbl_creation T";
	$qry.=" left join ref_creationclass CC on T.CreationClassID=CC.CreationClassID";
	$qry.=$qrywhr;
	$qry.=" order by CreationDate desc";
	$qry.=" limit $startrow, $showcount";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
?>
<script type="text/javascript">
$(function() {
	for(var i=0; i<<?=$rowcount1;?>; i++){
		$("#capslide_img_cont"+i).capslide({
	    	caption_color	: '#fff',
	        caption_bgcolor	: '#333',
	        overlay_bgcolor : '#fff',
	        border			: '0px solid #000',
	        showcaption	    : true
	   	});
	}
});
</script>
<?php 	
	if ($rowcount1>0){

	$j1=0;
	while ($j1<$rowcount1){
		if($j1%2==1) $marginl="margin-left: 10px";
		else $marginl="";
?>
			<div style="float: left; width: 49%; max-height:380px; overflow:hidden; <?=$marginl;?>">
				<div id="capslide_img_cont<?=$j1;?>" class="ic_container">
<?php
		$imagesource=$drf."/files/creation/small/".$row1[$j1]['ImageSource'];
		if (!empty($row1[$j1]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/creation/small/".$row1[$j1]['ImageSource'];  
?>
					<a href="<?=$rf;?>/creation/detail/<?=$row1[$j1]['CreationID'];?>">
					
					<img src="<?=$imagesource;?>" width="100%" height="80%"  style="margin: 5px 0px; height:auto !important;" alt=""/></a>
<?php
		} 
?>
	                <div class="overlay" style="display: none;"></div>
	                <div class="ic_caption">
	                	<p class="ic_category"><?=$row1[$j1]['CreationClassName'];?></p>
	                    <a href="<?=$rf;?>/creation/detail/<?=$row1[$j1]['CreationID'];?>"><h3 style="text-align: left;"><?=$row1[$j1]['Title'];?></h3></a>
	                    <p class="ic_text">
	                    	<?=GetStrBr(strip_tags($row1[$j1]['Descr']), "100");?>
	                   	</p>
					</div>
	        	</div>
	       	</div>
	       	
	       	
<?php
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