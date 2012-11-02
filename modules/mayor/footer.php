<style type="text/css">
	.footnews{
		float: left;
		font-size: 11px;
		width: 326px;
	}
	.footnewshead{
		background-color: #eeeeee;
		font-weight: bold;
		padding-left: 10px;
		color: #666666;
		line-height: 25px;
		border-top-left-radius: 8px 8px;
		border-top-right-radius: 3px 3px;
		
		-moz-border-radius-topleft: 8px;
		-moz-border-radius-topright: 3px;
		
		-webkit-border-top-left-radius: 8px;
		-webkit-border-top-right-radius: 3px;
	}
	.footnews ul {
		padding-left: 20px;
		width: 300px;
	}
	.footnews ul li{
		list-style: disc;
		color: #eeeeee;
		padding-top: 3px;
		padding-bottom: 3px;
	}
	.footnews ul li a{
		color: #14385e;
		text-decoration: none;
	}
	.footnews ul li a:HOVER{
		text-decoration: underline;
	}
	.footer{
		padding-top: 0px !important;
		height: 25px !important;
		line-height: 9px !important;	
	
		border-bottom-left-radius: 8px 8px;
		border-bottom-right-radius: 8px 8px;
		
		-moz-border-radius-bottomleft: 8px;
		-moz-border-radius-bottomright: 8px;
		
		-webkit-border-bottom-left-radius: 8px;
		-webkit-border-bottom-right-radius: 8px;
		margin-bottom: 10px !important;
	}
</style>

<div style="margin: 10px auto; width: 1000px;">
	<div class="footnews">
		<div class="footnewshead">Цаг үеийн мэдээ</div>
		<ul>
			<?php
				$newsleng=8;
				$strbr=40;	
			
				$qry="select T.*, DATE_FORMAT(T.NewsDate,'%Y-%m-%d') as date";
				$qry.=" from tbl_news T";
				$qry.=" left join tbl_newsorgan N";
				$qry.=" on T.NewsID = N.NewsID";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and N.OrganID='".MAYORID."'";
				$qry.=" group by T.NewsID";
				$qry.=" order by T.NewsDate desc, T.CreateDate desc";
				$qry.=" limit 0, $newsleng";
				$row=$con->select($qry);
				$rowcount=count($row);
				for($i=0; $i<$rowcount; $i++){
				$link="$rf/news/dailynews/detail/".$row[$i]['NewsID']."/";
			?>
			<li><a href="<?=$link?>"><?=GetStrBr($row[$i]['Title'], $strbr)?></a></li>
			<?php }?>
		</ul>
	</div>
	<div class="footnews" style="margin-left: 10px;">
		<div class="footnewshead">Хэлсэн үг, илтгэл</div>
		<ul>
			<?php
				$qry="select T.*, DATE_FORMAT(T.SpeechDate,'%Y-%m-%d') as date";
				$qry.=" from tbl_speech T";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and T.OrganID='".MAYORID."'";
				$qry.=" order by T.SpeechDate desc, T.CreateDate desc";
				$qry.=" limit 0, $newsleng";
				$row=$con->select($qry);
				$rowcount=count($row);
				for($i=0; $i<$rowcount; $i++){
					$link="$rf/news/speech/detail/".$row[$i]['SpeechID']."/";
			?>
			<li><a href="<?=$link?>"><?=GetStrBr($row[$i]['Title'], $strbr)?></a></li>
			<?php }?>
		</ul>
	</div>
	<div class="footnews" style="margin-left: 10px;">
		<div class="footnewshead">Хэвлэлийн тойм</div>
		<ul>
			<?php
				$qry="select *, DATE_FORMAT(PublicationNewsDate,'%Y-%m-%d') as date from tbl_publicationnews";
				$qry.=" where IsShow='YES'";
				$qry.=" and OrganID='".MAYORID."'";
				$qry.=" order by PublicationNewsDate desc, CreateDate desc";
				$qry.=" limit 0, $newsleng";;
				$row=$con->select($qry);
				$rowcount=count($row);
				for($i=0; $i<$rowcount; $i++){
					$link="$rf/news/publicationnews/detail/".$row[$i]['PublicationNewsID']."/";
			?>
			<li><a href="<?=$link?>"><?=GetStrBr($row[$i]['Title'], $strbr)?></a></li>
			<?php }?>
		</ul>
	</div>
	<div class="clear"></div>
</div>

<div class="footer">
	<div style="margin: 10px; margin-top: 8px;">
		<div style="float: left"><?=$strFooterLeft?></div>
		<div style="float: right"><?=$strFooterRight?></div>
		<div class="clear"></div>
	</div>
</div>