
var _lactq = _lactq || [];
var functionMap = {
	'init_protectCSFR': app.protectCSFR,
	'init_modulePolicySelection': app.init_module_policy_selection,
	'init_single_page_map': app.single_page_map,
	'init_front_page_map': app.front_page_map,
};

$(document).ready(function() {      
    $.each(_lactq, function(index, value) {
        functionMap[value.f].apply(app,value.a);       
    });   
});