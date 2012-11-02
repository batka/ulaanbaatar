<style type="text/css">
	.required{
		color: red;
		padding: 0;
		margin: 0;
	}
</style>
<div class="forum" style="width: 100%;">
<?php
	$forumclassid=$_GET["forumclassid"];
	$forumtopicid=$_GET["forumtopicid"];
	$forumtopictype=$_GET["forumtopictype"];
	
	$qry="select T.*";
	$qry.=" from tbl_forumtopic T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumTopicID='$forumtopicid'";
	//echo $qry;
	$row=$con->select($qry);
	$j=0;
?>
<div id="simple">
	<div class="mainborder">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr>
				<td width="100%" nowrap="nowrap">
					<table cellpadding="0" cellspacing="0" align="left" >
					<tr>
						<td class="mainleftimage"></td>
						<td class="maincenterimage">
							<div class="mainpagetitle">
								<?php 
									$qry="select Title";
									$qry.=" from tbl_forumclass T";
									$qry.=" where T.IsShow='YES'";
									$qry.=" and T.ForumClassID='$forumclassid'";
								?>
								<a href="<?=$rf_forum."/".$forumclassid;?>"><?=$con->GetDescr($qry);?></a>
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
		<?=strip_tags($con->GetDescr("select ForumIntro from tbl_forumclass T where T.IsShow='YES' and T.ForumClassID='$forumclassid'"));?>
	</div>
	<div class="bottomtitle">
		<strong style="color: #2b587a;">Хариу бичих</strong>
		<div class="floatright" style="float: right;" style="padding: 5px 5px 0pt 0pt;"><span class="required" style="font-weight: bold;">* </span>-заавал оруулна</div>
	</div>
<div style="border: 1px solid #dae2e8; padding: 20px 50px;">
	<div class="paddedbox12 remark" style="border: 1px solid #dae2e8; background: #eeeeee none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
		<strong>Санамж: </strong>Та <a href="<?=$rf_forum."/topic/".$forumid."/".$forumclassid."/".$forumtopicid;?>" style="color: #2b587a;"><?=$row[$j]['ForumTopicName'];?></a> сэдвийн хариу бичих хэсэг рүү орсон байна.<br>
		Та мэдээллээ кирилл үсэг буюу монголоор бичиж оруулна уу.
	</div>
	<br>
	<form id="frmForumTopicReply" method="post" action="<?=$rf;?>/processform.php?action=forumtopicreply" onsubmit="if(confirm('Илгээхдээ итгэлтэй байна уу!')) return true; else return false;">
    <input name="forumclassid" value="<?=$forumclassid;?>" maxlength="250" type="hidden">
    <input name="forumtopicid" value="<?=$forumtopicid;?>" maxlength="250" type="hidden">
    
	<table id="form" border="0" cellpadding="2" cellspacing="2" width="100%">
	<tbody>
	<?php if($_SESSION['alert_msg']=='success'){ $_SESSION['alert_msg'] = '';?>
	<tr>
		<td colspan="2">
			<div style="padding: 5px; border: 1px solid #80f274; background-color: #e5ffe1; ">
				<img src="<?=$rf;?>/images/icon/32x32/105.png" width="30" style="float: left; margin-right: 10px;">
				<div style="padding-top: 8px; font-weight: bold;">Амжилттай хадгаллаа!</div>
				<div style="clear: both;"></div>
			</div>
		</td>
	</tr>
	<?php }?>
	<tr><td height="5"></td></tr>
	<tr valign="top">
		<td align="right"><strong class="label">Сэдэв:</strong></td>
		<td style="line-height: 17px;">
			<div><strong><a href="<?=$rf;?>/forum/topic/<?=$forumclassid;?>/<?=$forumtopicid;?>"><?=$row[0]['Title'];?></a></strong></div>
			<div><?=$row[0]['Descr'];?></div>
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr valign="top">
		<td align="right"><strong class="label ">Нэр: <span class="required">*</span></strong></td>
		<td><input name="firstname" id="firstname" size="50" maxlength="300" type="text"></td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr valign="top">
		<td align="right"><strong class="label">И-мэйл:</strong></td>
		<td><input name="email" id="email" size="50" maxlength="300" type="text"></td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr valign="top">
		<td class="label" align="right">Хариуны агуулга: <span class="required">*</span> </td>
		<td><input name="subject" id="subject" size="100" maxlength="250" type="text"></td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr valign="top">
		<td class="label" align="right">Хариу:<span class="required">&nbsp;</span></th>
		<td>
			<textarea id="message" name="message" rows="13" cols="119"></textarea>
		</td>
	</tr>
	<tr valign="top">
		<td class="label" align="right">Хамгаалалтын код:<span class="required">&nbsp;</span></th>
		<td>
			<img id="secureimage" src="<?=$rf;?>/libraries/securimage/securimage_show.php?sid=<?=md5(uniqid(time()));?>" align="absmiddle">
           	<a href="javascript:" onclick="document.getElementById('secureimage').src = '<?=$rf;?>/libraries/securimage/securimage_show.php?sid=' + Math.random(); return false;" title="Кодыг өөрчлөх"><img src="<?=$rf;?>/images/icon/16x16/refresh.png" align="absmiddle"></a>
            <div style="padding-top:5px"><input type="text" id="securecode" name="securecode" value="" maxlength="10" size="15"></div>
		</td>
	</tr>
	
	
	
	<tr><td height="5"></td></tr>
	</tbody>
    </table>
	<br>
	<div align="center">
		<input type="submit" name="eventSubmitDoPost" class="bluebutton" value="Илгээх">
		<input type="button" name="eventSubmitDoCancelToList" class="bluebutton" onclick="window.open('<?=$rf;?>/forum/topic/<?=$forumclassid;?>/<?=$forumtopicid;?>','_parent');" value="Болих">
	</div>
	</form>
	<br>

</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#frmForumTopicReply").validate({
			rules: {
				subject: "required",
				firstname:"required",
				email:{
//					required : true,
					email: true
				}
				//message: "required"
			},
			messages: {
				subject: "Хариуны агуулгаа оруулна уу!",
				firstname: "Та өөрийн нэрээ оруулна уу!",
				email:{
//					required : "И-мэйлээ оруулна уу!",
					email : "И-мэйлийн бүтэц буруу байна!"
				}					
				
						
				//message: "Хариугаа оруулна уу!"
			}
		});
	});
</script>