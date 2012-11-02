<?php
	$pageFormName="frmLawRuleList";
	
	if($_POST['lawruledate']) $lawruledate=$_POST['lawruledate'];
	if($_POST['lawruledescr']) $lawruledescr=$_POST['lawruledescr'];
	if($_POST['orderby']) $orderby=$_POST['orderby']; 
	else $orderby="T.LawRuleDate desc";
	if($_POST['letter']) $letter=$_POST['letter'];

	$showcount = 30;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}
		
	if (!empty($lawruledate)){
		$qrywhr.=" and T.LawRuleDate='$lawruledate'";
	}
	if(!empty($letter)){
		$qrywhr.=" and SUBSTR(REPLACE(UPPER(CONVERT(T.Title USING utf8)),' ',''),1,1)=UPPER('$letter')";
	}
	$lawruledescr=mb_strtolower(trim($lawruledescr),'utf-8');
	if(!empty($lawruledescr)){
		$qrywhr.=" and (LOWER(CONVERT(T.Title USING utf8)) like '%$lawruledescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.LawRuleNo USING utf8)) like '%$lawruledescr%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$lawruledescr%')";
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
	
	.tableinfo .llink{
		color: #244d79;
		text-decoration: none;
	}
	.tableinfo .llink:HOVER{
		text-decoration: underline;
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
			$("#lawruledate").val('');
			$("#lawruledescr").val('');
			$('#<?=$pageFormName;?>').submit();
		});
		$.datepick.setDefaults($.datepick.regional['mn']);
		$('#lawruledate').datepick({
			yearRange: '2000:<?=date('Y');?>',
			dateFormat: 'yy-mm-dd',
			minDate: new Date(2000, 1 - 1, 1),
			maxDate: '+12M',
			showStatus: true,
			showOn: 'both',
			buttonImageOnly: true,
			buttonImage: '<?=$rf;?>/js/jquery/jquery.datepick/calendar-blue.gif'
		});
	});
	
	function downloadLink(param){
		$("#lawruleid").val(param);
		$("#<?=$pageFormName;?>").attr("action", "<?=$rf;?>/processform.php?action=lawruledownloadfile");
		$('#<?=$pageFormName;?>').submit();
	}
</script>
<div class="formcenter">
<form action="<?=$REQUEST_URI?>" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$govformtitle?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
		<input type="hidden" name="lawruleid" id="lawruleid" value=""/>
		<input type="hidden" name="letter" id="letter" value=""/>
			<div style="font-size: 11px; margin-bottom: 10px;">
				<div style="float: left;">
					<span>Огноо: </span>
					<input name="lawruledate" id="lawruledate" size="8" value="<?=$lawruledate;?>"/>
					<span>&nbsp;&nbsp;Хайлт: </span>
					<input type="text" name="lawruledescr" id="lawruledescr" value="<?=$lawruledescr;?>" size="15"/>
					<input type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
					<input type="button" name="btnall" id="btnall" value="Бүгд"/>
				</div>
				<div style="float: right;">
				<?php
					$qry="select SysID, SysDescr";
					$qry.=" from asu_progcombo";
					$qry.=" where ComboName='LAWRULESORTBY'";
					$qry.=" order by RowID";
				?>
					<span>Эрэмбэ: </span>
					<select name="orderby" id="orderby" onchange="btnsrch.click();"><?=$con->COMBOFILL($qry, $orderby, 0, 1, 2);?></select>
				</div>
				<div class="clear" style="margin-bottom: 3px;"></div>
				<?php
					$qry="select SysID, SysDescr";
					$qry.=" from asu_progcombo";
					$qry.=" where ComboName='LETTER'";
					$qry.=" order by RowID";
					$rowl=$con->select($qry);
					$rowcountl=count($rowl);
					
					for ($jl=0; $jl<$rowcountl; $jl++){
				?>
									<span style="padding: 3px; <?php if($letter==$rowl[$jl]['SysID']) echo "font-weight: bold; text-decoration: underline;";?>"><a class="letter" href="javascript:" onclick="$('#letter').val('<?=$rowl[$jl]['SysID'];?>'); $('#btnsrch').click();"><?=$rowl[$jl]['SysDescr'];?></a></span>
				<?php
					} 
				?>
			</div>
			<div style="min-height: 400px;">
			<?php
				$qry="select T.*, DATE_FORMAT(T.LawRuleDate,'%Y-%m-%d') as date1, DATE_FORMAT(T.StartDate,'%Y-%m-%d') as date2";
				$qry.=" from tbl_lawrule T";
				$qry.=" where IsShow='YES'";
				$qry.=" and T.OrganID='".MAYORID."'";
				$qry.=" and T.IsPublic='YES'";
				$qry.=$qrywhr;
				$qry.=" order by $orderby, T.CreateDate desc";
				$allrow=count($con->select($qry));
				$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
				$row=$con->select($qry);
				$rowcount=count($row);
				if($rowcount>0){?>
				<table class="tableinfo" cellpadding="0" cellspacing="1">
					<tr>
						<th width="5%">№</th>						
						<th width="10%">Дугаар</th>
						<th width="15%">Батлагдсан огноо</th>
						<th width="">Захирамжийн нэр</th>
					</tr>
					<?php			
					$index=$pagenum*$showcount;
					for($i=0; $i<$rowcount; $i++){
					?>
					<tr>
						<td align="center"><?=($index+$i+1)?>.</td>
						<td align="center"><?=$row[$i]['LawRuleNo']?></td>
						<td align="center"><?=$row[$i]['date1']?></td>
						<td align="left"><a href="javascript:none();"  class="llink" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=governororder.php&qs1=lawruleid=<?=$row[$i]['LawRuleID'];?>',600, 600); return false;"><?=$row[$i]['Title']?></a></td>
					</tr>
					<tr>
						<td colspan="6" style="border-top: 1px solid #cccccc; height: 0px;"></td>
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