<div class="topmenu">
	<div class="nav" style="width: 605px;">
	    <ul id="menu" class="menu">
	    	<?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='101'")?>
	        <li class="nodiv"><a href="<?=$rf?>/<?=$row[0][1]?>/"><?=$row[0][0]?></a></li>
	        
	    	<?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='103'")?>
	        <li class="nodiv"><a href="<?=$rf?>/<?=$row[0][1]?>/"><?=$row[0][0]?></a>
	        	<?php
					$qry="select * from mayor_governor";
					$qry.=" where IsShow='YES'";
					$qry.=" order by ShowOrder";
					$row=$con->select($qry);
					$rowcount=count($row);
				?>
				<ul>
				<?php for($i=0; $i<$rowcount; $i++){?>
					<li style="width: 165px;">
						<a href="<?=$rf?>/governor/<?=$row[$i]['GovernorLink']?>">
							<?=$row[$i]['GovernorName'.$_SESSION['mayor_lang']]?>
						</a>
					</li>
				<?php }?>
				</ul>
	        </li>
	        
	    	<?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='104'")?>
	        <li class="nodiv"><a href="<?=$rf?>/<?=$row[0][1]?>/"><?=$row[0][0]?></a>
	        	<?php
					$qry="select * from mayor_chairman";
					$qry.=" where IsShow='YES'";
					$qry.=" order by ShowOrder";
					$row=$con->select($qry);
					$rowcount=count($row);
				?>
				<ul>
				<?php for($i=0; $i<$rowcount; $i++){?>
					<li style="width: 130px;">
						<a href="<?=$rf?>/chairman/detail/<?=$row[$i]['ChairmanID']?>/" style="width: 135;">
							<?=mb_substr($row[$i]['LastName'],0,1,'utf-8')?>.<?=$row[$i]['FirstName']?>
						</a>
					</li>
				<?php }?>
				</ul>
	        </li>
	        
	    	<?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='105'")?>
	        <li class="nodiv"><a href="<?=$rf?>/<?=$row[0][1]?>/"><?=$row[0][0]?></a>
	        	<?php
					$qry="select * from mayor_council";
					$qry.=" where IsShow='YES'";
					$qry.=" order by ShowOrder";
					$row=$con->select($qry);
					$rowcount=count($row);
				?>
				<ul>
				<?php for($i=0; $i<$rowcount; $i++){?>
					<li style="width: 165px;">
						<a href="<?=$rf?>/council/<?=$row[$i]['CouncilLink']?>/"><?=$row[$i]['CouncilName'.$_SESSION['mayor_lang']]?></a>
					</li>
				<?php }?>
				</ul>
	        </li>
	        
	        <?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='106'")?>
	        <li class="nodiv"><a href="<?=$rf?>/<?=$row[0][1]?>/"><?=$row[0][0]?></a>
	        <?php
				$qry="select * from mayor_newstype";
				$qry.=" where IsShow='YES'";
				$qry.=" order by ShowOrder";
				$row=$con->select($qry);
				$rowcount=count($row);
			?>
				<ul>
				<?php for($i=0; $i<$rowcount; $i++){?>
					<li style="width: 130px;">
						<a href="<?=$rf?>/news/<?=$row[$i]['NewsTypeLink']?>" ><?=$row[$i]['NewsTypeName'.$_SESSION['mayor_lang']]?></a>
					</li>
				<?php }?>
				</ul>
	        </li>
	        	        
	   <!-- <?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='107'")?>
	        <li class="nodiv"><a href="<?=$rf?>/<?=$row[0][1]?>/" style="border: 0px;"><?=$row[0][0]?></a></li>  -->
	        
	        <?php $row=$con->select("select TopMenuName".$_SESSION['mayor_lang'].", TopMenuLink from mayor_webtopmenu where TopMenuID='109'")?>
	        <li class="nodiv" style="padding-right: 0"><a href="<?=$rf?>/<?=$row[0][1]?>/" style="border: 0px;"><?=$row[0][0]?></a>
        	<?php
				$qry="select * from mayor_nzdtgabout";
				$qry.=" where IsShow='YES'";
				$qry.=" order by ShowOrder";
				$row=$con->select($qry);
				$rowcount=count($row);
			?>
				<ul>
				<?php for($i=0; $i<$rowcount; $i++){?>
					<li style="width: 130px;">
						<a href="<?=$rf?>/nzdtg/about/<?=$row[$i]['AboutID']?>" ><?=$row[$i]['AboutName'.$_SESSION['mayor_lang']]?></a>
					</li>
				<?php }?>
	       	
	    </ul>
	    <div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
	var dropdown=new TINY.dropdown.init("dropdown", {id:'menu', active:'menuhover'});
</script>