<footer>

<div class="foot-map">
<div class="container">
	
<div class="rlpadhome">
<div class="spacer10"></div>
<div class="row-fluid">
  <div class="span2">
	  <div class="page-header-foot">
	  <h4>Улаанбаатар <small></small></h4>
	  </div>
	  
	  	<ul class="footerlist">
			      
			      <?php
						$qry="select CapitalID, CapitalName, Url";
						$qry.=" from capital_class";
						$qry.=" where IsShow='YES' and CapitalID='101002'";
						$qry.=" order by CapitalName";
						$row=$con->select($qry);
						$rowcount=count($row);
					
						$j=0;
						while ($j<$rowcount) {
					?>
										<li><a href="<?=$rf;?>/capital/<?=$row[$j]['Url'];?>"><?=$row[$j]['CapitalName'];?></a></li>
					<?php
							$j++;
						} 
					?>
			      <li class=""><a href="<?=$rf;?>/creation">Бүтээн байгуулалт</a></li>
			      <li class=""><a href="<?=$rf;?>/history">Хотын түүх</a></li>
			      <li class=""><a href="<?=$rf;?>/comcity">Хамтын ажиллагаатай хотууд</a></li>
		</ul>
  </div>
  <div class="span2">
	  <div class="page-header-foot">
	  <h4>Мэдээ, Мэдээлэл <small></small></h4>
	  </div>
	  
	  	<ul class="footerlist">
		  <li><a href="<?=$rf;?>/news">Цаг үеийн мэдээ</a></li>
		  <li><a href="<?=$rf;?>/speech">Илтгэл, хэлсэн үг</a></li>
		  <li><a href="<?=$rf;?>/publication">Хэвлэлийн тойм</a></li>
		  <li><a href="<?=$rf;?>/news/photo">Фото мэдээ</a></li>
		  <li><a href="<?=$rf;?>/news/video">Дүрстэй мэдээ</a></li>
		</ul>
  </div>
  <div class="span2">
	  <div class="page-header-foot">
	  <h4>Нээлттэй мэдээлэл <small></small></h4>
	  </div>
	  
	  	<ul class="footerlist">
		  <?php
						$qry="select InfoClassID, InfoClassName, Url";
						$qry.=" from ref_infoclass";
						$qry.=" where IsShow='YES'";
						$qry.=" order by ShowOrder";
						$row=$con->select($qry);
						$rowcount=count($row);
					
						$j=0;
						while ($j<$rowcount) {
					?>
					<li><a href="<?=$rf;?>/<?=$row[$j]['Url'];?>"><?=$row[$j]['InfoClassName'];?></a></li>
					<?php
							$j++;
						} 
					?>
					<li><a style="font-style: italic;" href="<?=$rf?>/admin/councilpromptnessperform.php" target="_blank">Нийслэлийн шуурхайн биелэлт оруулах</a></li>
					<!--<li><a style="font-style: italic;" href="http://ub.gov.mn/ulaanbaatar_sub//index.php?option=com_docman&Itemid=26" target="_blank">Нийслэлийн шуурхайн биелэлт оруулах</a></li>-->
					<li><a style="font-style: italic;" href="<?=$rf;?>/webbudget.php">2013 оны төсвийн төсөлд санал өгөх</a></li>
		</ul>
  </div>
  <div class="span2">
	  <div class="page-header-foot">
	  <h4>Зар мэдээ <small></small></h4>
	  </div>
	  
	  	<ul class="footerlist">
		  <?php
						$qry="select NoticeClassID, NoticeClassName, Url";
						$qry.=" from ref_noticeclass";
						$qry.=" where IsShow='YES'";
						$qry.=" order by ShowOrder";
						$row=$con->select($qry);
						$rowcount=count($row);
					
						$j=0;
						while ($j<$rowcount) {
					?>
					<li><a href="<?=$rf;?>/<?=$row[$j]['Url'];?>"><?=$row[$j]['NoticeClassName'];?></a></li>
					<?php
							$j++;
						} 
					?>
		</ul>
  </div>
  <div class="span4">
	  <div class="page-header-foot">
	  <h4>Төрийн үйлчилгээ <small></small></h4>
	  </div>
	  
	  	<ul class="footerlist">
		  <?php
						$qry="select ServiceClassID, ServiceClassName";
						$qry.=" from ref_serviceclass";
						$qry.=" where IsShow='YES'";
						$qry.=" order by ShowOrder";
						$row=$con->select($qry);
						$rowcount=count($row);
					
						$j=0;
						while ($j<$rowcount) {
					?>
					<li><a href="<?=$rf;?>/service/<?=$row[$j]['ServiceClassID'];?>"><?=$row[$j]['ServiceClassName'];?></a></li>
					<?php
							$j++;
						} 
					?>
		</ul>
  </div>
</div>
</div>


<div class="spacer20"></div>

</div><!-- /container -->
</div><!-- /foot-map -->




<div class="navbar navbar-static-top">
     <div class="navbar-inner">
     <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="brand" style="font-size:12px;"><p style="margin:0;">&copy; 2012. Улаанбаатар хот. <a href="<?=$rf;?>/home">Нийслэлийн Мэдээлэл Технологийн Газар</a>. </p></div>
          
          <div class="nav-collapse collapse">
              
            <ul class="nav pull-right">
              <li class="divider-vertical"><a href="#contact">Холбоо барих</a></li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</footer>