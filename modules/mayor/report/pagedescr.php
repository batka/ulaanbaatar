<style>
.divPageDesc {
FONT-SIZE: 9px; COLOR: #000;/*FLOAT: left*/
}
.divPageDescr A {
COLOR: #ccc; FLOAT: none; text-decoration:none;
}
.divPageDescr select {
FONT-SIZE: 9px;
}
</style>
<div class="divPageDescr" style="width:97%">
	<table border="0" cellpadding="1" cellspacing="1" width="100%" style="margin-top:5">
	<tr valign="top">
		<td nowrap align="right" style="color: #e3e3e3">Хуудас:</span>
			<?php
				$icen=($showpagecount+1)/2;
				$ilen=($showpagecount-1)/2;
				
				$j=$activepage-$ilen;
				if($activepage<=$icen) $j=1;
				if($activepage>$pagecount-$ilen) $j=$pagecount-$showpagecount+1;
				if($j<1) $j=1;
				
				$ii=$pagecount;
				if($pagecount>$icen+1 && $showpagecount<=$pagecount) $ii=$j+$icen+$ilen-1;
				for($i=$j; $i<=$ii; $i++){
			?>
			&nbsp;
			<?php
					if($activepage==$i) echo "<b>";
					else {
			?>
			<a href="<?=$pageFileName;?>&activepage=<?=$i;?>">
			<?php
					}
					echo $i;
					if($activepage==$i) echo "</b>";
			?>
			</a>
			<?php
				}
			?>
		</td>
	</tr>
	</table>
</div>
