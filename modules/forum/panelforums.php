<?php
	$forumclassid=$_GET["forumclassid"];
	$tdspace=5;
	
	$pageFileName=$rf_forum;
	if(!empty($forumclassid)) $pageFileName.="/".$forumclassid;
	$pageFormName='frmForumTopic';
?>
<div id="simple" style="width: 1000px; margin-top: 10px;" align="left" >
	<table cellpadding="0" cellspacing="0" border="0" height="25" align="left">
	<tr>
	<?php 
		$classname = "";
		if(!empty($forumclassid))$classname = 'inactive';
	?>
	<td class="<?=$classname;?>">
		<div class="tableft<?=$classname;?>"></div>
		<div class="tabcenter<?=$classname;?>">
			<a href="<?=$rf_forum;?>" class="tabtitle">Бүгд</a>
		</div>
		<div class="tabright<?=$classname;?>"></div>
	</td>
	<td width="<?=$tdspace;?>"></td>
	<?php
	 
		$qry="select *";
		$qry.=" from tbl_forumclass F";
		$qry.=" where IsShow = 'YES'";
		$qry.=" order by ShowOrder";
		
		$row=$con->select($qry);
		$rowcount=count($row);
		$j=0;
		while($j<$rowcount){
			if($forumclassid!=$row[$j]['ForumClassID']) $classname="inactive";
			else $classname="";
	?>
		<td class="<?=$classname;?>">
			<div class="tableft<?=$classname;?>"></div>
			<div class="tabcenter<?=$classname;?>">
				<a href="<?=$rf_forum."/".$row[$j]["ForumClassID"];?>" class="tabtitle"><?=$row[$j]['Title'];?></a>
			</div>
			<div class="tabright<?=$classname;?>"></div>
		</td>
		<?php if(($j+1)!=$rowcount){?>
		<td width="<?=$tdspace;?>"></td>
	<?php
			}
			$j++;
		}
	?>
	</tr>
	</table>
	<div style="clear: both;"></div>
	<div class="tabcontent">
		<div style="clear: both;"></div>
	    <form id="<?=$pageFormName;?>" name="<?=$pageFormName;?>" method="post" action="<?=$pageFileName;?>">
	    <input type="hidden" id="showcount" name="showcount" value="<?=$_SESSION['uni_showcountselect'];?>">
		<div class="tabcontent" <?php if($browser->getBrowser()==Browser::BROWSER_IE){?>style="margin-top: -20px;"<?php }?>>
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
			<tr><td colspan="3" class="s" align="center"><?=$msg;?></td></tr>
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
			<tr<?php if($j%2!=0){ ?> class="listbg"<?php } ?>>
				<td>
					<a href="<?=$rf_forum.'/topic/'.$row[$j]['ForumClassID']."/".$row[$j]['ForumTopicID'];?>">
						<?=$row[$j]['Title'];?></a>
					<span class="alert s">[<?=$forumtopictype;?>]</span>
					<br>
					<div class="remark">
						оруулсан <a href="<?=$rf;?>/<?=$row[$j]['MemberID'];?>"><?=$fullname;?></a>
	                    <?=$row[$j]['ForumTopicDate1'];?>
					</div>
				</td>
				<td class="remark">
	<?php
				$qry="select T.*,";
				$qry.=" DATE_FORMAT(T.CreateDate, '%H:%i, %Y оны %m-р сарын %d') as ReplyDate1";
				$qry.=" from tbl_forumpost T";
				$qry.=" where T.IsShow='YES'";
				$qry.=" and T.ForumTopicID='".$row[$j]['ForumTopicID']."'";
				$qry.=" group by T.ForumPostID";
				$qry.=" order by T.CreateDate desc";
				$qry.=" limit 0, 1";
				$row2=$con->select($qry);
				$rowcount2=count($row2);
				$j2=0;
				$fullname=$row2[$j2]['FirstName'];
				if($rowcount2>0){
					$lnk=$rf_forum."/topic/".$row[$j]['ForumClassID']."/".$row[$j]['ForumTopicID']."/p/".$page."#last";
	?>
					<a href="<?=$lnk;?>">
						<?php if(!empty($row2[$j2]['Title']))echo $row2[$j2]['Title'];else echo GetStrBr($row2[$j2]['Descr'],30);?>
	                </a>
	                <br>
					Oруулсан: <a href="<?=$rf;?>/<?=$row2[$j2]['MemberID'];?>"><?=$fullname;?></a><br>
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
	
		<div class="pageNav"><?php require 'panelpagego.php'; ?></div>
		</form>
		<div style="float: right; clear: both;">
<!--	    <form name="managerTopic" id="managerTopicForm" method="post" action="#">-->
<!--	       <input value="Сэдэв тавих" type="button" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Discussion";?>'); $('#managerTopicForm').submit();">-->
<!--	       <input value="Асуулт асуух" type="button" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Question";?>'); $('#managerTopicForm').submit();">-->
<!--	       <input value="Судалгаа авах" type="button" onclick="$('#managerTopicForm').attr('action','<?=$rf_forum."/topic/".$forumclassid."/".$forumid."/add/Survey";?>'); $('#managerTopicForm').submit();">-->
<!--	   </form>-->
		</div>
		<div style="clear: both;"></div>
	</div>
    <br>
<script language="javascript" type="text/javascript">
<!--
function changeForum(){
	forumid = document.getElementById('forumselect').value;
	if(forumid != ""){
		url = "<?=$rf_forum;?>/topic/" + forumid;
		document.location = url;
	}
}
//-->
</script>
	
	
	
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