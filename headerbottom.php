<div class="container">
	<div style="position:relative;">
		<div id="slider">
			<ul>				
				<li><img src="uploads/ub1.jpg" alt="image description"/></li>
				<li><img src="uploads/ub2.jpg" alt="image description"/></li>
				<li><img src="uploads/ub3.jpg" alt="image description"/></li>	
			</ul>
		</div>
	</div>
</div><!-- /container -->

<div class="container">
	<div id="newsline">
		<?php
			$qry="select NewsID, Title, NewsDate"; 
			$qry.=" from tbl_news";
			$qry.=" where IsShow='YES'";
			//$qry.=" and NewsDate=DATE_FORMAT(NOW(), '%Y-%m-%d')";
			$qry.=" order by NewsDate desc, CreateDate desc";
			$qry.=" limit 50";
			//echo $qry; exit;
			$row=$con->select($qry);
			$rowcount=count($row);
			
			$j=0;
			while ($j<$rowcount){
		?>
			    <div><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>"><?=GetStrBr($row[$j]['Title'], "100");?>. [<?=$row[$j]['NewsDate'];?>]</a></div>
		<?php
			$j++;
			}
		?>
	</div>
</div><!-- /container -->