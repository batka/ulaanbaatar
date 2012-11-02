<?php
	require_once("../libraries/connect.php");
	$con = new Database();
?>
<HTML>
<HEAD>
<?php
	require_once "../headerjsstyle.php";
?>
<style type="text/css">
	table{
		font-family: Tahoma;
		font-size: 12px;
		line-height: 18px;
	}
	.orderheader{
		margin: auto;
		width: 679px;
		height: 250px;
		position: relative;
	}
	.orderyear{
		height: 20px;
		position: absolute;
		left: 18px;
		bottom: 36px;
	}
	.ordermonth{
		height: 20px;
		position: absolute;
		left: 92px;
		bottom: 36px;
	}
	.orderday{
		height: 20px;
		position: absolute;
		left: 157px;
		bottom: 36px;
	}
	.ordernum{
		height: 20px;
		position: absolute;
		left: 347px;
		bottom: 36px;
	}
	.descr{
		font-size: 12px;
		text-align: justify;
		color: #000000;
	}
}
</style>
</HEAD>

<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" rightmargin="0" bottommargin="0" style="background-color: white; padding: 5px;">
<?php
	$lawruleid=$_GET['lawruleid'];
	$repnotice='Засаг даргын захирамж';
	
	$qry="select *,";
	$qry.=" DATE_FORMAT(LawRuleDate,'%Y') as orderyear,";
	$qry.=" DATE_FORMAT(LawRuleDate,'%m') as ordermonth,";
	$qry.=" DATE_FORMAT(LawRuleDate,'%d') as orderday";
	$qry.=" from tbl_lawrule";
	$qry.=" where LawRuleID='$lawruleid'";
	$row=$con->select($qry);
        
        if($row[0]['IsRule']==0){
            $bgimg = "$rf/images/web/lawtolgoi.jpg";
        }else{
            $bgimg = "$rf/images/web/lawtolgoi1.jpg";
        }
	
	if($_GET['activepage']=="") $activepage=1;
	else $activepage=$_GET['activepage'];
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<?php if($activepage==1){?>
	<tr>
		<td>
			<div class="orderheader" sty>
				<img src="<?=$bgimg?>">
				<div class="orderyear"><?=$row[0]['orderyear'];?></div>
				<div class="ordermonth"><?=$row[0]['ordermonth'];?></div>
				<div class="orderday"><?=$row[0]['orderday'];?></div>
				<div class="ordernum"><?=$row[0]['LawRuleNo'];?></div>
			</div>
		</td>
	</tr>
	<?php }?>
	<tr>
		<td>
		<?php if($activepage==1){?>
			<center><div style="margin-top: 20px; width: 310px; font-weight: bold; font-size: 14px; color: #000000;"><?=$row[0]['Title'];?></div></center>
			<br/><br/>
		<?php }?>
			<div class="descr"><?=$row[0]['Descr'];?></div>
		</td>
	</tr>
	</table>
</BODY>
</HTML>