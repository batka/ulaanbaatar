<style type="text/css">

.forumCategory{width:100%;border:1px solid #C8D8E7;margin:15px 0 15px 0;}
.forumCategory .welcome{height:26px;background:#CEE6FA url(<?=$rf;?>/images/style/090416_forumcategory_bg.gif) repeat-x;font:14px/21px arial;padding:7px 10px 3px 10px;}
.forumCategory .forumSearch{float:right;}
.forumCategory .forumSearch span{font:10px/16px verdana!important;padding-left:5px;}

.forumCategories {}
.forumCategories .categoryList, .forumCategories .categoryListOver {float:left;list-style:none!important;list-style-image:none!important;height:125px;padding:5px;margin:0;width:310px;background:#fff;}	//182px
.forumCategories .categoryList, .forumCategories .categoryListOver, .forumCategories .moreList{font:11px/24px verdana!important;}
.forumCategories .categoryList li, .forumCategories .categoryListOver li {padding:3px 2px 3px 2px;margin:0;line-height:1em;}
.forumCategories .categoryListOver {background:#edf4f8;}
.forumCategories .parent {font:bold 13px/24px arial;}
.forumCategories a.more {padding:0 10px 0 0;font:bold 10px/1em tahoma;background:url(<?=$rf;?>/images/style/dot_more.gif) right 70% no-repeat;}
.forumCategories a.more:hover {text-decoration:none;background:url(<?=$rf;?>/images/style/dot_more.gif) right 70% no-repeat;}
.forumCategories .moreList {position:absolute;z-index:999;}
.forumCategories .moreList {width:150px;border:solid 1px #93b8cc;padding:5px 10px;background:#EDF4F8;}
.forumCategories .moreList ul {list-style:none!important;list-style-image:none!important;padding:0;margin:0;}
input.buttonSkinA{color:#5E2708;background:#FEEEB1 url(<?=$rf;?>/images/style/buttonSkinAL.gif) bottom repeat-x!important;border-top:1px solid #F39D24!important;border-left:1px solid #F39D24!important;border-right:1px solid #CF6F18!important;border-bottom:1px solid #CF6F18!important;}
.jumpToForum{float:right;font:bold 12px/18px arial;}
.jumpToForum select{margin-left:5px;width:250px;color:#000;}
.forumSelectTitle{font-weight:bold!important;background:#DFEFF8;padding:2px 0;color:#0A426F;}

#tab{clear:both;}
#tab ul {margin:0;list-style-type:none;height:26px;}
#tab li {display:block;float:left;margin-right:3px;}
#tab li a {padding:7px 10px 4px 10px;margin-left:2px;width:auto;display:block;font:13px/100% arial;text-decoration:none;}
#tab li a:hover {color:#f60!important;}
#tab li a:visited {color:#039;}
#tab li a:link {color:#455B80;}

#tab {background: url(<?=$rf;?>/images/style/tabs_skinB_line.gif) top repeat-x;}
#tab li {background:url(<?=$rf;?>/images/style/tabs_skinB_left.gif) #D3E0F0 left top no-repeat;}
#tab li a:link,#tab li a:visited,#tab li a:hover{background:url(<?=$rf;?>/images/style/tabs_skinB_right.gif) #D3E0F0 right top no-repeat;color:#081B39;}
#tab li.current {background:url(<?=$rf;?>/images/style/tabs_skinB_current_left.gif) #416A9E left top no-repeat;}
#tab li.current a,#tab li.current a:hover{text-decoration:none;color:#fff!important;background:url(<?=$rf;?>/images/style/tabs_skinB_current_right.gif) #416A9E right top no-repeat!important;}
#tab .box {padding:12px;}

.tabsingle {border-bottom:2px solid #ccc;height:23px;}
.tabsingle div{float: left; padding-right: 0px; padding-left: 9px; BACKGROUND: url(<?=$rf;?>/images/style/tabsingle_left.gif) no-repeat left top;}
.tabsingle div strong{float:left; display:block; font-size:13px; padding-right:15px; padding-left:6px; padding-bottom: 3px; padding-top:4px; background: url(<?=$rf;?>/images/style/tabsingle_right.gif) no-repeat right top; }

#tab-f{background:url(<?=$rf;?>/images/style/tab_f_bottomline.gif) bottom repeat-x;}
#tab-f ul{margin:0;height:27px;}
#tab-f li {float:left;display:block;margin-right:5px;margin-bottom:0;}
#tab-f li a:hover {color:#f60!important;text-decoration:none;}
#tab-f li a:visited{color:#039;}
#tab-f li a{padding:4px 10px;display:block;font:13px arial;text-decoration:none;}
#tab-f li.current a{color:#000!important;padding-bottom:6px;}
#tab-f li.current a:hover{color:#000!important;}
#tab-f li {border:1px solid #BFDAF3;border-bottom:1px solid #DCEBF9;background:url(<?=$rf;?>/images/style/resourcetab.gif) #B2D4FF repeat-x;}
#tab-f li.current{background:url(<?=$rf;?>/images/style/resourcetab_f_current.gif) #F1F8FF repeat-x;border:1px solid #ccc;border-bottom:none;}
#tab-f li.future{background:#fff;border:1px solid;border-bottom:none;}
.tabcontent{border:1px solid #ccc;border-top:none;word-wrap:break-word; word-break:break-all; word-break/* */:normal ;}

</style>

<div class="forumCategory">

<script language="javascript" type="text/javascript">
	function beforeSubmit(SearchForm){
		if(trim(SearchForm.keywords.value) == ''){
			alert('Please input a search term.');
			return false;
		}
		return true;
	}
</script>
<div class="welcome">
	<strong>Хэлэлцүүлэгтээ тавтай морилно уу:</strong>
<?php
	if(empty($_SESSION['uni_person'])){
?>
    <a href="<?=$rf;?>/login"><strong>Хэрэглэгчээр нэвтрэх</strong></a>
<?php
	} else {
		$qry="select T.*, LFName";
		$qry.=" from asu_proguser T";
		$qry.=" left join hrs_employee E on T.RegID=E.RegID";
		$qry.=" where T.IsShow='YES'";
		$qry.=" and T.UserID='".$_SESSION['eorg_userid']."'";
		//echo $qry;
		$row=$con->select($qry);
		$j=0;
?>
    <a href="<?=$rf;?>/user/login"><?=$row[$j]['LFName'];?></a>
<?php
	}
?>
</div>
	
<div class="forumCategories">

<?php
	$qry="select *";
	$qry.=" from frm_forumclass";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ShowOrder";
	$qry.=" limit 0, 3";
	//echo $qry;
	$row=$con->select($qry);
	$rowcount=count($row);
	$j=0;
	while($j<$rowcount){
?>
<ul class="categoryList" onmouseover="this.className='categoryListOver';" onmouseout="this.className='categoryList';">
	<li class="parent"><a href="<?=$rf_forum."/home/".$row[$j]["ForumClassID"];?>"><?=$row[$j]['ForumClassName'];?></a></li>
<?php
		$qry="select *";
		$qry.=" from frm_forum";
		$qry.=" where IsShow='YES'";
		$qry.=" and ForumClassID='".$row[$j]['ForumClassID']."'";
		$qry.=" order by ShowOrder";
		$qry.=" limit 0, 10";
		//echo $qry;
		$row1=$con->select($qry);
		$rowcount1=count($row1);
		$j1=0;
		while($j1<$rowcount1){
			if($j1<4){
?>
	<li><a href="<?=$rf_forum."/topic/".$row[$j]['ForumClassID']."/".$row1[$j1]['ForumID'];?>"><?=$row1[$j1]['ForumName'];?></a></li>
<?php
			} else {
?>
	<li>
    	<a class="more viewMoreList" href="javascript:void(0);" rel="nofollow">Илүү үзэх</a>
		<div class="moreList viewMoreListContent" style="display: none;" onmouseout="this.parentNode.parentNode.className='categoryList'">
			<ul>
            <?php for($i=$j1;$i<=$rowcount1;$i++,$j1++){ ?>
				<li><a href="<?=$rf_forum."/topic/".$row[$j]['ForumClassID']."/".$row1[$i]['ForumID'];?>"><?=$row1[$i]['ForumName'];?></a></li>
            <?php } ?>
			</ul>
		</div>
	</li>
<?php
			}
			$j1++;
		}
?>
</ul>
<?php
		$j++;
	}
?>
<div style="clear: both;"></div>
</div>
</div>
