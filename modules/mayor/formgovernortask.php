<?php
	
	$govformname=$con->GetDescr("select GovernorName".$_SESSION['mayor_lang']." from mayor_governor where GovernorLink='detail'");

	$pageFormName="frmGovernerListWork";
	$showcount=6;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}

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
			$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
			$qry.=" from mayor_directortask";
			$qry.=" where IsShow='YES'";
			$qry.=" and Mayor='YES'";
			$qry.=$qrywhr;
			$qry.=" order by CreateDate desc";
			$allrow=count($con->select($qry));
			$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
			$row=$con->select($qry);
			$rowcount=count($row);
			if($rowcount>0){
			for($i=0; $i<$rowcount; $i++){
				$link="$rf/governor/task/detail/".$row[$i]['DirectorTaskID']."/";
		?>
			<div class="descr">
					<div class="dcontent" style="padding-top: 0px;">
						<div style="margin-bottom: 3px;">
							<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
						</div>
						<div class="descr">
						<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/directortask/".$row[$i]['ImageSource'])){?>
							<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rf?>/images/directortask/small/<?=$row[$i]['ImageSource']?>" width="120"/></a>
						<?php }
						if(!empty($row[$i]['Intro'])){
							echo GetStrBr(strip_tags($row[$i]['Intro']), 400);
						}else{
							echo GetStrBr(strip_tags($row[$i]['Descr']), 400);
						}
						?>
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
		</div>
		</td>
	</tr>
	</table>
</form>
</div>