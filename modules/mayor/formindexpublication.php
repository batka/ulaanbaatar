<div>
	<ul id="globalnav">
		<li><a class="here">Хэвлэлийн тойм</a></li>
	</ul>
	<div style="height: 150px; border: 1px solid #dcdcdc; background: #fff;">
		<div style="display: block; padding: 5px; height: 97.5%; overflow: auto;">
		<?php
			$qry="select PublicationNewsID, Title, Descr"; 
			$qry.=" from tbl_publicationnews";
			$qry.=" where IsShow='YES'";
			$qry.=" and OrganID='".MAYORID."'";
			$qry.=" order by PublicationNewsDate desc, CreateDate desc";
			$qry.=" limit 0, 1";
			$row=$con->select($qry);
			$rowcount=count($row);
			
			if($rowcount>0){
				$link="$rf/news/publicationnews/detail/".$row[0]['PublicationNewsID']."/";
			?>
			<div style="line-height: 13px; margin-bottom: 3px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79; font-size: 12px;">
				<?=asuUniConvert($row[0]['Title']);?>: 
			</a></div>
			<div style="color: #244d79; font-size: 11px; text-align: left; line-height: 13px">
				<span style="color: #000;"><?=GetStrBr(strip_tags($row[0]['Descr']), 250);?></span>
			</div>
			<?php
			}else{?>
				<div class="notice"><?=$strnotfound?></div>
			<?php }?>
		</div>		
	</div>
</div>