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
    
    generateEmbedCode : function (default_site_access, host){
        var siteAccess = $('#LocaleID').val() == default_site_access ? '' : $('#LocaleID').val();

        var width = $('#id_widget_width').val() != '' ? 'widget_width:\''+$('#id_widget_width').val()+'\'' : '';
        
        
        var tag ='<!-- Place this tag where you want the Live Helper Status to render. -->'+"\n"+'<div id="widget_container" ></div>';
     
        var script = tag+"\n\n"+'<script type="text/javascript">'+"\n"+"var eventWidget = {};\n"+
          'eventWidget.opt = {'+width+'};\n'+
          '(function() {'+"\n"+
            'var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;'+"\n"+
            'po.src = \''+$('#HttpMode').val()+'//'+host+siteAccess+'event/widget\''+"\n"+
            'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);'+"\n"+
          '})();'+"\n"+
        '</scr'+'ipt>';

        $('#HMLTContent').text(script);
    },

    widgetEmbedCode : function (default_site_access, host){
	    $('#LocaleID,#HttpMode,#id_widget_width').change(function(){
	        app.generateEmbedCode(default_site_access, host);
	    });
	    app.generateEmbedCode(default_site_access, host);
    }
    

};