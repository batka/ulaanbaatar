<link href="<?=$rf;?>/js/jquery/cycle.slideshow/slideshow.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$rf;?>/js/jquery/cycle.slideshow/jquery.cycle.js"></script>
<div class="hdtitle1">&nbsp;&nbsp;Нээлттэй мэдээлэл</div>
<script type="text/javascript">
$slideshow = {
	    context: false,
	    tabs: false,
	    autostop : true,
	    timeout: 10000,      // time before next slide appears (in ms)
	    slideSpeed: 1000,   // time it takes to slide in each slide (in ms)
	    tabSpeed: 300,      // time it takes to slide in each slide (in ms) when clicking through tabs
	    fx : "fade",   // the slide effect to use
	    
	    init: function() {
	        // set the context to help speed up selectors/improve performance
	        this.context = $('#slideshow');
	        
	        // set tabs to current hard coded navigation items
	        this.tabs = $('ul.slides-nav li', this.context);
	        
	        // remove hard coded navigation items from DOM 
	        // because they aren't hooked up to jQuery cycle
	        this.tabs.remove();
	        
	        // prepare slideshow and jQuery cycle tabs
	        this.prepareSlideshow();
	    },
	    
	    prepareSlideshow: function() {
	        // initialise the jquery cycle plugin -
	        // for information on the options set below go to: 
	        // http://malsup.com/jquery/cycle/options.html
	        $('div.slides > ul', $slideshow.context).cycle({
	            fx: $slideshow.fx,
	            timeout: $slideshow.timeout,
	            speed: $slideshow.slideSpeed,
	            fastOnEvent: $slideshow.tabSpeed,
	            pager: $('ul.slides-nav', $slideshow.context),
	            pagerAnchorBuilder: $slideshow.prepareTabs,
	            before: $slideshow.activateTab,
	            pauseOnPagerHover: true,
	            pause: true
	        });            
	    },
	    
	    prepareTabs: function(i, slide) {
	        // return markup from hardcoded tabs for use as jQuery cycle tabs
	        // (attaches necessary jQuery cycle events to tabs)
	        return $slideshow.tabs.eq(i);
	    },

	    activateTab: function(currentSlide, nextSlide) {
	        // get the active tab
	        var activeTab = $('a[href="#' + nextSlide.id + '"]', $slideshow.context);
	        
	        // if there is an active tab
	        if(activeTab.length) {
	            // remove active styling from all other tabs
	            $slideshow.tabs.removeClass('on');
	            
	            // add active styling to active button
	            activeTab.parent().addClass('on');
	        }            
	    }            
	};


	$(function() {
	    // add a 'js' class to the body
	    $('body').addClass('js');
	    
	    // initialise the slideshow when the DOM is ready
	    $slideshow.init();
	});  
</script>
<div id="slideshow" style="height: 285px">
	<ul class="slides-nav">  	
    	<li class="on"><a href="#pro">Төсөл, хөтөлбөр</a></li>
    	<li><a href="#lawrule">Захирамж</a></li>
    	<li><a href="#report">Төсөв, НЭЗ-ийн зорилт</a></li>
    	<li><a href="#prompt">Нийслэлийн шуурхай</a></li>
	</ul>
	<div class="slides">
    	<ul>
    		<li id="pro">
<?php
	$qry="select *";
	$qry.=" from tbl_pro";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 0, 5";
	//echo $qry; exit;
	$row2=$con->select($qry);
	$rowcount2=count($row2);
?>
<table cellpadding="5" cellspacing="1" width="100%" class="legal">
<tr align="center">
	<th>№</th>
	<th>Төсөл, хөтөлбөрийн нэр</th>
	<th width="15%">Хэрэгжих хугацаа</th>
</tr>
<?php 
	$j2=0;
	while($j2<$rowcount2){
?>
<tr>
	<td width="1%" ><?=$j2+1;?>.</td>
	<td valign="top"><a href="<?=$rf;?>/pro/detail/<?=$row2[$j2]['ProID'];?>" title="<?=$row2[$j2]['ProName'];?>"><?=GetStrBr($row2[$j2]['ProName'], 80);?></a></td>
	<td align="center"><?=$row2[$j2]['ContinueTime'];?></td>
</tr>
<?php
	$j2++;
	} 
?>
</table>
				<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/pro" style="color: #16387c">илүү &raquo;</a></p>
           	</li>
           	<li id="lawrule">
<?php
	$qry="select LawRuleID, LawRuleDate, StartDate, Title, OrganName,LawRuleNo";
	$qry.=" from tbl_lawrule T";
	$qry.=" left join ref_organ O on T.OrganID=O.OrganID";
	$qry.=" where T.IsShow='YES'";
	$qry.=" and T.IsPublic='YES'";
	$qry.=" order by T.LawRuleDate desc,T.LawRuleNo desc";
	$qry.=" limit 0, 5";
	$row1=$con->select($qry);
	$rowcount1=count($row1);
?>           	
<table cellpadding="5" cellspacing="0" width="100%" class="legal">
<tr align="center">
	<th width="1%">№</th>
	<th width="10%" nowrap="nowrap">Дугаар</th>
	<th width="8%">Батлагдсан огноо</th>
	<th width="35%">Байгууллага</th>
	<th>Захирамжийн нэр</th>
	
</tr>
<?php 
	$j1=0;
	while($j1<$rowcount1){
		if($j1%2==0) $bgclass="row1";
		else $bgclass="row2";
?>
<tr class="<?=$bgclass;?>">
	<td ><?=$j1+1;?>.</td>
	<td align="center"><?=$row1[$j1]['LawRuleNo'];?></td>
	<td align="center"><?=$row1[$j1]['LawRuleDate'];?></td>
	<td align="center"><?=$row1[$j1]['OrganName'];?></td>
	<td valign="top"><a href="<?=$rf;?>/lawrule/detail/<?=$row1[$j1]['LawRuleID'];?>" title="<?=$row1[$j1]['Title'];?>"><?=GetStrBr($row1[$j1]['Title'], 80);?></a></td>
</tr>
<?php
	$j1++;
	} 
?>
</table>
				<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/lawrule" style="color: #16387c">илүү &raquo;</a></p>
           	</li>
        	<li id="report">
<?php
	$qry="select *";
	$qry.="from tbl_report";
	$qry.=" where IsShow='YES'";
	$qry.=" order by ReportDate desc";
	$qry.=" limit 0, 5";
	$row=$con->select($qry);
	$rowcount=count($row);
?>
	<table cellpadding="5" cellspacing="1" width="100%" class="legal">
	<tr align="center">
		<th width="1%">№</th>
		<th width="15%">Огноо</th>
		<th><?=$strTitle;?></th>
	</tr>
<?php 
	$j=0;
	while($j<$rowcount){
?>
	<tr>
		<td ><?=$j+1;?>.</td>
		<td align="center"><?=$row[$j]['ReportDate'];?></td>
		<td><a href="<?=$rf;?>/report/detail/<?=$row[$j]['ReportID'];?>" title="<?=$row[$j]['Title'];?>"><?=GetStrBr(strip_tags($row[$j]['Title']), 80);?></a></td>
	</tr>
<?php
	$j++;	
	} 
?>
	</table>
				<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/report" style="color: #16387c;">илүү &raquo;</a></p>
           	</li>
           	<li id="prompt">
<?php
	$qry="select *";
	$qry.="from mayor_councilpromptness";
	$qry.=" where IsShow='YES'";
	$qry.=" order by CreateDate desc";
	$qry.=" limit 0, 5";
	$row=$con->select($qry);
	$rowcount=count($row);
?>
	<table cellpadding="5" cellspacing="1" width="100%" class="legal">
	<tr align="center">
		<th width="1%">№</th>
		<th width="13%">Огноо</th>
		<th>Нийслэлийн шуурхай</th>
		<th width="10%">Биелэлт</th>
	</tr>
<?php 
	$j=0;
	while($j<$rowcount){
?>
	<tr>
		<td><?=$j+1;?>.</td>
		<td align="center"><?=$row[$j]['PromptDate'];?></td>
		<td align="left"><a href="<?=$rf;?>/prompt/detail/<?=$row[$j]['CouncilPromptnessID'];?>"><?=$row[$j]['Title'];?></a></td>
		<td align="center">
			<?php if(!empty($row[$j]['Descr1'])){?>
			<img src="<?=$rf;?>/images/web/morefile.png" style="float: left;">
			<a href="<?=$rf;?>/prompt/detail/<?=$row[$j]['CouncilPromptnessID'];?>#execution" title="<?=$row[$j]['Title'];?>">биелэлт</a>
			<?php }?>
		</td>
	</tr>
<?php
	$j++;	
	} 
?>
	</table>
	<p style="margin: 0px; padding: 0px; float: right;"><a href="<?=$rf?>/prompt" style="color: #16387c;">илүү &raquo;</a></p>
           	</li>
		</ul>
	</div>
</div>
<div class="clear"></div>
