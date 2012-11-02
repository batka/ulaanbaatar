<div style="padding: 5px">
<?php 
	$qry="select O.*, C.OrganClassName, OC.*";
	$qry.=" from ref_organ O";
	$qry.=" left join ref_organclass C on O.OrganClassID = C.OrganClassID";
	$qry.=" left join (
			select CapitalID as ClassID, Url, Domain
			from capital_class
			where IsShow='YES'
			union all
			select DistrictID as ClassID, Url, Domain
			from district_class
			where IsShow='YES'
			union all
			select AgencyID as ClassID, Url, Domain
			from agency_class
			where IsShow='YES'
			union all
			select RegionID as ClassID, Url, Domain
			from region_class
			where IsShow='YES'
			union all
			select ZAARegionID as ClassID, Url, Domain
			from zaaregion_class
			where IsShow='YES'
	)OC on O.RegID=OC.ClassID";
	//echo $qry; exit;
	$qry.=" where O.IsShow='YES'";
	//$qry.=" AND C.OrganClassID !='101'";
	$qry.=" AND C.OrganClassID !='106'";
	$qry.=" AND C.OrganClassID !='107'";
	$qry.=" order by C.ShowOrder, O.OrganClassID, O.ShowOrder, O.OrganName";
	//echo $qry;
	$row = $con->select($qry);
	$rowcount = count($row);
	for($str='', $i=0; $i<$rowcount; $i++){
		if($str!=$row[$i]['OrganClassID']){
			$str = $row[$i]['OrganClassID']; 
			if($i!=0){
?>
			</select>
			</div>
<?php 
			}
?>
	<div style="margin-top: 0px">
		<select name="select<?=$row[$i]['OrganClassID'];?>" id="select<?=$row[$i]['OrganClassID'];?>" style="width: 250px">
			<option value=""><?=$row[$i]['OrganClassName'];?></option>
			<option value="<?=$row[$i]['Url'];?>"><?=$row[$i]['OrganName'];?></option>
<?php 
		} else {
			if(!empty($row[$i]['Url']) || !empty($row[$i]['Domain'])){
?>
			<option value="<?=$row[$i]['Url'];?>"><?=$row[$i]['OrganName'];?></option>
<?php 
			}
		}
		
	}
?>	
		</select>
	</div>
<?php 
	$qry="select * from ref_organclass where IsShow = 'YES' order by ShowOrder";
	$row = $con->select($qry);
	$rowcount = count($row);
?>
<script type="text/javascript">
	<?php 
		for($i=0; $i<$rowcount; $i++){
			if($row[$i]['OrganClassID']=='101') $link = "capital";
			if($row[$i]['OrganClassID']=='102') $link = "district";
			if($row[$i]['OrganClassID']=='103') $link = "agency";
			if($row[$i]['OrganClassID']=='104') $link = "region";
			if($row[$i]['OrganClassID']=='105') $link = "zaaregion";
	?>
	$("#select<?=$row[$i]['OrganClassID'];?>").change(function(){
		if($(this).val!='')	window.open("<?=$rf;?>/<?=$link;?>/"+$(this).val(), "_parent");
	});
	<?php }?>
</script>
</div>
