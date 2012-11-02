eval(function (p, a, c, k, e, r) {
	e = function (c) {
		return (c < a ? "" : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36));
	};
	if (!"".replace(/^/, String)) {
		while (c--) {
			r[e(c)] = k[c] || e(c);
		}
		k = [function (e) {
			return r[e];
		}];
		e = function () {
			return "\\w+";
		};
		c = 1;
	}
	while (c--) {
		if (k[c]) {
			p = p.replace(new RegExp("\\b" + e(c) + "\\b", "g"), k[c]);
		}
	}
	return p;
}("C K(d,c,b,a){3.1G=b;3.L=d;3.M=c;3.H=a===6?{}:a;3.1l=3.H.2e==6?6:3.H.2e;3.28=3.H.2I==6?6:3.H.2I;3.20=3.H.2z==6?6:3.H.2z;3.1c=3.20==6?17:19;3.1x=17;3.Q=3.H.2k==6?0:3.H.2k;3.1u=3.H.2g==6?0+3.Q:3.H.2g+3.Q;3.1F=3.H.2c==6?0+3.Q:3.H.2c+3.Q;3.1h=3.H.26==6?3J:3.H.26;3.A=6;3.v=G.1f('1e');3.v.7.12='3o';3.v.7.J='Y';3.E=G.1f('1e');3.E.Z=3.M+'2q';3.E.1w=3.1G;3.E.7.J='1i';3.E.7.W='1j';3.1b=G.1f('1e')};K.D=1v 2W();K.D.2V=C(b){3.A=b;s(3.1c){3.2D=3.A.21().z*0.9;3.27=3.A.21().F*0.9}3.25={23:3.A.21().z/2,3F:1};3.4={O:{t:0,l:0,w:0,h:0,u:6},t:{t:0,l:0,w:0,h:0,u:6},11:{t:0,l:0,w:0,h:0,u:6},l:{t:0,l:0,w:0,h:0,u:6},r:{t:0,l:0,w:0,h:0,u:6},X:{t:0,l:0,w:0,h:0,u:6},b:{t:0,l:0,w:0,h:0,u:6},1C:{t:0,l:0,w:0,h:0,u:6},1d:{t:0,l:0,w:0,h:0,u:6},V:{t:0,l:0,w:0,h:0,u:6}};s(3.1c){3.4.T={t:0,l:0,w:0,h:0,u:6};3.4.15={t:0,l:0,w:0,h:0,u:6}}1m(8 i 1o 3.4){8 g=G.1f('1e');g.Z=3.M+'1z'+i;g.7.W='1j';G.1y.13(g);g=G.1t(3.M+'1z'+i);8 e=3.4[i];e.w=1O(3.1a(g,'z'),10);e.h=1O(3.1a(g,'F'),10);G.1y.1N(g)}1m(8 i 1o 3.4){s(i=='V'){3.1b.13(3.E)}8 f=6;s(3.4[i].u==6){f=G.1f('1e');3.1b.13(f)}R{f=3.4[i].u}f.Z=3.M+'1z'+i;f.7.12='1k';f.7.z=3.4[i].w+'B';f.7.F=3.4[i].h+'B';f.7.S=3.4[i].t+'B';f.7.1s=3.4[i].l+'B';3.4[i].u=f}3.A.31(2Z).13(3.v);3.v.Z=3.M;8 d=3.1a(G.1t(3.M),'z');3.v.7.z=(d==6?3.25.23:d);3.A.2Y().13(3.E);3.14=3.P(3.v).z;3.E.7.z=3.14+'B';3.E.7.12='1k';3.v.13(3.1b);s(3.1c){3.2h=3.P(3.v).z;2U.2T(3.2h)}s(3.1c){22=3.A;2C=3.2D;2Q=3.27;2N=3.v;2d=3.20;s(3.L){N.1g(3.L,'2b')}2a=3.v.7.z;29=3.v.7.F;N.1J(3.4.T.u,'1q',C(){8 a=22.I();a.v.7.z=2C+'B';a.1p(2d);s(3.L){N.1g(3.L,'24')}a.1x=19;a.1I(19);a.1r()});N.1J(3.4.15.u,'1q',C(){8 a=22.I();a.v.7.z=2a;a.v.7.F=29;s(a.1l!=6){a.1p(3.1l)}R{a.E.1w=a.1G}a.1x=17;a.1I(19);a.1H();a.1r()});3.1r()}8 c=['3I','3G','3E'];1m(i=0;i<c.2H;i++){N.3C(3.v,c[i],3,3.2F)}N.1g(3.A,'3B');s(3.1l!=6){3.1p(3.1l)}};K.D.2F=C(e){s(3A.3z.3y().3x('3w')!=-1&&G.3v){2B.2A.3u=19;2B.2A.3t=17}R{e.3s()}};K.D.2y=C(){s(3.A.I()!=6){N.1g(3.A,'2b');N.3r(3.v);s(3.v.2x){3.v.2x=''}s(3.v.2w){3.v.2w.1N(3.v)}3.v=6;N.1g(3.A,'24');3.A.1W(6)}};K.D.3q=C(){U 1v K(3.L,3.M,3.1G,3.H)};K.D.1I=C(c){s(!c||3.v==6)U;8 d=3.E.16;3.E.7.F=d+'B';3.14=3.P(3.v).z;3.E.7.z=3.v.7.z;3.E.7.1s=3.4.l.w+'B';3.E.7.S=3.4.O.h+'B';3.E.7.W='2v';3.4.O.t=0;3.4.O.l=0;3.4.t.l=3.4.O.w;3.4.t.w=(3.4.l.w+3.14+3.4.r.w)-3.4.O.w-3.4.11.w;3.4.t.h=3.4.O.h;3.4.11.l=3.4.t.w+3.4.O.w;3.4.l.t=3.4.O.h;3.4.l.h=d;3.4.r.l=3.14+3.4.l.w;3.4.r.t=3.4.11.h;3.4.r.h=d;3.4.X.t=d+3.4.O.h;3.4.b.l=3.4.X.w;3.4.b.t=d+3.4.O.h;3.4.b.w=(3.4.l.w+3.14+3.4.r.w)-3.4.X.w-3.4.1C.w;3.4.b.h=3.4.X.h;3.4.1C.l=3.4.b.w+3.4.X.w;3.4.1C.t=d+3.4.11.h;3.4.1d.l=3.Q+(3.14/2)-(3.4.1d.w/2);3.4.1d.t=3.4.X.t+3.4.X.h-3.Q;3.4.V.l=3.4.11.l+3.4.11.w-3.4.V.w-3.Q;3.4.V.t=3.Q;s(3.1c){3.4.T.l=3.4.V.l-3.4.T.w-5;3.4.T.t=3.4.V.t;3.4.15.l=3.4.T.l;3.4.15.t=3.4.T.t}1m(8 i 1o 3.4){s(i=='V'){3.1b.3p(3.E,3.4[i].u)}8 e=6;s(3.4[i].u==6){e=G.1f('1e');3.1b.13(e)}R{e=3.4[i].u}e.Z=3.M+'1z'+i;e.7.12='1k';e.7.z=3.4[i].w+'B';e.7.F=3.4[i].h+'B';e.7.S=3.4[i].t+'B';e.7.1s=3.4[i].l+'B';3.4[i].u=e}8 a=3.L;8 b=3.A;N.1J(3.4.V.u,'1q',C(){b.18()});8 f=3.A.1n(3.L.1B());3.v.7.12='1k';8 g=3.L.1A();3.v.7.1s=(f.x-(3.14/2)-g.1U.x+g.1T.x)+'B';3.v.7.S=(f.y-3.4.X.h-d-3.4.O.h-3.4.1d.h-g.1U.y+g.1T.y+3.Q)+'B';3.v.7.J='1i';s(3.A.I()!=6){3.1S()}};K.D.1r=C(){s(3.4.T.u!=6&&3.4.15.u!=6){s(3.1x){3.4.T.u.7.J='Y';3.4.15.u.7.J='1i'}R{3.4.T.u.7.J='1i';3.4.15.u.7.J='Y'}}};K.D.1H=C(){8 g=3.E.3n(19);g.Z=3.M+'2u';g.7.W='1j';g.7.F='1R';G.1y.13(g);g=G.1t(3.M+'2u');8 c=g.16;G.1y.1N(g);3.E.7.F=c+'B';8 f=3.v.1Q;8 d=3.A.1n(3.L.1B());8 e=3.4.t.u.16+3.4.l.u.16+3.4.b.u.16;8 a=3.4.t.u.2t;3.4.l.u.7.F=c+'B';3.4.r.u.7.F=c+'B';8 b=3.4.b.u.2t-c;3.4.l.u.7.S=b+'B';3.4.r.u.7.S=b+'B';3.E.7.S=b+'B';2s=1O(3.4.t.u.7.F,10);b-=2s;3.4.V.u.7.S=b+3.Q+'B';3.4.O.u.7.S=b+'B';3.4.t.u.7.S=b+'B';3.4.11.u.7.S=b+'B';3.1S()};K.D.1S=C(){8 i=3.A.1n(3.A.2r().3m());8 r=3.A.1n(3.A.2r().3l());8 k=3.A.1n(3.L.1B());8 c=0;8 d=0;8 g=3.1u;8 h=3.1F;8 o=3.L.1A().1T;8 p=3.L.1A().1U;8 m=3.4.t.u;8 j=3.4.l.u;8 b=3.4.b.u;8 l=3.4.r.u;8 q=3.4.1d.u;8 f=k.y-(-o.y+p.y+3.P(q).F+3.P(b).F+3.P(j).F+3.P(m).F+3.1F);s(f<i.y){d=i.y-f}R{8 a=k.y+3.1F;s(a>=r.y){d=-(a-r.y)}}8 e=2p.2o(k.x+3.P(3.v).z/2+3.P(l).z+3.1u+o.x-p.x);s(e>i.x){c=-(e-i.x)}R{8 n=-(2p.2o((3.P(3.v).z/2-3.L.1A().3k.z/2)+3.P(j).z+3.Q+3.1u)-k.x-o.x+p.x);s(n<r.x){c=r.x-n}}s(c!=0||d!=0&&3.A.I()!=6){s((d<0-3.1h||d>3.1h)&&(c<0-3.1h||c>3.1h)){3.A.3j(3.L.1B())}R{3.A.3i(1v 3h(c,d))}}};K.D.1p=C(f){8 d=3.A;8 e=3.28;3f(f,C(a,c){s(d.I()!==6){8 b=G.1t(d.I().M+'2q');s(a==6||c==-1){b.1w='<2m 3e=\"3d\">3b: 3a 39 38 37 36 35 3c 34 33 \"'+f+'\"</2m>'}R{b.1w=a}s(e!=6){e()}d.I().1H()}N.1g(d,'32')})};K.D.P=C(g){8 b=3.1a(g,'J');s(b!='Y'&&b!=6){U{z:g.1Q,F:g.16}}8 f=g.7;8 c=f.W;8 e=f.12;8 h=f.J;f.W='1j';f.12='1k';f.J='1i';8 a=g.3g;8 d=g.30;f.J=h;f.12=e;f.W=c;U{z:a,F:d}};K.D.1a=C(d,c){8 a=17;c=3.2n(c);s(d.Z==3.M&&c=='z'&&d.7.J=='Y'){d.7.W='1j';d.7.J=''}8 b=d.7[c];s(!b){s(G.1M&&G.1M.2l){8 e=G.1M.2l(d,6);b=e?e[c]:6}R s(d.2j){b=d.2j[c]}}s((b=='1R')&&(c=='z'||c=='F')&&(3.1a(d,'J')!='Y')){s(c=='z'){b=d.1Q}R{b=d.16}}s(d.Z==3.M&&c=='z'&&d.7.J!='Y'){d.7.J='Y';d.7.W='2v'}U(b=='1R')?6:b};K.D.2n=C(c){8 a=c.2X('-'),1L=a.2H;s(1L==1)U a[0];8 b=c.1P(0)=='-'?a[0].1P(0).2i()+a[0].2J(1):a[0];1m(8 i=1;i<1L;i++){b+=a[i].1P(0).2i()+a[i].2J(1)}U b};1Z.D.1D=6;1Z.D.1V=6;1Z.D.1X=6;1E.D.1Y=C(d,b,e,c){s(d==6){2f'2E 1o 1E.1Y: 2S 2R 2P 6';U 17}s(b==6||b==''){2f'2E 1o 1E.1Y: 2O 2M a 3D';U 17}d.2L();s(d.I()!=6){d.18()}s(d.I()==6){d.1W(1v K(3,b,e,c));s(d.1V==6){d.1V=N.2G(d,'1q',C(a){s(!a&&d.I()!=6){d.18()}})}s(d.1X==6){d.1X=N.2G(d,'2K',C(a){s(d.I()!=6){d.18()}})}d.3H(d.I())}};1E.D.18=C(a){s(a.I()!=6){a.18()}};1K.D.I=C(){U 3.1D};1K.D.1W=C(a){3.1D=a};1K.D.18=C(){s(3.I()!=6){3.1D.2y()}};", 62, 232, "|||this|wrapperParts||null|style|var||||||||||||||||||||if||domElement|container_||||width|map_|px|function|prototype|contentDiv_|height|document|options_|getExtInfoWindow|display|ExtInfoWindow|marker_|infoWindowId_|GEvent|tl|getDimensions_|borderSize_|else|top|max|return|close|visibility|bl|none|id||tr|position|appendChild|contentWidth|min|offsetHeight|false|closeExtInfoWindow|true|getStyle_|wrapperDiv_|maximizeEnabled_|beak|div|createElement|trigger|maxPanning_|block|hidden|absolute|ajaxUrl_|for|fromLatLngToDivPixel|in|ajaxRequest_|click|toggleMaxMin_|left|getElementById|paddingX_|new|innerHTML|isMaximized_|body|_|getIcon|getPoint|br|ExtInfoWindowInstance_|GMarker|paddingY_|html_|resize|redraw|addDomListener|GMap2|len|defaultView|removeChild|parseInt|charAt|offsetWidth|auto|repositionMap_|infoWindowAnchor|iconAnchor|ClickListener_|setExtInfoWindow_|InfoWindowListener_|openExtInfoWindow|GMap|maxContent_|getSize|thisMap|containerWidth|extinfowindowclose|defaultStyles|maxPanning|maxHeight_|callback_|thisMinHeight|thisMinWidth|extinfowindowbeforeclose|paddingY|thisMaxContent|ajaxUrl|throw|paddingX|minWidth_|toUpperCase|currentStyle|beakOffset|getComputedStyle|span|camelize_|round|Math|_contents|getBounds|windowTHeight|offsetTop|_tempContents|visible|parentNode|outerHTML|remove|maxContent|event|window|thisMaxWidth|maxWidth_|Error|onClick_|addListener|length|ajaxCallback|substring|infowindowopen|closeInfoWindow|specify|thisContainer|must|be|thisMaxHeight|cannot|map|log|console|initialize|GOverlay|split|getContainer|G_MAP_FLOAT_PANE|clientHeight|getPane|extinfowindowupdate|from|content|get|to|failed|request|Ajax|The|ERROR|HTML|error|class|GDownloadUrl|clientWidth|GSize|panBy|setCenter|iconSize|getSouthWest|getNorthEast|cloneNode|relative|insertBefore|copy|clearInstanceListeners|stopPropagation|returnValue|cancelBubble|all|msie|indexOf|toLowerCase|userAgent|navigator|extinfowindowopen|bindDom|cssId|DOMMouseScroll|borderSize|dblclick|addOverlay|mousedown|500".split("|"), 0, {}));
function uifix() {
	var h = $(window).height();
	var w = $(window).width();
	//$("#container").css("height", h - 165 - 65 > 0 ? (h - 165 - 65) + "px" : "0");
	//$("#leftpane").css("height", h - 165 - 45 > 0 ? (h - 165 - 45) + "px" : "0");
	//$("#container").css("width", w - 304 > 497 ? (w - 304) + "px" : "497px");
	//$("#commands").css("width", w - 324 > 477 ? (w - 324) + "px" : "477px");
}
$(function () {
	uifix();
	$(window).resize(function () {
		uifix();
		setTimeout("uifix();", 100);
	});
});
function biasPoint(p1, p2) {
	var lat = (0.5 * p1.lat() + 1.5 * p2.lat()) / 2;
	var lng = (0.5 * p1.lng() + 1.5 * p2.lng()) / 2;
	return new GLatLng(lat, lng);
}
function compressAndMovePts(allPoints, ratio) {
	var goalLength = ratio * allPoints.length;
	var distList = new Array(allPoints.length);
	var lowestPoint = 0;
	var lowestDistance = 100000;
	for (var p = 1; p < allPoints.length - 2; p += 1) {
		distList[p] = (allPoints[p].distanceFrom(allPoints[p - 1]) + allPoints[p].distanceFrom(allPoints[p + 1])) / 2;
		if ((distList[p] < lowestDistance) && (p > 1) && (p < allPoints.length - 1)) {
			lowestPoint = p;
			lowestDistance = distList[p];
		}
	}
	distList[0] = (allPoints[0].distanceFrom(allPoints[allPoints.length - 1]) + allPoints[0].distanceFrom(allPoints[1])) / 2;
	distList[allPoints.length - 1] = (allPoints[allPoints.length - 1].distanceFrom(allPoints[allPoints.length - 2]) + allPoints[allPoints.length - 1].distanceFrom(allPoints[0])) / 2;
	try {
		while (allPoints.length > goalLength) {
			var removeLatLng = allPoints[lowestPoint];
			distList.splice(lowestPoint, 1);
			allPoints.splice(lowestPoint, 1);
			allPoints[lowestPoint - 1] = biasPoint(removeLatLng, allPoints[lowestPoint - 1]);
			distList[lowestPoint - 1] = (allPoints[lowestPoint - 1].distanceFrom(allPoints[lowestPoint - 2]) + allPoints[lowestPoint - 1].distanceFrom(allPoints[lowestPoint])) / 2;
			allPoints[lowestPoint] = biasPoint(removeLatLng, allPoints[lowestPoint]);
			distList[lowestPoint] = (allPoints[lowestPoint].distanceFrom(allPoints[lowestPoint - 1]) + allPoints[lowestPoint].distanceFrom(allPoints[lowestPoint + 1])) / 2;
			var lowestDistance = 100000;
			for (var p = 2; p < allPoints.length - 2; p += 1) {
				if (distList[p] < lowestDistance) {
					lowestPoint = p;
					lowestDistance = distList[p];
				}
			}
		}
	}
	catch (e) {
		return allPoints;
	}
	return allPoints;
}
function check(zm, x, y) {
	if (zm == 13) {
		if (x > 6521 && x < 6534 && y > 5336 && y < 5347) {
			return true;
		} else {
			return false;
		}
	}
	if (zm == 14) {
		if (x > 13044 && x < 13067 && y > 10674 && y < 10693) {
			return true;
		} else {
			return false;
		}
	}
	if (zm == 15) {
		if (x > 26090 && x < 26133 && y > 21349 && y < 21385) {
			return true;
		} else {
			return false;
		}
	}
	if (zm == 16) {
		if (x > 52182 && x < 52265 && y > 42699 && y < 42769) {
			return true;
		} else {
			return false;
		}
	}
	if (zm == 17) {
		if (x > 104365 && x < 104530 && y > 85399 && y < 85537) {
			return true;
		} else {
			return false;
		}
	}
}
function TypeControl() {
}
TypeControl.prototype = new GControl();
TypeControl.prototype.initialize = function (map) {
	var that = this;
	var container = document.createElement("div");
	var zoomInDiv = document.createElement("div");
	this.setButtonStyle_(zoomInDiv, "sat");
	container.appendChild(zoomInDiv);
	GEvent.addDomListener(zoomInDiv, "click", function () {
		map.setMapType(map.getMapTypes()[0]);
	});
	var zoomOutDiv = document.createElement("div");
	this.setButtonStyle_(zoomOutDiv, "real");
	container.appendChild(zoomOutDiv);
	GEvent.addDomListener(zoomOutDiv, "click", function () {
		map.setMapType(map.getMapTypes()[1]);
	});
	map.getContainer().appendChild(container);
	return container;
};
TypeControl.prototype.getDefaultPosition = function () {
	return new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(10, 10));
};
TypeControl.prototype.setButtonStyle_ = function (button, type) {
	button.style.font = "small Arial";
	button.style.padding = "2px";
	button.style.width = "32px";
	button.style.height = "31px";
	button.style.marginBottom = "3px";
	button.style.textAlign = "center";
	button.style.cursor = "pointer";
	if (type == "sat") {
		button.style.background = "url('images/card.gif')";
	}
	if (type == "real") {
		button.style.background = "url('images/sat.gif')";
	}
};
function request(url, params, id) {
	$("#loader").show();
	$.ajax({type:"POST", url:url, data:params, success:function (data) {
		if (id) {
			$("#" + id).html(data);
		}
		$("#loader").hide();
	}, error:function (xhr, status, error) {
		$("#loader").hide();
	}});
}
var ggmap = function () {
	var map;
	var colors = {polyline:"#000080", polygon:"#F11413"};
	var polyv;
	var desc;
	var position = false;
	var tool = {measure:false, position:false, area:false};
	var plistener;
	var mker = null;
	var zips = [];
	var bdirection = {bstops:[], direction1:null, direction2:null};
	var apartment = {aps:[], region:null};
	var objects = [];
	return {init:function (id, input) {
		if(document.getElementById(id) == null) return;
		var copyCollection = new GCopyrightCollection("");
		var copyright = new GCopyright(1, new GLatLngBounds(new GLatLng(-90, -180), new GLatLng(90, 180)), 13, "");
		copyCollection.addCopyright(copyright);
		var tilelayers = [new GTileLayer(copyCollection, 13, 17)];
		tilelayers[0].getTileUrl = function (a, b) {
			var zm = b;
			var coff = 8191;
			var mx = (zm - 13);
			for (var i = 0; i < mx; i += 1) {
				coff = (coff * 2) + 1;
			}
			var tiles = "";
			if (check(zm, a.x, (coff - a.y))) {
				//tiles = "http://stat.gogo.mn/map/v2map/nmlvt/" + zm + "/" + a.x + "_" + (coff - a.y) + ".png";
				tiles = "http://mt" + Math.floor(Math.random() * 4) + ".google.com/vt/lyrs=m@145&hl=en&x=" + a.x + "&y=" + a.y + "&z=" + zm + "&s=Gali";
			} else {
				tiles = "http://mt" + Math.floor(Math.random() * 4) + ".google.com/vt/lyrs=m@145&hl=en&x=" + a.x + "&y=" + a.y + "&z=" + zm + "&s=Gali";
			}
			return tiles;
		};
		var tilelayers_sat = [new GTileLayer(copyCollection, 13, 17)];
		tilelayers_sat[0].getTileUrl = function (a, b) {
			var zm = b;
			var coff = 8191;
			var mx = (zm - 13);
			for (var i = 0; i < mx; i += 1) {
				coff = (coff * 2) + 1;
			}
			var tiles = "";
			if (check(zm, a.x, (coff - a.y))) {
				//tiles = "http://stat.gogo.mn/map/v2map/satvt/" + zm + "/" + a.x + "_" + (coff - a.y) + ".jpg";
				tiles = "http://khm" + Math.floor(Math.random() * 4) + ".google.com/kh/v=93&x=" + a.x + "&y=" + a.y + "&z=" + zm;
			} else {
				tiles = "http://khm" + Math.floor(Math.random() * 4) + ".google.com/kh/v=93&x=" + a.x + "&y=" + a.y + "&z=" + zm;
			}
			return tiles;
		};
		var cnormal = new GMapType(tilelayers, new GMercatorProjection(18), "dsfasdfasdf\xa0sdfasdf\xa0fasdf", {errorMessage:"Image Not found"});
		cnormal.getMinimumResolution = function () {
			return 13;
		};
		cnormal.getMaximumResolution = function () {
			return 17;
		};
		var csatlet = new GMapType(tilelayers_sat, new GMercatorProjection(18), "SAT", {errorMessage:"Image Not found"});
		csatlet.getMinimumResolution = function () {
			return 13;
		};
		csatlet.getMaximumResolution = function () {
			return 17;
		};
		map = new GMap2(document.getElementById(id), {mapTypes:[cnormal, csatlet]});
		map.enableContinuousZoom();
		map.enableScrollWheelZoom();
		map.addControl(new GLargeMapControl3D());
		map.addControl(new TypeControl());
		map.addControl(new GScaleControl());
		map.setCenter(new GLatLng(47.918631, 106.917674), 13);
		GEvent.addListener(map, "mousemove", function (point) {
			if (position == true) {
				if (desc) {
					desc.setPoint(point);
					desc.setContents(ggmap.locationBox(point));
				} else {
					desc = new ELabel(point, ggmap.locationBox(point), "awindow", new GSize(10, 60));
					map.addOverlay(desc);
				}
			}
		});
		if (input) {
			GEvent.addListener(map, "click", function (overlay, latlng) {
				if (latlng) {
					if (mker == null) {
						mker = ggmap.createMarker(latlng, new GSize(32, 32), new GPoint(16, 32), "http://stat.gogo.mn/staticcontents/map/v2/images/pmarker.png", true);
						GEvent.addListener(mker, "dragend", function (point) {
							$("#lat,#slat").val(point.lat());
							$("#lng,#slng").val(point.lng());
						});
						map.addOverlay(mker);
						$("#lat,#slat").val(latlng.lat());
						$("#lng,#slng").val(latlng.lng());
					} else {
						mker.setLatLng(latlng);
						$("#lat,#slat").val(latlng.lat());
						$("#lng,#slng").val(latlng.lng());
					}
				}
			});
			if ($("#slat").val() && $("#slng").val()) {
				var x = new GLatLng(parseFloat($("#slat").val()), parseFloat($("#slng").val()));
				mker = ggmap.createMarker(x, new GSize(32, 32), new GPoint(16, 32), "http://stat.gogo.mn/staticcontents/map/v2/images/pmarker.png", true);
				GEvent.addListener(mker, "dragend", function (point) {
					$("#lat,#slat").val(point.lat());
					$("#lng,#slng").val(point.lng());
				});
				map.addOverlay(mker);
				map.setCenter(x);
			}
		}
	}, setCenter:function (lat, lng, depth) {
		if (lat && lng && depth) {
			map.setCenter(new GLatLng(parseFloat(lat), parseFloat(lng)), depth);
		} else {
			map.setCenter(new GLatLng(47.918631, 106.917674), 13);
		}
	}, location:function () {
		this.clear();
		position = true;
	}, measure:function () {
		this.clear();
		polyv = new GPolyline([], colors.polyline, 2, 0.9);
		this.startDrawing(polyv, function () {
			if (desc) {
				desc.setPoint(polyv.getVertex(polyv.getVertexCount() - 1));
				desc.setContents(ggmap.measureBox(polyv));
			} else {
				desc = new ELabel(polyv.getVertex(polyv.getVertexCount() - 1), ggmap.measureBox(polyv), "mwindow", new GSize(10, -10));
				map.addOverlay(desc);
			}
		}, colors.polyline);
	}, area:function () {
		this.clear();
		polyv = new GPolygon([], colors.polygon, 2, 0.9, colors.polygon, 0.3);
		this.startDrawing(polyv, function () {
			if (desc) {
				desc.setPoint(polyv.getVertex(polyv.getVertexCount() - 1));
				desc.setContents(ggmap.areaBox(polyv));
			} else {
				desc = new ELabel(polyv.getVertex(polyv.getVertexCount() - 1), ggmap.areaBox(polyv), "awindow", new GSize(10, -10));
				map.addOverlay(desc);
			}
		}, colors.polygon);
	}, startDrawing:function (poly, onUpdate, color) {
		map.addOverlay(poly);
		poly.enableDrawing({});
		poly.enableEditing({onEvent:"mouseover"});
		poly.disableEditing({onEvent:"mouseout"});
		GEvent.bind(poly, "lineupdated", null, onUpdate);
		GEvent.addListener(poly, "endline", function () {
			GEvent.addListener(poly, "click", function (latlng, index) {
				if (typeof index == "number") {
					poly.deleteVertex(index);
				}
			});
		});
	}, clear:function () {
		if (polyv) {
			polyv.disableEditing();
			map.removeOverlay(polyv);
			polyv = null;
		}
		if (desc) {
			map.removeOverlay(desc);
			desc = null;
		}
		position = false;
		for (var i = 0; i < zips.length; i += 1) {
			map.removeOverlay(zips[i].point);
			map.removeOverlay(zips[i].code);
		}
		zips = [];
		if (bdirection.direction1) {
			map.removeOverlay(bdirection.direction1);
			bdirection.direction1 = null;
		}
		if (bdirection.direction2) {
			map.removeOverlay(bdirection.direction2);
			bdirection.direction2 = null;
		}
		for (var i = 0; i < bdirection.bstops.length; i += 1) {
			map.removeOverlay(bdirection.bstops[i]);
		}
		bdirection.bstops = [];
		map.closeExtInfoWindow();
		if (apartment.region) {
			map.removeOverlay(apartment.region);
			apartment.region = null;
		}
		for (var i = 0; i < apartment.aps.length; i += 1) {
			map.removeOverlay(apartment.aps[i]);
		}
		apartment.aps = [];
		for (var i = 0; i < objects.length; i += 1) {
			map.removeOverlay(objects[i]);
		}
		objects = [];
	}, measureBox:function (poly) {
		var html = "<div class='header'><div class='close' onclick='ggmap.clear();'></div>%s</div>";
		html += "<div class='body'>%s<span class='special'>%.2f</span> %s</div>";
		var len = poly.getLength();
		return sprintf(html, this.message("js.measure"), this.message("js.measure.total.length"), len > 1000 ? len / 1000 : len, len > 1000 ? "km" : "m");
	}, Box:function (name, title) {
		var html = "<div class='header'>%s</div>";
		html += "<div class='body'>%s</div>";
		return sprintf(html, title, name);
	}, areaBox:function (poly) {
		var html = "<div class='header'><div class='close' onclick='ggmap.clear();'></div>%s</div>";
		html += "<div class='body'><table><tr><td>%s</td><td><span class='special'>%.2f</span> %s</td></tr><tr><td>%s</td><td><span class='special'>%.2f</span> %s</td></tr></table></div>";
		var len = poly.getArea();
		return sprintf(html, this.message("js.area"), this.message("js.area.km2"), len / 1000000, "km<sup>2</sup>", this.message("js.area.m2"), len, "m<sup>2</sup>");
	}, locationBox:function (point) {
		var html = "<div class='header'>%s</div>";
		html += "<div class='body'><table><tr><td width='70'>%s</td><td><span class='special'>%s</span></td></tr><tr><td>%s</td><td><span class='special'>%s</span></td></tr></table></div>";
		var lat = point.lat();
		var lng = point.lng();
		var deg = Math.floor(lat);
		var ll = lat - Math.floor(lat);
		var min = ll * 60;
		var sek = min - Math.floor(min);
		min = Math.floor(min);
		sek = sek * 60;
		sec = Math.floor(sek);
		var latstr = deg + "<sup>o</sup>" + min + "'" + sek.toFixed(2) + "''";
		deg = Math.floor(lng);
		ll = lng - Math.floor(lng);
		min = ll * 60;
		sek = min - Math.floor(min);
		min = Math.floor(min);
		sek = sek * 60;
		sec = Math.floor(sek);
		var lngstr = deg + "<sup>o</sup>" + min + "'" + sek.toFixed(2) + "''";
		return sprintf(html, this.message("js.location"), this.message("js.location.lat"), latstr, this.message("js.location.lng"), lngstr);
	}, message:function (key) {
		if (messages[key]) {
			return messages[key];
		} else {
			return key;
		}
	}, printline:function () {
		var line = new GPolyline([], colors.polyline, 2, 0.9);
		this.printDrawing(line, function () {
		}, colors.polyline);
	}, printarea:function () {
		var area = new GPolygon([], colors.polygon, 2, 0.9, colors.polygon, 0.3);
		this.printDrawing(area, function () {
		}, colors.polyline);
	}, printDrawing:function (poly, onUpdate, color) {
		map.addOverlay(poly);
		poly.enableDrawing({});
		GEvent.addListener(poly, "endline", function () {
			var x = ggmap.createMarker(poly.getVertex(poly.getVertexCount() - 1), new GSize(14, 13), new GPoint(0, 0), "http://stat.gogo.mn/staticcontents/map/v2/images/close.png", false);
			map.addOverlay(x);
			GEvent.bind(x, "click", null, function (latlng) {
				map.removeOverlay(poly);
				map.removeOverlay(x);
			});
		});
	}, placeMarker:function () {
		if (plistener != null) {
			GEvent.removeListener(plistener);
			plistener = null;
		}
		if (plistener == null) {
			plistener = GEvent.addListener(map, "click", function (overlay, latlng) {
				if (latlng) {
					GEvent.removeListener(plistener);
					plistener = null;
					var marker = ggmap.createMarker(latlng, new GSize(32, 32), new GPoint(16, 32), "http://stat.gogo.mn/staticcontents/map/v2/images/pmarker.png", true);
					map.addOverlay(marker);
					GEvent.bind(marker, "click", null, function (latlng) {
						map.removeOverlay(marker);
					});
				}
			});
		}
	}, printText:function () {
		if (plistener != null) {
			GEvent.removeListener(plistener);
			plistener = null;
		}
		if (plistener == null) {
			plistener = GEvent.addListener(map, "click", function (overlay, latlng) {
				if (latlng) {
					GEvent.removeListener(plistener);
					plistener = null;
					var val = "";
					while (val == "") {
						val = prompt(ggmap.message("js.print.text.please.input.text"), "");
					}
					if (val != null) {
						var label = new ELabel(latlng, val, "ptext", new GSize(0, 0));
						map.addOverlay(label);
						var x = ggmap.createMarker(latlng, new GSize(14, 13), new GPoint(0, 0), "http://stat.gogo.mn/staticcontents/map/v2/images/close.png", false);
						map.addOverlay(x);
						GEvent.bind(x, "click", null, function (latlng) {
							map.removeOverlay(label);
							map.removeOverlay(x);
						});
					}
				}
			});
		}
	}, textBox:function () {
		var html = "";
		var id = new Date().getTime();
		html += "<div id='c" + id + "'><input type='text' id='" + id + "' value='aaa' style='z-index:1000000;'/><input type='button' onclick='$(\"#c" + id + "\").html($(\"<div></div>\").text($(\"#" + id + "\").val()).html());'/></div>";
		return html;
	}, createMarker:function (point, size, ap, url, drag) {
		var f = new GIcon();
		f.image = url;
		f.iconSize = size;
		f.iconAnchor = ap;
		newMarker = new GMarker(point, {icon:f, draggable:drag});
		return newMarker;
	}, street:function (name, points, center) {
		this.clear();
		polyv = new GPolyline(ggmap.tolist(points), colors.polygon, 5, 0.8);
		map.addOverlay(polyv);
		desc = new ELabel(polyv.getVertex(0), ggmap.Box(name, this.message("js.street.title")), "street", new GSize(10, -10));
		map.addOverlay(desc);
		map.setCenter(polyv.getVertex(0), center == null ? 14 : center);
	}, road:function (name, points, center) {
		this.clear();
		polyv = new GPolyline(ggmap.tolist(points), colors.polygon, 5, 0.8);
		map.addOverlay(polyv);
		desc = new ELabel(polyv.getVertex(0), ggmap.Box(name, this.message("js.road.title")), "street", new GSize(10, -10));
		map.addOverlay(desc);
		map.setCenter(polyv.getVertex(0), center == null ? 14 : center);
	}, tolist:function (kml, offset) {
		var list = new Array();
		kml = kml.replace(/\(/gi, "").replace(/\)/gi, "");
		kml = kml.split(",");
		for (var i = 0; i < kml.length; i += 2) {
			if (offset) {
				list.push(new GLatLng(parseFloat(kml[i]) - offset, parseFloat(kml[i + 1]) + offset));
			} else {
				list.push(new GLatLng(parseFloat(kml[i]), parseFloat(kml[i + 1])));
			}
		}
		return list;
	}, region:function (name, points, isdist) {
		this.clear();
		var pts = ggmap.tolist(points);
		pts.push(pts[0]);
		polyv = new GPolygon(pts, colors.polygon, 2, 0.9, colors.polygon, 0.3);
		map.addOverlay(polyv);
		if (isdist == true) {
			map.setCenter(polyv.getBounds().getCenter(), 13);
			desc = new ELabel(polyv.getBounds().getCenter(), ggmap.Box(name, this.message("js.localarea")), "street", new GSize(20, -20));
		} else {
			map.setCenter(polyv.getVertex(0), 14);
			desc = new ELabel(polyv.getVertex(0), ggmap.Box(name, this.message("js.localarea")), "street", new GSize(20, -20));
		}
		map.addOverlay(desc);
	}, zipcode:function (name, points, route) {
		var pts = ggmap.tolist(points);
		pts.push(pts[0]);
		// pts = compressAndMovePts(pts, 0.5);
		var p = {};
		p.point = new GPolygon(pts, "#ffffff", 1, 1, "#000080", 0.3);
		p.code = new ELabel(p.point.getBounds().getCenter(), name, "zipnumber", new GSize(-10, 0));
		zips.push(p);
		map.addOverlay(p.point);
		map.addOverlay(p.code);
		if (route == true) {
			map.setCenter(p.point.getBounds().getCenter());
		}
	}, busdirection:function (bd, bstops, bs) {
		this.clear();
		var pts = ggmap.tolist(bd.polygon);
		bdirection.direction1 = new GPolyline(pts, "#ffffff", 9, 1);
		bdirection.direction2 = new GPolyline(pts, "#0066bb", 5, 1);
		map.addOverlay(bdirection.direction1);
		map.addOverlay(bdirection.direction2);
		var cntr = null;
		for (var i = 0; i < bstops.length; i += 1) {
			var point = new GLatLng(bstops[i].lat, bstops[i].lng);
			var marker;
			if (bstops[i].bstype == 2) {
				marker = ggmap.cBstop(point, ggmap.message("js.loading"), bstops[i].id, "http://stat.gogo.mn/staticcontents/map/v2/images/bstop/green-" + bstops[i].cname + ".png", new GSize(16, 36), new GPoint(8, 28), new GPoint(8, -2));
			}
			if (bstops[i].bstype == 1) {
				marker = ggmap.cBstop(point, ggmap.message("js.loading"), bstops[i].id, "http://stat.gogo.mn/staticcontents/map/v2/images/bstop/yellow-" + bstops[i].cname + ".png", new GSize(16, 36), new GPoint(8, 28), new GPoint(8, -2));
			}
			if (bstops[i].bstype == 0) {
				cntr = point;
				marker = ggmap.cBstop(point, ggmap.message("js.loading"), bstops[i].id, "http://stat.gogo.mn/staticcontents/map/v2/images/Ball-blue-32.png", new GSize(32, 32), new GPoint(16, 16), new GPoint(16, 16));
			}
			bdirection.bstops.push(marker);
			map.addOverlay(marker);
		}
		if (bs == 0) {
			if (cntr == null) {
				cntr = bdirection.bstops[0].getLatLng();
			}
			map.setCenter(cntr, 13);
		}
	}, cBstop:function (point, html, id, url, size, ap, wp) {
		var f = new GIcon();
		f.image = url;
		f.iconSize = size;
		f.iconAnchor = ap;
		f.infoWindowAnchor = wp;
		var newMarker = new GMarker(point, {icon:f});
		GEvent.addListener(newMarker, "click", function () {
			newMarker.openExtInfoWindow(map, "e_window", "<div style='padding:10px;'>" + html + "</div>", {ajaxUrl:"/get/busstop.do?id=" + id, beakOffset:1});
		});
		return newMarker;
	}, apartment:function (unitkml, apartments) {
		this.clear();
		if(unitkml != null) {
		var pts = ggmap.tolist(unitkml);
		pts.push(pts[0]);
		apartment.region = new GPolygon(pts, "#ffffff", 3, 1, "#000080", 0.1);
		map.addOverlay(apartment.region);
		}
		var point = null;
		for (var i = 0; i < apartments.length; i += 1) {
			point = new GLatLng(apartments[i].lat, apartments[i].lng - 0.0001);
			var marker;
			marker = this.marker(point, "e_window_min_100", apartments[i].name);
			apartment.aps.push(marker);
			map.addOverlay(marker);
		}
		if (point && unitkml != null) {
			map.setCenter(point, 15);
		}
	}, marker:function (point, cname, html, ajax, num, marker) {
		var f = new GIcon();		
		if (marker == "") {
			if (num) {
				f.image = "http://stat.gogo.mn/staticcontents/map/v2/images/marker/m" + num + ".png";
			} else {
				f.image = "http://stat.gogo.mn/staticcontents/map/v2/images/marker/marker.png";
			}
		} else {
			f.image = marker;
		}
		f.shadow = "http://stat.gogo.mn/staticcontents/map/v2/images/marker/shadow.png";
		f.shadowSize = new GSize(32, 23);
		f.iconSize = new GSize(20, 22);
		f.iconAnchor = new GPoint(10, 23);
		f.infoWindowAnchor = new GPoint(10, 0);
		var newMarker = new GMarker(point, {icon:f});
		GEvent.addListener(newMarker, "click", function () {
			if (ajax) {
				newMarker.openExtInfoWindow(map, cname, "<div style='padding:10px;'>" + html + "</div>", {ajaxUrl:ajax, beakOffset:1});
			} else {
				newMarker.openExtInfoWindow(map, cname, "<div style='padding:10px;'>" + html + "</div>", {beakOffset:1});
			}
		});
		return newMarker;
	}, result:function (objs) {
		this.clear();
		for (var i = 0; i < objs.length; i += 1) {
			objects[i] = this.marker(new GLatLng(objs[i].lat, objs[i].lng), "e_window", ggmap.message("js.loading"), "/get/object.do?id=" + objs[i].id, i + 1, objs[i].marker);
			map.addOverlay(objects[i]);
		}
	}, click:function (index, lat, lng, depth) {
		try {
			GEvent.trigger(objects[index], "click");
			map.setCenter(new GLatLng(lat, lng), depth);
		}
		catch (e) {
		}
	}, apartmentclick:function (index, lat, lng, depth) {
		try {
			GEvent.trigger(apartment.aps[index], "click");
			map.setCenter(new GLatLng(lat, lng), depth);
		}
		catch (e) {
		}
	}};
}();
function openNewWindow(name, url, width, height, posX, posY) {
	eval(name + " = window.open('" + url + "','" + name + "','width=" + width + ",height=" + height + ",toolbar=no,status=no,resizabe=no,scrollbars=yes');");
	eval(name + ".focus();");
	eval(name + ".moveTo(" + posX + "," + posY + ");");
}


