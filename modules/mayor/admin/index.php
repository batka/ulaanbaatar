<HTML>
<HEAD>
<TITLE>Administrator</TITLE>
<script language="JavaScript">
function goTo () {
	var page = "http://ulaanbaatar.mn/admin";
	if (page != "" ) {
		if (page == "--" ) {
			resetMenu();
		} else {
			document.location.href = page;
		}
	}
	return false;
}goTo();
</script>
</HEAD>