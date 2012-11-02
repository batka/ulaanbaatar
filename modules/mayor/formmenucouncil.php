<?php
	$qry="select * from mayor_council";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$row=$con->select($qry);
	$rowcount=count($row);
?>

<?php require_once 'styles/styleleftmenu.php';?>
<div id="leftmenu">
	<div class="title" style="margin-bottom: -2px;"><?=$menutitle?></div>	
	<ul>
	<?php for($i=0; $i<$rowcount; $i++){?>
		<li>
			<a href="<?=$rf?>/council/<?=$row[$i]['CouncilLink']?>/"><?=$row[$i]['CouncilName'.$_SESSION['mayor_lang']]?></a>
		</li>
	<?php }?>
	</ul>
</div>