<?php require_once 'styles/styleleftmenu.php';?>

<div id="leftmenu">
	<div class="title"><?=$menutitle?></div>
	<ul>
		<?php
			$qry="select * from mayor_nzdtgabout";
			$qry.=" where IsShow='YES'";
			$qry.=" order by ShowOrder";
			$row=$con->select($qry);
			$rowcount=count($row);
			if($rowcount>0){
		?>
		<li>
			<div class="subtitle"><?=$strnzdtgabout?></div>
		</li>
		<?php for($i=0; $i<$rowcount; $i++){?>
		<li>
			<a href="<?=$rf?>/nzdtg/about/<?=$row[$i]['AboutID']?>/"><?=$row[$i]['AboutName'.$_SESSION['mayor_lang']]?></a>
		</li>
		<?php }
		}
			$qry="select * from mayor_structure";
			$qry.=" where IsShow='YES'";
			$qry.=" order by CreateDate";
			$row=$con->select($qry);
			$rowcount=count($row);
			if($rowcount>0){
		?>
		<li>
			<div class="subtitle"><?=$strnzdtgstructure?></div>
		</li>
		<?php for($i=0; $i<$rowcount; $i++){?>
		<li>
			<a href="<?=$rf?>/nzdtg/structure/<?=$row[$i]['StructureID']?>/"><?=$row[$i]['Title']?></a>
		</li>
		<?php }
		}
			$qry="select * from mayor_nzdtgpetition";
			$qry.=" where IsShow='YES'";
			$qry.=" order by ShowOrder";
			$row=$con->select($qry);
			$rowcount=count($row);
			if($rowcount>0){
		?>
		<li>
			<div class="subtitle"><?=$strnzdtgstlnews?></div>
		</li>
		<?php for($i=0; $i<$rowcount; $i++){?>
		<li>
			<a href="<?=$rf?>/nzdtg/<?=$row[$i]['PetitionLink']?>/"><?=$row[$i]['PetitionName'.$_SESSION['mayor_lang']]?></a>
		</li>
		<?php }}?>
	</ul>
</div>