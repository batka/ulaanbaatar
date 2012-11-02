<?php
	$qry="select * from mayor_governor";
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
			<a href="<?=$rf?>/governor/<?=$row[$i]['GovernorLink']?>">
				<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drf/images/governor/small/".$row[$i]['ImageSource'])){?>
					<img src="<?=$rf?>/images/governor/small/<?=$row[$i]['ImageSource']?>" width="60" height="60" class="menuimg">
				<?php }?>
				<?=$row[$i]['GovernorName'.$_SESSION['mayor_lang']]?>
				<div class="clear"></div>
			</a>
		</li>
	<?php }?>
	</ul>
</div>