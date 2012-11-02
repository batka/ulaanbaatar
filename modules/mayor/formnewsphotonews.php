<?php
	$pageFormName="frmPhotoNews";
	
	$showcount=8;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}

	$noticetitle=$con->GetDescr("select NewsTypeName".$_SESSION['mayor_lang']." from mayor_newstype where NewsTypeLink='$newslink'");

	if($_POST['srchv']) $srchv=$_POST['srchv'];
	
	if(!empty($srchv)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$srchv%'";
		$qrywhr.=" or LOWER(CONVERT(Descr USING utf8)) like '%$srchv%')";
	}	
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#pagenum").val('');
			$("#<?=$pageFormName;?>").attr("action", "<?=$REQUEST_URI?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$("#srchv").val('');
			$('#<?=$pageFormName;?>').submit();
		});
	});
</script>

<div class="formcenter">
<form action="<?=$REQUEST_URI?>" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <?=$noticetitle;?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
		<div style="font-size: 11px; margin-bottom: 10px; float: right;">
			<span>&nbsp;&nbsp;Хайлт: </span>
			<input type="text" name="srchv" id="srchv" value="<?=$srchv;?>" size="20"/>
			<input type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
			<input type="button" name="btnall" id="btnall" value="Бүгд"/>
		</div>
		<div class="clear"></div>
		<div  style="min-height: 500px;">
	<?php
		$qry="select *, DATE_FORMAT(PhotoNewsDate,'%Y-%m-%d') as date from tbl_photonews";
		$qry.=" where IsShow='YES'";
		$qry.=" and OrganID='".MAYORID."'";
		$qry.=$qrywhr;
		$qry.=" order by PhotoNewsDate desc";
		$allrow=count($con->select($qry));
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/news/photonews/detail/".$row[$i]['PhotoNewsID']."/";
	?>
		<div style="float: left; width: 265px; height: 240px ;margin-right: 20px; position: relative;">
			<div class="descr" style="text-align: center;">
			    <?php
			    	$qry1="select ImageSource from tbl_photonewsimage";
			    	$qry1.=" where IsShow='YES'";
			    	$qry1.=" and PhotoNewsID='".$row[$i]['PhotoNewsID']."'";
			    	$row1=$con->select($qry1);
			    	$rowcount1=count($row1);
			    	if(!empty($row1[0]['ImageSource']) && file_exists("$drfo/files/photonews/detail/small/".$row1[0]['ImageSource'])){
			    ?>
			    	<a href="<?=$link?>" class="descrtitle"><img class="dcontentimg" style="float: none" src="<?=$rfo?>/files/photonews/detail/small/<?=$row1[0]['ImageSource']?>" width="200"/></a>
			    <?php }else{?>
			    	<a href="<?=$link?>" class="descrtitle"><img class="dcontentimg" style="float: none" src="<?=$rf?>/images/web/no_image.jpeg" width="200"/></a>
			    <?php }?>			    
		    	<div class="clear"></div>
			    <div style="margin-bottom: 3px; font-size: 11px;">
					<a href="<?=$link?>" class="descrtitle" title="<?=$row[$i]['Title']?>"><?=GetStrBr($row[$i]['Title'], 90)?></a>
				</div>
			</div>
			<div class="clear"></div>
		    <div class="dcontentbottom" style="position: absolute; bottom: 5px; ">
				<?=$strImageCount.": ".$rowcount1." | ".$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?> 		
    		</div>
    	</div>
	<?php }?>
		<div class="clear"></div>		
		</div>
	<?php 
		require_once 'pagenumberpost.php';
	}else{?>
		<div class="notice"><?=$strnotfound?></div>
	<?php }?>
		</div>
		</td>
	</tr>
	</table>
</form>
</div>