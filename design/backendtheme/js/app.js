var app = {
		
	formAddPath: WWW_DIR_JAVASCRIPT,	
	
	protectCSFR : function() {
		
    	$('a.csfr-required').click(function(){
    		var inst = $(this);    		
    		if (!inst.attr('data-secured')){
        		inst.attr('href',inst.attr('href')+'/(csfr)/'+WWW_CSRF);
        		inst.attr('data-secured',1);
        	}
    	});
    	
    },
    
    init_module_policy_selection : function() {
    	
    	$( "#ModuleSelectedID" ).change( function () { 
    		var module_val = $( "#ModuleSelectedID" ).val();
    		if (module_val != '*'){
    			$.getJSON(WWW_DIR_JAVASCRIPT + 'permission/modulefunctions/' + module_val ,{ }, function(data){ 
    				if (data.error == 'false') {	 
    					$( "#ModuleFunctionsID" ).html(data.result);
    				}		
    			});
    		} else {
    			$( "#ModuleFunctionsID" ).html( '<select name="ModuleFunction" ><option value="*">All functions></option></select>');
    		}
    	});
    },
    
    eventizer_news : function() {
    	$.getJSON(WWW_DIR_JAVASCRIPT + 'ajax/eventizernews/' ,{ }, function(data){ 
    		if (data.error === false) {	 
    			$( "#eventizer_news" ).html(data.result);
    		}		
    	});
    },
    
    editor : function() {
    	$('.editor').wysihtml5();
    },
    
    ckeditor : function(id) {
    	CKEDITOR.replace(id);
    },
    
    datepicker : function(id) {
    	 $("#"+id).datepicker({format: "dd/mm/yyyy", autoclose: true});
    },
    

};