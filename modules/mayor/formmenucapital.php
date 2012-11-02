<?php
	$qry="select * from mayor_capital";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);
?>

<?php require_once 'styles/styleleftmenu.php';?>

<div id="leftmenu">
	<div class="title"><?=$menutitle?></div>	
	<ul>
	<?php for($i=0; $i<$rowcount; $i++){?>
		<li>
			<a href="<?=$rf?>/capital/<?=$row[$i]['CapitalLink']?>/"><?=$row[$i]['CapitalName'.$_SESSION['mayor_lang']]?></a>
		</li>
	<?php }?>
	</ul>
</div>