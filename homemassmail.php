<style type="text/css">
	.massmail{
		color: #666666;
	}
	.massmail:FOCUS {
		color: #000000;
	}
	#massmailsubmit:HOVER{
		cursor: pointer;
		background-color: #ffffff;
	}
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$('#massmail').val('');
});
function massmailsubmit(){
	loadPage('#massmailinfo','<?=$rf;?>/processform.php?action=massmailadd&mail='+$('#massmail').val());
	setTimeout("$('#massmailinfo').html('');",3000);
};
</script>

<div class="subhd" style="background: #7c5916">Масс и-мэйл</div>
<div style="background: #f2f2f2">
	<table align="center" style="margin-top: 10px;">
		<tr>
			<td align="right">
				<input type="text" size="33" id="massmail" placeholder="И-мэйл хаягаа бичнэ үү." class="massmail" value="''">
			</td>
		</tr>
		<tr>
			<td align="right">
				<input type="button" value="Бүртгэх" id="massmailsubmit" onclick="massmailsubmit()">
			</td>
		</tr>
	</table>
	<div id="massmailinfo" style="height: 20px;">
	</div>
	<div class="clear"></div>
</div>
