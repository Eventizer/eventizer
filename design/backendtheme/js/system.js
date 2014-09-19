
var _lactq = _lactq || [];
var functionMap = {
	'init_protectCSFR': app.protectCSFR,
	'init_modulePolicySelection': app.init_module_policy_selection,
	'eventizer_news': app.eventizer_news,
	'editor': app.editor,
	'ckeditor': app.ckeditor,
	'datepicker': app.datepicker,
};

$(document).ready(function() {      
    $.each(_lactq, function(index, value) {
        functionMap[value.f].apply(app,value.a);       
    }); 
    
    $('.modal_reload').on('hidden.bs.modal', function() {
    	
	  $(this).removeData('bs.modal');
	 });
});