<link href="<?=$rf;?>/js/jquery/jquery.validate/stylejqvalidate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$rf?>/js/jquery/jquery.validate/jquery.validate.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#frmPollVote").validate({
			rules: {
				pollvoteid:		"required"				
			}
		});
	});
</script>

<style type="text/css">
	form.jqValForm label.error { display: none; }	
</style>
<?php
 	$qry="select *";
	$qry.=" from tbl_forumtopic";
    $qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 0, 5";
    //echo $qry;
    $row=$con->select($qry);
    $rowcount=count($row);
?>
<div class="subhd">Хэлэлцүүлэг, судалгаа</div>
<div style="background: ; padding: 5px">
	<table cellpadding="0" cellspacing="0" width="100%">
	<?php 
		for($i=0; $i<$rowcount; $i++){
			if($row[$i]['ForumTopicType']=='Survey')$temp = "Судалгаа";
			if($row[$i]['ForumTopicType']=='Discussion')$temp = "Хэлэлцүүлэг";
	?>
	<tr valign="top">
		<td>
			&raquo;
		</td>
		<td width="5"></td>
		<td>
			<div><a href="<?=$rf;?>/forum/topic/<?=$row[$i]['ForumClassID'];?>/<?=$row[$i]['ForumTopicID'];?>"><?=$row[$i]['Title'];?></a>&nbsp;<span class="alert">[<?=$temp;?>]</span></div>
		</td>
	</tr>
	<tr><td colspan="3" height="10"></td></tr>
	<?php }?>
	</table>
</div>
<style type="text/css">
	.alert{
		color: #bbb;
	}
</style>