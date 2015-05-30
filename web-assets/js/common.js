//Global variable
var lastsel2;
var g_OnEditRowId;


//Constructor
var Common = function (){};

/***************** Common.jqgridOptions *************************************************************************************************/
Common.jqgridOptions = {};
Common.jqgridOptions.navGridDelete = {
    jqModal: true,
    reloadAfterSubmit: true,
    afterShowForm: function(form) {
        var $dialog = $(form).closest('div[role="dialog"]');
        // hide original confirm
        $dialog.hide();

        BootstrapDialog.confirm('กรุณายืนยัน', 
        function(r) {
            if (r) {
                $dialog.find('#dData').trigger('click');
            } else {
                $dialog.find('#eData').trigger('click');
            }
        });
    },
    afterComplete: function(response, postdata, formid) {
        var data = $.parseJSON(response.responseText);

        if (!data.success) {
            setTimeout(function() {
                $.each(postdata, 
                function(i, e) {
                    $('#rowed5').setSelection(e, true);
                });
            }, 50);
        }

        BootstrapDialog.alert(data.message);
    }
};
/****************** Common.jqgrid *************************************************************************************************/
Common.jqgrid = function(){};
Common.jqgrid.setEditMode = function(pager, isEditMode){
	if(isEditMode){
		jQuery(pager).find('.glyphicon-plus, .glyphicon-trash, .glyphicon-search, .glyphicon-refresh').closest('td').removeClass('ui-state-disabled').addClass('ui-state-disabled');
	    jQuery(pager).find('.glyphicon-floppy-disk, .glyphicon-ban-circle').closest('td').removeClass('ui-state-disabled');
	}else{
		jQuery(pager).find('.glyphicon-plus, .glyphicon-trash, .glyphicon-search, .glyphicon-refresh').closest('td').removeClass('ui-state-disabled');
	    jQuery(pager).find('.glyphicon-floppy-disk, .glyphicon-ban-circle').closest('td').removeClass('ui-state-disabled').addClass('ui-state-disabled');
	}
};
Common.jqgrid.setAddMode = function(pager, isAddMode){
	if(isAddMode){
// 		jQuery(pager).find('.glyphicon-plus, .glyphicon-trash, .glyphicon-search, .glyphicon-refresh').closest('td').removeClass('ui-state-disabled').addClass('ui-state-disabled');
// 	    jQuery(pager).find('.glyphicon-floppy-disk, .glyphicon-ban-circle').closest('td').removeClass('ui-state-disabled');
	}else{
// 		jQuery(pager).find('.glyphicon-plus, .glyphicon-trash, .glyphicon-search, .glyphicon-refresh').closest('td').removeClass('ui-state-disabled');
// 	    jQuery(pager).find('.glyphicon-floppy-disk, .glyphicon-ban-circle').closest('td').removeClass('ui-state-disabled').addClass('ui-state-disabled');
	}
	Common.jqgrid.setEditMode(pager, false);
};
Common.jqgrid.restoreRow = function(t, id, pager){
	jQuery(t).restoreRow(lastsel2); 
	lastsel2=id;
	Common.jqgrid.setEditMode(pager, false);
	g_OnEditRowId=undefined;
};
Common.jqgrid.getPostData = function(grid){
	var postData = jQuery(grid).getGridParam('postData');
	delete postData.nd;
	delete postData.filters;
	return postData;
};
Common.jqgrid.getDefaultPostData = function(_rtparams, defaultParams){
    var rtparams = {_search: false, rows: 10, page: 1, sidx: "SEQ", sord: "asc", filters: "", searchField: "", searchOper: "", searchString: ""};
    if(defaultParams!=undefined){
        jQuery.extend(rtparams, defaultParams);
    }
    try{
    	jQuery.extend( rtparams, jQuery.parseJSON(Common.Base64.decode(_rtparams)) );
    }catch (e){}
    return rtparams;
};
Common.jqgrid.getSaveButton = function(){
    return {
       caption:"", 
       buttonicon:"glyphicon-floppy-disk", 
       onClickButton: function(){ 
            BootstrapDialog.confirm('ยืนยันการบันทึก', function(result){
                if(result) {
                    jQuery("#rowed5").saveRow(g_OnEditRowId);
                    Common.jqgrid.setEditMode('#pagered', false);
                } 
            });
       }, 
       position:"last"
    };
};
Common.jqgrid.getAddButton = function(urlfunc){
    return {
       id: "navBtnAdd",
       caption:"", 
       buttonicon:"glyphicon-plus hidden", 
       onClickButton: function(){ 
            window.location = urlfunc();
       }, 
       position:"first"
    };
};
Common.jqgrid.getCancelButton = function(){
    return {
       caption:"", 
       buttonicon:"glyphicon-ban-circle", 
       onClickButton: function(){
            BootstrapDialog.confirm('ต้องการยกเลิกการแก้ไข', function(result){
                if(result) {
                    Common.jqgrid.restoreRow('#rowed5', g_OnEditRowId, '#pagered');
                }
            });
            
       }, 
       position:"last"
    };
};
Common.jqgrid.onGridCompleted = function(){
    var pager = jQuery(this).getGridParam("pager");
	Common.jqgrid.setEditMode(pager, false);
    jQuery(this).find(">tbody>tr.jqgrow:odd").addClass("myAltRowClassEven");
    jQuery(this).find(">tbody>tr.jqgrow:even").addClass("myAltRowClassOdd");
};
Common.jqgrid.onCellSelect = function(t, id, iCol, cellcontent, noActioniCol){
    if(noActioniCol==undefined) noActioniCol=[];
	var pager = jQuery(t).getGridParam("pager");
	if(jQuery.inArray(iCol, noActioniCol)>=0){
	    Common.jqgrid.restoreRow(t, id, pager);
		jQuery(t).setSelection(id, false);
	}else if(iCol>1){
		if(id && id!==lastsel2){ 
			 Common.jqgrid.restoreRow(t, id, pager);
	    }
		jQuery(t).editRow(id, true
		, {/*oneditfunc*/}
		, function(res){jQuery(t).trigger('reloadGrid'); g_OnEditRowId=undefined;} //successfunc
		, undefined //url
		, {/*extraparam*/}
		, {/*aftersavefunc*/}
		, {/*errorfunc*/}
		, function(){jQuery(t).trigger('reloadGrid'); g_OnEditRowId=undefined;}/*afterrestorefunc*/
		)
		.setSelection(id, false);
		Common.jqgrid.setEditMode(pager, true);
		g_OnEditRowId = id;
	}else{
		Common.jqgrid.restoreRow(t, id, pager);
	}
};
Common.jqgrid.onFilter = function(required_all){
	if(required_all==undefined) required_all=false;
    var myfilter = { groupOp: "AND", rules: [] };
    var inputs = jQuery('#frmsearch').find('select, input:text, input:checked');
    jQuery(inputs).each(function(){
        if(required_all || !Common.utils.isNullOrBlank(this.value)){
            myfilter.rules.push({ field: this.name, op: "eq", data: this.value });
        }
    });
    
    // Common.utils.logger(myfilter);
    jQuery("#rowed5").setGridParam({postData: {filters: JSON.stringify(myfilter)}, datatype:'json', search:true}).trigger('reloadGrid');
};
Common.jqgrid.uploadImage = function(t, url, fileSelector, rowid, response, postdata){
    var data = jQuery.parseJSON(response.responseText);

    if (data.success == true) {
        if (!Common.utils.isNullOrBlank(fileSelector) && jQuery(fileSelector).val() != "") {
            Common.ajax.ajaxFileUpload(url, fileSelector, data.id, function(){
                jQuery(t).trigger('reloadGrid');
                setTimeout(function(){ jQuery('.ui-jqdialog-titlebar-close').click(); }, 200); //Close dialog.
            });
        } else {
            jQuery(t).trigger('reloadGrid');
            Common.utils.showFlashMessage({
                text: 'บันทึกข้อมูลสำเร็จ',
                className: 'success'
            });
        }
    } else {
        Common.jqgrid.aftersavefunc(rowid, response, postdata);
    }  

    return [data.success, data.message, data.id];
};
Common.jqgrid.playerPicFormatter = function(cellvalue, options, rowObject){
  var html = '<img class="cursor-hand" src="'+cellvalue+'" onclick="Common.bootstrap.modal.displayImg(this)" data-toggle="modal" data-target="#modalUploadFile" width="70" height="70" />';
  return html;
};
Common.jqgrid.chkFormatter = function(cellvalue, options, rowObject){
	var ret = cellvalue;
	switch(cellvalue){
		case 'A': ret = 'ใช้งาน';
			break;
		case 'C': ret = 'ไม่ใช้งาน';
			break;
		case 'Y': ret = 'ใช่';
			break;
		case 'N': ret = 'ไม่ใช่';
			break;
	}
	return ret;
};
Common.jqgrid.setColumn = function(selector, columnname, val){
	var ids = $(selector).jqGrid('getDataIDs');
//	jQuery.each(ids, function(i, l){
//		jQuery(selector).setRowData(l, { columnname: val});
//	})
	
	var colset = [];
	colset[columnname] = val;
	
	for(i=0; i<ids.length; i++){
		jQuery(selector).setRowData(ids[i], colset);
//		jQuery(selector).setRowData(ids[i], { 'month': '666'});
	}
};
Common.jqgrid.setFormInput = function(formSel, defaultOpt){
    
    var opt = {type:'hidden', name:'', id:'', value:''};
    if(defaultOpt!=undefined){
        jQuery.extend(opt, defaultOpt);
    }
    
    if(!Common.utils.isNullOrBlank(opt.name) || !Common.utils.isNullOrBlank(opt.id)){
        
        if(Common.utils.isNullOrBlank(opt.name)) opt.name = opt.id;
        else if(Common.utils.isNullOrBlank(opt.id)) opt.id = opt.name;
        
        //TODO: Add input to form.
        var elms = jQuery(formSel).find('input[name="'+opt.name+'"]');
        if(elms.length>0){ 
            elms.val(opt.value);
        }else{
            var html = '';
            html = '<input type="'+opt.type+'" name="'+opt.name+'" id="'+opt.id+'" value="'+opt.value+'" />';
            jQuery(formSel).append(html);
        }
    }
    
};
Common.jqgrid.setGridHiddenInput = function(gridSel, name, value){
    jQuery(gridSel).find('td[role="gridcell"] input[name="'+name+'"]').val(value);
};
Common.jqgrid.getBtnAction = function(cellValue, options, rowObject) {
    setTimeout(function() {
        if (Common.utils.isNullOrBlank(cellValue) || cellValue == 'save') {
            Common.jqgrid.showSubLink('save', options); 
        } else {
            Common.jqgrid.showSubLink('cancel', options); 
        }
    }, 50);

    if (Common.utils.isNullOrBlank(cellValue) || cellValue == 'save') {
        return '<span style="margin:auto;cursor:pointer;" onclick="Common.jqgrid.clickSaveRow(this)" class="glyphicon glyphicon-floppy-disk"></span><span style="margin:auto;cursor:pointer;margin-left:8px;" onclick="Common.jqgrid.clickCancelRow(this)" class="glyphicon glyphicon-ban-circle"></span>';
    } else {
        return '<span style="margin:auto;cursor:pointer;" onclick="Common.jqgrid.clickEditRow(this)" class="glyphicon glyphicon-pencil"></span>';
    }
};
Common.jqgrid.clickEditRow = function(obj) {
    var $grid = $("#rowed5");
    var $row = $(obj).closest('tr');
    var $cell = $(obj).closest('td');
    var rowId = $row.attr('id');
    //clickCancelRow(obj, rowId);

    // TODO: clear edit state in other row
    $grid.find('input[type=checkbox]').each(function() {
        var $row = $(this).closest('tr');
        var loopRowId = $row.attr('id');

        if (loopRowId != rowId) {
            Common.jqgrid.clickCancelRow($row.find('td[aria-describedby="rowed5_action"]'));
        }
    });

    // TODO: check checkbox has already been check
    if ($row.find('td[aria-describedby="rowed5_cb"] input[type="checkbox"]').prop('checked')) {
    } else {
        $grid.setSelection(rowId, true);
    }
    $('#rowed5_iledit').trigger('click');

    $cell.html(Common.jqgrid.getBtnAction('save', {gid: "rowed5", rowId: rowId}, ''));
};
Common.jqgrid.clickSaveRow = function(obj) {
    var $row = $(obj).closest('tr');
    var $cell = $(obj).closest('td');
    var rowId = $row.attr('id');

    BootstrapDialog.confirm('คุณต้องการบันทึก หรือไม่', function(result){
        if (result) {
            $('#rowed5_ilsave').trigger('click');
            
            $cell.html(Common.jqgrid.getBtnAction('cancel', {gid: "rowed5", rowId: rowId}, ''));
        } else {
        }
    });
};
Common.jqgrid.clickCancelRow = function(obj) {
    var $row = $(obj).closest('tr');
    var $cell = $(obj).closest('td');
    var rowId = $row.attr('id');

    // TODO: check checkbox has already been not check
    if ($row.find('td[aria-describedby="rowed5_cb"] input[type="checkbox"]').prop('checked')) {
        $('#rowed5').setSelection($row.attr('id'), false);
    } else {
    }
    $('#rowed5_ilcancel').trigger('click');

    $cell.html(Common.jqgrid.getBtnAction('cancel', {gid: "rowed5", rowId: rowId}, ''));
};
Common.jqgrid.showSubLink = function (action, options) {
    var $subLinkTd = $('#'+options.gid).find('#'+options.rowId).find('td[aria-describedby="rowed5_sub"]');
    if (action == 'save') {
        $subLinkTd.find('span').hide();
        $subLinkTd.append('<span style="margin:auto;cursor:pointer;" class="glyphicon glyphicon-ban-circle block-sub-link"></span>');
    } else {
        $subLinkTd.find('span').show();
        $subLinkTd.find('span.block-sub-link').remove();
    }
};
Common.jqgrid.aftersavefunc = function (rowid, response, postdata) {
    var data = jQuery.parseJSON(response.responseText);
    if (data.success == true) {
        Common.utils.showFlashMessage({
            text: 'บันทึกข้อมูลสำเร็จ',
            className: 'success'
        });
    } else {
        var errorText = '';
        $.each(data.message, function(i, e) {
            if (errorText) {
                errorText += ', '+ e;
            } else {
                errorText += e;
            }
        });

        Common.utils.showFlashMessage({
            text: errorText,
            className: 'error'
        });

        // TODO: delete row when create
        if (isNaN(rowid)) {
          $('#rowed5').jqGrid('delRowData', rowid);  
        }
    }

    jQuery('#rowed5').trigger('reloadGrid');
};
Common.jqgrid.getEditLink = function(options) {
    var className = '';
    var fnClick = '';

    if (options.year && options.month) {
        className = 'glyphicon glyphicon-ban-circle';
        fnClick = options.functionName;

        if (Common.utils.isCurrentMonth(options.year, options.month, true)) {
            if (options.status == 'A' || options.status == 'S') {
                className += 'glyphicon glyphicon-pencil';
            }
        } else {
            if (options.status == 'S') {
                className += 'glyphicon glyphicon-pencil';
            }
        }
    } else {
        className = 'glyphicon glyphicon-ban-pencil';
        fnClick = options.functionName;
    }
   
    return '<span style="margin:auto;cursor:pointer;" onclick="'+fnClick+'" class="'+className+'" data-status="'+options.status+'"></span>';
};
/***************** End of Common.jqgrid ********************************************************************************************/


/****************** Common.bootstrap *************************************************************************************************/
Common.bootstrap = function(){};
Common.bootstrap.modal = function(){};
Common.bootstrap.modal.displayImg = function(t, id){
	
	if(Common.utils.isNullOrBlank(id)) id=jQuery(t).closest('tr[role="row"]').attr('id');
	
	jQuery('#reviewImage').attr('src', jQuery(t).attr('src'));
    jQuery('#fileToUpload').val('');
	jQuery('#fileuploadid').val(id);
    jQuery('#fileToUpload').change(function() {
        Common.utils.reviewImage(this, "reviewImage");
    });
}
/****************** End of Common.bootstrap ****************************************************************************************/


/****************** Common.utils *************************************************************************************************/
Common.utils = function(){};
Common.utils.isNullOrBlank = function(obj){
	if(obj==undefined){ 
		return true;
	}else if($.isArray(obj)){
		if(obj.length == 0) return true;
	}else if($.isPlainObject(obj)){
		if($.isEmptyObject(obj)) return true;
	}else if(typeof obj === 'string'){
		if($.trim(obj)=='') return true;
	}else return false;
};
Common.utils.isFunction = function(functionToCheck) {
	var getType = {};
	return !this.isNullOrBlank(functionToCheck) && getType.toString.call(functionToCheck) === '[object Function]';
};
Common.utils.logger = function(obj){
    console.log(obj);
};
Common.utils.showFlashMessage = function(options) {
    $('#flagMessage').showFlashMessage(options);
};
Common.utils.reviewImage = function(input, container) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#' + container).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
         $('#' + container).attr('src', '/browallia/web/images/no_image_available.jpg');
    }
};
Common.utils.isCurrentMonth = function(year, month, isBuddhist) {
    var now = new Date();
    if (isBuddhist) {
        year -= 543;
    }

    if (year == now.getFullYear() && month == (now.getMonth() + 1)) {
        return true;
    } else {
        return false;
    }
};
Common.utils.checkFileSize_OnChange = function(){
	var x = this;
	var size = 0;
	if ('files' in x) {
	    if (x.files.length == 0) {
	    } else {
	    	size = x.files[0].size;
	    }
	}
	
	if(size>5242880){ //5MB -> Byte
		alert('ไฟล์มีขนาดใหญ่เกินไป กรุณาเลือกไฟล์ที่มีขนาดไม่เกิน 5MB');
		jQuery(this).val('');
	}
	
}
/****************** End Common.utils *************************************************************************************************/


/****************** Common.ajax *************************************************************************************************/
Common.ajax = function(){};
Common.ajax.ajaxFileUpload = function(url, fileSelector, id, onSuccess){
    jQuery("#loading")
    .ajaxStart(function () {
        jQuery(this).show();
    })
    .ajaxComplete(function () {
        jQuery(this).hide();
    });

    jQuery.ajaxFileUpload
    (
        {
            url: url,
            secureuri: false,
            fileElementId: jQuery(fileSelector).attr('id'),
            dataType: 'json',
            data: {id:id},
            success: function (data, status) {

                if (typeof (data.success) != 'undefined') {
                    if (data.success == true) {
                    	//console.log(t);
                    	onSuccess(data);
                        return;
                    } else {
                        Common.utils.showFlashMessage({
                            text: 'บันทึกข้อมูลสำเร็จ',
                            className: 'success'
                        });
                    }
                }
                else {
                    return alert('(1)Failed to upload logo!');
                    // Common.utils.showFlashMessage({
                    //     text: '(1)Failed to upload logo!',
                    //     className: 'error'
                    // });
                    // return;
                }
            },
            error: function (data, status, e) {
                return alert('(2)Failed to upload logo!');
                // Common.utils.showFlashMessage({
                //     text: '(2)Failed to upload logo!',
                //     className: 'error'
                // });
                // return;
            }
        }
    );
};
Common.ajax.ajaxFileUploadCustomParams = function(options){
    $fileInput = $(options.fileSelector);
    if (Common.utils.isNullOrBlank($fileInput.val())) {
        return BootstrapDialog.alert('กรุณาเลือกไฟล์');
    }

    jQuery("#loading")
    .ajaxStart(function () {
        jQuery(this).show();
    })
    .ajaxComplete(function () {
        jQuery(this).hide();
    });

    jQuery.ajaxFileUpload(
    {
        url: options.url,
        secureuri: false,
        fileElementId: $fileInput.attr('id'),
        dataType: 'json',
        data: options.params,
        success: function (data, status) {
            if (typeof options.onSuccess == 'function') {
                options.onSuccess(data, status);
                return;
            } else {
                if (typeof (data.success) != 'undefined') {
                    if (data.success == true) {
                        return BootstrapDialog.alert('Completed to upload logo!');  
                    } else {
                        return BootstrapDialog.alert('Failed to upload logo!');
                    }
                } else {
                    return BootstrapDialog.alert('(1)Failed to upload logo!');
                }
            }
        },
        error: function (data, status, e) {
            if (typeof options.onError == 'function') {
                options.onError(data, status, e);
                return;
            } else {
                return BootstrapDialog.alert('(2)Failed to upload logo!');
            }
        }
    });
}
Common.ajax.onChangeProvince = function(t, elm_name_amphoe, amphoe_id){
	var province_id=t.value;
    var data = {province : province_id};
    var jElm = jQuery('select[name="'+elm_name_amphoe+'"]');
    
    var initialOptions = '<option value="">กรุณาเลือก</option>';
    if(!Common.utils.isNullOrBlank(amphoe_id)){
    	initialOptions = '';
    }
    
    if(province_id!=''){
        jQuery.post(APP.ajaxAction.getAmphoe, data, function(data){
            //on ajax success.
            jElm.find('option').remove();
        	jElm.append(initialOptions);
            jQuery.each(data, function(i, row){
                jElm.append('<option value="'+row.AMPHOE_CODE+'">'+row.AMPHOE_NAME_TH+'</option>');
            });
            jElm.change();
        }, 'json');
    }else{
    	jElm.find('option').remove();
    	jElm.change();
    }
}
/****************** Common.ajax *************************************************************************************************/


/****************** Common.Base64 *************************************************************************************************/
Common.Base64 = function(){};
Common.Base64.encode = function(input) {
     var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
     input = escape(input);
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) {
           enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
           enc4 = 64;
        }

        output = output +
           keyStr.charAt(enc1) +
           keyStr.charAt(enc2) +
           keyStr.charAt(enc3) +
           keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
     } while (i < input.length);

     return output;
  };

Common.Base64.decode = function(input) {
     var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
     var base64test = /[^A-Za-z0-9\+\/\=]/g;
     if (base64test.exec(input)) {
        /*alert("There were invalid base64 characters in the input text.\n" +
              "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
              "Expect errors in decoding.");*/
        return;
     }
     input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

     do {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 != 64) {
           output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
           output = output + String.fromCharCode(chr3);
        }

        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";

     } while (i < input.length);

     return unescape(output);
  };
/****************** End of Common.Base64 *************************************************************************************************/