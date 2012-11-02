<?php
	$pageFormName="frmErrand";
	
	if($_POST['erranddate']) $erranddate=$_POST['erranddate'];
	if($_POST['erranddescr']) $erranddescr=$_POST['erranddescr'];
	if($_POST['orderby']) $orderby=$_POST['orderby'];
	else $orderby="ErrandDate desc";
	if($_POST['letter']) $letter=$_POST['letter'];

	$showcount = 30;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}
	
	if (!empty($erranddate)){
		$qrywhr.=" and ErrandDate='$erranddate'";
	}
	if(!empty($letter)){
		$qrywhr.=" and SUBSTR(REPLACE(UPPER(CONVERT(Title USING utf8)),' ',''),1,1)=UPPER('$letter')";
	}
	$erranddescr=mb_strtolower(trim($erranddescr),'utf-8');
	if(!empty($erranddescr)){
		$qrywhr.=" and (LOWER(CONVERT(Title USING utf8)) like '%$erranddescr%'";
		$qrywhr.=" or LOWER(CONVERT(Descr USING utf8)) like '%$erranddescr%')";
	} 
?>

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
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#<?=$pageFormName;?>").attr("action", "<?=$REQUEST_URI?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$('#activepage option:first').attr('selected', 'selected');
			$("#erranddate").val('');
			$("#erranddescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#erranddate').datepick({
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
	
	function donwloadLink(param){
		$("#errandid").val(param);
		$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/processform.php?action=erranddownloadfile");
		$('#<?=$pageFormName;?>').submit();
	}
</script>
<div class="formcenter">
<form action="<?=$REQUEST_URI?>" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$lmenutitle?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
		<input type="hidden" name="errandid" id="errandid" value=""/>
		<input type="hidden" name="letter" id="letter" value=""/>
			<div style="font-size: 11px; margin-bottom: 10px;">
				<div style="float: right;">
					<span>Огноо: </span>
					<input name="erranddate" id="erranddate" size="10" value="<?=$erranddate;?>"/>
					<span>&nbsp;&nbsp;Хайлт: </span>
					<input type="text" name="erranddescr" id="erranddescr" value="<?=$erranddescr;?>" size="20"/>
					<input type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
					<input type="button" name="btnall" id="btnall" value="Бүгд"/>
				</div>
				<div class="clear"></div>
			</div>
			<div style="min-height: 400px;">
			<?php
				$qry="select *, DATE_FORMAT(ErrandDate,'%Y-%m-%d') as date1";
				$qry.=" from mayor_errand";
				$qry.=" where IsShow='YES'";
				$qry.=" and OrganID='".MAYORID."'";
				$qry.=$qrywhr;
				$qry.=" order by ErrandDate desc, CreateDate desc";
				$allrow=$con->GetDescr("select count(*) from mayor_errand where IsShow='YES' ");
				$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
				$row=$con->select($qry);
				$rowcount=count($row);
				if($rowcount>0){?>
				<table class="tableinfo" cellpadding="0" cellspacing="1">
					<tr>
						<th width="5%">№</th>						
						<th width="15%">Огноо</th>
						<th width="">Албан даалгавар</th>
						<th width="15%">Биелэлт</th>
						<th width="10%">Хавсралт файл</th>
					</tr>
					<?php			
					$index=$pagenum*$showcount;
					for($i=0; $i<$rowcount; $i++){
					?>
					<tr>
						<td align="center"><?=($index+$i+1)?>.</td>
						<td align="center"><?=$row[$i]['date1']?></td>
						<td align="left"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilerrand.php&qs1=errandid=<?=$row[$i]['ErrandID'];?>&qs2=descr=Descr',600, 600); return false;"><?=$row[$i]['Title']?></a></td>
						<td align="center"><a href="javascript:none();" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilerrand.php&qs1=errandid=<?=$row[$i]['ErrandID'];?>&qs2=descr=Descr1',600, 600); return false;">Биелэлт</a></td>
						<td align="center">
							<?php if(!empty($row[$i]['FileSource']) && file_exists("$drf/files/errand/".$row[$i]['FileSource'])){?>
								<a href="<?=$rf?>/files/errand/<?=$row[$i]['FileSource']?>" target="_blank"><img src="<?=$rf?>/images/web/icon/icon_download.png"></a>
							<?php }?>
						</td>
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