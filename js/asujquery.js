
/*
	------------- ASU Discovery Co.,Ltd -------------
	
	CreateDate: 2008-11-15 13:12
	UpdateDate: 2008-11-16 11:38
	Created by programmer UGTAKHBAYAR Mandakh

	-------------------------------------------------
	JQuery user defined function
*/

function loadPage(divTag, goUrl){
	$.ajax({
		type: "GET",
		url: goUrl,
		beforeSend: function(){
			// Handle the beforeSend event
			$(divTag).show();
			$(divTag).prepend("<div style='margin: 0px 0px 5px 2px'><img src='/images/web/loading.gif' align='absmiddle'> Уншиж байна. Түр хүлээнэ үү!</div>");
		},
		success: function(html){
			$(divTag).empty();
			$(divTag).append(html);
		}
	});
	//$(divTag).load(goUrl);	
}

function loadPage1(divTag, goUrl){
	$.ajax({
		type: "GET",
		url: goUrl,
		beforeSend: function(){
			// Handle the beforeSend event
			$(divTag).show();
			$(divTag).prepend("<div style='margin: 0px 0px 5px 2px'><img src='/images/web/loading.gif' align='absmiddle'> Түр хүлээнэ үү!</div>");
		},
		success: function(html){
			$(divTag).empty();
			$(divTag).append(html);
		}
	});
	//$(divTag).load(goUrl);	
}

function postPage(divTag, f, goUrl){
	s='';
	for(i=0;i<f.elements.length;i++) s=s+'&'+f.elements[i].name+'='+f.elements[i].value;
	$.ajax({
		type: "POST",
		url: goUrl,
		data: s,
		beforeSend: function(){
			// Handle the beforeSend event
			$(divTag).show();
			$(divTag).prepend("<div style='margin: 0px 0px 5px 2px'><img src='/1927new/images/web/loading.gif' align='absmiddle'> Уншиж байна. Түр хүлээнэ үү!</div>");
		},
		success: function(html){
			$(divTag).empty();
			$(divTag).append(html);
			$(divTag).show();
		}
	});
}

function resetForm(f){
	$(f).each(function(){
	   	this.reset();
	});
}

function remotePage(divTag, linkClass){
	$(linkClass).remote(divTag, function(){
        if (window.console && window.console.info){
        	$(divTag).prepend("<div style='margin: 0px 0px 5px 2px'><img src='/1927new/images/loading.gif'> Уншиж байна. Түр хүлээнэ үү!</div>");
			console.info('content loaded');
        }
    });
    $.ajaxHistory.initialize();
}

function changeSelectBox(pUrl, pSBSrc, pSBDst, pSBStrSelect, pSBDstValue){
	$.getJSON(pUrl,{sbdst: pSBDst, id: $(pSBSrc).val(), sbstrselect: pSBStrSelect, ajax: 'true'}, function(j){
		var options = '';
		for (var i = 0; i < j.length; i++) {
			options += '<option value="' + j[i].optionValue + '"';
			//if (i == 0) options += ' selected="selected"';
			if (pSBDstValue!='' && pSBDstValue == j[i].optionValue) options += ' selected="selected"';
			options += '>' + j[i].optionDisplay + '</option>';
			//options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
		}
		$(pSBDst).html(options);
		//$(pSBDst+' option:first').attr('selected', 'selected');
	})
}
function selectBox(pUrl, p_id_src, p_id_dst, p_selected_val, p_type){
	$.getJSON(pUrl,{p_id: p_id_dst, id: $(p_id_src).val(), type: p_type, ajax: 'true'}, function(data){
		var options = '';
		for($j=0; $j<data.length; $j++){
			options += '<option value="' + data.value[$j]+ '"';
			if (p_selected_val!='' && p_selected_val == data.value[$j]) options += ' selected="selected"';
			options += '>' + data.name[$j]+ '</option>';
	    };
		$(p_id_dst).html(options);
	});
}
function blockUI(divDlg, divWidth){
	$.blockUI({
		message: $(divDlg),
		css: {
			padding: '5px',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			opacity: '1',
			color: '#fff',
			width: divWidth
		}
	});
}

function saveFormData(a_url){
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:a_url,
				secureuri:false,
				fileElementId:'filesource',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				}
			}
		)
		return false;
}

function ajaxFileUpload(fpath){
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'js/jquery/ajaxfileupload/doajaxfileupload.php?filepath='+fpath,
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							alert(data.msg);
						}
					}
				}
			}
		)
		return false;
}

function mycarousel_itemVisibleInCallback(carousel, item, i, state, evt)
{
    // The index() method calculates the index from a
    // given index who is out of the actual item range.
    var idx = carousel.index(i, mycarousel_itemList.length);
    carousel.add(i, mycarousel_getItemHTML(mycarousel_itemList[idx - 1]));
};

function mycarousel_itemVisibleOutCallback(carousel, item, i, state, evt)
{
    carousel.remove(i);
};

/**
 * Item html creation helper.
 */
function mycarousel_getItemHTML(item)
{
    return '<img src="' + item.url + '" width="80" height="60" alt="' + item.title + '" />';
};

function noneDIV(divelm, btnminus, btnplus, divcntmin, divcnt){
	for(i=1;i<=$.cookie(divelm);i++){
		if($("#"+divelm+i)!=undefined){
			$("#"+divelm+i).show();
		} else break;
	}
	if($.cookie(divelm)<=divcntmin){
		$('#'+btnminus).attr({
			disabled:"disabled",
			src: "http://"+window.location.hostname+"/eland/images/icon/remove_item_dis.png",
			style:"cursor:default",
			title:""
		})
	}
	if($.cookie(divelm)>=divcnt){
		$('#'+btnplus).attr({
			disabled:"disabled",
			src: "http://"+window.location.hostname+"/eland/images/icon/add_item_dis.png",
			style:"cursor:default",
			title:""
		})
	}
}

function plusDIV(divelm,btnminus, btnplus, divcntmin, divcnt){
	i=$.cookie(divelm);
	if(i<divcnt){
		i++; 
		if(i>divcntmin) $('#'+btnminus).attr({
			disabled:"",
			src: "http://"+window.location.hostname+"/eland/images/icon/remove_item.png",
			style:"cursor:pointer",
			title:"Хасах"
		});
		else $('#'+btnminus).attr({
			disabled:"disabled",
			src: "http://"+window.location.hostname+"/eland/images/icon/remove_item_dis.png",
			style:"cursor:default",
			title:"Хасах"
		});
	}
	if($("#"+divelm+i)!=undefined){
		$("#"+divelm+i).show();
		if(i==divcnt) $('#'+btnplus).attr({
			disabled:"disabled",
			src: "http://"+window.location.hostname+"/eland/images/icon/add_item_dis.png",
			style:"cursor:default",
			title:""
		});
		$.cookie(divelm,i);
	}
}

function minusDIV(divelm, btnminus, btnplus, divcntmin, divcnt){
	i=$.cookie(divelm);
	$("#"+divelm+i).hide();
	if(i>divcntmin){
		i--;
		
		if(i<divcnt) $('#'+btnplus).attr({
			disabled:"",
			src: "http://"+window.location.hostname+"/eland/images/icon/add_item.png",
			style:"cursor:pointer",
			title:"Нэмэх"
		});
		else $('#'+btnplus).attr({
			disabled:"disabled",
			src: "http://"+window.location.hostname+"/eland/images/icon/add_item_dis.png",
			style:"cursor:default",
			title:""
		});
	}
	if(i==divcntmin) $('#'+btnminus).attr({
		disabled:"disabled",
		src: "http://"+window.location.hostname+"/eland/images/icon/remove_item_dis.png",
		style:"cursor:default",
		title:""
	});
	$.cookie(divelm,i);
}