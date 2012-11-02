<?php
	require_once 'libraries/connect.php';
	$con=new Database();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<?php
	require_once "headerjsstyle.php";
	$module="nzdtg";
	$formtitle=$con->GetDescr("select PetitionName".$_SESSION['mayor_lang']." from mayor_nzdtgpetition where PetitionID='101'");
?>
<style type="text/css">
	.tableinfo{
		width: 100%;
		font-family: Tahoma;
		font-size: 12px;
	}
	
	.tableinfo th{
		background-color: #5e84b0;
		color: #ffffff;
		font-size: 11px;
		padding: 2px;
	}
	
	.tableinfo td{
		background-color: #e5e5e5;
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
</HEAD>
<BODY>
	<?php require_once 'header.php';?>
	<div class="container">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td width="200" valign="top"><?php require_once 'formmenunzdtg.php';?></td>
			<td width="800" valign="top">
				<div class="formcenter">
					<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
						<td><div class=pageformtitle><?=$strnzdtgstlnews?> &raquo; <?=$formtitle?></div></td>
							<td align="right">
							<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
							</div>
							</td>
						</tr>
						<tr>
						<td colspan="2">
						<div class="pageform">
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="text-align: center;" height="25">Ирсэн захидлуудыг оноор зэрэгцүүлэн харуулбал:</td>
								</tr>
								<tr>
									<td style="padding: 0px">
										<table cellpadding="3" cellspacing="1" class="tableinfo" width="100%">
										<tr>
											<th rowspan="2" width="10%">Он</th>
											<th rowspan="2" width="15%">Бүртгэлд орсон захидлын тоо</th>
											<th colspan="2" width="20%">Хяналтанд орсон захидлын тоо</th>
											<th colspan="2" width="20%">Шийдвэрлэлт </th>
											<th rowspan="2">Тайлбар</th>
										</tr>
										<tr>
											<th>Тоо</th>
											<th>Хувь</th>
											<th>Тоо</th>
											<th>Хувь</th>
										</tr>
							<?php
								$qry=" select *";
								$qry.=" from mayor_newspetition";
								$qry.=" where IsShow='YES'";
								$qry.=" order by PetitionYear";
								$row=$con->select($qry);
								$rowcount=count($row);
							
								$j=0;
								while ($j<$rowcount){
							?>
										<tr>
											<td style="text-align: center;"><?=$row[$j]['PetitionYear']?></td>
											<td style="text-align: center;"><?=$row[$j]['PetitionTotal']?></td>
											<td style="text-align: center;"><?=$row[$j]['ControlCount']?></td>
											<td style="text-align: center;"><?=$row[$j]['ControlPercent']?></td>
											<td style="text-align: center;"><?=$row[$j]['DecideCount']?></td>
											<td style="text-align: center;"><?=$row[$j]['DecidePercent']?></td>
											<td style="line-height: 1.5em; text-align: justify;"><?=$row[$j]['Descr']?></td>
										</tr>
							<?php
								$j++;
								} 
							?>
										</table>
									</td>
								</tr>
								</table>
							<div class="clear"></div>
						</div>
						</td>
					</tr>
					</table>	
				</div>
			</td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>