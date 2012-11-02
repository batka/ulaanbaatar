<div class="hdtitle">Төсөл, хөтөлбөр</div>
<div id="content" style="margin-bottom: 10px">
	<table class="textualData links" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<th width="1%">№</th>
		<th width="10%">Огноо</th>
		<th>Гарчиг</th>
	</tr>
<?php
	$qry="select *";
	$qry.=" from (
			select ProjectName as ProName, 'ТӨСӨЛ' as ProType, ProjectDescr as Descr, CreateDate
			from tbl_project
			where IsShow='YES'
			union all
			select ProgramName as ProName, 'ХӨТӨЛБӨР' as ProType, ProgramDescr as Descr, CreateDate
			from tbl_program
			where IsShow='YES'
			) TT ";
	$qry.=" order by TT.CreateDate desc";
	$qry.=" limit 0, 5";
	$row=$con->select($qry);
	$rowcount=count($row);
	
	$j=0;
	while ($j<$rowcount){
?>
	<tr>
		<td class="odd"><?=$j+1;?>.</td>
	  	<td class="odd" align="center"><?=$row[$j]['Date']?></td>
	  	<td class="odd" align="left"><a href="<?=$rf;?>/report/detail/<?=$row[$j]['ReportID']?>"><?=$row[$j]['ProName']?></a></td>
	</tr>
<?php
	$j++;
	} 
?>
	</table>
</div>