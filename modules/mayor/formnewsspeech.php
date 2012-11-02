<?php
	$pageFormName="frmSpeechNews";
	
	$showcount=6;
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
	<?php
		$qry="select T.*, DATE_FORMAT(T.SpeechDate,'%Y-%m-%d') as date";
		$qry.=" from tbl_speech T";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.OrganID='".MAYORID."'";
		$qry.=$qrywhr;
		$qry.=" order by T.SpeechDate desc, T.CreateDate desc";
		$allrow=count($con->select($qry));
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		
		if($rowcount>0){
		for($i=0; $i<$rowcount; $i++){
			$link="$rf/news/$newslink/detail/".$row[$i]['SpeechID']."/";
	?>
		<div class="dcontent">			
			<div class="descr">
			<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drfo/files/speech/small/".$row[$i]['ImageSource'])){?>
				<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rfo?>/files/speech/small/<?=$row[$i]['ImageSource']?>" width="120"/></a>
			<?php }?>
				<div style="line-height: 13px; margin-bottom: 3px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79; font-size: 14px;">
				<?=GetStrBr(strip_tags($row[$i]['Title']), 100)?>
			</a></div>				
				<?=GetStrBr(strip_tags($row[$i]['Descr']), 300);?>
				<div class="clear"></div>
			</div>
			<div class="dcontentbottom">
				<?=$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?>
			</div>
			<a class="morelink" href="<?=$link?>"><?=$strMore?></a>
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