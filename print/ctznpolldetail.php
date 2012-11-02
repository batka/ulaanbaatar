<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
	require_once '../headerjsstyle.php'; 
	if(isset($_GET['pollid'])) $pollid=$_GET['pollid'];
?>
<link href="<?=$rf;?>/js/jquery/jquery.validate/stylejqvalidate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$rf?>/js/jquery/jquery.validate/jquery.validate.js"></script>
<script type="text/javascript">
	$.metadata.setType("attr", "validate");
	$().ready(function(){
		$("#frmPollVote").validate({
			rules: {
				pollvoteid: "required"
			}
		});
	});
</script>
<style type="text/css">
	form.jqValForm label.error { display: none; }	
</style>
</head>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0" style="background: #fff">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="3" cellpadding="3">
			<tr>
				<td><?php require_once "reportheader.php"; ?></td>
			</tr>
<?php
	$qry="select T.*";
	$qry.=" from ctz_poll T";
	$qry.=" left join asu_progcombo PC on T.IsActive=PC.SysID and ComboName='BOOL'";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and PollID='$pollid'";
	$row=$con->select($qry);
?>
			<tr>
				<td style="background: #CCCCCC no-repeat right top">
					<div style="padding: 2 5 2 5;"><b><?=$strPoll;?></b></div></td>
			</tr>
			<tr valign="top">
				<td>
					<table width="100%" border="0" cellspacing="1" cellpadding="1">
					<tr>
						<td colspan="2" style="padding-bottom: 10"><b><?=$row[0]['PollDescr'];?></b></td>
					</tr>
					<tr valign="middle">
						<td colspan="2">
							<form class="jqValForm" id="frmPollVote" name="frmPollVote" action="../processform.php?action=ctznpoll" method="post">
							<input type="hidden" name="pollid" value="<?=$pollid;?>">
							<table width="99%" border="0" cellspacing="1" cellpadding="1" align="center">
<?php
	$qry="select sum(PollVote)";
	$qry.=" from ctz_pollvote";
	$qry.=" where PollID='$pollid'";
	//echo $qry;
	$row=$con->select($qry);
	$votesum=$row[0][0];
	
	$qry="select PollVoteID, PollValue, PollVote, PollVote*100";
	if($votesum!="" && $votesum!=0) $qry.="/".$votesum;
	$qry.=" from ctz_pollvote";
	$qry.=" where PollID='$pollid'";
	$qry.=" order by ShowOrder";
	//echo $qry;
	$row=$con->select($qry);
	$rowcount=count($row);
	$j=0;
	while($j<$rowcount){
?>
							<tr valign="top">
								<td width="1%"><input type="radio" name="pollvoteid" value="<?=$row[$j][0];?>"></td>
								<td><?=$row[$j][1];?></td>
								<td width="150"><img src="../images/web/poll_ind.gif" border="0" height="18" width="<?=1.5*$row[$j][3]+5;?>" align="middle">&nbsp;</td>
								<td width="30" align="right"><?=$row[$j][2];?></td>
								<td width="60" align="right"><?=number_format($row[$j][3], 2, '.', '')." %";?></td>
							</tr>
<?php
		$j++;
	}
?>
							<tr>
								<td colspan="5" height="1"><div style="border-bottom: 1px dotted #ccc;"></div></td>
							</tr>
                            <tr>
                                <td colspan="5" align="center"><label for="pollvoteid" class="error">Та сонголтоо хийнэ үү!</label></td>
 	                       </tr>
							<tr valign="top">
								<td colspan="5" style="padding: 5 0 5 0;">
									<input class="button2" type="submit" name="btnPoll" value="Үнэл" />
								</td>
							</tr>
							</table>
							</form>
						</td>
					</tr>
					<tr>
						<td colspan="2"><b>Нийт саналын тоо:&nbsp;&nbsp;<?=number_format($votesum, 0, '.', '');?></b></td>
					</tr>
<?php
	$qry="select FirstDate, LastDate";
	$qry.=" from ctz_poll";
	$qry.=" where PollID='$pollid'";
	//echo $qry;
	$row=$con->select($qry);
?>
					<tr>
						<td>&nbsp;&nbsp;Хамгийн анх санал өгсөн:</td>
						<td><?=$row[0][0];?></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;Хамгийн сүүлд санал өгсөн:</td>
						<td><?=$row[0][1];?></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

</BODY>
</html>
