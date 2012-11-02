<?php
	$pageFormName="frmGovernerSolveWork";
	$showcount=6;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}

	$govformname=$con->GetDescr("select GovernorName".$_SESSION['mayor_lang']." from mayor_governor where GovernorLink='detail'");

	if($_POST['srchv']) $srchv=$_POST['srchv'];
	
	if(!empty($srchv)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$srchv%'";
		$qrywhr.=" or LOWER(CONVERT(Descr USING utf8)) like '%$srchv%')";
	}	
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
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
		<td><div class=pageformtitle><a href="<?=$rf?>/governor/detail/"><?=$govformname?></a> &raquo; <?=$govformtitle;?></div></td>
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
	<?php
		$qry="select *, DATE_FORMAT(StartDate,'%Y-%m-%d') as date from tbl_solvework";
		$qry.=" where IsShow='YES'";
		$qry.=" and OrganID='".MAYORID."'";
		$qry.=$qrywhr;
		$qry.=" order by StartDate desc, CreateDate desc";
		$allrow=count($con->select($qry));
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/governor/solvework/detail/".$row[$i]['SolveWorkID']."/";
			$rowcount1 = $con->GetDescr("select count(*) from tbl_solveworkimage where SolveWorkID='".$row[$i]['SolveWorkID']."'");
	?>
		<div class="dcontent">
			<div class="descr">
			    <?php
			    	if(!empty($row[$i]['ImageSource']) && file_exists("$drfo/files/solvework/medium/".$row[$i]['ImageSource'])){
			    ?>
			    	<a href="<?=$link?>" class="descrtitle"><img class="dcontentimg" src="<?=$rfo?>/files/solvework/medium/<?=$row[$i]['ImageSource']?>" width="200"/></a>
			    <?php }else{?>
			    	<a href="<?=$link?>" class="descrtitle"><img class="dcontentimg" src="<?=$rf?>/images/web/no_image.jpeg" width="200"/></a>
			    <?php }?>
			    <div style="margin-bottom: 3px;">
					<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
				</div>
			    <?=GetStrBr(strip_tags($row[$i]['Descr']), 300);?>
		    	<div class="clear"></div>
			</div>
			    <div class="dcontentbottom">
				<?=$strImageCount.": ".$rowcount1." | ".$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?> 		
	    		</div>
	    		<div class="clear"></div>
    	</div>
	<?php }
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