
/*
	------------- ASU Discovery Co.,Ltd -------------
	
	CreateDate: 2008-11-15 12:18
	UpdateDate: 2008-11-16 11:38
	Created by programmer UGTAKHBAYAR Mandakh

	-------------------------------------------------
	General user defined function
*/

var querywindow = '';

function OpenWindow(url,p_height,p_width,p_top){
	if(p_width==undefined) p_width='500';
	
    if (!querywindow.closed && querywindow.location) {
        querywindow.focus();
    } else {
		//alert(url+'&scrolltop='+p_top);
		querywindow=window.open(url,'','toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=yes,resizable=no,top=1,left=1,width='+p_width+',height='+p_height);
    }

    if (!querywindow.opener) {
        querywindow.opener = self;
    }

	querywindow.location=url;

	if (window.focus) {		
        querywindow.focus();
    }

    return false;
}

function ShowPage(f,elm){
	f.activepage.value=elm;
	f.submit();
}

function asuIsEmpty(elm,msg){
	if(elm=="" || elm==null){
		return "\""+msg+"\" талбар нь хоосон байна.\n";
	}
	return "";
}

function IsNum(elm,msg,cc){
	if(isNaN(elm.value)){
    	alert(msg+" нь тоо байх ёстой!");
		elm.value="";
		elm.focus();
		return false;
	}
	else if(parseFloat(elm.value)<=0 && cc!=1){
		alert(msg+" нь 0-ээс багагүй байх ёстой!");
		elm.value="";
		elm.focus();
		return false;
	}
	return true;
}

function IsEmail(elm){
	// checks if the e-mail address is valid
	/*
	var emailPat = /^(\".*\"|[A-Za-z]\w*)@(\[\d{1,3}(\.\d{1,3}){3}]|[A-Za-z]\w*(\.[A-Za-z]\w*)+)$/;
	var matchArray = elm.value.match(emailPat);
	if (matchArray == null) {
		alert("Таны и-мэйл хаягийн бичилт буруу байна!");
		elm.focus();
		elm.select();
		return false;
	}
	return true;
	*/
	//alert("validating");
	emailRegEx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*\.(\w{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/;
	if (!elm.value.match(emailRegEx)){
		alert("И-мэйл хаягийн бичилт буруу байна!");
		elm.focus();
		elm.select();
		return false;
	}
	return true;
}

function WriteDate(){
	var now = new Date();
	var month = now.getMonth();
	var day = now.getDate();
	var year = now.getYear();
	var yearname;
	if(year < 1000) year+=1900;
	if(!yearname) yearname = year;
	document.write("<font face='Tahoma' color='#000000'>");
	document.write(yearname+" оны "+(month+1)+ "-р сарын " +day);
	document.write("</font>");
}

// Start of scroller script
var scrollCounter = 0;
var scrollText    = "Тавтай морилно уу."
var scrollDelay   = 100;

var i = 0;
while (i ++ < 140)
scrollText = " " + scrollText;
	
function Scroller(){
	window.status = scrollText.substring(scrollCounter++, scrollText.length);
	if (scrollCounter == scrollText.length)  
	scrollCounter = 0;
	setTimeout("Scroller()", scrollDelay);
	//window.status = "Тавтай морилно уу.";
}
// End of scroller script -->

/***********************************************
* Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

function disableSelection(target){
	if (typeof target.onselectstart!="undefined") //IE route
		target.onselectstart=function(){return false}
	else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
		target.style.MozUserSelect="none"
	else //All other route (ie: Opera)
		target.onmousedown=function(){return false}
	target.style.cursor = "default"
}

nereidFadeObjects = new Object();
nereidFadeTimers = new Object();
function nereidFade(object, destOp, rate, delta){
	if (!document.all)
	return
	if (object != "[object]"){ //do this so I can take a string too
		setTimeout("nereidFade("+object+","+destOp+","+rate+","+delta+")",0);
		return;
	}
	
	clearTimeout(nereidFadeTimers[object.sourceIndex]);
	
	diff = destOp-object.filters.alpha.opacity;
	direction = 1;
	if (object.filters.alpha.opacity > destOp){
		direction = -1;
	}
	delta=Math.min(direction*diff,delta);
	object.filters.alpha.opacity+=direction*delta; 
	if (object.filters.alpha.opacity != destOp){
		nereidFadeObjects[object.sourceIndex]=object;
		nereidFadeTimers[object.sourceIndex]=setTimeout("nereidFade(nereidFadeObjects["+object.sourceIndex+"],"+destOp+","+rate+","+delta+")",rate);
	}
}

//Sample usages
//disableSelection(document.body) //Disable text selection on entire body
//disableSelection(document.getElementById("mydiv")) //Disable text selection on element with id="mydiv"


//Disable right click script III- By Renigade (renigade@mediaone.net)
//For full source code, visit http://www.dynamicdrive.com

/*
	var message="";
	
	function clickIE() {if (document.all) {(message);return false;}}
	function clickNS(e) {if
	(document.layers||(document.getElementById&&!document.all)) {
	if (e.which==2||e.which==3) {(message);return false;}}}
	if (document.layers)
	{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
	else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
	
	document.oncontextmenu=new Function("return false")
*/

// -->
