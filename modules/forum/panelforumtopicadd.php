<div style="width:810px;">
	
<?php
	$forumclassid=$_GET["forumclassid"];
	$forumid=$_GET["forumid"];
	$forumtopictype=$_GET["forumtopictype"];
	$forumtopictypeadd=$_GET["forumtopictypeadd"];

	if($forumtopictypeadd=='Question') $str="Асуулт асуух";
	elseif($forumtopictypeadd=='Survey') $str="Судалгаа авах";
	else $str="Сэдэв оруулах";
	
	$qry="select T.*";
	$qry.=" from asubi_forumclass T";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.ForumClassID='$forumclassid'";
	//echo $qry;
	$row=$con->select($qry);
	$j=0;
?>
<div id="simple">
	<div class="mainborder">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr>
				<td width="100%" nowrap="nowrap">
					<table cellpadding="0" cellspacing="0" align="left">
					<tr>
						<td class="mainleftimage"></td>
						<td class="maincenterimage">
							<div class="mainpagetitle">
								<a href="<?=$rf_forum;?>/<?=$forumid;?>">
									<?php
										$qry="select Title from asubi_forum where ForumID = '$forumid'";
										echo $con->GetDescr($qry);
									?>
								</a>
								<span>&raquo;</span>
								<a href="<?=$rf_forum."/topic/".$forumid."/".$forumclassid;?>"><?=$row[$j]['Title'];?></a>
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
		<strong style="color: #2b587a;"><?=$str;?></strong>
		<div class="floatright" style="float: right;" style="padding: 5px 5px 0pt 0pt;"><span class="required">&nbsp;</span>заавал оруулна</div>
	</div>
<div style="border: 1px solid #dae2e8; padding: 20px;">
<?php 
	if($row[0]['Private']=='YES'){
		$clubid = $con->GetDescr("select ClubID from hobby_club where ForumClassID = '$forumclassid'");
		$priv = $con->GetDescr("select Priv from hobby_clubmember where ClubID = '$clubid' and MemberID = '".$_SESSION['asubi_memberid']."'");
		if($priv=='admin' || $priv=='superadmin'){
			$temp = 'YES';
		}else{
			$temp = 'NO';
		}
	}else {
		$temp="YES";
	}
	
	if(!empty($_SESSION['asubi_memberid']) && $temp=='YES'){
?>
	<div class="paddedbox12 remark" style="border: 1px solid #dae2e8; background: #eeeeee none repeat scroll 0% 0%; -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">
		<strong>Санамж: </strong>Та <a href="<?=$rf_forum."/topic/".$forumid."/".$forumclassid;?>" style="color: #2b587a;"><?=$row[$j]['Title'];?></a> хэлэлцүүлгийн шинэ сэдэв оруулах хэсэг рүү орсон байна.<br>
		Та мэдээллээ кирилл үсэг буюу монголоор бичиж оруулна уу.
	</div>
	<br>
	<form id="frmForumTopicAdd" method="post" action="<?=$rf_forum;?>/process/action/forumtopicadd" onsubmit="if(confirm('Илгээхдээ итгэлтэй байна уу!')) return true; else return false;">
    <input name="forumclassid" value="<?=$forumclassid;?>" maxlength="250" type="hidden">
    <input name="forumid" value="<?=$forumid;?>" maxlength="250" type="hidden">
    <input name="forumtopictypeadd" value="<?=$forumtopictypeadd;?>" maxlength="250" type="hidden">
	
	<table id="form" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 0px solid #cbddf1;">
	<tbody>
<?php
	$qry="select M.*, LEFT(UPPER(CONVERT( REPlACE(M.LastName,' ','') USING utf8)),1) as LName ";
	$qry.=" from asubi_member M";
	$qry.=" where 1=1";
	$qry.=" and M.MemberID='".$_SESSION['asubi_memberid']."'";
	$row=$con->select($qry);
	$j=0;
	$fullname=$row[$j]['LName'].".".$row[$j]['FirstName'];
?>
	<tr><td height="5"></td></tr>
	<tr>
		<td><strong class="label">Нэр:</strong>&nbsp;<?=$fullname;?></td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr>
		<td class="label">Сэдвийн агуулга:<span class="required">&nbsp;</span> </th>
	</tr>
	<tr><td height="5"></td></tr>
	<tr>
		<td><input name="forumtopicname" id="forumtopicname" size="100" maxlength="250" type="text"></td>
	</tr>
	<tr><td height="3"></td></tr>
	<tr>
		<td class="label">Сэдвийн дэлгэрэнгүй:<span class="required">&nbsp;</span></th>
	</tr>
	<tr><td height="5"></td></tr>
	<tr valign="top">
		<td>
			<textarea id="descr" name="descr" rows="13" cols="119"></textarea>
		</td>
	</tr>
<?php
	if($forumtopictypeadd=="Survey"){
?>
	<tr>
		<td class="label">Сонгох сонголтууд:<span class="required">&nbsp;</span></th>
	</tr>
	<tr>
		<td style="padding-left: 20px;">
			<div id="addThreadForm">
				&bull; <input id="polloption" name="polloption[]" size="100" type="text" style="margin: 2px 0px 2px 0"><br>
				&bull; <input id="polloption" name="polloption[]" size="100" type="text" style="margin: 2px 0px 2px 0"><br>
				<div id="addOptionBefore" class="FormElement" style="margin-top: 5px;" align="center">
					<button type="button" name="vote_addoption" id="editpost_vote_addoption" class="bluebutton" onclick="javascript:addVoteOption();">Сонголт нэмэх</button>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="label">Сонгох төрөл:<span class="required">&nbsp;</span></th>
	</tr>
	<tr>
		<td style="padding-left: 20px;">
			<input name="choicetype" value="Single" checked="checked" id="single" type="radio"> <label for="single">Зөвхөн нэгийг сонгоно</label>
			<input name="choicetype" value="Multiple" type="radio" id="multi"> <label for="multi">Нэгээс илүү сонголттой байж болно</label>
		</td>
	</tr>
<?php
	}
?>
	</tbody>
    </table>
	<br>
	<div align="center">
		<button type="submit" name="eventSubmitDoPost" class="bluebutton">Хадгалах</button>
		<button type="button" name="eventSubmitDoCancelToList" class="bluebutton" onclick="history.go(-1);">Болих</button>
	</div>
	</form>
	<br>
<?php 
	}else{
		require_once 'login.php';
	}
?>
</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#frmForumTopicAdd").validate({
			rules: {
				forumtopicname: "required",
				//descr: "required"
				polloption: "required"
			},
			messages: {
				forumtopicname: "<?=$title1;?> хоосон байна! Оруулна уу.",
				//descr: "Мессежээ оруулна уу!",
				polloption: "Сонгох сонголтоо оруулна уу!"
			}
		});
	});
</script>

<script type="text/javascript">
	function addVoteOption(){
		var newEle;
		var btn		= document.getElementById("addOptionBefore");
		var con		= document.getElementById("addThreadForm");
		if(!btn || !con) return;
		var newEle	= document.createElement("DIV");
		newEle		= con.insertBefore(newEle,btn);
		if(newEle){
			newEle.innerHTML	= "&bull; <input name=\"polloption[]\" type=\"text\" size=\"100\" style=\"margin: 2px 0px 2px 0\"/> <button class='bluebutton' name=\"delpoll\" type=\"button\" onclick=\"javascript:removeOption(this);\">Устгах</button><br />";
		}
	}
	function removeOption(e){
		var tar		= e.parentNode;
		var con		= document.getElementById("addThreadForm");
		con.removeChild(tar);
	}
</script>