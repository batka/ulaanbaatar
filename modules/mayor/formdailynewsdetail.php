<?php
	$newsid=$_GET['newsid'];
	
	$con->qryexec("update tbl_news set SawCount = SawCount+1 where NewsID='$newsid'");
	
	$qry="select T.*, DATE_FORMAT(T.NewsDate,'%Y оны %m-р сарын %d') as date";
	$qry.=" from tbl_news T";
	$qry.=" left join tbl_newsorgan N";
	$qry.=" on T.NewsID = N.NewsID";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and N.OrganID='".MAYORID."'";
	$qry.=" and T.NewsID='$newsid'";
	$row=$con->select($qry);
?>
<div class="formcenter">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <a href="<?=$rf?>/news/dailynews/"><?=$govformtitle;?></a></div></td>
			<td align="right">
			<div style="font-size:11px; color: #3b3b3b; padding: 3px; width: 135px;">
			<?php
				$total = $con->GetDescr("SELECT count(*) FROM tbl_news T LEFT JOIN tbl_newsorgan N ON T.NewsID = N.NewsID WHERE T.IsShow='YES' AND N.OrganID='".MAYORID."'");
				$activepage = $con->GetDescr("select count(T.NewsID) from tbl_news T LEFT JOIN tbl_newsorgan N ON T.NewsID = N.NewsID where T.IsShow = 'YES' and N.OrganID='".MAYORID."' and T.NewsID > '$newsid'");
			?>
				<div style="float: left;">
					<?php 
						$qry="select T.NewsID from tbl_news T LEFT JOIN tbl_newsorgan N ON T.NewsID = N.NewsID  where T.IsShow = 'YES' and  N.OrganID='".MAYORID."' and  T.NewsID > '$newsid' order by T.CreateDate limit 0,1";
						$previd = $con->GetDescr($qry);
						if(empty($previd)) $previd = $con->GetDescr("select T.NewsID from tbl_news T LEFT JOIN tbl_newsorgan N ON T.NewsID = N.NewsID  where T.IsShow = 'YES' and  N.OrganID='".MAYORID."' order by T.CreateDate limit 0,1");
						
						$qry="select T.NewsID from tbl_news T LEFT JOIN tbl_newsorgan N ON T.NewsID = N.NewsID  where T.IsShow = 'YES' and  N.OrganID='".MAYORID."' and T.NewsID < '$newsid' order by T.CreateDate desc limit 0,1";
						$nextid = $con->GetDescr($qry);
						if(empty($nextid)) $nextid = $con->GetDescr("select T.NewsID from tbl_news T LEFT JOIN tbl_newsorgan N ON T.NewsID = N.NewsID  where T.IsShow = 'YES' and N.OrganID='".MAYORID."' order by T.CreateDate desc limit 0,1");
					?>
					<a href="<?=$rf?>/news/dailynews/detail/<?=$previd;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_prev.png" style="vertical-align: bottom;"/></a>
					<a href="<?=$rf?>/news/dailynews/detail/<?=$nextid;?>/" class="nonestyle"><img src="<?=$rf?>/images/web/icon/icon_next.png" style="vertical-align: bottom;"/></a>
				</div>							
				<div style="float: right;">
					Нийт: <?=$total;?> - <?=$activepage+1;?>
				</div>
				<div class="clear"></div>
			</div>
			</td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
			<div class="dcontent">
				<div class="descrtitle"><?=$row[0]['Title']?></div>
				<?php if(!empty($row[0]['ImageSource']) && file_exists("$drfo/files/news/medium/".$row[0]['ImageSource'])){?>
					<img src="<?=$rfo?>/files/news/medium/<?=$row[0]['ImageSource']?>" width="280" style="margin-right: 5px; float: left;"/>
				<?php }?>
				<div class="descr"><?=str_replace("/files/editor", "$rfub/files/editor", $row[0]['Descr'])?></div>
				<div class="clear"></div>
			</div>
			<div class="dcontentbottom"><?=$strSaw.": ".$row[0]['SawCount']?> | <?=$strDate.": ".$row[0]['date']?></div>
		</div>
		</td>
	</tr>
	</table>	
</div>