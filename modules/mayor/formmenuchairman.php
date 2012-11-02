<?php
	$qry="select * from mayor_chairman";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);
?>

<style type="text/css">
	#leftmenu{
		margin-top: 10px;
		width: 200px;
		border: 1px solid #b1c1fb;
	}
	
	#leftmenu .title{
		height: 24px;
		line-height: 23px;
		color: #ffffff;
		font-size: 12px;
		font-weight: bold;
		padding-left: 15px;
		background-color: #a90102;
	}
		
	#leftmenu ul{
		margin: 0px;
		padding: 2px;
		padding-bottom: 1px;
	}
	
	#leftmenu ul li{
		list-style: none;
	}
	
	#leftmenu ul li a{
		display: list-item;
		color: #333333;
		font-size: 11px;
		text-decoration: none;
		line-height: 15px;
		list-style: none;
		padding: 3px;
		padding-left: 5px;
		background-color: #fcc6c7;
		border-bottom: 1px solid #faa1a2;
	}
	
	#leftmenu ul li a:HOVER{
		color: #ffffff;
		background-color: #b01010;
	}
	
	img.menuimg{
		float: left;
		margin-right: 2px;
	}
</style>

<div id="leftmenu">
	<div class="title"><?=$menutitle?></div>	
	<ul>
	<?php for($i=0; $i<$rowcount; $i++){?>
		<li>			
			<table cellpadding="0" cellspacing="0" style="margin-bottom: 3px;">
				<tr>
					<td valign="top" width="60px">
						<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/chairman/small/".$row[$i]['ImageSource'])){?>
							<a href="<?=$rf?>/chairman/detail/<?=$row[$i]['ChairmanID']?>/" style="background-color: inherit; padding: 0px; border: 0px;">
								<img src="<?=$rf?>/images/chairman/small/<?=$row[$i]['ImageSource']?>" width="60" height="73" border="0" class="menuimg">
							</a>
						<?php }?>
					</td>
					<td valign="top" width="135">
						<a href="<?=$rf?>/chairman/detail/<?=$row[$i]['ChairmanID']?>/" style="width: 135;">
							<?=mb_substr($row[$i]['LastName'],0,1,'utf-8')?>.<?=$row[$i]['FirstName']?>
						</a>
						<a href="<?=$rf?>/chairman/task/<?=$row[$i]['ChairmanID']?>/" style="width: 135;">
							ҮА-ны зорилтууд
						</a>
					</td>
				</tr>
			</table>
		</li>
	<?php }?>
	</ul>
</div>