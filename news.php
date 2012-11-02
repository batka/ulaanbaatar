<?php 
	require_once 'lib/connect.php';
	$con = new Database();
?>
<!DOCTYPE html>
<html> 
<head> 
	<?php require_once 'headerjsstyle.php';?>	
</head> 

<body  >
<div data-role="page" id="page1">
    <div data-theme="a" data-role="header" data-position="fixed">
        <h3>
            Мэдээ
        </h3>
        <a data-theme="c" data-role="button" data-transition="none" href="./" data-icon="home" data-iconpos="left">
            Нүүр
        </a>
    </div>
    <div data-role="content">
    	<div style="padding: 10px;">
		<ul data-role="listview" data-inset="false" class="ui-content" data-theme="c" id="newslist">
			<?php 
				$qry="
					select Title, ImageSource, NewsID,
					CASE DATEDIFF(NOW(),NewsDate) WHEN 0 THEN DATE_FORMAT(NewsDate,'Өнөөдөр') WHEN 1 THEN DATE_FORMAT(NewsDate,'Өчигдөр') ELSE DATE_FORMAT(NewsDate,'%Y оны %m сарын %d') END as NewsDate1
					from tbl_news 
					where IsShow = 'YES'
					order by Newsdate desc
					limit 0,10
				";
				$row = $con->select($qry);
				$rowcount = count($row);
				for($i=0; $i<$rowcount; $i++){
			?>
           <li data-inline="true">
             <a href="<?=$rf;?>/newsdetail.php?newsid=<?=$row[$i]['NewsID'];?>" data-transition="none">
             	<?php if(!empty($row[$i]['ImageSource'])){?>
				<img src="../../files/news/small/<?=$row[$i]['ImageSource'];?>" />
				<?php }?>
				<p class="ui-li-desc" style="white-space:normal;">
					<strong><?=$row[$i]['Title'];?></strong> 
				</p>
				<div style="font-size: 10px; color: #296ac0;"><?=$row[$i]['NewsDate1'];?></div>
			 </a>
			</li>
			<?php }?>
         </ul>
         </div>
         <div align="center">
         	<a href="javascript:;" rel="1"  id="load" style="margin-top: 15px; height: 30px;" data-inline="false" data-role="button" data-mini="true" data-corners="true"  data-transition="fade"><img border="0" src="<?=$rf;?>/files/webimages/news_load_more.gif"></a>
         </div>
    </div>
<script type="text/javascript">
 	$(document).ready(function(){
 	 	$('#load').live('click',function(){
 	 	 	p = $(this).attr('rel');
// 	 	 	if(p>5)$('#load').hide();
 	 	 	$(this).attr('rel',parseInt(p)+1);
 	 		$.ajax({
 	 			type: "GET",
 	 			url: '<?=$rf;?>/processform.php?action=morenews&page='+p,
 	 			beforeSend: function(){
 	 				
 	 			},
 	 			success: function(html){
 	 				$('#newslist').append(html);
 	 				$('#newslist').listview('refresh');
 	 			}
 	 		});
 	 	});
 	});
 </script>
    <?php require_once 'footer.php';?>
</div>
</body>
</html>