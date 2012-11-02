<?php
	$forumclassid=$_GET["forumclassid"];
	$forumid=$_GET["forumid"];
	$forumtopictype=$_GET["forumtopictype"];
	
	$pageFileName=$rf_forum."/topic/".$forumclassid."/".$forumid;
	if(!empty($forumtopictype)) $pageFileName.="/".$forumtopictype;
	$pageFormName='frmForumTopic';
	
	$qry="select T.*";
	$qry.=" from uni_frm_forum T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumID='$forumid'";
	$row=$con->select($qry);
	$j=0;
?>
<div id="simple">
	<div class="mainborder">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr>
				<td width="100%" nowrap="nowrap">
					<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="mainleftimage"></td>
						<td class="maincenterimage">
							<div class="mainpagetitle">
								<!--<a href="<?=$rf;?>/modules/profession/">Мэргэжил</a> &raquo; <span><?=$row[0]['ProfessionName'];?></span>
							-->
								<a href="<?=$rf;?>/forum/home/<?=$forumclassid;?>">
									<?php
										$qry="SELECT FC.*,U.ShortName as UniShortName, U.OhShortName,F.ShortName";
										$qry.=" from uni_frm_forumclass FC";
										$qry.=" left join uni_university U";
										$qry.=" on FC.UniversityID = U.UniversityID";
										$qry.=" left join uni_faculty F";
										$qry.=" on F.FacultyID = FC.FacultyID";
										$qry.=" where FC.IsShow = 'YES'";
										$qry.=" and ForumClassID = '$forumclassid'";
										$row1 = $con->select($qry);
										if($row1[0]['FacultyID']=="uni")echo $row1[0]['UniShortName'];
										elseif ($row1[0]['FacultyID']=="mox")echo $row1[0]['OhShortName'];
										else echo $row1[0]['ShortName'];
									?>
								</a>
								<span>&raquo;</span>
								<?=$row[$j]['ForumName'];?>
							</div>
						</td>
						<td class="mainrightimage"></td>
					</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div class="bottomtitlebrigth">
		<?=strip_tags($row[$j]['ForumIntro']);?>
	</div>
	<div class="bottomtitle">
<?php 
	$qry="select count(*)";
	$qry.=" from uni_frm_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumID='".$forumid."'";

	$qry1=$qry." and T.ForumTopicType='Discussion'";
	$topiccount=$con->GetDescr($qry1);
	
	$qry1=$qry." and T.ForumTopicType='Question'";
	$questioncount=$con->GetDescr($qry1);
	
	$qry1=$qry." and T.ForumTopicType='Survey'";
	$surveycount=$con->GetDescr($qry1);
?>
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>Хэлэлцүүлэг: <?=$topiccount;?>&nbsp;|&nbsp;Асуулт: <?=$questioncount;?>&nbsp;|&nbsp;Судалгаа: <?=$surveycount;?></td>
			<td align="right">
				<form name="managerTopic" id="managerTopicForm" method="post" action="#">
					<a href="javascript:void(0);" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Discussion";?>'); $('#managerTopicForm').submit();">Сэдэв тавих</a>&nbsp;|
					<a href="javascript:void(0);" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Question";?>'); $('#managerTopicForm').submit();">Асуулт асуух</a>&nbsp;|
					<a href="javascript:void(0);" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Survey";?>'); $('#managerTopicForm').submit();">Судалгаа авах</a>
				</form>
			</td>
		</tr>
		</table>
	</div>
	<div style="margin-top: 20px;"></div>
<?php 
	$tdspace=10;
?>
	<div class="subtab">
	    <table cellpadding="0" cellspacing="0" border="0" height="25" >
		<tr>
		<?php if(empty($forumtopictype)) $classname=""; else $classname="inactive";?> 
			<td class="<?=$classname;?>">
				<div class="tableft<?=$classname;?>"></div>
				<div class="tabcenter<?=$classname;?>">
					<a href="<?=$rf_forum."/topic/".$forumclassid."/".$forumid;?>" class="tabtitle">Бүх сэдвүүд</a>
				</div>
				<div class="tabright<?=$classname;?>"></div>
			</td>
			<td width="<?=$tdspace;?>"></td>
		<?php if($forumtopictype=="Question") $classname=""; else $classname="inactive";?> 
			<td class="<?=$classname;?>">
				<div class="tableft<?=$classname;?>"></div>
				<div class="tabcenter<?=$classname;?>">
					<a href="<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/Question";?>" class="tabtitle">Бүх асуултууд</a>
				</div>
				<div class="tabright<?=$classname;?>"></div>
			</td>
			<td width="<?=$tdspace;?>"></td>
		<?php if($forumtopictype=="Survey") $classname=""; else $classname="inactive";?>
			<td class="<?=$classname;?>">
				<div class="tableft<?=$classname;?>"></div>
				<div class="tabcenter<?=$classname;?>">
					<a href="<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/Survey";?>" class="tabtitle">Бүх судалгаанууд</a>
				</div>
				<div class="tabright<?=$classname;?>"></div>
			</td>
			<td width="<?=$tdspace;?>"></td>
		</tr>
		</table>
	    
	    <form id="<?=$pageFormName;?>" name="<?=$pageFormName;?>" method="post" action="<?=$pageFileName;?>">
	    <input type="hidden" id="showcount" name="showcount" value="<?=$_SESSION['uni_showcountselect'];?>">
		<div class="tabcontent" style="width: 100%;">
			<div class="list-f">
			<table border="0" cellpadding="0" cellspacing="1">
			<tbody>
	        <tr>
				<th width="48%">Сэдвийн нэр</th>
				<th width="40%">Сүүлийн бичлэг</th>
				<th width="12%">Үзсэн / Бичсэн</th>
			</tr>
	<?php
		$isshowpage="";
		$showpagestep=10;
	
		$showcount=$_POST['showcount'];
		if(empty($showcount)){
			$showcount=10;
			$_SESSION['uni_showcountselect']=$showcount;
		} else $_SESSION['uni_showcountselect']=$showcount;
		$showpagecount=7;
		
		$qrywhr =" where T.IsShow='YES'";
		$qrywhr.=" and T.ForumID='$forumid'";
		if(!empty($forumtopictype)) $qrywhr.=" and T.ForumTopicType='$forumtopictype'";
	
		$qry="select CEILING(count(*)/$showcount), count(*)";
		$qry.=" from uni_frm_forumtopic T";
		$qry.=$qrywhr;
//		echo $qry;
		
		$row=$con->select($qry);
		$pagecount=$row[0][0];
		$rowcount=$row[0][1];
		
		if(empty($_GET['activepage']) || $_GET['activepage']==0) $activepage=1;
		else $activepage=$_GET['activepage'];
		$startrow=($activepage-1)*$showcount;
		if($activepage==$pagecount) $showcount=$rowcount-$showcount*($activepage-1);
		
		$qry="select T.*,P.*, LEFT(UPPER(CONVERT( REPlACE(P.LastName,' ','') USING utf8)),1) as LName,";
		$qry.=" DATE_FORMAT(ForumTopicDate, '%H:%i, %Y оны %m-р сарын %d') as ForumTopicDate1,";
		$qry.=" IF(DATEDIFF(NOW(),ForumTopicDate)<=7,1,0) as IsNew,";
		$qry.=" ifnull(WorthCount,0) as WorthCount, ifnull(NoWorthCount,0) as NoWorthCount";
		$qry.=" from uni_frm_forumtopic T";
		$qry.=" left join uni_person P on P.PersonID=T.PersonID";
		$qry.=" left join (select ForumTopicID, count(*) as WorthCount from uni_frm_forumtopicrating where RatingType='worth' group by ForumTopicID) FTR1 on T.ForumTopicID=FTR1.ForumTopicID";
		$qry.=" left join (select ForumTopicID, count(*) as NoWorthCount from uni_frm_forumtopicrating where RatingType='noworth' group by ForumTopicID) FTR2 on T.ForumTopicID=FTR2.ForumTopicID";
		$qry.=$qrywhr;
		$qry.=" order by T.ForumTopicDate desc";
		$qry.=" limit $startrow, $showcount";
		$row=$con->select($qry);
		$rowcountpage=count($row);
		if($rowcountpage<1){
			$msg="Одоохондоо сэдэв оруулаагүй байна!"
	?>
			<tr><td colspan="3" class="s" align="center"><?=$msg;?></td></tr>
	<?php
		} else {
			$j=0;
			while($j<$rowcountpage){
				if($row[$j]['ForumTopicType']=='Discussion') $forumtopictype="Хэлэлцүүлэг";
				elseif($row[$j]['ForumTopicType']=='Question') $forumtopictype="Асуулт";
				elseif($row[$j]['ForumTopicType']=='Survey') $forumtopictype="Судалгаа";
				$recordcount=$con->GetDescr("select count(*) from uni_frm_forumreply where ForumTopicID='".$row[$j]['ForumTopicID']."'");
				$page=ceil($recordcount/10);
				$fullname=$row[$j]['LName'].".".$row[$j]['FirstName'];
	?>
			<tr<?php if($j%2!=0){ ?> class="listbg"<?php } ?>>
				<td>
					<a href="<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/".$row[$j]['ForumTopicID'];?>">
						<?=$row[$j]['ForumTopicName'];?></a>
					<span class="alert s">[<?=$forumtopictype;?>]</span>
					<?php if($row[$j]['IsNew']=="1"){ ?><img src="<?=$rf;?>/images/forum/icon_new.gif" title="Шинэ" width="24"><?php } ?>
	  			  	<?php if($row[$j]['WorthCount']>$row[$j]['NoWorthCount']){ ?><img src="<?=$rf;?>/images/forum/highly_rated.gif" title="Өндөр үнэлгээтэй" width="16"><?php } ?>
					<?php if($row[$j]['IsLocked']=="YES"){ ?><img src="<?=$rf;?>/images/forum/locked.gif" title="Түгжээтэй" width="16"><?php } ?>
					<br>
					<div class="remark">
						оруулсан <a href="#"><?=$fullname;?></a>
	                    <?=$row[$j]['ForumTopicDate1'];?>
					</div>
				</td>
				<td class="remark">
	<?php
				$qry="select T.*,P.*,LEFT(UPPER(CONVERT( REPlACE(P.LastName,' ','') USING utf8)),1) as LName,";
				$qry.=" DATE_FORMAT(ReplyDate, '%H:%i, %Y оны %m-р сарын %d') as ReplyDate1";
				$qry.=" from uni_frm_forumreply T";
				$qry.=" left join uni_person P on T.PersonID=P.PersonID";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and T.ForumTopicID='".$row[$j]['ForumTopicID']."'";
				$qry.=" order by T.ReplyDate desc";
				$qry.=" limit 0, 1";
				$row2=$con->select($qry);
				$rowcount2=count($row2);
				$j2=0;
				$fullname=$row2[$j2]['LName'].".".$row2[$j2]['FirstName'];
				if($rowcount2>0){
					if($row2[$j2]['IsStudent']=="YES"){
					 	$imagesource = $rf."/images/student/smallx/".$row2[$j2]['ImageSource'];
					 	$imagesource1 = $drf."/images/student/smallx/".$row2[$j2]['ImageSource'];
					 } else {
					 	$imagesource = $rf."/images/teacher/smallx/".$row2[$j2]['ImageSource'];
					 	$imagesource1 = $drf."/images/teacher/smallx/".$row2[$j2]['ImageSource'];
					 }
					 if(!file_exists($imagesource1)|| empty($row2[$j2]['ImageSource']))$imagesource=$rf."/images/forum/nophoto_man.gif";
					$lnk=$rf_forum."/topic/".$forumclassid."/".$forumid."/".$row[$j]['ForumTopicID']."/p/".$page."#last";
	?>
					<a href="#" title="<?=$row2[$j2]['FirstName'];?>"><img src="<?=$imagesource;?>" align="left" class="img" width="50"></a>
					<a href="<?=$lnk;?>">
		                <?=GetStrBr($row2[$j2]['Subject'],30);?>
	                </a>
	                <br>
					Oруулсан: <a href="#"><?=$fullname;?></a><br>
					<?=$row2[$j2]['ReplyDate1'];?>
	<?php
				}
	?>
				</td>
				<td class="s" align="center">
					<?=number_format($row[$j]['SawCount']);?> /
					<?=number_format($recordcount);?>
				</td>
			</tr>
	<?php
				$j++;
			}
		}
	?>
			</tbody>
	        </table>
			</div>
		</div>
	
		<div class="pageNav"><?php require '../../panelpagego.php'; ?></div>
		</form>
		<div style="float: right; clear: both;">
<!--	    <form name="managerTopic" id="managerTopicForm" method="post" action="#">-->
<!--	       <input value="Сэдэв тавих" type="button" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Discussion";?>'); $('#managerTopicForm').submit();">-->
<!--	       <input value="Асуулт асуух" type="button" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Question";?>'); $('#managerTopicForm').submit();">-->
<!--	       <input value="Судалгаа авах" type="button" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Survey";?>'); $('#managerTopicForm').submit();">-->
<!--	   </form>-->
		</div>
		<div style="clear: both;"></div>
		<br>
		<div class="greybg paddedbox12 s">
			<strong>Тэмдэглэгээ:</strong>
			<img src="<?=$rf;?>/images/forum/thread.gif" align="absmiddle"> Attached to top 
			<img src="<?=$rf;?>/images/forum/locked.gif" style="margin-left: 15px;" align="absmiddle"> Түгжээтэй сэдэв
			<img src="<?=$rf;?>/images/forum/recommended.gif" style="margin-left: 15px;" align="absmiddle"> Санал болгосон сэдэв
			<img src="<?=$rf;?>/images/forum/highly_rated.gif" style="margin-left: 15px;" align="absmiddle"> Өндөр үнэлгээтэй сэдэв
			<img src="<?=$rf;?>/images/forum/moderator.gif" style="margin-left: 15px;" align="absmiddle"> Хэлэлцүүлгийг удирдагч
		</div>	
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.inactive').hover(function(){
		$('.tableftinactive',this).attr('class','tableftinactivehover');
		$('.tabcenterinactive',this).attr('class','tabcenterinactivehover');
		$('.tabrightinactive',this).attr('class','tabrightinactivehover');
	},function(){
		$('.tableftinactivehover',this).attr('class','tableftinactive');
		$('.tabcenterinactivehover',this).attr('class','tabcenterinactive');
		$('.tabrightinactivehover',this).attr('class','tabrightinactive');
	});
});
</script>