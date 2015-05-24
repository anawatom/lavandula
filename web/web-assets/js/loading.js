function g_setLoading() {
//	document.getElementsByName("div_loading").className = "loading-visible";
    document.getElementById("div_loading").className = "loading-visible";
}

function g_unsetLoading() {
    document.getElementById("div_loading").className = "loading-invisible";
    //document.getElementById('block-page').style.display='none';
}

function g_setBlock() {
	var D = document;
	jQuery("#block-page").css("height",Math.max(
	        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
	        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
	        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
	    ));
	jQuery("#block-page").css("width",Math.max(
	        Math.max(D.body.scrollWidth, D.documentElement.scrollWidth),
	        Math.max(D.body.offsetWidth, D.documentElement.offsetWidth),
	        Math.max(D.body.clientWidth, D.documentElement.clientWidth)
	    ));
    D.getElementById("block-page").className = "loading-block";
}

function g_unsetBlock() {
    document.getElementById("block-page").className = "loading-unblock";
}
function loading(){
	g_setLoading();
	g_setBlock();
}
function unloading(){
	g_unsetLoading();
	g_unsetBlock();
}
function fLoadCommin(i_divLoading){
	g_divLoading = i_divLoading;
//	if(jQuery("#f_"+i_divLoading).html()){
//		return;
//	}
	var v_divPopup = "";
	v_divPopup += "<div id='"+i_divLoading+"_loading' class='loading-invisible'>"+jQuery("#div_loading").html()+"</div>";
	v_divPopup += "<div id='"+i_divLoading+"block-page' class='loading-unblock'>"+jQuery("#block-page").html()+"</div>";
	jQuery("#f_"+i_divLoading).html(v_divPopup);	
}
function fLoading() {
//	return;
	if(!g_divLoading){
		return;
	}
	var D = document;
	jQuery(g_divLoading+"#block-page").css("height",Math.max(
	        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
	        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
	        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
	    ));
	jQuery(g_divLoading+"#block-page").css("width",Math.max(
	        Math.max(D.body.scrollWidth, D.documentElement.scrollWidth),
	        Math.max(D.body.offsetWidth, D.documentElement.offsetWidth),
	        Math.max(D.body.clientWidth, D.documentElement.clientWidth)
	    ));
    D.getElementById(g_divLoading+"block-page").className = "loading-block";
    
    document.getElementById(g_divLoading+"_loading").className = "loading-visible";
    
}

function fUnloading() {
//	return;
	if(!g_divLoading){
		return;
	}
    document.getElementById(g_divLoading+"_loading").className = "loading-invisible";
    document.getElementById(g_divLoading+"block-page").className = "loading-unblock";
    //document.getElementById('block-page').style.display='none';
}

function loadingMessage(msg) {
	if(msg!=undefined){
		jQuery('div#div_loading').find('span.message').html(msg);
	}else{
		jQuery('div#div_loading').find('span.message').html('Loading');
	}
}