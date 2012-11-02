<script type="text/javascript">
	var newscontabbefore="newscon1";
	var newsconmenubefore="newscontab1";
	var newscontab,newsconmenu;
	function shownewscontab(id){
		newscontab="newscon"+id;
		newsconmenu="newscontab"+id;
		document.getElementById(newscontabbefore).style.display="none";		
		document.getElementById(newscontab).style.display="block";

		document.getElementById(newsconmenubefore).className="";
		document.getElementById(newsconmenu).className="here";		

		newsconmenubefore=newsconmenu;
		newscontabbefore=newscontab;
	}
</script>
<div style="margin-top: 10px; margin-left: 10px; height: 597px;">
	<ul id="globalnav">
		<li><a style="cursor: pointer;" id="newscontab1" onclick="shownewscontab('1');" class="here">Мэдээ</a></li>
		<li><a style="cursor: pointer;" id="newscontab2" onclick="shownewscontab('2');">Илтгэл, хэлсэн үг</a></li>
		<li><a style="cursor: pointer;" id="newscontab3" onclick="shownewscontab('3');">Хэвлэлийн тойм</a></li>
	</ul>
	<div style="height: 593px;">
		<div id="newscon1" style="display: block; padding: 5px; height: 95%; overflow: auto;">		
			<ul style="margin: 0; padding: 0">			
	<?php
		$qry="select T.*, DATE_FORMAT(T.NewsDate,'%Y-%m-%d') as date";
		$qry.=" from tbl_news T";
		$qry.=" left join tbl_newsorgan N";
		$qry.=" on T.NewsID = N.NewsID";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and N.OrganID='".MAYORID."'";
		$qry.=" group by T.NewsID";
		$qry.=" order by T.NewsDate desc, T.CreateDate desc";
		$qry.=" limit 0, 10";
		$row=$con->select($qry);
		$rowcount=count($row);
		
		$j=0;
		while ($j<$rowcount){
			$link="$rf/news/dailynews/detail/".$row[$j]['NewsID']."/";
		?>
			
				<li style="padding: 5px; list-style: none;">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
		<?php
		$imagesource=$drfo."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){
			$imagesource=$rfo."/files/news/xsmall/".$row[$j]['ImageSource']; 
		?>
			<a href="<?=$link?>" title="<?=$row[$j]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="80" height="50" style="border: 1px solid #dddddd; padding: 2px"></a><br/>
		<?php }?>				
					</div>
					<div style="font-size: 12px; line-height: 12px"><a href="<?=$link?>" class="nonestyle" style="font-size: 13px; color: #244d79;"><?=GetStrBr(strip_tags($row[$j]['Title']), "80");?></a></div>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					<?php
					if(empty($row[$j]['Intro'])){
					?>
					<div class="descr" style="font-size: 11px;"><?=GetStrBr($row[$j]['Intro'], "165");?><div>
					<?php }else{?>
                                                <div class="descr" style="font-size: 11px; border-bottom: 1px solid #ddd; border-bottom-style: dotted;"><?=GetStrBr(strip_tags($row[$j]['Descr']), "165");?><div>
					<?php }?>
					<div class="clear"></div>
				</li>
		<?php $j++;}?>
			</ul>
		</div>

		
		<div id="newscon2" style="display: none; padding: 5px; height: 95%; overflow: auto;">
			<ul style="margin: 0; padding: 0">	
		<?php
			$qry="select T.SpeechID, T.Title, T.Descr, T.ImageSource, DATE_FORMAT(T.SpeechDate,'%Y-%m-%d') as date";
			$qry.=" from tbl_speech T";
			$qry.=" where T.IsShow='YES'";
			$qry.=" and T.OrganID='".MAYORID."'";
			$qry.=" order by T.SpeechDate desc, T.CreateDate desc";
			$qry.=" limit 0, 10;";
			$row=$con->select($qry);
			$rowcount=count($row);
			
			$j=0;
			while ($j<$rowcount){
				$link="$rf/news/speech/detail/".$row[j]['SpeechID']."/";
			?>
				
					<li style="padding: 5px; list-style: none;">
						<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
			<?php
			$imagesource=$drfo."/files/speech/xsmall/".$row[$j]['ImageSource'];
			if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){
				$imagesource=$rfo."/files/speech/xsmall/".$row[$j]['ImageSource']; 
			?>
				<a href="<?=$link?>" title="<?=$row[$j]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="80" height="50" style="border: 1px solid #dddddd; padding: 2px"></a><br/>
			<?php }?>				
						</div>
						<div style="font-size: 12px; line-height: 12px"><a href="<?=$link?>" class="nonestyle" style="font-size: 13px; color: #244d79;"><?=GetStrBr(strip_tags($row[$j]['Title']), "80");?></a></div>
						<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['date'];?></span>
                                                <div class="descr" style="font-size: 11px; border-bottom: 1px solid #ddd; border-bottom-style: dotted;"><?=GetStrBr(strip_tags($row[$j]['Descr']), "165");?><div>
						<div class="clear"></div>
					</li>
			<?php $j++;}?>
				</ul>
		</div>
		
		<div id="newscon3" style="display: none; padding: 5px; height: 95%; overflow: auto;">
			<ul style="margin: 0; padding: 0">	
		<?php
			$qry="select PublicationNewsID, Title, Descr, ImageSource, DATE_FORMAT(PublicationNewsDate,'%Y-%m-%d') as date"; 
			$qry.=" from tbl_publicationnews";
			$qry.=" where IsShow='YES'";
			$qry.=" and OrganID='".MAYORID."'";
			$qry.=" order by PublicationNewsDate desc, CreateDate desc";
			$qry.=" limit 0, 10";
			$row=$con->select($qry);
			$rowcount=count($row);
			
			$j=0;
			while ($j<$rowcount){
				$link="$rf/news/publicationnews/detail/".$row[$j]['PublicationNewsID']."/";
				?>
					
						<li style="padding: 5px; list-style: none;">
							<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
				<?php
				$imagesource=$drfo."/files/publication/xsmall/".$row[$j]['ImageSource'];
				if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){
					$imagesource=$rfo."/files/publication/xsmall/".$row[$j]['ImageSource']; 
				?>
					<a href="<?=$link?>" title="<?=$row[$j]['Title'];?>"><img alt="" src="<?=$imagesource;?>" width="80" height="50" style="border: 1px solid #dddddd; padding: 2px"></a><br/>
				<?php }?>				
							</div>
							<div style="font-size: 12px; line-height: 12px"><a href="<?=$link?>" class="nonestyle" style="font-size: 13px; color: #244d79;"><?=GetStrBr(strip_tags($row[$j]['Title']), "80");?></a></div>
							<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['date'];?></span>
							<div class="descr" style="font-size: 11px; border-bottom: 1px solid #ddd; border-bottom-style: dotted;"><?=GetStrBr(strip_tags($row[$j]['Descr']), "165");?><div>
							<div class="clear"></div>
						</li>
				<?php $j++;}?>
				</ul>
		</div>
		
	</div>
</div>
<div style="clear: both;"></div>