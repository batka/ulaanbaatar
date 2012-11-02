<?php
	$pageFormName="frmDailyNews";
	
	$showcount=6;
	$pagenum=$_POST['pagenum'];
	if(empty($pagenum)){$pagenum=0;}
	
	$noticetitle=$con->GetDescr("select NewsTypeName".$_SESSION['mayor_lang']." from mayor_newstype where NewsTypeLink='$newslink'");
	
	if($_POST['srchv']) $srchv=$_POST['srchv'];
	
	if(!empty($srchv)){
		$qrywhr.=" and (LOWER(CONVERT(T.Title USING utf8)) like '%$srchv%'";
		$qrywhr.=" or LOWER(CONVERT(T.Descr USING utf8)) like '%$srchv%')";
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsrch").click(function(){
			$("#pagenum").val('');
			$("#<?=$pageFormName;?>").attr("action", "<?=$REQUEST_URI?>");
			$('#<?=$pageFormName;?>').submit();
		});
		$("#btnall").click(function(){
			$("#srchv").val('');
			$('#<?=$pageFormName;?>').submit();
		});
	});
</script>

<div class="formcenter">
<form action="<?=$REQUEST_URI?>" name="<?=$pageFormName;?>" id="<?=$pageFormName;?>" method="post">
	<table cellpadding="0" cellspacing="0" width="100%"><tr valign="bottom">
		<td><div class=pageformtitle><?=$menutitle?> &raquo; <?=$noticetitle;?></div></td>
			<td></td>
		</tr>
		<tr>
		<td colspan="2">
		<div class="pageform">
			<div style="font-size: 11px; margin-bottom: 10px; float: right;">
				<span>&nbsp;&nbsp;Хайлт: </span>
				<input type="text" name="srchv" id="srchv" value="<?=$srchv;?>" size="20"/>
				<input type="submit" name="btnsrch" id="btnsrch" value="Хайх"/>
				<input type="button" name="btnall" id="btnall" value="Бүгд"/>
			</div>
			<div class="clear"></div>
		<?php
			$qry="select T.*, DATE_FORMAT(T.NewsDate,'%Y-%m-%d') as date";
			$qry.=" from tbl_news T";
			$qry.=" left join tbl_newsorgan N";
			$qry.=" on T.NewsID = N.NewsID";
			$qry.=" where T.IsShow='YES'";
			$qry.=" and N.OrganID='".MAYORID."'";
			$qry.=$qrywhr;
			$qry.=" group by T.NewsID";
			$qry.=" order by T.NewsDate desc, T.CreateDate desc";
			$allrow=count($con->select($qry));
			$qry.=" limit ".($pagenum*$showcount).", ".$showcount;
			$row=$con->select($qry);
			$rowcount=count($row);
			
			if($rowcount>0){
			for($i=0; $i<$rowcount; $i++){
				$link="$rf/news/$newslink/detail/".$row[$i]['NewsID']."/";
		?>
			<div class="dcontent">			
				<div class="descr">
					<?php if(!empty($row[$i]['ImageSource']) && file_exists("$drfo/files/news/small/".$row[$i]['ImageSource'])){?>
						<a href="<?=$link?>"><img class="dcontentimg" src="<?=$rfo?>/files/news/small/<?=$row[$i]['ImageSource']?>" width="120"/></a>
					<?php }?>
					<div style="margin-bottom: 3px;">
						<a href="<?=$link?>" class="descrtitle"><?=$row[$i]['Title']?></a>
					</div>
					<?php if(!empty($row[$i]['Intro'])){?>
						<?=strip_tags($row[$i]['Intro']);?>
					<?php }else{?>
						<?=GetStrBr(strip_tags($row[$i]['Descr']), 300);?>
					<?php }?>
					<div class="clear"></div>
				</div>
				<div class="dcontentbottom">
					<?=$strSaw.": ".$row[$i]['SawCount']?> | <?=$strDate.": ".$row[$i]['date']?>
				</div>
				<a class="morelink" href="<?=$link?>"><?=$strMore?></a>
				<div class="clear"></div>
			</div>
		<?php }
			require_once 'pagenumberpost.php';
		}else{?>
			<div class="notice"><?=$strnotfound?></div>
		<?php }?>		
		</div>
		</td>
	</tr>
	</table>
</form>
</div>