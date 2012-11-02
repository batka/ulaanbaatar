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
	$formtitle=$con->GetDescr("select PetitionName".$_SESSION['mayor_lang']." from mayor_nzdtgpetition where PetitionID='102'");
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
								<td style="text-align: center;" height="25">Албан бичгийн шийдвэрлэлтийн явцыг оноор зэрэгцүүлэн харуулбал:</td>
							</tr>
							<tr>
								<td>
									<table cellpadding="3" cellspacing="1" width="100%" class="tableinfo">
									<tr>
										<th width="10%">Он</th>
										<th width="12%">Ирсэн бичгийн тоо</th>
										<th width="10%">Хяналтад авсан</th>
										<th width="10%">Шийдвэрлэсэн</th>
										<th width="10%">Үлдэгдэл</th>
										<th width="10%">Шийдвэрлэлтийн хувь</th>
										<th>Тайлбар</th>
									</tr>
						<?php
							$qry=" select *, ROUND((DecideCount/ControlCount)*100,2) as DecidePercent";
							$qry.=" from mayor_newsletter";
							$qry.=" where IsShow='YES'";
							$qry.=" order by LetterYear";
							$row=$con->select($qry);
							$rowcount=count($row);
						
							$j=0;
							while ($j<$rowcount){
						?>
									<tr>
										<td style="text-align: center;" bgcolor="#f2f2f2"><?=$row[$j]['LetterYear']?></td>
										<td style="text-align: center;" bgcolor="#f2f2f2"><?=$row[$j]['ArriveCount']?></td>
										<td style="text-align: center;" bgcolor="#f2f2f2"><?=$row[$j]['ControlCount']?></td>
										<td style="text-align: center;" bgcolor="#f2f2f2"><?=$row[$j]['DecideCount']?></td>
										<td style="text-align: center;" bgcolor="#f2f2f2"><?=$row[$j]['ArrearageCount']?></td>
										<td style="text-align: center;" bgcolor="#f2f2f2"><?=$row[$j]['DecidePercent']?>%</td>
										<td style="line-height: 1.5em; text-align: justify;" bgcolor="#f2f2f2"><?=$row[$j]['Descr']?></td>
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