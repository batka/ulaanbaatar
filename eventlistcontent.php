<script type='text/javascript'>
$(document).ready(function() {
	$('#calendar').fullCalendar({
		theme: true,
		editable: false,
		events: "/json-events.php",
		loading: function(bool) {
			if (bool) $('#loading').show();
			else $('#loading').hide();
		}
	});
});
</script>
<div id="loading" style="display:none">loading...</div>
<div id="calendar"></div>