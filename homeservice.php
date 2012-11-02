<div class="hdtitle2">Төрийн үйлчилгээ</div>
<?php
	$qry="select ServiceClassID, ServiceClassName";
	$qry.=" from ref_serviceclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);

	$j=0;
	while ($j<$rowcount) {
		
?>
<div style="width: 341px; float: left; margin-bottom: 10px; margin-left: 20px;">
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr>
			<td width="40">
				<img src="<?=$rf;?>/images/icon/32x32/<?=$row[$j]['ServiceClassID'];?>.png" style="float: left; margin-right: 5px" width="30"/>
			</td>
			<td>
				<a href="<?=$rf;?>/service/<?=$row[$j]['ServiceClassID'];?>" style="line-height: 17px; font-size: 12px; font-weight: bold; color: #16387c;">
					<?=$row[$j]['ServiceClassName'];?>
				</a>
			</td>
		</tr>	
	</table>
</div>
<?php if(($j+1)%2==0){?>
<div style="clear: both;"></div>
<?php }?>
<?php
	$j++;
	}
?>