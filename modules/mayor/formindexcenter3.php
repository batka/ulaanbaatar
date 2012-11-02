<style type="text/css">
	.tableinfo{
		width: 100%;
		font-family: Tahoma;
		font-size: 12px;
	}
	
	.tableinfo tr{
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
	
	.tableinfo .nlink{
		color: #000000;
		text-decoration: none;
	}
	.tableinfo .nlink:HOVER{
		color: #023eac;
		text-decoration: none;
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
	var prcontabbefore="prcon1";
	var prconmenubefore="prcontab1";
	var prcontab,prconmenu;
	function showprcontab(id){
		prcontab="prcon"+id;
		prconmenu="prcontab"+id;
		document.getElementById(prcontabbefore).style.display="none";		
		document.getElementById(prcontab).style.display="block";

		document.getElementById(prconmenubefore).className="";
		document.getElementById(prconmenu).className="here";		

		prconmenubefore=prconmenu;
		prcontabbefore=prcontab;
	}
	function donwloadLink(param){
		$("#errandid").val(param);
		$("#frmErrand").attr("action", "<?=$rf;?>/processform.php?action=erranddownloadfile");
		$("#frmErrand").submit();
	}
</script>
<div style="overflow: hidden;">
	<ul id="globalnav">
		<li><a style="cursor: pointer;" id="prcontab1" onclick="showprcontab('1');" class="here">Нийслэлийн шуурхай</a></li>
		<li><a style="cursor: pointer;" id="prcontab2" onclick="showprcontab('2');">Албан даалгавар</a></li>
	</ul>
	<div style="border: 1px solid #ebebeb; background-color: #f6f7f7;  height: 100px">

		<div id="prcon1" style="display: block; padding: 5px; height: 95%; overflow: auto;">		
			<ul style="margin: 0; padding: 0">			
			<table class="tableinfo" cellpadding="0" cellspacing="0">
			<?php
				$qry="select *, DATE_FORMAT(CreateDate,'%Y-%m-%d') as date";
				$qry.=" from mayor_councilpromptness";
				$qry.=" where IsShow='YES'";
				$qry.=" order by CreateDate desc";
				$allrow=$con->GetDescr("select count(*) from mayor_councilpromptness where IsShow='YES'");
				$qry.=" limit 0, 3";
				$row=$con->select($qry);
				$rowcount=count($row);
				if($rowcount>0){
					for($i=0; $i<$rowcount; $i++){?>
				<tr>
					<td align="center" width="5%"><?=($index+$i+1)?>.</td>
					<td align="left" width=""><a href="javascript:none();" class="llink" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilprompt.php&qs1=promptid=<?=$row[$i]['CouncilPromptnessID'];?>&qs2=descr=Descr',600, 600); return false;"><strong><?=$row[$i]['date']?></strong> удирдах ажилтнуудын шуурхай</a></td>
				</tr>
			<?php }}else{?>
				<tr>
					<td colspan="3" bgcolor="#fff"><span class="notice"><?=$strnotfound?></span></td>
				</tr>
			<?php }?>
			</table>
			</ul>
			<a href="<?=$rf?>/governor/prompt/" class="indexformmorelink">Цааш<img src="<?=$rf?>/images/web/arrow.png" align="middle"/></a>
		</div>

		
		<div id="prcon2" style="display: none; padding: 5px; height: 95%; overflow: auto;">
			<ul style="margin: 0; padding: 0">	
				<table class="tableinfo" cellpadding="0" cellspacing="0">
			<?php				
				$qry="select *, DATE_FORMAT(ErrandDate,'%Y-%m-%d') as date1";
				$qry.=" from mayor_errand";
				$qry.=" where IsShow='YES'";
				$qry.=" order by CreateDate desc";
				$qry.=" limit 0, 3";
				$row=$con->select($qry);
				$rowcount=count($row);
				if($rowcount>0){
					for($i=0; $i<$rowcount; $i++){?>
					<tr>
						<td align="center" width="5%"><?=($index+$i+1)?>.</td>
						<td align="left"><a href="javascript:none();" class="llink" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilerrand.php&qs1=errandid=<?=$row[$i]['ErrandID'];?>&qs2=descr=Descr',600, 600); return false;"><?=GetStrBr($row[$i]['Title'],80)?></a></td>
						<td align="center"  width="20%"><a href="javascript:none();" class="nlink" onClick="OpenWindow('<?=$rf?>/report/printreport.php?fn=councilerrand.php&qs1=errandid=<?=$row[$i]['ErrandID'];?>&qs2=descr=Descr1',600, 600); return false;"><img src="<?=$rf?>/images/web/morefile.png" style="vertical-align: middle;"> биелэлт</a></a></td>
						<td align="center">
							<?php if(!empty($row[$i]['FileSource'])){?>
								<a href="<?=$rf?>/files/errand/<?=$row[$i]['FileSource']?>" target="_blank"><img src="<?=$rf?>/images/web/icon/icon_download.png"></a>
							<?php }?>
						</td>
					</tr>
			<?php }}else{?>
				<tr>
					<td colspan="3" bgcolor="#fff"><span class="notice"><?=$strnotfound?></span></td>
				</tr>
			<?php }?>
			</table>
			</ul>
			<a href="<?=$rf?>/governor/errand/" class="indexformmorelink">Цааш<img src="<?=$rf?>/images/web/arrow.png" align="middle"/></a>
		</div>
	</div>
</div>
<div style="clear: both;"></div>