<div id="pcgchotlines" class="contextitem">
	<h2>Цаг агаар</h2>
	
<?php
	if(empty($cityid)) $cityid='101';	

	$qry="select *";
	$qry.=" from asu_refcity";
	$qry.=" where CityID='$cityid'";
	$row=$con->select($qry); 
	$weathercode=$row[0]['WeatherCode'];
	$cityname=$row[0]['CityName'];
	$weatherlink=$row[0]['WeatherLink'];;
?>
<table cellpadding="0" cellspacing="0" width="100%" align="center">
	<tr>
		<td>
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<?php
				require_once 'libraries/yweather/YWeather.php';
				$YWeather = new YWeather($weathercode,'c');
				$YWeather->SetCacheFile('libraries/yweather/temp/yweather.cache');
				$YWeather->SetLifetime(1); 
				$a = $YWeather->Fetch();
			?>				
			<tr valign="top">
			    <td>
			        <div style="background-color:#fff;" >
			        <table width="100%" cellspacing="0" cellpadding="0" border="0">
			        <tr valign="top">
			            <td align="left" style="font-family: arial; font-size: 12px; color: #224466;"><?=$cityname;?></td>
			        </tr>
			        <tr valign="top">
			            <td align="center">
			            	<div class="tblborder">
			                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" >
			                <tr>
			                	<td colspan="3" align="center" style="color: #3275d0;"><b>ӨНӨӨДӨР</b></td>
			                </tr>
			                <tr valign="middle">
<?php
	$s=$con->GetDescr("select WeatherName from ref_weather where WeatherID='".trim($a['forecast'][0]['text'])."'");
	if(empty($s)) $s=$a['forecast'][0]['text'];
	if($a['forecast'][0]['high']>0) $ch1="+"; else if($a['forecast'][0]['high']<0) $ch1=""; else $ch1="";
	if($a['forecast'][0]['low']>0) $ch2="+"; else if($a['forecast'][0]['low']<0) $ch2=""; else $ch2="";
?>
			                    <td width="30%" align="center">
			                    	<img src="<?=$rf."/images/weather/".$a['forecast'][0]['code'];?>.jpg" width="50"><br/>
			                    </td>
			                    <td width="15%" align="center" style="color:#224466; font-family: arial; font-weight: normal;">
			                    	<div><?=$s;?></div>
			                    </td>
			                    <td width="30%" align="center" style="font-family: arial; font-size: 11px; font-weight: normal;"></strong>
			                    	Өдөртөө <strong><?=$ch1.$a['forecast'][0]['high'];?></strong>
			                    	Шөнөдөө <strong><?=$ch2.$a['forecast'][0]['low'];?></strong>
			                    </td>
			                </tr>
			                 <tr>
			                	<td colspan="3" align="center"><b>МАРГААШ</b></td>
			                </tr>
			                <tr valign="middle">
<?php
	$s=$con->GetDescr("select WeatherName from ref_weather where WeatherID='".trim($a['forecast'][1]['text'])."'");
	if(empty($s)) $s=$a['forecast'][1]['text'];
	if($a['forecast'][1]['high']>0) $ch1="+"; else if($a['forecast'][1]['high']<0) $ch1=""; else $ch1="";
	if($a['forecast'][1]['low']>0) $ch2="+"; else if($a['forecast'][1]['low']<0) $ch2=""; else $ch2="";
?>
			                    <td width="20%" align="center">
			                    	<img src="<?=$rf."/images/weather/".$a['forecast'][1]['code'];?>.jpg" width="50">
			                    </td>
			                    <td width="15%" align="center" style="color:#224466; font-family: arial; font-weight: normal;">
			                    	<div><?=$s;?></div>
			                    </td>
			                    <td width="30%" align="center" style="font-family: arial; font-size: 11px; font-weight: normal;">
			                    	Өдөртөө <strong><?=$ch1.$a['forecast'][1]['high'];?></strong>
			                    	Шөнөдөө <strong><?=$ch2.$a['forecast'][1]['low'];?></strong>
			                    </td>
			                </tr>
				                </table>
				                </div>
				            </td>
				        </tr>
				        <tr>
				        	<td align="right"><a href="javascript:" onclick="OpenWindow('<?=$weatherlink;?>',500,310); return false;">илүү</a>&nbsp;&nbsp;&nbsp;</td>
				        </tr>
				        </table>
				        </div>
					</td>
				</tr>
				</table>
   			</td>
		</tr>
</table>
	
</div>