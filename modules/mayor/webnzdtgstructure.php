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
	$structureid=$_GET['structureid'];
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
			<td width="600" valign="top">
				<?php
					$qry="select *";
					$qry.=" from mayor_structure";
					$qry.=" where IsShow='YES'";
					$qry.=" and StructureID='$structureid'";
					$row=$con->select($qry);
				?>
				<div class="formcenter">
					<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
						<td><div class=pageformtitle><?=$strnzdtgstructure?> &raquo; <?=$row[0]['Title']?></div></td>
							<td align="right">
							<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 130px;">
							</div>
							</td>
						</tr>
						<tr>
						<td colspan="2">
						<div class="pageform">
							<div class="subtitle" style="color: #54524f; text-transform: uppercase; margin-bottom: 5px;">Эрх зүйн байдал</div>
							<?php if(count($row)>0){?>
							<div class="descr"><?=$row[0]['Descr']?></div>
							<?php
								$qry1="select *";
								$qry1.=" from mayor_structureworker";
								$qry1.=" where IsShow='YES'";
								$qry1.=" and StructureID='$structureid'";
								$qry1.=" order by ShowOrder";
								$row1=$con->select($qry1);
								$rowcount1=count($row1);
								if($rowcount1){
							?>
							<div class="subtitle" style="margin-top: 10px; color: #54524f; text-transform: uppercase; margin-bottom: 5px;">АЛБАН ХААГЧДЫН ТАЛААРХ МЭДЭЭЛЭЛ</div>
							<table class="tableinfo">
								<tr>
									<th width="5%">№</th>
									<th width="41%">Албан хаагчийн нэр</th>
									<th width="18%">Албан тушаал</th>
									<th width="18%">И-мэйл хаяг</th>
									<th width="18%">Утас</th>
								</tr>
								<?php
								for($j=0; $j<$rowcount1; $j++){
								?>
								<tr>
									<td align="center"><?=($j+1)?>.</td>
									<td align="center"><?=mb_substr($row1[$j]['LastName'],0,1,'utf-8').".".$row1[$j]['FirstName']?></td>
									<td align="center"><?=$row1[$j]['PositionName']?></td>
									<td align="center"><?=$row1[$j]['Email']?></td>
									<td align="center"><?=$row1[$j]['PhoneNumber']?></td>
								</tr>
								<?php }?>
							</table>
							<?php }?>
						<?php }?>
						</div>
						</td>
					</tr>
					</table>	
				</div>
			</td>
			<td width="200" valign="top"><?php require_once 'formwebleft.php';?></td>
			</tr>
		</table>
	</div>
	<?php require_once 'footer.php';?>
</BODY>
</HTML>