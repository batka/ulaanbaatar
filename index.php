<?php
	require_once 'libraries/connect.php';
	$con = new Database ( );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php
	require_once 'headerstyle.php';
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29342417-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>

<header>
	<?php require_once 'header.php';?>
	<?php require_once 'headerbottom.php';?>
</header>

<div class="container">
<div id="wrap">

<div class="rlpadhome">

<div class="spacer10"></div>

<!-- <ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Library</a> <span class="divider">/</span></li>
  <li class="active">Data</li>
</ul> -->

<div class="row-fluid">
  <div class="span4" style="min-height:500px;">
	  <div class="page-header">
	  <h3>ТОП МЭДЭЭ <small></small></h3>
	  </div>
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab1" data-toggle="tab">Нийслэл</a></li>
		    <li><a href="#tab2" data-toggle="tab">Агентлаг</a></li>
		    <li><a href="#tab3" data-toggle="tab">Дүүрэг</a></li>
		  </ul>
		  <div class="tab-content">
<div class="tab-pane active" id="tab1">
		    
		    <ul style="margin: 0; padding: 0">			
			<?php
				$qry="select T.*";
				$qry.=" from tbl_news T";
				$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
				$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
				$qry.=" where T.IsShow='YES'";
				if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
				if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
				if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
				$qry.=" and OrganClassID='101'";
				$qry.=" order by T.NewsDate desc, T.CreateDate desc";
				$qry.=" limit 0, 3";
				$row=$con->select($qry);
				$rowcount=count($row);
				
				$j=0;
				while ($j<$rowcount){
			?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
			</ul>
			</div>
		    
<div class="tab-pane" id="tab2">
		      <?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
	$qry.=" and OrganClassID='103'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 3";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
		    </div>
<div class="tab-pane" id="tab3">
		      <?php
	$qry="select T.*";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	if(!empty($spec[0]))$qry.=" and T.NewsID != '".$spec[0]."'";
	if(!empty($spec[1]))$qry.=" and T.NewsID != '".$spec[1]."'";
	if(!empty($spec[2]))$qry.=" and T.NewsID != '".$spec[2]."'";
	$qry.=" and OrganClassID='102'";
	$qry.=" order by T.NewsDate desc, T.CreateDate desc";
	$qry.=" limit 0, 3";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
<?php
		$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
		if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
			$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
<?php
		} 
?>
					<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h4><a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a></h4>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
<?php
	$j++;
	} 
?>
		    </div>
		  </div>
		</div>
  </div>
  
  
  
  
  
  

  <div class="span8">
	  <div class="page-header">
	  <h3>НЭЭЛТТЭЙ МЭДЭЭЛЭЛ <small></small></h3>
	  </div>
	  
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab4" data-toggle="tab">Тендэр</a></li>
		    <li><a href="#tab5" data-toggle="tab">Төсөл хөтөлбөр</a></li>
		    <li><a href="#tab6" data-toggle="tab">Захирамж</a></li>
		    <li><a href="#tab7" data-toggle="tab">Нийслэлийн шуурхай</a></li>
		  </ul>
		  <div class="tab-content">
<div class="tab-pane active" id="tab4">
		      <?php require_once 'hometender.php';?>
		    </div>
<div class="tab-pane" id="tab5">
		      <?php
					$qry="select *";
					$qry.=" from tbl_pro";
					$qry.=" where IsShow='YES'";
					$qry.=" order by CreateDate desc";
					$qry.=" limit 0, 10";
					//echo $qry; exit;
					$row2=$con->select($qry);
					$rowcount2=count($row2);
				?>
				<table cellpadding="5" cellspacing="1" width="100%" class="legal">
				<tr align="center">
					<th>№</th>
					<th>Төсөл, хөтөлбөрийн нэр</th>
					<th width="15%">Хэрэгжих хугацаа</th>
				</tr>
				<?php 
					$j2=0;
					while($j2<$rowcount2){
				?>
				<tr>
					<td width="1%" ><?=$j2+1;?>.</td>
					<td valign="top"><a href="<?=$rf;?>/pro/detail/<?=$row2[$j2]['ProID'];?>" title="<?=$row2[$j2]['ProName'];?>"><?=GetStrBr($row2[$j2]['ProName'], 80);?></a></td>
					<td align="center"><?=$row2[$j2]['ContinueTime'];?></td>
				</tr>
				<?php
					$j2++;
					} 
				?>
				</table>
				<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/pro" style="color: #16387c">илүү &raquo;</a></p>
		    </div>
<div class="tab-pane" id="tab6">
		      <?php
					$qry="select LawRuleID, LawRuleDate, StartDate, Title, OrganName,LawRuleNo";
					$qry.=" from tbl_lawrule T";
					$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
					$qry.=" where T.IsShow='YES'";
					$qry.=" and T.IsPublic='YES'";
					$qry.=" order by T.LawRuleDate desc,T.LawRuleNo desc";
					$qry.=" limit 0, 6";
					$row1=$con->select($qry);
					$rowcount1=count($row1);
				?>           	
				<table cellpadding="5" cellspacing="0" width="100%" class="legal">
				<tr align="center">
					<th width="1%">№</th>
					<th width="10%" nowrap="nowrap">Дугаар</th>
					<th width="8%">Батлагдсан огноо</th>
					<th width="35%">Байгууллага</th>
					<th>Захирамжийн нэр</th>
					
				</tr>
				<?php 
					$j1=0;
					while($j1<$rowcount1){
						if($j1%2==0) $bgclass="row1";
						else $bgclass="row2";
				?>
				<tr class="<?=$bgclass;?>">
					<td ><?=$j1+1;?>.</td>
					<td align="center"><?=$row1[$j1]['LawRuleNo'];?></td>
					<td align="center"><?=$row1[$j1]['LawRuleDate'];?></td>
					<td align="center"><?=$row1[$j1]['OrganName'];?></td>
					<td valign="top"><a href="<?=$rf;?>/lawrule/detail/<?=$row1[$j1]['LawRuleID'];?>" title="<?=$row1[$j1]['Title'];?>"><?=GetStrBr($row1[$j1]['Title'], 80);?></a></td>
				</tr>
				<?php
					$j1++;
					} 
				?>
				</table>
				<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/lawrule" style="color: #16387c">илүү &raquo;</a></p>
		    </div>
<div class="tab-pane" id="tab7">
		      <?php
					$qry="select *";
					$qry.="from mayor_councilpromptness";
					$qry.=" where IsShow='YES'";
					$qry.=" order by CreateDate desc";
					$qry.=" limit 0, 10";
					$row=$con->select($qry);
					$rowcount=count($row);
				?>
					<table cellpadding="5" cellspacing="1" width="100%" class="legal">
					<tr align="center">
						<th width="1%">№</th>
						<th width="13%">Огноо</th>
						<th>Нийслэлийн шуурхай</th>
						<th width="10%">Биелэлт</th>
					</tr>
				<?php 
					$j=0;
					while($j<$rowcount){
				?>
					<tr>
						<td><?=$j+1;?>.</td>
						<td align="center"><?=$row[$j]['PromptDate'];?></td>
						<td align="left"><a href="<?=$rf;?>/prompt/detail/<?=$row[$j]['CouncilPromptnessID'];?>"><?=$row[$j]['Title'];?></a></td>
						<td align="center">
							<?php if(!empty($row[$j]['Descr1'])){?>
							<img src="<?=$rf;?>/images/web/morefile.png" style="float: left;">
							<a href="<?=$rf;?>/prompt/detail/<?=$row[$j]['CouncilPromptnessID'];?>#execution" title="<?=$row[$j]['Title'];?>">биелэлт</a>
							<?php }?>
						</td>
					</tr>
				<?php
					$j++;	
					} 
				?>
					</table>
					<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/prompt" style="color: #16387c;">илүү &raquo;</a></p>
		    </div>
		  </div>
		</div>
  </div>
</div>
</div><!-- /rlpadhome -->



<div class="banner">
<a href="http://www.ulaanbaatar.mn/files/editor/101/files/Newidea.docx"><img src="/uploads/banner01.jpg"/></a>
</div>



<div class="rlpadhome">
<div class="row-fluid">
  <div class="span4"  style="min-height:380px;">
	  <div class="page-header">
	  <h3>ТӨРИЙН ҮЙЛЧИЛГЭЭ <small></small></h3>
	  </div>
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab8" data-toggle="tab">Лавлагаа мэдээлэл</a></li>
		    <li><a href="#tab9" data-toggle="tab">Цахим үйлчилгээ</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab8">
		      <?php
					$qry="select ServiceClassID, ServiceClassName";
					$qry.=" from ref_serviceclass";
					$qry.=" where IsShow='YES'";
					$qry.=" order by ShowOrder";
					$row=$con->select($qry);
					$rowcount=count($row);
				
					$j=0;
					while ($j<$rowcount-6) {
						
				?>
				<div style="width: 341px; float: left; margin-bottom: 10px; margin-left: 20px;">
					<table cellpadding="0" cellspacing="0" width="100%" border="0">
						<tr>
							<td width="40">
								<img src="<?=$rf;?>/images/icon/32x32/<?=$row[$j]['ServiceClassID'];?>.png" style="float: left; margin-right: 5px" width="30"/>
							</td>
							<td>
								<a href="<?=$rf;?>/service/<?=$row[$j]['ServiceClassID'];?>" style="line-height: 17px; font-size: 12px; font-weight: bold; color: #16387c;">
									<?=$row[$j]['ServiceClassName'];?>
								</a>
							</td>
						</tr>	
					</table>
				</div>
				<?php if(($j+1)%2==0){?>
				<div style="clear: both;"></div>
				<?php }?>
				<?php
					$j++;
					}
				?>
		    </div>
		    <div class="tab-pane" id="tab9">
		    	<?php 
			    	while ($j<$rowcount) {
						
				?>
				<div style="width: 341px; float: left; margin-bottom: 10px; margin-left: 20px;">
					<table cellpadding="0" cellspacing="0" width="100%" border="0">
						<tr>
							<td width="40">
								<img src="<?=$rf;?>/images/icon/32x32/<?=$row[$j]['ServiceClassID'];?>.png" style="float: left; margin-right: 5px" width="30"/>
							</td>
							<td>
								<a href="<?=$rf;?>/service/<?=$row[$j]['ServiceClassID'];?>" style="line-height: 17px; font-size: 12px; font-weight: bold; color: #16387c;">
									<?=$row[$j]['ServiceClassName'];?>
								</a>
							</td>
						</tr>	
					</table>
				</div>
				<?php if(($j+1)%2==0){?>
				<div style="clear: both;"></div>
				<?php }?>
				<?php
					$j++;
					}
		    	?>
		    </div>
		  </div>
		</div>
  </div>
  
  <div class="span8">
	  <div class="page-header">
	  <h3>БИД ТАНЫГ СОНСОЖ БАЙНА <small></small></h3>
	  </div>
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab10" data-toggle="tab">Өрөгдөл санал гомдлын систем</a></li>
		    <li><a href="#tab11" data-toggle="tab">Call center</a></li>
		    <li><a href="#tab12" data-toggle="tab">Хэлэлцүүлэг</a></li>
		    <li><a href="#tab13" data-toggle="tab">Санал хүсэлт</a></li>
		  </ul>
		  <div class="tab-content">
<div class="tab-pane active" id="tab10">
		      <div class="ub1234">
		      <h1 style="color:#00A1E0;">Улаанбаатар сонсож байна</h1>
		      <h3 style="color:#999;">www.ub1234.mn</h3>
		      <a href="http://ub1234.mn/" target="_blank"><p>Энд дарж нэвтрэнэ үү</p></a>
		      </div>
		    </div>
<div class="tab-pane" id="tab11">
				<div class="ub1234">
			      <h1 style="color:#00A1E0;">Ulaanbaatar Call Center</h1>
			      <h3 style="color:#999;">Салбар байгууллагууд мэдээллээ өгөх заавар</h3>
			      <a href="http://www.ulaanbaatar.mn/files/editor/101/files/UlaanbaatarCallCenter.xlsx"><p>Энд дарж татаж авна уу</p></a>
			    </div>
		    </div>
<div class="tab-pane" id="tab12">
		      <?php
		$isshowpage="";
		$showpagestep=10;
	
		$showcount=$_POST['showcount'];
		if(empty($showcount)){
			$showcount=5;
			$_SESSION['uni_showcountselect']=$showcount;
		} else $_SESSION['uni_showcountselect']=$showcount;
		$showpagecount=7;
		
		$qrywhr =" where T.IsShow='YES'";
		if(!empty($forumclassid))$qrywhr.=" and T.ForumClassID='$forumclassid'";
		if(!empty($forumtopictype)) $qrywhr.=" and T.ForumTopicType='$forumtopictype'";
	
		$qry="select CEILING(count(*)/$showcount), count(*)";
		$qry.=" from tbl_forumtopic T";
		$qry.=$qrywhr;
		$row=$con->select($qry);
		$pagecount=$row[0][0];
		$rowcount=$row[0][1];
		
		if(empty($_GET['activepage']) || $_GET['activepage']==0) $activepage=1;
		else $activepage=$_GET['activepage'];
		$startrow=($activepage-1)*$showcount;
		if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
		
		$qry="select T.*,";
		$qry.=" DATE_FORMAT(T.CreateDate, '%H:%i, %Y оны %m-р сарын %d') as ForumTopicDate1,";
		$qry.=" IF(DATEDIFF(NOW(),T.CreateDate)<=7,1,0) as IsNew,";
		$qry.=" ifnull(WorthCount,0) as WorthCount, ifnull(NoWorthCount,0) as NoWorthCount";
		$qry.=" from tbl_forumtopic T";
		$qry.=" left join (select ForumTopicID, count(*) as WorthCount from tbl_forumtopicrate where RatingType='worth' group by ForumTopicID) FTR1 on T.ForumTopicID=FTR1.ForumTopicID";
		$qry.=" left join (select ForumTopicID, count(*) as NoWorthCount from tbl_forumtopicrate where RatingType='noworth' group by ForumTopicID) FTR2 on T.ForumTopicID=FTR2.ForumTopicID";
		$qry.=$qrywhr;
		$qry.=" group by T.ForumTopicID";
		$qry.=" order by T.CreateDate desc";
		$qry.=" limit $startrow, $showcount";
		$row=$con->select($qry);
		$rowcountpage=count($row);
		if($rowcountpage<1){
			$msg="Одоохондоо сэдэв оруулаагүй байна!"
	?>
			
			<tr><td colspan="1" class="s" align="center"><?=$msg;?></td></tr>
	<?php
		} else {
			$j=0;
			while($j<$rowcountpage){
				if($row[$j]['ForumTopicType']=='Discussion') $forumtopictype="Хэлэлцүүлэг";
				elseif($row[$j]['ForumTopicType']=='Question') $forumtopictype="Асуулт";
				elseif($row[$j]['ForumTopicType']=='Survey') $forumtopictype="Судалгаа";
				$recordcount=$con->GetDescr("select count(*) from tbl_forumpost where ForumTopicID='".$row[$j]['ForumTopicID']."'");
				$page=ceil($recordcount/20);
				$fullname=$row[$j]['FirstName'];
	?>
			<li style="border-bottom:1px solid #f2f2f2; list-style:none; margin-bottom:10px;">
			<tr<?php if($j%2!=0){ ?> class="listbg"<?php } ?>>
				<td>
					<a href="<?=$rf_forum.'/topic/'.$row[$j]['ForumClassID']."/".$row[$j]['ForumTopicID'];?>">
						<?=$row[$j]['Title'];?></a>
					
					<br>
					<div class="remark">
						оруулсан <a href="<?=$rf;?>/<?=$row[$j]['MemberID'];?>"><?=$fullname;?></a>
	                    <?=$row[$j]['ForumTopicDate1'];?>
					</div>
				</td>
				
			</tr>
			</li>
	<?php
				$j++;
			}
		}
	?>
		    </div>
<div class="tab-pane" id="tab13">
		      <div class="ub1234">
		      <h1 style="color:#00A1E0;">Улаанбаатар сонсож байна</h1>
		      <h3 style="color:#999;">ӨРГӨДӨЛ ГОМДОЛ ГАРГАХ</h3>
		      <a href="http://ub1234.mn/login.php?tsk=compose&type=2" target="_blank"><p>Энд дарж нэвтрэнэ үү</p></a>
		      </div>
		    </div>
		  </div>
		</div>
  </div>
</div>
</div><!-- /rlpadhome -->



<div class="divide"></div>



<div class="rlpadhome">
<div class="row-fluid">
  <div class="span4"  style="min-height:340px;">
	  <div class="page-header">
	  <h3>БҮТЭЭН БАЙГУУЛАЛТ <small></small></h3>
	  </div>
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab14" data-toggle="tab">Видео мэдээ</a></li>
		    <li><a href="#tab15" data-toggle="tab">Дүрстэй мэдээ</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab14">
		      <?php require_once 'homevideo.php';?>
		    </div>
		    <div class="tab-pane" id="tab15">
		      <?php require_once 'homephotonews.php';?>
		    </div>
		  </div>
		</div>
  </div>
  
  <div class="span4">
	  <div class="page-header">
	  <h3>ХЭВЛЭЛИЙН ТОЙМ <small></small></h3>
	  </div>
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab16" data-toggle="tab">Мэдээ</a></li>
		    <li><a href="#tab17" data-toggle="tab">Илтгэл, хэлсэн үг</a></li>
		    <li><a href="#tab18" data-toggle="tab">Хэвлэлийн тойм</a></li>
		  </ul>
		  <div class="tab-content">
			<div class="tab-pane active" id="tab16">
		    	<?php
					$qry="select *";
					$qry.=" from tbl_news";
					$qry.=" where IsShow='YES'";
					if(!empty($spec[0]))$qry.=" and NewsID != '".$spec[0]."'";
					if(!empty($spec[1]))$qry.=" and NewsID != '".$spec[1]."'";
					if(!empty($spec[2]))$qry.=" and NewsID != '".$spec[2]."'";
					$qry.=" order by NewsDate desc, CreateDate desc";
					$qry.=" limit 0, 2";
					$row=$con->select($qry);
					$rowcount=count($row);
					
					$j=0;
					while ($j<$rowcount){
				?>
			
				<li style="padding: 5px; margin-bottom: 5px; list-style: none; background: #fafafc; border-top: 2px solid #e8edf0">
					<div style="float: left; margin-right: 5px; text-align: center; line-height: 1.1em">
						<?php
							$imagesource=$drf."/files/news/xsmall/".$row[$j]['ImageSource'];
							if (!empty($row[$j]['ImageSource']) && file_exists($imagesource)){ 
								$imagesource=$rf."/files/news/xsmall/".$row[$j]['ImageSource']; 
						?>
						<img alt="" src="<?=$imagesource;?>" width="80" style="border: 1px solid #c5ced7; padding: 2px"><br/>
						<?php
							} 
						?>
						<span style="font-size: 10px; color: #999">Огноо: <?=$row[$j]['NewsDate'];?></span>
					</div>
					<h5>
						<a href="<?=$rf;?>/news/detail/<?=$row[$j]['NewsID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr($row[$j]['Title'], "35");?></a>
					</h5>
					<p><?=GetStrBr($row[$j]['Intro'], "70");?></p>
					<div class="clear"></div>
				</li>
				<?php
						$j++;
					} 
				?>
		    </div>
			<div class="tab-pane" id="tab17">
		    	<?php require_once 'homespeech.php';?>
		    </div>
			<div class="tab-pane" id="tab18">
		    	<?php require_once 'homepublicationnews.php';?>
		    </div>
		  </div>
	  </div>
  </div>
  
  <div class="span4">
	  <div class="page-header">
	  <h3>БАЙГУУЛЛАГУУД <small></small></h3>
	  </div>
	  <div class="tabbable"> <!-- Only required for left/right tabs -->
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#tab19" data-toggle="tab">Веб хуудас</a></li>
		    <li><a href="#tab20" data-toggle="tab">Үйл явдал</a></li>
		  </ul>
		  <div class="tab-content">
		    <div class="tab-pane active" id="tab19">
		      <?php require_once 'nzb.php';?>
		    </div>
		    <div class="tab-pane" id="tab20">
		      <?php require_once 'homeevent.php';?>
		    </div>
		  </div>
		</div>
  </div>
</div>

</div><!-- /rlpadhome -->



<div class="spacer20"></div>
</div><!-- /wrap -->
</div><!-- /container -->

<?php require_once 'footer.php';?>

<?php
	require_once 'footerjs.php';
?>
</body>
</html>