<div style="margin: 0px 10px 0px 10px;">
	<ul id="globalnav">
		<li><a class="here">Хэлсэн үг, илтгэл</a></li>
	</ul>
	<div style="height: 150px; border: 1px solid #dcdcdc;  background: #fff;">
		<div style="display: block; padding: 5px; height: 97.5%; overflow: auto;">
		<?php
			$qry="select T.SpeechID, T.Title, T.Descr, T.ImageSource";
			$qry.=" from tbl_speech T";
			$qry.=" where T.IsShow='YES'";
			$qry.=" and T.OrganID='".MAYORID."'";
			$qry.=" order by T.SpeechDate desc, T.CreateDate desc";
			$qry.=" limit 0, 1;";
			$row=$con->select($qry);
			$rowcount=count($row);
			
			if($rowcount>0){
				$link="$rf/news/speech/detail/".$row[0]['SpeechID']."/";
			?>
			<?php if(!empty($row[0]['ImageSource']) && file_exists("$drfo/files/speech/small/".$row[0]['ImageSource'])){?>
				<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rfo?>/files/speech/small/<?=$row[0]['ImageSource']?>" width="120"/></a>
			<?php }?>
			<div style="line-height: 13px; margin-bottom: 3px;"><a href="<?=$link?>" class="nonestyle" style="color: #244d79; font-size: 12px;">
				<?=GetStrBr(asuUniConvert($row[0]['Title']), 100)?>
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