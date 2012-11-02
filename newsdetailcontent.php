<script type="text/javascript">
	$(document).ready(function(){
		$("#frmCommentAdd").validate({
			rules: {
				writername:		"required",
				intro:	 		"required",
				securecode:		"required"
				
			},
			messages: {
				writername:		"Нэрээ оруулна уу!",
				intro:			"Сэтгэгдэл оруулна уу!",
				securecode:		"Хамгаалах код оруулна уу!"
			}
		});
	});
</script>
<?php
	$qry="select count(*) as TotalCount";
	$qry.=" from tbl_news";
	$qry.=" where IsShow='YES'";
	$qry.=" and NewsClassID = '$newsclassid'";
	$totalrow = $con->GetDescr($qry);
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num
		FROM (
			SELECT @www :=@www+1 AS Num, T.NewsID 
			FROM tbl_news T 
			WHERE T.IsShow='YES' 
			AND T.NewsClassID='$newsclassid' 
			ORDER BY T.NewsDate desc, CreateDate desc
		) T
		WHERE T.NewsID='$newsid'
	";
	$currentcount=$con->GetDescr($qry);
	
	if($currentcount==$totalrow){
		$nextcount=1;
		$prevcount=$totalrow-1;
	}elseif($currentcount==1) {
		$nextcount=$currentcount+1;
		$prevcount=$totalrow;
	}elseif($currentcount>1 && $currentcount<$totalrow){
		$nextcount=$currentcount+1;
		$prevcount=$currentcount-1;
	}
	
	$con->qryexec("SET @www:=0");
	$qry="
		SELECT T.Num, T.NewsID 
		FROM (
			SELECT @www :=@www+1 AS Num, T.NewsID 
			FROM tbl_news T 
			WHERE T.IsShow='YES' 
			AND T.NewsClassID='$newsclassid' 
			ORDER BY T.NewsDate desc, CreateDate desc
		) T
		WHERE T.Num='$nextcount'
		OR T.Num='$prevcount'
	";
	$records=$con->select($qry);
	$recordcount=count($records);
	for($j=0; $j<$recordcount; $j++){
		if($records[$j]['Num']==$nextcount){
			$next=$records[$j];
		}else{
			$prev=$records[$j];
		}
	}

//	$qry="select count(*) as TotalCount,";
//	$qry.=" (select count(*) from tbl_news where IsShow='YES' and NewsID <= '$newsid') as NewsCount,";
//	$qry.=" (select NewsID from tbl_news where IsShow='YES' and NewsID < '$newsid' order by NewsID desc, NewsDate desc, CreateDate desc limit 1) as PrivNewsID,";
//	$qry.=" (select NewsID from tbl_news where IsShow='YES' and NewsID > '$newsid' order by NewsDate desc, CreateDate desc limit 1) as NextNewsID";
//	$qry.=" from tbl_news";
//	$qry.=" where IsShow='YES'";
	//echo $qry; exit;
//	$row=$con->select($qry);
?>
<div class="listbg">
<?php
	$qry="select T.*, NewsClassName, OrganName";
	$qry.=" from tbl_news T";
	$qry.=" left join ref_newsclass NC on T.NewsClassID=NC.NewsClassID";
	$qry.=" left join tbl_newsorgan NO on T.NewsID=NO.NewsID";
	$qry.=" left join ref_organ O on NO.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES' and T.NewsID='$newsid'";
	//echo $qry; exit;
	$row1=$con->select($qry);
	$rowcount1=count($row1);
	
	if ($rowcount1>0){ 
?>
		<ul class="presslist">
			<div style="background: #fff; margin-bottom: 10px; padding: 6px 10px">
				<div style="float: left;">Нийт: <?=$totalrow;?> / <?=$currentcount;?></div>
				<div style="float: right;">
					<a href="<?=$rf;?>/news/detail/<?=$prev['NewsID'];?>">&laquo; Өмнөх</a>&nbsp;|&nbsp;
					<a href="<?=$rf;?>/news/detail/<?=$next['NewsID'];?>">Дараах &raquo;</a>
				</div> 
				<div class="clear"></div>
			</div>
			<li class="topbrdr">
				<p class="pmdate">Огноо: <?=$row1[0]['NewsDate'];?></p>
<?php
		if (!empty($row1[0]['OrganID'])){
?>
				<div class="org"><span><?=$row1[0]['OrganName'];?></span></div>
<?php
		}
		$imagesource=$drf."/files/news/medium/".$row1[0]['ImageSource'];
		if (!empty($row1[0]['ImageSource']) && file_exists($imagesource)){
			$size=getimagesize($imagesource);
				$w=$size[0];
				$h=$size[1];
			$imagesource=$rf."/files/news/medium/".$row1[0]['ImageSource'];
			$stringlong="280"; 
?>
				<img src="<?=$imagesource?>" <?php if($w>300)echo ' width="300" ';?>  style="float: left; margin: 5px 10px 0 0"/>
<?php
		} 
?>
				<h2 style="padding: 3px"><?=$row1[0]['Title'];?></h2>
				<div style="font-size: 12px; text-align: justify; line-height: 1.5em"><?=$row1[0]['Descr'];?></div>
				<div class="clear"></div>
			</li>
<?php if($row1[0]['IsShowComment']=='YES'){?>
			<div style="margin: 10px 0px; background: #fff; padding: 5px 10px;">
				<h2 style="border-bottom: 2px solid #ccc">Сэтгэгдэл</h2>
					<div>
						<form action="<?=$rf;?>/process/action/commentadd" name="frmCommentAdd" id="frmCommentAdd" method="post">
						<input type="hidden" name="newsid" id="newsid" value="<?=$newsid;?>"/>
						<table cellpadding="2" cellspacing="3" width="100%" style="background: #f8f8f8">
						<tr>
							<td></td>
							<td><?php if(!empty($msg)) echo $$msg;?></td>
						</tr>
						<tr>
							<td align="right" valign="top" width="20%">Нэр: <?=$strRequiredField;?></td>
							<td align="left"><input type="text" name="writername" id="writername" size="30" maxlength="30"/></td>
						</tr>
						<tr>
							<td align="right" valign="top">Сэтгэгдэл: <?=$strRequiredField;?></td>
							<td align="left"><textarea name="intro" id="intro" cols="70" rows="3"></textarea></td>
						</tr>
						<tr>
							<td valign="top" align="right">Хамгаалалтын код: <?=$strRequiredField;?></td>
							<td align="left">
								<img id="secureimage" src="<?=$rf;?>/libraries/securimage/securimage_show.php?sid=<?=md5(uniqid(time()));?>" align="absmiddle">
				              	<a href="javascript:" onclick="document.getElementById('secureimage').src = '<?=$rf;?>/libraries/securimage/securimage_show.php?sid=' + Math.random(); return false;" title="Кодыг өөрчлөх"><img src="<?=$rf;?>/images/icon/16x16/refresh.png" align="absmiddle"></a>
				                <div style="padding-top:5px"><input type="text" id="securecode" name="securecode" value="" maxlength="10" size="15"></div>
							</td>
						</tr>
						<tr>
							<td align="right"></td>
							<td align="left"><input type="submit" name="bntSend" id="bntSend" value="Илгээх"/></td>
						</tr>
						</table>
						</form>
					</div>
<?php
	$qry="select *, DATE_FORMAT(CommentDate, '%Y оны %m-р сарын %d, %H:%i') as CommentDate1";
	$qry.=" from tbl_newscomment";
	$qry.=" where IsShow='YES' and NewsID='$newsid'";
	$qry.=" order by CommentDate asc";
	$row2=$con->select($qry);
	$rowcount2=count($row2);
	
	$j2=0;
	while ($j2<$rowcount2){
?>
						<div style="background: #f8f8f8; margin-top: 5px; padding: 10px">
							<div style="float: left; font-size: 24px; font-family: Georgia; color: #33558e; border-right: 1px solid #bbbbaa; padding-right: 5px; margin: 0px 5px"><?=$j2+1;?>.</div>
							<div style="float: left; padding: 3px 5px;">
								<div><span style="color: #999999"><?=$row2[$j2]['CommentDate1'];?>,</span> <span style="color: #0077aa"><?=$row2[$j2]['WriterName'];?>:</span> </div>
								<div class="descr" style="float: left; padding: 3px 0px 0px 0px"><?=nl2br($row2[$j2]['Descr']);?></div>
							</div>
							<div class="clear"></div>		
						</div>
<?php
	$j2++;
	} 
?>
			</div>
<?php }?>
<?php
	} else {
?>
			<div style="text-align: center;"><?=$msg_nodata;?></div>
<?php
	} 
?>
			<div class="clear"></div>
		</ul>
	</div>
</div>