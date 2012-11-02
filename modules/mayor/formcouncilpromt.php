<?php
	$pageFormName="frmPrompt";
	
	if($_POST['promptdate']) $promptdate=$_POST['promptdate'];
	if($_POST['promptdescr']) $promptdescr=$_POST['promptdescr'];
	if($_POST['orderby']) $orderby=$_POST['orderby'];
	else $orderby="PromptDate desc";
	if($_POST['letter']) $letter=$_POST['letter'];

	$showcount = 30;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}
	
	if (!empty($promptdate)){
		$qrywhr.=" and PromptDate='$promptdate'";
	}
	if(!empty($letter)){
		$qrywhr.=" and SUBSTR(REPLACE(UPPER(CONVERT(Title USING utf8)),' ',''),1,1)=UPPER('$letter')";
	}
	$promptdescr=mb_strtolower(trim($promptdescr),'utf-8');
	if(!empty($promptdescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$promptdescr%'";
		$qrywhr.=" or LOWER(CONVERT(Descr USING utf8)) like '%$promptdescr%')";
	} 
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#<?=$pageFormName;?>").attr("action", "<?=$REQUEST_URI?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$('#activepage option:first').attr('selected', 'selected');
			$("#promptdate").val('');
			$("#promptdescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#promptdate').datepick({
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


<style type="text/css">
	.tableinfo{
		width: 100%;
		font-family: Tahoma;
		font-size: 12px;
	}
	
	.tableinfo th{
		background-color: #eeeeee;
		color: #000000;
		font-size: 11px;
		padding: 2px;
		height: 20px;
	}
	
	.tableinfo td{
		color: #000000;
		font-size: 11px;
		padding: 2px;
		height: 20px;
	}
	
	.tableinfo a{
		color: #000000;
		text-decoration: none;
	}
	.tableinfo a:HOVER{
		color: #023eac;
	}
</style>

<div class="formcenter">
<form action="<?=$REQUEST_URI?>" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$lmenutitle?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform"><input type="hidden" name="promptid" id="promptid" value=""/>
		<input type="hidden" name="letter" id="letter" value=""/>
			<div style="font-size: 11px; margin-bottom: 10px;">
				<div style="float: right;">
					<span>Огноо: </span>
					<input name="promptdate" id="promptdate" size="10" value="<?=$promptdate;?>"/>
					<span>&nbsp;&nbsp;Хайлт: </span>
					<input type="text" name="promptdescr" id="promptdescr" value="<?=$promptdescr;?>" size="20"/>
					<input type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
					<input type="button" name="btnall" id="btnall" value="Бүгд"/>
				</div>
				<div class="clear"></div>
			</div>
	<div style="min-height: 400px;">
	<?php
		$qry="select *, DATE_FORMAT(PromptDate,'%Y-%m-%d') as date";
		$qry.=" from mayor_councilpromptness";
		$qry.=" where IsShow='YES'";
		$qry.=$qrywhr;
		$qry.=" order by PromptDate desc, CreateDate desc";
		$allrow=$con->GetDescr("select count(*) from mayor_councilpromptness where IsShow='YES'");
		$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){?>
		<table class="tableinfo">
			<tr>
				<th width="5%">№</th>
				<th width="35%">Нийслэлийн шуурхай</th>			
				<th width="20%">Биелэлт</th>
			</tr>
			<?php			
			$index=$pagenum*$showcount;
			for($i=0; $i<$rowcount; $i++){
			?>
			<tr>
				<td align="center"><?=($index+$i+1)?>.</td>
				<td align="center"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilprompt.php&qs1=promptid=<?=$row[$i]['CouncilPromptnessID'];?>&qs2=descr=Descr',600, 600); return false;"><b><?=$row[$i]['date']?></b> өдрийн шуурхай</a></td>
				<td align="center"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilprompt.php&qs1=promptid=<?=$row[$i]['CouncilPromptnessID'];?>&qs2=descr=Descr1',600, 600); return false;">Дэлгэрэнгүй</a></td>
			</tr>
			<?php }?>
		</table>	
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