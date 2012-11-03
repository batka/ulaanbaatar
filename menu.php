<div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
           		<li class=""><a href="/home">Нүүр</a></li>
           		<li class="dropdown">
			    	<a class="dropdown-toggle" data-hover="dropdown" href="#">Улаанбаатар<b class="caret"></b></a>
				    <ul class="dropdown-menu">
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
				
			  	</li>
			  	<li class="dropdown ">
			    	<a class="dropdown-toggle" data-hover="dropdown" href="#">Мэдээ, Мэдээлэл<b class="caret"></b></a>
				    <ul class="dropdown-menu" role="menu">
				      <li><a href="<?=$rf;?>/news">Цаг үеийн мэдээ</a></li>
						<li><a href="<?=$rf;?>/speech">Илтгэл, хэлсэн үг</a></li>
						<li><a href="<?=$rf;?>/publication">Хэвлэлийн тойм</a></li>
						<li><a href="<?=$rf;?>/news/photo">Фото мэдээ</a></li>
						<li><a href="<?=$rf;?>/news/video">Дүрстэй мэдээ</a></li>
				    </ul>
			  	</li>
			  	<li class="dropdown">
			    	<a class="dropdown-toggle"
						data-hover="dropdown" data-delay="500"
						href="#">
						Нээлттэй мэдээлэл
						<b class="caret"></b>
					</a>
				    <ul class="dropdown-menu" role="menu">
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
				  </li>
			  	<li class="dropdown ">
			    <a class="dropdown-toggle"
			       data-hover="dropdown" data-delay="500"
			       href="#">
			        Зар мэдээ
			        <b class="caret"></b>
			      </a>
			    <ul class="dropdown-menu" role="menu">
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
			  </li>
			  
			  
			  
			  <li class="dropdown ">
			    <a class="dropdown-toggle"
			       data-hover="dropdown" data-delay="500"
			       href="#">
			        Төрийн үйлчилгээ
			        <b class="caret"></b>
			      </a>
			    <ul class="dropdown-menu" role="menu">
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
							<li>
								<a href="<?=$rf;?>/service/<?=$row[$j]['ServiceClassID'];?>">
									<?=$row[$j]['ServiceClassName'];?>
								</a>
							</li>
					<?php
							$j++;
						} 
					?>
				</ul>
			  </li>
				<li>
					<a href="http://www.ubgeodata.mn/geocity/map_default.phtml?config=basemap&language=mn" target="_blank">MAP</a>
				</li>
            </ul>
            <?php if(empty($websearchform)){?>
				<form class="navbar-form pull-right" id="webSearch" name="webSearch" action="/search" method="post">
					<input type="text" size="25" id="srch_v" name="srch_v" class="span2 search-query">
					<button type="submit" class="btn">Хайх</button>
				</form>
			<?php }?>
          </div><!--/.nav-collapse -->



        </div>
      </div>