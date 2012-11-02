<style type="text/css">
<!--

#tnt_pagination {
	display:block;
	text-align:left;
	height:22px;
	line-height:22px;
	clear:both;
	padding-top:3px;
	padding-bottom:3px;
	font-family:arial;
	font-size:10px;
	font-weight:normal;
	color:#000000;
	float:left;
}

#tnt_pagination a:link, #tnt_pagination a:visited{
	font-size:10px;
	padding:7px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px solid #EBEBEB;
	margin:0px;
	text-decoration:none;
	background-color:#F5F5F5;
	color:#000000;
	width:22px;
	font-weight:normal;
}

#tnt_pagination a:hover {
	font-size:10px;
	background-color:#B3B9BF;
	border:1px solid #CCCCCC;
	color:#000000;	
}

#tnt_pagination .active_tnt_link {
	font-size:10px;
	padding:7px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px solid #CCCCCC;
	margin:0px;
	text-decoration:none;
	background-color:#B3B9BF;
	color:#000000;
	cursor:default;
}

#tnt_pagination .disabled_tnt_pagination {
	font-size:10px;
	padding:7px;
	padding-top:2px;
	padding-bottom:2px;
	border:1px solid #EBEBEB;
	margin-left:0px;
	text-decoration:none;
	background-color:#F5F5F5;
	color:#D7D7D7;
	cursor:default;
}
-->
</style>

<div id="tnt_pagination">
<?php 
	$icen=($showpagecount+1)/2;
	$ilen=($showpagecount-1)/2;
	
	$j=$activepage-$ilen;
	if($activepage<=$icen) $j=1;
	if($activepage>$pagecount-$ilen) $j=$pagecount-$showpagecount+1;
	if($j<1) $j=1;

	if(($pagecount-$showpagecount)>0 && ($activepage>$icen)){ 
?>
<a href="javascript:" onclick="document.<?=$pageFormName;?>.action='<?=$pagelink."p/1";?>';document.<?=$pageFormName;?>.submit(); return false;">I&lt;</a>
<?php 
	}
	if($activepage-1>0){
		$prevpage=$activepage-1;			
?>	
<a href="javascript:" onclick="document.<?=$pageFormName;?>.action='<?=$pagelink."p/".$prevpage.""?>';document.<?=$pageFormName;?>.submit(); return false;">&lt;&lt;</a>
<?php
	}
	$ii=$pagecount;
	if($pagecount>$icen+1 && $showpagecount<=$pagecount) $ii=$j+$icen+$ilen-1;
	//echo $ii;
	for($i=$j; $i<=$ii; $i++){
		if($activepage==$i) echo "<span class='active_tnt_link'>";
		else {
?>
<a href="javascript:" onclick="document.<?=$pageFormName;?>.action='<?=$pagelink."p/".$i."";?>';document.<?=$pageFormName;?>.submit(); return false;">
<?php
		}
		echo $i;
		if($activepage==$i) echo "</span>";
?>
</a>
<?php
	}
	if($activepage+1<=$pagecount){
		$nextpage=$activepage+1;
?>
<a href="javascript:" onclick="document.<?=$pageFormName;?>.action='<?=$pagelink."p/".$nextpage.""?>';document.<?=$pageFormName;?>.submit(); return false;">&gt;&gt;</a>
<?php 
	}
	if(($pagecount-$showpagecount)>0 && ($activepage+$ilen<$pagecount)){
?>	
<a href="javascript:" onclick="document.<?=$pageFormName;?>.action='<?=$pagelink."p/".$pagecount.""?>';document.<?=$pageFormName;?>.submit(); return false;">&gt;I</a>
<?php
	}
?>
	<span style="font-size:10px; font-family:tahoma; padding-left:5px"> Нийт тоо: <strong><?=$rowcount;?></strong></span>
<?php if(empty($isshowpage)){ ?>
<div style="float:right; height:23px; padding-top:5px;">
   	Харуулах тоо:
    <select style="font-size: 10px;" name="showcount" onchange="this.form.submit()">
<?php 
		if(empty($showpagestep)) $showpagestep=5;
		for($i=$showpagestep, $j=0; $j<5; $i+=$showpagestep, $j++){
?>		
        <option value="<?=$i?>"<?php if($_SESSION['haant_showcountselect']==$i) echo " selected";?>><?=$i;?></option>
<?php 	
		}
?>       
    </select>
</div>
<?php } ?>
</div>
