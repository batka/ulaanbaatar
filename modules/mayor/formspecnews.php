<script type="text/javascript" >
$(document).ready(function(){ 
 $('#sildercontent').suSlider({
 mode: 'fade',
 speed: 1000,
 select:12000,
 auto:true,
 wrapper_class: 'portfolio_container'
  }); 
});
</script>

<div style="margin-top: 10px;">
	<div id="silder">
		<div id="sildercontent">
			<?php
				$qry="select T.*, DATE_FORMAT(T.NewsDate,'%Y-%m-%d') as date";
				$qry.=" from tbl_news T";
				$qry.=" left join tbl_newsorgan N";
				$qry.=" on T.NewsID = N.NewsID";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and N.OrganID='".MAYORID."'";
				$qry.=" and T.IsSpecial='YES'";
				$qry.=" group by T.NewsID";
				$qry.=" order by T.NewsDate desc, T.CreateDate desc";
				$qry.=" limit 0, 10";
				$row=$con->select($qry);
				$rowcount=count($row);
				if($rowcount>0){
					for($i=0; $i<$rowcount; $i++){
					$link="$rf/news/dailynews/detail/".$row[$i]['NewsID']."/";
			?>
			
			<div class="silderitem">
				<div style="margin-bottom: 5px;">
					<a href="<?=$link?>" style="color: #244d79; font-size: 14px; text-decoration: none; font-weight: bold;"><?=GetStrBr($row[$i]['Title'], 90)?></a>
				</div>
				<?php
					$imagesource=$drfo."/files/news/medium/".$row[$i]['ImageSource'];
					if (!empty($row[$i]['ImageSource']) && file_exists($imagesource)){
						$imagesource=$rfo."/files/news/medium/".$row[$i]['ImageSource']; 
					?>
					<a href="<?=$link?>"><img src="<?=$imagesource?>" width="640" height="360"/></a>
				<?php }?>
				<div class="descr" style="width: 640px;">
					<?php if(!empty($row[$i]['Intro'])){?>
				  		<?=GetStrBr(strip_tags($row[$i]['Intro']), 180);?>
				  	<?php }else{?>
						<?=GetStrBr(strip_tags($row[$i]['Descr']), 180);?>
					<?php }?>
				</div>
			</div>
			<?php }}?>		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div id="sildernav">
			<ul id="slnav">
				<?php for($i=0; $i<$rowcount; $i++){?>
				<li class="slnav <?php if ($i==0) echo 'active'?>">
				    <img src="<?=$rfo?>/files/news/xsmall/<?=$row[$i]['ImageSource']?>"/>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
</div>