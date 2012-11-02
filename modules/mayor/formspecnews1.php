<script type="text/javascript">
	$(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
		$('#gallery').gallery({
		    interval: 5500,
		    width: '496px',
		    height: '320px'
		    //toggleBar: false
		  });
	});
</script>

<div style="margin-top: 10px;">
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
		$qry.=" limit 0, 8";
		$row=$con->select($qry);
		$rowcount=count($row);
		if($rowcount>0){
	?>
		<div id="gallery" class="gallery" style="border: 1px solid #dcdcdc;;">		
		  <ul class="galleryBar">
			<?php for($i=0; $i<$rowcount; $i++){?>
		    <li><a href="<?=$rfo?>/files/news/medium/<?=$row[$i]['ImageSource']?>" rel="spec<?=$i?>" title=""><img src="<?=$rfo?>/files/news/small/<?=$row[$i]['ImageSource']?>" title="" height="40" style="border: 0" /></a></li>
		    <?php }?>
		  </ul>
		</div>
		<?php for($i=0; $i<$rowcount; $i++){
			$link="$rf/news/dailynews/detail/".$row[$i]['NewsID']."/";
		?>
		<div id="spec<?=$i?>" style="display:none;">
		  <a href="<?=$link?>" class="speclink" target="_blank"><?=$row[$i]['Title']?></a><br/>
		  <a href="<?=$link?>" class="speca" style="text-align: justify"  target="_blank">
		  	<?php if(!empty($row[$i]['Intro'])){?>
		  		<?=GetStrBr(strip_tags($row[$i]['Intro']), 200);?>
		  	<?php }else{?>
				<?=GetStrBr(strip_tags($row[$i]['Descr']), 200);?>
			<?php }?>
		  </a>
		</div>
		<?php }?>
	<?php }?>
</div>