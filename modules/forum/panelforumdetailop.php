<?php
	$qry="select count(*)";
	$qry.=" from tbl_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumClassID='$forumclassid'";
	$topiccount=$con->GetDescr($qry);
	
	$qry="select count(*)";
	$qry.=" from tbl_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumClassID='$forumclassid'";
	$qry.=" and T.ForumTopicID>'$forumtopicid'";
	$qry.=" order by T.CreateDate";
	$topicnow=$con->GetDescr($qry)+1;
	
	$qry="select T.*";
	$qry.=" from tbl_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumClassID='$forumclassid'";
	$qry.=" and T.ForumTopicID>'$forumtopicid'";
	$qry.=" order by T.CreateDate";
	$qry.=" limit 0, 1";
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	if(empty($rowcount1)) {
		$qry="select T.*";
		$qry.=" from tbl_forumtopic T";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.ForumClassID='$forumclassid'";
		$qry.=" and T.ForumTopicID!='$forumtopicid'";
		$qry.=" order by T.CreateDate ";
		$qry.=" limit 0, 1";
		$row1=$con->select($qry);
		$rowcount1=count($row1);
	}
	
	$qry="select T.*";
	$qry.=" from tbl_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumClassID='$forumclassid'";
	$qry.=" and T.ForumTopicID<'$forumtopicid'";
	$qry.=" order by T.CreateDate desc";
	$qry.=" limit 0, 1";
	$row2=$con->select($qry);
	$rowcount2=count($row2);
	if(empty($rowcount2)) {
		$qry="select T.*";
		$qry.=" from tbl_forumtopic T";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.ForumClassID='$forumclassid'";
		$qry.=" and T.ForumTopicID!='$forumtopicid'";
		$qry.=" order by T.CreateDate desc";
		$qry.=" limit 0, 1";
		$row2=$con->select($qry);
		$rowcount2=count($row2);
	}
?>
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
	<td nowrap="nowrap">
		<strong style="color: #2b587a;">
		Нийт <?=$topiccount." - ".$topicnow;?>.
		</strong>
	</td>
	<td width="100%" style="color: #244e80;">
		&nbsp;&nbsp;
		<?php 
			if($rowcount1>0 || $rowcount2>0){ 
			if($rowcount1>0){
		?>
				<a href="<?=$rf_forum."/topic/".$forumclassid."/".$row1[0]['ForumTopicID'];?>" class="previous-topic" title="<?=GetStrBr($row1[0]['Title'],20);?>" style="color: #244e80;">&laquo; Өмнөх</a>
		<?php }else echo "Өмнөх"; ?>
				|
		<?php if($rowcount2>0){ ?>
				<a href="<?=$rf_forum."/topic/".$forumclassid."/".$row2[0]['ForumTopicID'];?>" class="next-topic" title="<?=GetStrBr($row2[0]['Title'],20);?>" style="color: #244e80;">Дараах &raquo;</a>
		<?php }else echo "Дараах";} ?>
	</td>
	<td width="5"></td>
	<td align="right" width="370" nowrap="nowrap">
		<div class="topic-action" >
	        <form name="managerTopic" id="managerTopicForm" method="post" action="#">
		    	<a href="<?=$rf_forum."/topic/".$forumclassid."/".$forumtopicid."/reply";?>" style="color: #244e80;">Хариу бичих</a>
	        </form>
		</div>
	</td>
</tr>
</table>
