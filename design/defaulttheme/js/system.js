
var _lactq = _lactq || [];
var functionMap = {
	'init_protectCSFR': app.protectCSFR,
	'init_modulePolicySelection': app.init_module_policy_selection
};

$(document).ready(function() {      
    $.each(_lactq, function(index, value) {
        functionMap[value.f].apply(app,value.a);       
    });   
});