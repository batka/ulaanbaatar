var G_INCOMPAT = false;
function GScript(src) {
	document.write('<' + 'script src="' + src + '"'
			+ ' type="text/javascript"><' + '/script>');
}
function GBrowserIsCompatible() {
	if (G_INCOMPAT)
		return false;
	return true;
}
function GApiInit() {
	if (GApiInit.called)
		return;
	GApiInit.called = true;
	window.GAddMessages
			&& GAddMessages( {
				160 : '\x3cH1\x3eServer Error\x3c/H1\x3eThe server encountered a temporary error and could not complete your request.\x3cp\x3ePlease try again in a minute or so.\x3c/p\x3e',
				1415 : '.',
				1416 : ',',
				1547 : 'mi',
				1616 : 'km',
				4100 : 'm',
				4101 : 'ft',
				10018 : 'Loading...',
				10021 : 'Zoom In',
				10022 : 'Zoom Out',
				10024 : 'Drag to zoom',
				10029 : 'Return to the last result',
				10049 : 'Map',
				10050 : 'Satellite',
				10093 : '',
				10111 : 'Map',
				10112 : 'Sat',
				10116 : 'Hybrid',
				10117 : 'Hyb',
				10120 : 'We are sorry, but we don\x27t have maps at this zoom level for this region.\x3cp\x3eTry zooming out for a broader look.\x3c/p\x3e',
				10121 : 'We are sorry, but we don\x27t have imagery at this zoom level for this region.\x3cp\x3eTry zooming out for a broader look.\x3c/p\x3e',
				10507 : 'Pan left',
				10508 : 'Pan right',
				10509 : 'Pan up',
				10510 : 'Pan down',
				10511 : 'Show street map',
				10512 : 'Show satellite imagery',
				10513 : 'Show imagery with street names',
				10806 : 'Click to see this area on Google Maps',
				10807 : 'Traffic',
				10808 : 'Show Traffic',
				10809 : 'Hide Traffic',
				12150 : '%1$s on %2$s',
				12151 : '%1$s on %2$s at %3$s',
				12152 : '%1$s on %2$s between %3$s and %4$s',
				10985 : 'Zoom in',
				10986 : 'Zoom out',
				11047 : 'Center map here',
				11089 : '\x3ca href\x3d\x22javascript:void(0);\x22\x3eZoom In\x3c/a\x3e to see traffic for this region',
				11259 : 'Full-screen',
				11751 : 'Show street map with terrain',
				11752 : 'Style:',
				11757 : 'Change map style',
				11758 : 'Terrain',
				11759 : 'Ter',
				11794 : 'Show labels',
				11303 : 'Street View Help',
				11274 : 'To use street view, you need Adobe Flash Player version %1$d or newer.',
				11382 : 'Get the latest Flash Player.',
				11314 : 'We\x27re sorry, street view is currently unavailable due to high demand.\x3cbr\x3ePlease try again later!',
				1559 : 'N',
				1560 : 'S',
				1561 : 'W',
				1562 : 'E',
				1608 : 'NW',
				1591 : 'NE',
				1605 : 'SW',
				1606 : 'SE',
				11907 : 'This image is no longer available',
				10041 : 'Help',
				12471 : 'Current Location',
				12492 : 'Earth',
				12823 : 'Google has disabled usage of the Maps API for this application. See the Terms of Service for more information: %1$s.',
				12822 : 'http://code.google.com/apis/maps/terms.html',
				12915 : 'Improve the map',
				12916 : 'Google, Europa Technologies',
				13171 : 'Hybrid 3D',
				0 : ''
			});
}
var GLoad;
( function() {
	var jslinker = {
		version : "182",
		jsbinary : [
				{
					id : "maps2",
					url : "http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/maps2/main.js"
				},
				{
					id : "maps2.api",
					url : "http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/maps2.api/main.js"
				},
				{
					id : "gc",
					url : "http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/gc.js"
				},
				{
					id : "suggest",
					url : "http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/suggest/main.js"
				},
				{
					id : "pphov",
					url : "http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/pphov.js"
				} ]
	};
	GLoad = function(callback) {
		var callee = arguments.callee;
		var apiCallback = callback;
		GApiInit();
		var opts = {
			public_api : true,
			export_legacy_names : true,
			tile_override : [
					{
						maptype : 0,
						min_zoom : 7,
						max_zoom : 7,
						rect : [ {
							lo : {
								lat_e7 : 330000000,
								lng_e7 : 1246050000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1293600000
							}
						}, {
							lo : {
								lat_e7 : 366500000,
								lng_e7 : 1297000000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1320034790
							}
						} ],
						uris : [
								"http://mt0.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt1.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt2.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt3.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26" ],
						mapprint_url : "http://www.gmaptiles.co.kr/mapprint"
					},
					{
						maptype : 0,
						min_zoom : 8,
						max_zoom : 9,
						rect : [ {
							lo : {
								lat_e7 : 330000000,
								lng_e7 : 1246050000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1279600000
							}
						}, {
							lo : {
								lat_e7 : 345000000,
								lng_e7 : 1279600000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1286700000
							}
						}, {
							lo : {
								lat_e7 : 348900000,
								lng_e7 : 1286700000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1293600000
							}
						}, {
							lo : {
								lat_e7 : 354690000,
								lng_e7 : 1293600000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1320034790
							}
						} ],
						uris : [
								"http://mt0.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt1.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt2.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt3.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26" ],
						mapprint_url : "http://www.gmaptiles.co.kr/mapprint"
					},
					{
						maptype : 0,
						min_zoom : 10,
						max_zoom : 18,
						rect : [ {
							lo : {
								lat_e7 : 329890840,
								lng_e7 : 1246055600
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1284960940
							}
						}, {
							lo : {
								lat_e7 : 344646740,
								lng_e7 : 1284960940
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1288476560
							}
						}, {
							lo : {
								lat_e7 : 350277470,
								lng_e7 : 1288476560
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1310531620
							}
						}, {
							lo : {
								lat_e7 : 370277730,
								lng_e7 : 1310531620
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1320034790
							}
						} ],
						uris : [
								"http://mt0.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt1.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt2.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26",
								"http://mt3.gmaptiles.co.kr/mt/v=kr1.11\x26hl=en\x26src=api\x26" ],
						mapprint_url : "http://www.gmaptiles.co.kr/mapprint"
					},
					{
						maptype : 3,
						min_zoom : 7,
						max_zoom : 7,
						rect : [ {
							lo : {
								lat_e7 : 330000000,
								lng_e7 : 1246050000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1293600000
							}
						}, {
							lo : {
								lat_e7 : 366500000,
								lng_e7 : 1297000000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1320034790
							}
						} ],
						uris : [
								"http://mt0.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt1.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt2.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt3.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26" ]
					},
					{
						maptype : 3,
						min_zoom : 8,
						max_zoom : 9,
						rect : [ {
							lo : {
								lat_e7 : 330000000,
								lng_e7 : 1246050000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1279600000
							}
						}, {
							lo : {
								lat_e7 : 345000000,
								lng_e7 : 1279600000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1286700000
							}
						}, {
							lo : {
								lat_e7 : 348900000,
								lng_e7 : 1286700000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1293600000
							}
						}, {
							lo : {
								lat_e7 : 354690000,
								lng_e7 : 1293600000
							},
							hi : {
								lat_e7 : 386200000,
								lng_e7 : 1320034790
							}
						} ],
						uris : [
								"http://mt0.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt1.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt2.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt3.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26" ]
					},
					{
						maptype : 3,
						min_zoom : 10,
						rect : [ {
							lo : {
								lat_e7 : 329890840,
								lng_e7 : 1246055600
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1284960940
							}
						}, {
							lo : {
								lat_e7 : 344646740,
								lng_e7 : 1284960940
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1288476560
							}
						}, {
							lo : {
								lat_e7 : 350277470,
								lng_e7 : 1288476560
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1310531620
							}
						}, {
							lo : {
								lat_e7 : 370277730,
								lng_e7 : 1310531620
							},
							hi : {
								lat_e7 : 386930130,
								lng_e7 : 1320034790
							}
						} ],
						uris : [
								"http://mt0.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt1.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt2.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26",
								"http://mt3.gmaptiles.co.kr/mt/v=kr1p.11\x26hl=en\x26src=api\x26" ]
					} ],
			jsmain : "http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/maps2.api/main.js",
			log_info_window_ratio : 0,
			log_fragment_count : 10,
			log_fragment_seed : 7,
			obliques_urls : [ "http://khmdb0.google.com/kh?v=22\x26",
					"http://khmdb1.google.com/kh?v=22\x26" ]
		};
		var pageArgs = {};
		apiCallback(
				[
						"http://mt0.google.com/vt/lyrs\x3dm@114\x26hl\x3den\x26src\x3dapi\x26",
						"http://mt1.google.com/vt/lyrs\x3dm@114\x26hl\x3den\x26src\x3dapi\x26" ],
				[ "http://khm0.google.com/kh/v\x3d49\x26",
						"http://khm1.google.com/kh/v\x3d49\x26" ],
				[
						"http://mt0.google.com/vt/lyrs\x3dh@114\x26hl\x3den\x26src\x3dapi\x26",
						"http://mt1.google.com/vt/lyrs\x3dh@114\x26hl\x3den\x26src\x3dapi\x26" ],
				"",
				"",
				"",
				true,
				"google.maps.",
				opts,
				[
						"http://mt0.google.com/vt/v\x3dapp.114\x26hl\x3den\x26src\x3dapi\x26",
						"http://mt1.google.com/vt/v\x3dapp.114\x26hl\x3den\x26src\x3dapi\x26" ],
				jslinker, pageArgs);
		if (!callee.called) {
			callee.called = true;
		}
	}
})();
function GUnload() {
	if (window.GUnloadApi) {
		GUnloadApi();
	}
}
var _mIsRtl = false;
var _mF = [
		,
		,
		false,
		,
		,
		20,
		4096,
		"bounds_cippppt.txt",
		"cities_cippppt.txt",
		"local/add/flagStreetView",
		true,
		,
		400,
		,
		,
		,
		,
		,
		,
		"/maps/c/ui/HovercardLauncher/dommanifest.js",
		,
		,
		,
		false,
		false,
		,
		,
		,
		,
		,
		true,
		,
		,
		,
		,
		,
		,
		,
		"http://maps.google.com/maps/stk/fetch",
		0,
		,
		true,
		,
		,
		,
		true,
		,
		,
		,
		"http://maps.google.com/maps/stk/style",
		,
		"107485602240773805043.00043dadc95ca3874f1fa",
		,
		,
		false,
		1000,
		,
		"http://cbk0.google.com",
		false,
		,
		"ar,iw",
		,
		,
		,
		,
		,
		,
		,
		,
		"http://pagead2.googlesyndication.com/pagead/imgad?id\x3dCMKp3NaV5_mE1AEQEBgQMgieroCd6vHEKA",
		,
		,
		false,
		false,
		,
		false,
		5000,
		,
		,
		,
		"SS",
		"en,fr,ja",
		,
		,
		,
		,
		,
		,
		true,
		,
		,
		false,
		,
		,
		true,
		,
		,
		,
		,
		"",
		"1",
		,
		false,
		false,
		,
		false,
		,
		,
		,
		"AU,BE,FR,NZ,US",
		,
		,
		false,
		true,
		500,
		"http://chart.apis.google.com/chart?cht\x3dqr\x26chs\x3d80x80\x26chld\x3d|0\x26chl\x3d",
		,
		,
		,
		true,
		,
		,
		,
		,
		false,
		,
		,
		false,
		false,
		true,
		,
		,
		true,
		,
		,
		,
		,
		,
		,
		,
		10,
		,
		true,
		true,
		,
		,
		false,
		30,
		"infowindow_v1",
		"",
		false,
		true,
		22,
		'http://khm.google.com/vt/lbw/lyrs\x3dm\x26hl\x3den\x26',
		'http://khm.google.com/vt/lbw/lyrs\x3ds\x26hl\x3den\x26',
		'http://khm.google.com/vt/lbw/lyrs\x3dy\x26hl\x3den\x26',
		'http://khm.google.com/vt/lbw/lyrs\x3dp\x26hl\x3den\x26',
		,
		,
		false,
		"US,AU,NZ,FR,DK,MX,BE,CA,DE,GB,IE,PR,PT,RU,SG,JM,HK,TW,MY,TH,AT,CZ,CN,IN,KR",
		,
		,
		"windows-ie,windows-firefox,windows-chrome,macos-safari,macos-firefox",
		true,
		false,
		20000,
		600,
		30,
		,
		,
		,
		,
		,
		false,
		false,
		,
		,
		"maps.google.com",
		,
		,
		true,
		true,
		"",
		true,
		true,
		false,
		,
		true,
		"4:http://gt%1$d.google.com/mt?v\x3dgwm.fresh\x26",
		"4:http://gt%1$d.google.com/mt?v\x3dgwh.fresh\x26",
		true,
		false,
		false,
		,
		0.25,
		,
		"107485602240773805043.0004561b22ebdc3750300",
		false,
		,
		,
		,
		false,
		,
		,
		true,
		,
		8,
		,
		,
		,
		,
		false,
		"https://cbks0.google.com",
		false,
		true,
		,
		,
		,
		,
		,
		false,
		,
		,
		,
		,
		,
		,
		true,
		false,
		,
		,
		true,
		true,
		false,
		,
		,
		,
		true,
		"http://mt0.google.com/vt/ft",
		false,
		,
		"http://chart.apis.google.com/chart",
		false,
		,
		true,
		,
		,
		,
		'0.25',
		false,
		false,
		,
		,
		,
		false,
		true,
		2,
		160,
		,
		,
		false,
		true,
		false,
		true,
		true,
		true,
		false,
		true,
		,
		45,
		true,
		,
		false,
		true,
		true,
		false,
		true,
		false,
		false,
		false,
		false,
		,
		false,
		false,
		false,
		false,
		true,
		false,
		false,
		true,
		true,
		,
		true,
		false,
		false,
		false,
		false,
		false,
		true,
		true,
		"DE,CH,LI,AT,BE,PL,NL,HU,GR,HR,CZ,SK,TR,BR,EE,ES,AD,SE,NO,DK,FI,IT,VA,SM,IL,CL,MX,AR,BG,PT",
		false, true, "15", true, 25, "Home for sale", , false, false, true,
		false, false, false,
		"4:https://gt%1$d.google.com/mt?v\x3dgwm.fresh\x26",
		"4:https://gt%1$d.google.com/mt?v\x3dgwh.fresh\x26", false, true,
		false, false, "", false, false, false, true, false, false, false,
		false, "1.x", false, false, false, false ];
var _mHost = "http://maps.google.com";
var _mHost1 = "http://stat.gogo.mn";
var _mUri = "/maps";
var _mDomain = "google.com";
var _mStaticPath1 = "http://stat.gogo.mn/map/static/";
var _mStaticPath = "http://maps.gstatic.com/intl/en_ALL/mapfiles/";
var _mRelativeStaticPath = "/intl/en_ALL/mapfiles/";
var _mJavascriptVersion = G_API_VERSION = "184a";
var _mTermsUrl = "http://www.google.com/intl/en_ALL/help/terms_maps.html";
var _mLocalSearchUrl = "http://www.google.com/uds/solutions/localsearch/gmlocalsearch.js";
var _mHL = "en";
var _mGL = "";
var _mTrafficEnableApi = true;
var _mTrafficTileServerUrls = [ "http://mt0.google.com/mapstt",
		"http://mt1.google.com/mapstt", "http://mt2.google.com/mapstt",
		"http://mt3.google.com/mapstt" ];
var _mTrafficCameraLayerIds = [
		"msid:103669521412303283270.000470c7965f9af525967",
		"msid:111496436295867409379.00047329600bf6daab897" ];
var _mCityblockLatestFlashUrl = "http://maps.google.com/local_url?q=http://www.adobe.com/shockwave/download/download.cgi%3FP1_Prod_Version%3DShockwaveFlash&amp;dq=&amp;file=api&amp;s=ANYYN7manSNIV_th6k0SFvGB4jz36is1Gg";
var _mCityblockFrogLogUsage = false;
var _mCityblockInfowindowLogUsage = false;
var _mCityblockDrivingDirectionsLogUsage = false;
var _mCityblockPrintwindowLogUsage = false;
var _mCityblockPrintwindowImpressionLogUsage = false;
var _mCityblockUseSsl = false;
var _mAddressBookUrl = "/maps?file\x3dapi\x26ie\x3dUTF8\x26hl\x3den\x26sidr\x3d1\x26oi\x3dsl_menu_edit";
var _mWizActions = {
	hyphenSep : 1,
	breakSep : 2,
	dir : 3,
	searchNear : 6,
	savePlace : 9
};
var _mIGoogleUseXSS = false;
var _mIGoogleEt = "4b0f6d19AsZQ27CQ";
var _mIGoogleServerTrustedUrl = "";
var _mMMEnablePanelTab = true;
var _mIdcRouterPath = "/maps/mpl/router";
var _mIdcRelayPath = "/maps/mpl/relay";
var _mIGoogleServerUntrustedUrl = "http://maps.gmodules.com";
var _mMplGGeoXml = 100;
var _mMplGPoly = 100;
var _mMplMapViews = 100;
var _mMplGeocoding = 100;
var _mMplDirections = 100;
var _mMplEnableGoogleLinks = true;
var _mMMEnableAddContent = true;
var _mMSEnablePublicView = true;
var _mMSSurveyUrl = "";
var _mMMLogPanelLoad = true;
var _mSatelliteToken = "fzwq1D4_QLalsL7lWvLApFkYSppOqhUN8Lp3Fg";
var _mMapCopy = "Map data \x26#169;2009 ";
var _mSatelliteCopy = "Imagery \x26#169;2009 ";
var _mGoogleCopy = "\x26#169;2009 Google";
var _mPreferMetric = false;
var _mMapPrintUrl = 'http://www.google.com/mapprint';
var _mSvgForced = true;
var _mLogPanZoomClks = false;
var _mSXBmwAssistUrl = '';
var _mSXCarEnabled = true;
var _mSXServices = {};
var _mSXPhoneEnabled = true;
var _mSXQRCodeEnabled = false;
var _mLyrcItems = [ {
	label : "12102",
	layer_id : "com.panoramio.all"
}, {
	label : "12103",
	layer_id : "com.youtube.all"
}, {
	label : "12210",
	layer_id : "org.wikipedia.en"
}, {
	label : "12953",
	layer_id : "com.google.webcams"
} ];
var _mAttrInpNumMap = {
	'hundred' : 100,
	'thousand' : 1000,
	'k' : 1000,
	'million' : 1000000,
	'm' : 1000000,
	'billion' : 1000000000,
	'b' : 1000000000
};
var _mMSMarker = 'Placemark';
var _mMSLine = 'Line';
var _mMSPolygon = 'Shape';
var _mMSImage = 'Image';
var _mDirectionsDragging = true;
var _mDirectionsEnableCityblock = true;
var _mDirectionsEnableApi = true;
var _mDBM = '';
var _mAdSenseForMapsEnable = "true";
var _mAdSenseForMapsFeedUrl = "http://pagead2.googlesyndication.com/afmaps/ads";
var _mReviewsWidgetUrl = "http://www.google.com/reviews/scripts/annotations_bootstrap.js?hl\x3den\x26amp;gl\x3d";
var _mPerTileBase = "http://mt0.google.com/vt/pt";
function GLoadMapsScript() {
	if (!GLoadMapsScript.called && GBrowserIsCompatible()) {
		GLoadMapsScript.called = true;
		//GScript("http://maps.gstatic.com/intl/en_ALL/mapfiles/184a/maps2.api/main.js");
		GScript("http://stat.gogo.mn/staticcontents/map/v2/js/main-l.js");
	}
}
( function() {
	if (!window.google)
		window.google = {};
	if (!window.google.maps)
		window.google.maps = {};
	var ns = window.google.maps;
	ns.BrowserIsCompatible = GBrowserIsCompatible;
	ns.Unload = GUnload;
})();
GLoadMapsScript();
var _mObfuscatedGaiaId = "107364031330149592426";